<?php

namespace App\Controllers;

use App\Models\ActiviteSportiveModel;
use App\Models\RegimeModel;
use App\Models\ObjectifModel;
use App\Models\UtilisateurObjectifModel;
use App\Models\HistoryModel; // Ajoutez HistoryModel

class Home extends BaseController
{
    protected $activiteModel;
    protected $regimeModel;
    protected $objectifModel;
    protected $utilisateurObjectifModel;
    protected $historyModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteSportiveModel();
        $this->regimeModel = new RegimeModel();
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
        $this->historyModel = new HistoryModel(); // Initialiser HistoryModel
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
        
        // Variables pour la variation de poids
        $variationPoids = null;
        $variationTexte = '';
        $tendanceIcone = '';
        $tendanceCouleur = '';
        
        if ($isLoggedIn) {
            $user = $session->get('user');
            $userId = $user['id'];
            
            // Récupérer la variation de poids depuis l'historique
            $poidsVariation = $this->getPoidsVariationFromHistory($userId);
            if ($poidsVariation) {
                $variationPoids = $poidsVariation['variation'];
                $variationTexte = $poidsVariation['texte'];
                $tendanceIcone = $poidsVariation['icone'];
                $tendanceCouleur = $poidsVariation['couleur'];
                
                // Mettre à jour le poids actuel dans $user si disponible
                if (isset($poidsVariation['poids_actuel'])) {
                    $user['poids'] = $poidsVariation['poids_actuel'];
                    $session->set('user', $user);
                }
            }
            
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
            'userObjectif' => $userObjectif,
            'variationPoids' => $variationPoids,
            'variationTexte' => $variationTexte,
            'tendanceIcone' => $tendanceIcone,
            'tendanceCouleur' => $tendanceCouleur
        ]);
    }
    
    /**
     * Récupère la variation de poids depuis l'historique
     * @param int $userId
     * @return array|null
     */
private function getPoidsVariationFromHistory($userId)
{
    // Récupérer les 2 dernières entrées d'historique de poids
    $historique = $this->historyModel
        ->where('user_id', $userId)
        ->orderBy('created_at', 'DESC')  // Utilisez 'created_at' au lieu de 'date_creation'
        ->limit(2)
        ->find();
    
    if (count($historique) >= 2) {
        $poids_ancien = floatval($historique[1]['poids']);
        $poids_actuel = floatval($historique[0]['poids']);
        $variation = round($poids_actuel - $poids_ancien, 1);
        
        // Mettre à jour le poids actuel dans la session
        $session = session();
        $user = $session->get('user');
        if ($user) {
            $user['poids'] = $poids_actuel;
            $session->set('user', $user);
        }
        
        return [
            'variation' => $variation,
            'poids_ancien' => $poids_ancien,
            'poids_actuel' => $poids_actuel,
            'texte' => $this->formatVariationTexte($variation),
            'icone' => $variation < 0 ? 'trending_down' : ($variation > 0 ? 'trending_up' : 'trending_flat'),
            'couleur' => $variation < 0 ? 'text-green-600' : ($variation > 0 ? 'text-red-500' : 'text-gray-500')
        ];
    } elseif (count($historique) == 1) {
        // Une seule entrée, pas de comparaison possible
        return [
            'variation' => 0,
            'poids_actuel' => floatval($historique[0]['poids']),
            'texte' => 'Première mesure',
            'icone' => 'info',
            'couleur' => 'text-blue-500'
        ];
    }
    
    return null;
}

/**
 * Formate le texte de variation
 */
private function formatVariationTexte($variation)
{
    $absVariation = abs($variation);
    if ($variation < 0) {
        return "-{$absVariation}kg cette semaine";
    } elseif ($variation > 0) {
        return "+{$absVariation}kg cette semaine";
    }
    return "Stable cette semaine";
}
}