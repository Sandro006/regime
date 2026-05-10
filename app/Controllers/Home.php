<?php

namespace App\Controllers;

use App\Models\UserModel;

class Home extends BaseController
{
    protected $userModel;

    public function __construct()
    {
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
        
        return view('accueil/index', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $userData
        ]);
    }
}
