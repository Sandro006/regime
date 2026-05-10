<?php

namespace App\Controllers;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $userModel;

    public function __construct(){
        $this->userModel = new UserModel();
    }
    public function Register(): string{
        // Charger les messages personnalisés
        $messagesFile = APPPATH . 'Config/Messages.json';
        $messages = [];
        
        if (file_exists($messagesFile)) {
            $messages = json_decode(file_get_contents($messagesFile), true)['auth']['register'] ?? [];
        }
        
        return view('auth/FrontOffice/register', ['messages' => json_encode($messages)]);
    }

    public function loginPage(): string
    {
        // Charger les messages personnalisés
        $messagesFile = APPPATH . 'Config/Messages.json';
        $messages = [];
        
        if (file_exists($messagesFile)) {
            $messages = json_decode(file_get_contents($messagesFile), true)['auth']['login'] ?? [];
        }
        
        return view('auth/BackOffice/login', ['messages' => json_encode($messages)]);
    }

    /**
     * Authentifier l'utilisateur
     */
    public function authenticate()
    {
        // Récupérer les données JSON
        $json = $this->request->getJSON();
        $email = $json->email ?? $this->request->getPost('email');
        $password = $json->password ?? $this->request->getPost('password');

        // Chercher l'utilisateur
        $user = $this->userModel->where('email', $email)->first();

        if (!$user || !password_verify($password, $user['password'])) {
            return $this->response->setStatusCode(401)->setJSON([
                'success' => false,
                'message' => 'Email ou mot de passe incorrect'
            ]);
        }

        // Démarrer la session et stocker l'utilisateur
        $session = session();
        $session->set([
            'estConnecte' => true,
            'user_id' => $user['id'],
            'username' => $user['username'],
            'email' => $user['email'],
            'gender' => $user['gender'],
            'taille' => $user['taille'],
            'poids' => $user['poids'],
            'solde' => $user['solde'],
            'gold' => $user['gold']
        ]);

        return $this->response->setStatusCode(200)->setJSON([
            'success' => true,
            'message' => 'Connexion réussie',
            'redirect' => '/accueil'
        ]);
    }

    /**
     * Afficher la page d'accueil
     */
    public function accueil()
    {
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login');
        }

        $data = [
            'user' => [
                'username' => $session->get('username'),
                'email' => $session->get('email'),
                'gender' => $session->get('gender'),
                'taille' => $session->get('taille'),
                'poids' => $session->get('poids'),
                'solde' => $session->get('solde'),
                'gold' => $session->get('gold')
            ]
        ];

        return view('accueil/index', $data);
    }

    /**
     * Déconnecter l'utilisateur
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/');
    }

    /**
     * Traiter l'enregistrement d'un nouvel utilisateur
     */
    public function store(){
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

    public function login(){
        return view('auth/FrontOffice/login');
    }
public function doLogin(){
        // Récupérer les champs email et password
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');
        
        // Est-ce une requête AJAX ?
        $isAjax = $this->request->isAJAX();

        // Valider que les champs ne sont pas vides
        if (empty($email) || empty($password)) {
            if ($isAjax) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Email et mot de passe requis'
                ]);
            }
            return redirect()->back()->with('error', 'Email et mot de passe requis');
        }
        
        // Valider le format email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            if ($isAjax) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Format d\'email invalide'
                ]);
            }
            return redirect()->back()->with('error', 'Email invalide');
        }
        
        // Tenter la connexion
        $user = $this->userModel->login($email, $password);
        
        if ($user) {
            // Démarrer la session
            $sessionData = [
                'estConnecte' => true,
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'gender' => $user['gender'],
                    'gold' => $user['gold']
                ]
            ];
            
            session()->set($sessionData);
            
            if ($isAjax) {
                return $this->response->setStatusCode(200)->setJSON([
                    'success' => true,
                    'message' => 'Connexion réussie ! Redirection...',
                    'redirect' => '/'
                ]);
            }
            
            // Rediriger vers le tableau de bord (Fallback non-AJAX)
            return redirect()->to('/')->with('success', 'Bienvenue ' . $user['username'] . ' !');
        } else {
            if ($isAjax) {
                return $this->response->setStatusCode(401)->setJSON([
                    'success' => false,
                    'message' => 'Email ou mot de passe incorrect'
                ]);
            }
            return redirect()->back()->with('error', 'Email ou mot de passe incorrect');
        }
    }

     /**
     * Déconnexion
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login')->with('success', 'Vous êtes déconnecté');
    }

}

