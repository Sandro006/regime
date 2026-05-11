<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\RegimeModel;
use App\Models\UtilisateurRegimeModel;
use App\Models\AchatsRegimeModel;
use App\Models\TransactionModel;
use App\Models\RegimeActiviteModel;

class Achat extends BaseController
{
    protected $userModel;
    protected $regimeModel;
    protected $utilisateurRegimeModel;
    protected $achatsRegimeModel;
    protected $transactionModel;
    protected $regimeActiviteModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->regimeModel = new RegimeModel();
        $this->utilisateurRegimeModel = new UtilisateurRegimeModel();
        $this->achatsRegimeModel = new AchatsRegimeModel();
        $this->transactionModel = new TransactionModel();
        $this->regimeActiviteModel = new RegimeActiviteModel();
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

        // Vérifier que regime_activite existe
        $regimeActivite = $this->regimeActiviteModel->getFirstByRegimeId($regimeId);
        if (!$regimeActivite) {
            return redirect()->to('/regime/detail/' . $regimeId)
                            ->with('error', 'Erreur: ce régime n\'est pas configuré correctement');
        }

        // Calculer le prix à payer
        $prixAPayer = (float) $regime['prix'];
        $remiseAppliquee = 0;

        // Appliquer remise Gold si utilisateur a le statut
        if ($userData['gold']) {
            $remiseAppliquee = $prixAPayer * 0.15; // 15% de remise
            $prixAPayer = $prixAPayer - $remiseAppliquee;
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
        $this->transactionModel->insert([
            'utilisateur_id' => $userId,
            'type' => 'Achat',
            'montant' => $prixAPayer,
            'date_transaction' => $dateAchat,
            'description' => 'Achat du régime: ' . $regime['nom_regime'] . 
                           ($remiseAppliquee > 0 ? ' (Remise Gold: -' . number_format($remiseAppliquee, 2) . ' Ar)' : '')
        ]);

        // Rediriger vers mes régimes avec message succès
        $message = 'Régime acheté avec succès! Vous avez dépensé ' . number_format($prixAPayer, 2) . ' Ar. ';
        if ($remiseAppliquee > 0) {
            $message .= 'Remise Gold appliquée: -' . number_format($remiseAppliquee, 2) . ' Ar';
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
}
