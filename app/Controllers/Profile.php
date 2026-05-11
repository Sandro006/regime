<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ObjectifModel;
use App\Models\UtilisateurObjectifModel;

class Profile extends BaseController{
    
    protected $userModel;
    protected $objectifModel;
    protected $utilisateurObjectifModel;

    public function __construct(){
        $this->userModel = new UserModel();
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
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
                    'message' => 'Profil mis à jour avec succès!'
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

    public function editObjectif(){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        $userId = $session->get('user')['id'];
        
        // Récupérer tous les objectifs
        $objectifs = $this->objectifModel->getAllObjectifs();
        
        // Récupérer l'objectif actuel de l'utilisateur
        $userObjectif = $this->utilisateurObjectifModel->where('user_id', $userId)->first();
        
        return view('profile/editObjectif', [
            'user' => $session->get('user'),
            'objectifs' => $objectifs,
            'currentObjectif' => $userObjectif ? $userObjectif['objectif_id'] : null
        ]);
    }

    public function doEditObjectif(){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        $userId = $session->get('user')['id'];
        $objectifId = $this->request->getPost('objectif_id');

        // Valider que l'objectif existe
        if (empty($objectifId) || !$this->objectifModel->find($objectifId)) {
            return redirect()->back()->with('error', 'Objectif invalide');
        }

        try {
            // Vérifier si l'utilisateur a déjà un objectif
            $existingObjectif = $this->utilisateurObjectifModel->where('user_id', $userId)->first();
            
            if ($existingObjectif) {
                // Mettre à jour l'objectif existant
                $this->utilisateurObjectifModel->update($existingObjectif['id'], [
                    'objectif_id' => $objectifId
                ]);
            } else {
                // Créer une nouvelle association
                $this->utilisateurObjectifModel->insert([
                    'user_id' => $userId,
                    'objectif_id' => $objectifId
                ]);
            }

            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(200)->setJSON([
                    'success' => true,
                    'message' => 'Objectif mis à jour avec succès!'
                ]);
            }
            
            return redirect()->to('/profile')->with('success', 'Objectif mis à jour avec succès!');
        } catch (\Exception $e) {
            if ($this->request->isAJAX()) {
                return $this->response->setStatusCode(500)->setJSON([
                    'success' => false,
                    'message' => 'Erreur lors de la mise à jour de l\'objectif',
                    'error' => $e->getMessage()
                ]);
            }
            
            return redirect()->back()->with('error', 'Une erreur est survenue lors de la mise à jour');
        }
    }

}