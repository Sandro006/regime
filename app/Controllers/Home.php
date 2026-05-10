<?php

namespace App\Controllers;

<<<<<<< Updated upstream
=======
use App\Models\ActiviteSportiveModel;
>>>>>>> Stashed changes
use App\Models\UserModel;

class Home extends BaseController
{
<<<<<<< Updated upstream
=======
    protected $activiteModel;
>>>>>>> Stashed changes
    protected $userModel;

    public function __construct()
    {
<<<<<<< Updated upstream
=======
        $this->activiteModel = new ActiviteSportiveModel();
>>>>>>> Stashed changes
        $this->userModel = new UserModel();
    }

    public function index(): string
    {
        // Vérifier si l'utilisateur est connecté
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        
        $userData = null;
        if ($isLoggedIn) {
            $userData = $session->get('user');
            
            // Calculer l'IMC s'il existe une taille et un poids
            if ($userData && isset($userData['taille']) && isset($userData['poids'])) {
                $imc = $this->userModel->calculateIMC($userData['poids'], $userData['taille']);
                $userData['bmi'] = $imc['valeur'];
                $userData['bmi_categorie'] = $imc['categorie'];
            }
        }
        
        // Récupérer les données utilisateur avec IMC calculé
        $userData = null;
        if ($isLoggedIn) {
            $userData = $session->get('user');
            
            // Calculer l'IMC s'il existe une taille et un poids
            if ($userData && isset($userData['taille']) && isset($userData['poids'])) {
                $imc = $this->userModel->calculateIMC($userData['poids'], $userData['taille']);
                $userData['bmi'] = $imc['valeur'];
                $userData['bmi_categorie'] = $imc['categorie'];
            }
        }
        
        return view('accueil/index', [
            'isLoggedIn' => $isLoggedIn,
<<<<<<< Updated upstream
            'user' => $userData
=======
            'user' => $userData,
            'activites' => $activites
>>>>>>> Stashed changes
        ]);
    }
}
