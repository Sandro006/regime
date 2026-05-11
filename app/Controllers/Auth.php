<?php

namespace App\Controllers;
use App\Models\UserModel;
use App\Models\ObjectifModel;
use App\Models\UtilisateurObjectifModel;
use App\Models\TransactionModel;
use App\Models\CodePortefeuilleModel;

class Auth extends BaseController
{
    protected $userModel;
    protected $objectifModel;
    protected $utilisateurObjectifModel;
    protected $transactionModel;
    protected $codePortefeuilleModel;

    public function __construct(){
        $this->userModel = new UserModel();
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
        $this->transactionModel = new TransactionModel();
        $this->codePortefeuilleModel = new CodePortefeuilleModel();
    }
    public function Register(): string{
        // Récupérer les objectifs de la base de données
        $objectifs = $this->objectifModel->getAllObjectifs();
        
        return view('auth/FrontOffice/register', ['objectifs' => $objectifs]);
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

        // Récupérer l'objectif sélectionné
        $objectifId = $this->request->getPost('objectif_id');

        // Valider les données
        if (!$this->userModel->validate($data)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Données invalides',
                'errors' => $this->userModel->errors()
            ]);
        }

        // Valider que l'objectif est sélectionné
        if (empty($objectifId)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Veuillez sélectionner un objectif'
            ]);
        }

        // Vérifier que l'email n'existe pas déjà
        if ($this->userModel->where('email', $data['email'])->first()) {
            return $this->response->setStatusCode(409)->setJSON([
                'success' => false,
                'message' => 'Cet email est déjà utilisé'
            ]);
        }

        // Vérifier que l'objectif existe
        if (!$this->objectifModel->find($objectifId)) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Objectif invalide'
            ]);
        }

        // Enregistrer l'utilisateur
        try {
            $userId = $this->userModel->insert($data);
            
            // Récupérer l'utilisateur nouvellement créé
            $user = $this->userModel->find($userId);
            
            // Enregistrer l'association utilisateur-objectif
            $this->utilisateurObjectifModel->insert([
                'user_id' => $userId,
                'objectif_id' => $objectifId
            ]);
            
            // Créer une transaction d'enregistrement
            $this->transactionModel->insert([
                'utilisateur_id' => $userId,
                'type' => 'Inscription',
                'montant' => 0,
                'date_transaction' => date('Y-m-d H:i:s'),
                'description' => 'Inscription au programme VitalFit'
            ]);
            
            // Calcul du BMI
            $bmi = round($user['poids'] / ($user['taille'] ** 2), 1);
            
            // Stocker l'utilisateur en session
            $session = session();
            $session->set([
                'estConnecte' => true,
                'user' => [
                    'id' => $user['id'],
                    'username' => $user['username'],
                    'email' => $user['email'],
                    'gender' => $user['gender'],
                    'taille' => $user['taille'],
                    'poids' => $user['poids'],
                    'solde' => $user['solde'],
                    'gold' => $user['gold'],
                    'bmi' => $bmi
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
            // Calcul du BMI
            $bmi = round($user['poids'] / ($user['taille'] ** 2), 1);
            
            $sessionData = [
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

