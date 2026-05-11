<?php

namespace App\Controllers;

use App\Models\ActiviteSportiveModel;
use App\Models\RegimeModel;

class Home extends BaseController
{
    protected $activiteModel;
    protected $regimeModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteSportiveModel();
        $this->regimeModel = new RegimeModel();
    }

    public function index(): string
    {
        // Vérifier si l'utilisateur est connecté
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        
        // Récupérer les activités sportives
        $activites = $this->activiteModel->getAllActivites();
        $regimes = $this->regimeModel->getAllRegimes();
        
        return view('accueil/index', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $isLoggedIn ? $session->get('user') : null,
            'activites' => $activites,
            'regimes' => $regimes
        ]);
    }
}
