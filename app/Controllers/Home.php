<?php

namespace App\Controllers;

use App\Models\ActiviteSportiveModel;

class Home extends BaseController
{
    protected $activiteModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteSportiveModel();
    }

    public function index(): string
    {
        // Vérifier si l'utilisateur est connecté
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        
        // Récupérer les activités sportives
        $activites = $this->activiteModel->getAllActivites();
        
        return view('accueil/index', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $isLoggedIn ? $session->get('user') : null,
            'activites' => $activites
        ]);
    }


}
