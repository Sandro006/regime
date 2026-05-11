<?php

namespace App\Controllers;

use App\Models\ActiviteSportiveModel;
use App\Models\RegimeModel;
use App\Models\ObjectifModel;
use App\Models\UtilisateurObjectifModel;

class Home extends BaseController
{
    protected $activiteModel;
    protected $regimeModel;
    protected $objectifModel;
    protected $utilisateurObjectifModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteSportiveModel();
        $this->regimeModel = new RegimeModel();
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
    }

    public function index(): string
    {
        // Vérifier si l'utilisateur est connecté
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        
        // Récupérer les activités sportives
        $activites = $this->activiteModel->getAllActivites();
        
        // Récupérer tous les régimes
        $allRegimes = $this->regimeModel->getAllRegimes();
        
        // Tableau des régimes recommandés
        $recommendedRegimes = [];
        $userObjectif = null;
        
        if ($isLoggedIn) {
            $user = $session->get('user');
            $userId = $user['id'];
            
            // Récupérer l'objectif de l'utilisateur
            $userObjectif = $this->objectifModel->getUserObjectif($userId);
            
            if ($userObjectif) {
                // Filtrer les régimes selon l'objectif
                $objectifText = strtolower($userObjectif['objectif']);
                
                if (strpos($objectifText, 'perdre') !== false || 
                    strpos($objectifText, 'réduire') !== false || 
                    strpos($objectifText, 'perte') !== false) {
                    // Objectif: Perdre du poids -> Régimes avec variation_poids < 0
                    $recommendedRegimes = array_filter($allRegimes, function($regime) {
                        return $regime['variation_poids'] < 0;
                    });
                } elseif (strpos($objectifText, 'gagner') !== false || 
                          strpos($objectifText, 'augmenter') !== false ||
                          strpos($objectifText, 'prise') !== false) {
                    // Objectif: Gagner du poids -> Régimes avec variation_poids > 0
                    $recommendedRegimes = array_filter($allRegimes, function($regime) {
                        return $regime['variation_poids'] > 0;
                    });
                } else {
                    // Objectif: IMC idéal ou autre -> Régimes équilibrés
                    $recommendedRegimes = array_filter($allRegimes, function($regime) {
                        return $regime['variation_poids'] >= -2 && $regime['variation_poids'] <= 2;
                    });
                    if (empty($recommendedRegimes)) {
                        $recommendedRegimes = $allRegimes;
                    }
                }
                
                // Réindexer le tableau après filtrage
                $recommendedRegimes = array_values($recommendedRegimes);
            }
        }
        
        // Si aucun régime recommandé ou utilisateur non connecté, prendre les 4 premiers régimes par défaut
        if (empty($recommendedRegimes)) {
            $recommendedRegimes = array_slice($allRegimes, 0, 4);
        }
        
        return view('accueil/index', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $isLoggedIn ? $session->get('user') : null,
            'activites' => $activites,
            'allRegimes' => $allRegimes,
            'recommendedRegimes' => $recommendedRegimes,
            'userObjectif' => $userObjectif
        ]);
    }
}