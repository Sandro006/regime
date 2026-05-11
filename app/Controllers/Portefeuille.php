<?php

namespace App\Controllers;

use App\Models\UserModel;
use App\Models\CodePortefeuilleModel;
use App\Models\TransactionModel;

class Portefeuille extends BaseController
{
    protected $userModel;
    protected $codeModel;
    protected $transactionModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->codeModel = new CodePortefeuilleModel();
        $this->transactionModel = new TransactionModel();
    }

    /**
     * Afficher le portefeuille: solde + historique transactions
     */
    public function index()
    {
        // Vérifier session utilisateur
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        $user = $session->get('user');
        $userId = $user['id'] ?? null;

        if (!$isLoggedIn || !$userId) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }

        // Récupérer utilisateur
        $user = $this->userModel->find($userId);
        if (!$user) {
            return view('portefeuille/index', [
                'error' => 'Utilisateur non trouvé'
            ]);
        }

        // Récupérer l'historique des transactions (50 dernières)
        $transactions = $this->transactionModel->getByUser($userId, 50);

        // Récupérer statistiques des transactions
        $stats = $this->transactionModel->getStatsByUser($userId);

        $data = [
            'user'         => $user,
            'transactions' => $transactions,
            'stats'        => $stats
        ];

        return view('portefeuille/index', $data);
    }

    /**
     * Afficher le formulaire de recharge avec code
     */
    public function recharger()
    {
        // Vérifier session utilisateur
        $user = session()->get('user');
        $userId = $user['id'] ?? null;
        if (!$userId) {
            return redirect()->to('/auth/login')->with('error', 'Veuillez vous connecter');
        }

        // Récupérer utilisateur complet
        $userData = $this->userModel->find($userId);
        if (!$userData) {
            return redirect()->to('/auth/login')->with('error', 'Utilisateur non trouvé');
        }

        $data = [
            'user' => $userData
        ];

        return view('portefeuille/recharger', $data);
    }

    /**
     * Valider le code et ajouter au portefeuille
     */
    public function validerCode()
    {
        // Vérifier session utilisateur
        $user = session()->get('user');
        $userId = $user['id'] ?? null;
        if (!$userId) {
            return redirect()->to('/portefeuille')->with('error', 'Veuillez vous connecter');
        }

        // Récupérer utilisateur complet
        $userData = $this->userModel->find($userId);
        if (!$userData) {
            return redirect()->to('/portefeuille')->with('error', 'Utilisateur non trouvé');
        }

        // Récupérer le code saisi
        $code = trim($this->request->getPost('code'));
        
        if (empty($code)) {
            return redirect()->to('/portefeuille')->with('error', 'Veuillez saisir un code');
        }

        // Chercher le code dans la BD
        $codePortefeuille = $this->codeModel->findByCode(strtoupper($code));

        // Vérifier si le code existe
        if (!$codePortefeuille) {
            return redirect()->to('/portefeuille')->with('error', 'Code invalide');
        }

        // Vérifier si le code a déjà été utilisé
        if ($codePortefeuille['utilise']) {
            return redirect()->to('/portefeuille')->with('error', 'Ce code a déjà été utilisé');
        }

        // Tout est ok: mettre à jour le solde utilisateur
        $newSolde = $userData['solde'] + $codePortefeuille['montant'];
        
        $this->userModel->update($userId, [
            'solde' => $newSolde
        ]);

        // Marquer le code comme utilisé
        $dateUtilisation = date('Y-m-d H:i:s');
        $this->codeModel->markAsUsed($codePortefeuille['id'], $userId, $dateUtilisation);

        // Créer une transaction
        $this->transactionModel->insert([
            'utilisateur_id' => $userId,
            'type' => 'Recharge',
            'montant' => $codePortefeuille['montant'],
            'date_transaction' => date('Y-m-d H:i:s'),
            'description' => 'Recharge via code portefeuille: ' . $code
        ]);

        // Rediriger vers portefeuille avec message succès
        return redirect()->to('/portefeuille')
                        ->with('success', 'Recharge effectuée avec succès! Nouveau solde: ' . number_format($newSolde, 2) . ' Ar');
    }
}
