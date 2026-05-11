<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RegimeModel;
use App\Models\UtilisateurRegimeModel;
use App\Models\AchatsRegimeModel;
use App\Models\TransactionModel;
use App\Models\RegimeActiviteModel;
use App\Models\AbonnementModel;
use App\Models\ParametreModel;
use App\Models\UtilisateurObjectifModel;
use App\Models\ObjectifModel;

class Achat extends BaseController
{
    protected $userModel;
    protected $regimeModel;
    protected $utilisateurRegimeModel;
    protected $achatsRegimeModel;
    protected $transactionModel;
    protected $regimeActiviteModel;
    protected $abonnementModel;
    protected $parametreModel;
    protected $utilisateurObjectifModel;
    protected $objectifModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->regimeModel = new RegimeModel();
        $this->utilisateurRegimeModel = new UtilisateurRegimeModel();
        $this->achatsRegimeModel = new AchatsRegimeModel();
        $this->transactionModel = new TransactionModel();
        $this->regimeActiviteModel = new RegimeActiviteModel();
        $this->abonnementModel = new AbonnementModel();
        $this->parametreModel = new ParametreModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
        $this->objectifModel = new ObjectifModel();
    }

    /**
     * Traiter l'achat d'un régime
     * @param int $regimeId
     */
    public function acheterRegime($regimeId)
    {
        // Vérifier session utilisateur
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        $user = $session->get('user');
        $userId = $user['id'] ?? null;

        if (!$isLoggedIn || !$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        // Récupérer l'utilisateur complet
        $userData = $this->userModel->find($userId);
        if (!$userData) {
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }

        // Récupérer le régime
        $regime = $this->regimeModel->find($regimeId);
        if (!$regime) {
            return redirect()->to('/regime')->with('error', 'Régime non trouvé');
        }

        // Récupérer l'objectif de l'utilisateur pour sélectionner l'activité appropriée
        $userObjectif = null;
        $userAssociations = $this->utilisateurObjectifModel->getAssociationsByUser($userId);
        
        if (!empty($userAssociations)) {
            $objectif = $this->objectifModel->find($userAssociations[0]['objectif_id']);
            $userObjectif = $objectif['objectif'] ?? null;
        }

        // Sélectionner l'activité appropriée selon l'objectif
        $regimeActivite = $this->regimeActiviteModel->getActivityByRegimeAndObjectif($regimeId, $userObjectif);
        
        if (!$regimeActivite) {
            return redirect()->to('/regime/detail/' . $regimeId)
                            ->with('error', 'Erreur: aucune activité disponible pour ce régime');
        }

        // Calculer le prix à payer
        $prixAPayer = (float) $regime['prix'];
        $remiseAppliquee = 0;
        $pourcentageRemise = 0;
        $typeAbonnement = null;

        // Vérifier si l'utilisateur a un abonnement actif
        $abonnement = $this->abonnementModel->getAbonnementActif($userId);
        
        if ($abonnement) {
            // Récupérer toutes les options d'abonnement pour déterminer le type
            $abonnementOptions = $this->parametreModel->getFormattedAbonnementOptions();
            
            foreach ($abonnementOptions as $plan_id => $plan) {
                if ($plan['prix'] == $abonnement['prix']) {
                    $typeAbonnement = $plan_id;
                    $pourcentageRemise = $plan['remise'];
                    break;
                }
            }
            
            // Appliquer la remise basée sur le pourcentage
            if ($pourcentageRemise > 0) {
                $remiseAppliquee = ($prixAPayer * $pourcentageRemise) / 100;
                $prixAPayer = $prixAPayer - $remiseAppliquee;
            }
        }

        // Vérifier si l'utilisateur a suffisamment de solde
        if ($userData['solde'] < $prixAPayer) {
            return redirect()->to('/regime/detail/' . $regimeId)
                            ->with('error', 'Solde insuffisant. Veuillez recharger votre portefeuille.');
        }

        // Vérifier si l'utilisateur a déjà acheté ce régime
        if ($this->achatsRegimeModel->hasUserPurchased($userId, $regimeId)) {
            return redirect()->to('/regime/detail/' . $regimeId)
                            ->with('error', 'Vous avez déjà acheté ce régime');
        }

        // Déduire du solde
        $nouveauSolde = $userData['solde'] - $prixAPayer;
        $this->userModel->update($userId, [
            'solde' => $nouveauSolde
        ]);

        // Enregistrer l'achat
        $dateAchat = date('Y-m-d H:i:s');
        $this->achatsRegimeModel->insert([
            'user_id' => $userId,
            'regime_id' => $regimeId,
            'prix_paye' => $prixAPayer,
            'date_achat' => $dateAchat
        ]);

        // Créer l'enregistrement régime utilisateur (actif)
        // Utiliser timestamp complet pour date_fin (date_debut utilise DEFAULT current_timestamp)
        $dateFin = date('Y-m-d H:i:s', strtotime('+' . $regime['duree'] . ' days'));

        $insertResult = $this->utilisateurRegimeModel->insert([
            'user_id' => $userId,
            'regime_activite_id' => $regimeActivite['id'],
            'date_fin' => $dateFin
        ]);

        if (!$insertResult) {
            $error = $this->utilisateurRegimeModel->errors();
            \log_message('error', 'Erreur insertion utilisateurs_regimes: ' . json_encode($error));
            return redirect()->to('/regime/detail/' . $regimeId)
                            ->with('error', 'Erreur lors de la création du régime utilisateur: ' . implode(', ', $error ?? []));
        }

        // Enregistrer la transaction
        $description = 'Achat du régime: ' . $regime['nom_regime'];
        if ($remiseAppliquee > 0) {
            $description .= ' (Remise ' . ucfirst($typeAbonnement) . ' ' . $pourcentageRemise . '%: -' . number_format($remiseAppliquee, 2) . ' Ar)';
        }
        
        $this->transactionModel->insert([
            'utilisateur_id' => $userId,
            'type' => 'Achat',
            'montant' => $prixAPayer,
            'date_transaction' => $dateAchat,
            'description' => $description
        ]);

        // Rediriger vers mes régimes avec message succès
        $message = 'Régime acheté avec succès! Vous avez dépensé ' . number_format($prixAPayer, 2) . ' Ar. ';
        if ($remiseAppliquee > 0) {
            $message .= 'Remise ' . ucfirst($typeAbonnement) . ' ' . $pourcentageRemise . '% appliquée: -' . number_format($remiseAppliquee, 2) . ' Ar';
        }

        return redirect()->to('/achat/mesRegimes')
                        ->with('success', $message);
    }

    /**
     * Afficher les régimes actifs de l'utilisateur
     */
    public function mesRegimes()
    {
        // Vérifier session utilisateur
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        $user = $session->get('user');
        $userId = $user['id'] ?? null;

        if (!$isLoggedIn || !$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        // Récupérer l'utilisateur complet
        $userData = $this->userModel->find($userId);
        if (!$userData) {
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }

        // Récupérer les régimes actifs avec détails - DEBUG
        $db = \Config\Database::connect();
        $regimes = $db->query("
            SELECT 
                ur.id as utilisateur_regime_id,
                ur.user_id,
                ur.date_debut,
                ur.date_fin,
                r.id as regime_id,
                r.nom_regime,
                r.description,
                r.prix,
                r.duree,
                a.nom_activite
            FROM utilisateurs_regimes ur
            INNER JOIN regime_activite ra ON ra.id = ur.regime_activite_id
            INNER JOIN regimes r ON r.id = ra.regime_id
            INNER JOIN activites_sportives a ON a.id = ra.activite_id
            WHERE ur.user_id = ?
            ORDER BY ur.date_debut DESC
        ", [$userId])->getResultArray();

        // Récupérer les statistiques
        $stats = $db->query("
            SELECT 
                COUNT(*) as total_regimes,
                COUNT(CASE WHEN ur.date_fin > NOW() THEN 1 END) as regimes_actifs,
                COUNT(CASE WHEN ur.date_fin <= NOW() THEN 1 END) as regimes_termines
            FROM utilisateurs_regimes ur
            WHERE ur.user_id = ?
        ", [$userId])->getRowArray();

        $data = [
            'user' => $userData,
            'regimes' => $regimes ?? [],
            'stats' => $stats
        ];

        return view('achat/mes_regimes', $data);
    }

    /**
     * Marquer un régime comme complété
     */
    public function completerRegime($regimeUtilisateurId)
    {
        // Vérifier session utilisateur
        $user = session()->get('user');
        $userId = $user['id'] ?? null;

        if (!$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        // Vérifier que le régime appartient à l'utilisateur
        $regimeUtilisateur = $this->utilisateurRegimeModel->find($regimeUtilisateurId);
        if (!$regimeUtilisateur || $regimeUtilisateur['user_id'] != $userId) {
            return redirect()->to('/achat/mesRegimes')->with('error', 'Régime non trouvé');
        }

        // Marquer comme complété
        $this->utilisateurRegimeModel->completeRegime($regimeUtilisateurId);

        return redirect()->to('/achat/mesRegimes')
                        ->with('success', 'Régime marqué comme complété!');
    }

    /**
     * Exporter les régimes en PDF
     */
    public function exportRegimesPDF()
    {
        // Vérifier session utilisateur
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        $user = $session->get('user');
        $userId = $user['id'] ?? null;

        if (!$isLoggedIn || !$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        // Récupérer l'utilisateur complet
        $userData = $this->userModel->find($userId);
        if (!$userData) {
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }

        // Récupérer les régimes de l'utilisateur avec activités
        $db = \Config\Database::connect();
        $regimes = $db->query("
            SELECT 
                ur.id as utilisateur_regime_id,
                ur.date_debut,
                ur.date_fin,
                ur.regime_activite_id,
                r.id,
                r.nom_regime,
                r.prix,
                r.duree,
                a.nom_activite
            FROM utilisateurs_regimes ur
            INNER JOIN regime_activite ra ON ra.id = ur.regime_activite_id
            INNER JOIN regimes r ON r.id = ra.regime_id
            INNER JOIN activites_sportives a ON a.id = ra.activite_id
            WHERE ur.user_id = ?
            ORDER BY ur.date_debut DESC
        ", [$userId])->getResultArray();

        // Récupérer les statistiques
        $stats = $db->query("
            SELECT 
                COUNT(*) as total_regimes,
                COUNT(CASE WHEN ur.date_fin > NOW() THEN 1 END) as regimes_actifs,
                COUNT(CASE WHEN ur.date_fin <= NOW() THEN 1 END) as regimes_termines
            FROM utilisateurs_regimes ur
            WHERE ur.user_id = ?
        ", [$userId])->getRowArray();

        // Préparer les données pour la vue
        $data = [
            'user' => $userData,
            'regimes' => $regimes ?? [],
            'stats' => $stats
        ];

        // Générer le HTML
        $html = view('achat/pdf_regimes', $data);

        // Vérifier si Dompdf est disponible
        if (!class_exists('Dompdf\Dompdf')) {
            return redirect()->back()->with('error', 'La bibliothèque PDF n\'est pas installée. Veuillez contacter l\'administrateur.');
        }

        try {
            // Créer une instance de Dompdf
            $dompdf = new \Dompdf\Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Télécharger le PDF
            $dompdf->stream('Mes_Regimes_' . date('Y-m-d') . '.pdf', ['Attachment' => 0]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de la génération du PDF: ' . $e->getMessage());
        }
    }
}
