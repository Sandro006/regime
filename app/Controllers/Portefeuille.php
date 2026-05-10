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
        $user = session()->get('user');
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        $userId = $user['id'];

        // Récupérer utilisateur
        $userDetails = $this->userModel->find($userId);
        if (!$userDetails) {
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }

        // Récupérer l'historique des transactions (50 dernières)
        $transactions = $this->transactionModel->getByUser($userId, 50);

        // Récupérer statistiques des transactions
        $stats = $this->transactionModel->getStatsByUser($userId);

        $data = [
            'user'         => $userDetails,
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
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        $userId = $user['id'];

        // Récupérer utilisateur
        $userDetails = $this->userModel->find($userId);
        if (!$userDetails) {
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }

        $data = [
            'user' => $userDetails
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
        if (!$user) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        $userId = $user['id'];

        // Récupérer utilisateur
        $userDetails = $this->userModel->find($userId);
        if (!$userDetails) {
            return redirect()->to('/login')->with('error', 'Utilisateur non trouvé');
        }

        // Récupérer le code saisi
        $code = $this->request->getPost('code');
        
        if (empty($code)) {
            return redirect()->back()->with('error', 'Veuillez saisir un code');
        }

        // Chercher le code dans la BD
        $codePortefeuille = $this->codeModel->findByCode($code);

        // Vérifier si le code existe et n'est pas utilisé
        if (!$codePortefeuille) {
            return redirect()->back()->with('error', 'Code invalide ou déjà utilisé');
        }

        if ($codePortefeuille['utilise']) {
            return redirect()->back()->with('error', 'Ce code a déjà été utilisé');
        }

        // Tout est ok: mettre à jour le solde utilisateur
        $newSolde = $userDetails['solde'] + $codePortefeuille['montant'];
        
        $this->userModel->update($userId, [
            'solde' => $newSolde
        ]);

        // Marquer le code comme utilisé
        $dateUtilisation = date('Y-m-d H:i:s');
        $this->codeModel->markAsUsed($codePortefeuille['id'], $userId, $dateUtilisation);

        // Créer une transaction
        $this->transactionModel->createTransaction(
            $userId,
            'Recharge',
            $codePortefeuille['montant'],
            'Recharge via code portefeuille: ' . $code
        );

        // Rediriger avec message succès
        return redirect()->to('/portefeuille')
                        ->with('success', 'Recharge effectuée avec succès! Nouveau solde: ' . number_format($newSolde, 2) . ' €');
    }
}
