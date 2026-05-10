<?php

namespace App\Controllers;

use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }
    public function Register(): string
    {
        // Charger les messages personnalisés
        $messagesFile = APPPATH . 'Config/Messages.json';
        $messages = [];
        
        if (file_exists($messagesFile)) {
            $messages = json_decode(file_get_contents($messagesFile), true)['auth']['register'] ?? [];
        }
        
        return view('auth/FrontOffice/register', ['messages' => json_encode($messages)]);
    }

    /**
     * Traiter l'enregistrement d'un nouvel utilisateur
     */
    public function store()
    {
        // Récupérer les données du formulaire
        $data = [
            'username' => $this->request->getPost('full_name'),
            'email' => $this->request->getPost('email'),
            'password' => password_hash($this->request->getPost('password'), PASSWORD_DEFAULT),
            'gender' => $this->request->getPost('gender'), // male ou female
            'taille' => $this->request->getPost('height') / 100, // Convertir cm -> m
            'poids' => $this->request->getPost('weight'),
            'solde' => 0,
            'gold' => 0
        ];

        // Valider les données
        if (!$this->userModel->validate($data)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Données invalides',
                'errors' => $this->userModel->errors()
            ]);
        }

        // Vérifier que l'email n'existe pas déjà
        if ($this->userModel->where('email', $data['email'])->first()) {
            return $this->response->setStatusCode(409)->setJSON([
                'success' => false,
                'message' => 'Cet email est déjà utilisé'
            ]);
        }

        // Enregistrer l'utilisateur
        try {
            $userId = $this->userModel->insert($data);
            
            // Récupérer l'utilisateur nouvellement créé
            $user = $this->userModel->find($userId);
            
            // Stocker l'utilisateur en session
            $session = session();
            $session->set([
                'estConnecte' => true,
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'gender' => $user['gender']
                ]
            ]);
            
            return $this->response->setStatusCode(201)->setJSON([
                'success' => true,
                'message' => 'Inscription réussie! Bienvenue sur VitalFit.',
                'userId' => $userId,
                'redirect' => '/'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Une erreur est survenue lors de l\'enregistrement',
                'error' => $e->getMessage()
            ]);
        }
    }
}
