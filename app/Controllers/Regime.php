<?php

namespace App\Controllers;

use App\Models\RegimeModel;
use App\Models\ObjectifModel;

class Regime extends BaseController
{
    protected $regimeModel;
    protected $objectifModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
        $this->objectifModel = new ObjectifModel();
    }

    /**
     * Lister tous les régimes
     */
    public function list()
    {
        $regimes = $this->regimeModel->getAllRegimes();
        
        return view('regime/list', [
            'regimes' => $regimes
        ]);
    }

    /**
     * Afficher les détails d'un régime
     */
    public function detail($id)
    {
        $regime = $this->regimeModel->getRegimeById($id);
        
        if (!$regime) {
            return redirect()->to('/regime/list')->with('error', 'Régime non trouvé');
        }

        return view('regime/detail', [
            'regime' => $regime
        ]);
    }

    /**
     * Afficher les régimes recommandés selon l'objectif de l'utilisateur
     */
    public function recommended()
    {
        $session = session();
        
        // Vérifier si l'utilisateur est connecté
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        $user = $session->get('user');
        $userId = $user['id'];

        // Récupérer l'objectif de l'utilisateur
        $userObjectif = $this->objectifModel->getUserObjectif($userId);
        
        if (!$userObjectif) {
            return redirect()->to('/objectif/list')->with('error', 'Veuillez choisir un objectif');
        }

        $recommendedRegimes = [];

        // Recommandations selon l'objectif
        if (strpos(strtolower($userObjectif['objectif']), 'perd') !== false) {
            // Objectif: Perdre du poids -> Régimes avec variation_poids < 0
            $allRegimes = $this->regimeModel->getAllRegimes();
            $recommendedRegimes = array_filter($allRegimes, function($regime) {
                return $regime['variation_poids'] < 0;
            });
        } elseif (strpos(strtolower($userObjectif['objectif']), 'gagn') !== false || 
                  strpos(strtolower($userObjectif['objectif']), 'augment') !== false) {
            // Objectif: Gagner du poids -> Régimes avec variation_poids > 0
            $allRegimes = $this->regimeModel->getAllRegimes();
            $recommendedRegimes = array_filter($allRegimes, function($regime) {
                return $regime['variation_poids'] > 0;
            });
        } else {
            // Objectif: IMC idéal ou autre -> Tous les régimes
            $recommendedRegimes = $this->regimeModel->getAllRegimes();
        }

        return view('regime/recommended', [
            'objectif' => $userObjectif,
            'regimes' => $recommendedRegimes,
            'user' => $user
        ]);
    }
}
