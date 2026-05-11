<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ObjectifModel;
use App\Models\UtilisateurObjectifModel;

class Profile extends BaseController{
    
    protected $userModel;
    protected $objectifModel;
    protected $utilisateurObjectifModel;
    protected $historyModel;


    public function __construct(){
        $this->userModel = new UserModel();
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
        $this->historyModel = new \App\Models\HistoryModel();
    }

    public function index(){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        
        return view('profile/user', [
            'user' => $session->get('user')
        ]);
    }

    public function edit(){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        
        return view('profile/edit', [
            'user' => $session->get('user')
        ]);
    }
    public function doEdit(){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        $userId = $session->get('user')['id'];
        
        // Récupérer les données du formulaire
        $oldUser = $this->userModel->find($userId);
        $data = [
            'username' => $this->request->getPost('username'),
            'gender' => $this->request->getPost('gender'),
            'taille' => $this->request->getPost('taille') / 100, // Convertir cm -> m
            'poids' => $this->request->getPost('poids'),
        ];

        // Valider les données
        if (!$this->userModel->validate($data)) {
            return redirect()->back()->withInput()->with('errors', $this->userModel->errors());
        }

        // Mettre à jour l'utilisateur
        try {
            $this->userModel->update($userId, $data);
            
            // Récupérer l'utilisateur mis à jour
            $user = $this->userModel->find($userId);
            
            // Calculer le nouveau BMI
            $bmi = round($user['poids'] / ($user['taille'] ** 2), 1);
            
            // Enregistrer dans l'historique si les métriques ont changé
            if ($oldUser['poids'] != $user['poids'] || $oldUser['taille'] != $user['taille']) {
                $this->historyModel->insert([
                    'user_id' => $userId,
                    'poids' => $user['poids'],
                    'taille' => $user['taille'],
                    'bmi' => $bmi
                ]);
            }
            
            // Mettre à jour la session
            $session->set([
                'estConnecte' => true,
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'gender' => $user['gender'],
                    'gold' => $user['gold'],
                    'taille' => $user['taille'],
                    'poids' => $user['poids'],
                    'solde' => $user['solde'],
                    'bmi' => $bmi
                ]
            ]);
            
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(200)->setJSON([
                    'success' => true,
                    'message' => 'Profil mis à jour avec succès!',
                    'bmi' => $bmi
                ]);
            }
            
            return redirect()->to('/profile')->with('success', 'Profil mis à jour avec succès!');
        } catch (\Exception $e) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Erreur lors de la mise à jour du profil',
                    'error' => $e->getMessage()
                ]);
            }
            
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour');
        }
    }

    public function updateMetrics(){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        $userId = $session->get('user')['id'];
        
        $rules = [
            'type' => 'required|in_list[poids,taille]',
            'value' => 'required|numeric|greater_than[0]'
        ];
        
        if (!$this->validate($rules)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Données invalides',
                'errors' => $this->validator->getErrors()
            ]);
        }
        
        $type = $this->request->getPost('type');
        $value = $this->request->getPost('value');
        
        if ($type === 'taille') {
            $value = $value / 100; // Convertir cm -> m
        }
        
        $user = $this->userModel->find($userId);
        $updateData = [];
        
        if ($type === 'poids') {
            $updateData['poids'] = $value;
        } else {
            $updateData['taille'] = $value;
        }
        
        try {
            $this->userModel->update($userId, $updateData);
            
            // Mettre à jour l'utilisateur
            $updatedUser = $this->userModel->find($userId);
            $bmi = round($updatedUser['poids'] / ($updatedUser['taille'] ** 2), 1);
            
            // Enregistrer dans l'historique
            $this->historyModel->insert([
                'user_id' => $userId,
                'poids' => $updatedUser['poids'],
                'taille' => $updatedUser['taille'],
                'bmi' => $bmi
            ]);
            
            // Mettre à jour la session
            $session->set([
                'user' => [
                    'id' => $updatedUser['id'],
                    'username' => $updatedUser['username'],
                    'email' => $updatedUser['email'],
                    'gender' => $updatedUser['gender'],
                    'gold' => $updatedUser['gold'],
                    'taille' => $updatedUser['taille'],
                    'poids' => $updatedUser['poids'],
                    'solde' => $updatedUser['solde'],
                    'bmi' => $bmi
                ]
            ]);
            
            return $this->response->setStatusCode(200)->setJSON([
                'success' => true,
                'message' => ucfirst($type) . ' mis à jour avec succès!',
                'type' => $type,
                'value' => $type === 'taille' ? $value * 100 : $value,
                'bmi' => $bmi
            ]);
            
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Erreur lors de la mise à jour'
            ]);
        }
    }

    public function getHistory($userId = null){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Non autorisé'
            ]);
        }
        
        $userId = $userId ?? $session->get('user')['id'];
        
        if ($session->get('user')['id'] != $userId) {
            return $this->response->setStatusCode(403)->setJSON([
                'success' => false,
                'message' => 'Accès non autorisé'
            ]);
        }
        
        $days = $this->request->getGet('days') ?? 90;
        $history = $this->historyModel->getWeightTrend($userId, $days);
        
        $formattedHistory = [];
        foreach ($history as $record) {
            $formattedHistory[] = [
                'date' => $record['date'],
                'poids' => (float)$record['poids'],
                'taille' => (float)$record['taille'] * 100,
                'bmi' => (float)$record['bmi']
            ];
        }
        
        return $this->response->setStatusCode(200)->setJSON([
            'success' => true,
            'history' => $formattedHistory
        ]);
    }
     public function editObjectif()
    {
        $session = session();
        
        // Vérifier si l'utilisateur est connecté
        if (!$session->has('estConnecte') || !$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        
        $userId = $session->get('user')['id'];
        
        // Récupérer tous les objectifs disponibles
        $objectifs = $this->objectifModel->findAll();
        
        // Récupérer l'objectif actuel de l'utilisateur
        $currentObjectif = $this->utilisateurObjectifModel
            ->where('user_id', $userId)
            ->orderBy('date_choix', 'DESC')
            ->first();
        
        $currentObjectifId = $currentObjectif ? $currentObjectif['objectif_id'] : null;
        
        return view('profile/editObjectif', [
            'objectifs' => $objectifs,
            'currentObjectif' => $currentObjectifId
        ]);
    }

    /**
     * Traite la modification d'objectif
     */
    public function doEditObjectif()
    {
        $session = session();
        
        // Vérifier si l'utilisateur est connecté
        if (!$session->has('estConnecte') || !$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        
        $userId = $session->get('user')['id'];
        
        // Valider l'entrée
        $rules = [
            'objectif_id' => 'required|integer|is_not_unique[objectifs.id]'
        ];
        
        if (!$this->validate($rules)) {
            return redirect()->back()
                ->withInput()
                ->with('error', 'Veuillez sélectionner un objectif valide');
        }
        
        $objectifId = $this->request->getPost('objectif_id');
        
        // Vérifier si l'objectif existe
        $objectif = $this->objectifModel->find($objectifId);
        if (!$objectif) {
            return redirect()->back()
                ->with('error', 'Objectif non trouvé');
        }
        
        // Insérer le nouvel objectif dans l'historique
        $data = [
            'user_id' => $userId,
            'objectif_id' => $objectifId,
            'date_choix' => date('Y-m-d H:i:s')
        ];
        
        if ($this->utilisateurObjectifModel->insert($data)) {
            return redirect()->to('/profile')
                ->with('success', 'Objectif mis à jour avec succès : ' . $objectif['objectif']);
        } else {
            return redirect()->back()
                ->with('error', 'Erreur lors de la mise à jour de l\'objectif');
        }
    }
}