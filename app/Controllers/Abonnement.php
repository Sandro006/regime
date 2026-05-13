<?php
namespace App\Controllers;

use CodeIgniter\Controller;

class Abonnement extends Controller
{
    protected $abonnementModel;
    protected $userModel;
    protected $transactionModel;

    public function __construct()
    {
        $this->abonnementModel = model('AbonnementModel');
        $this->userModel = model('UserModel');
        $this->transactionModel = model('TransactionModel');
    }

    /**
     * Afficher les plans d'abonnement
     */
    public function plans()
    {
        // Vérifier si l'utilisateur est connecté
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        if (!$isLoggedIn) {
            return redirect()->to('/login');
        }

        $userId = $session->get('user_id');
        $user = $this->userModel->find($userId);

        $data = [
            'userSolde' => $user->solde ?? 0
        ];

        return view('abonnement/plans', $data);
    }

    /**
     * Acheter un abonnement
     */
    public function acheter()
    {
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        if (!$isLoggedIn) {
            return redirect()->to('/login');
        }

        $userId = $session->get('user_id');
       $plan = $this->request->getGet('plan');
        
        // Définir les prix selon les plans
        $plans = [
            'gold' => ['nom' => 'Gold', 'prix' => 10000, 'remise' => 15, 'duree' => 30],
            'premium' => ['nom' => 'Premium', 'prix' => 25000, 'remise' => 20, 'duree' => 90],
            'platinium' => ['nom' => 'Platinium', 'prix' => 80000, 'remise' => 30, 'duree' => 365]
        ];

        if (!isset($plans[$plan])) {
            return redirect()->to('/profile')->with('error', 'Plan invalide');
        }
        
        $prix = $plans[$plan]['prix'];
        $user = $this->userModel->find($userId);
        
        // Vérifier si l'utilisateur a assez de crédit
        if ($session->get('solde') < $prix) {
            return redirect()->to('/portefeuille')->with('error', 'Solde insuffisant');
        }
        
        // Déduire le montant
        $this->userModel->debiterSolde($userId, $prix);
        
        // Créer l'abonnement
        $this->abonnementModel->createAbonnement($userId, $prix);
        
        // Enregistrer la transaction
        $this->transactionModel->insert([
            'utilisateur_id' => $userId,
            'type' => 'abonnement',
            'montant' => -$prix,
            'description' => 'Achat ' . $plans[$plan]['nom']
        ]);
        
        return redirect()->to('/profile')->with('success', 'Abonnement activé avec succès !');
    }

    /**
     * Vérifier le statut de l'abonnement (API)
     */
    public function verifierStatut()
    {
        $userId = session()->get('user_id');
        
        $response = [
            'has_abonnement' => $this->abonnementModel->hasActiveSubscription($userId),
            'jours_restants' => $this->abonnementModel->getJoursRestants($userId),
            'date_expiration' => $this->abonnementModel->getDateExpirationFormatee($userId),
            'remise' => $this->abonnementModel->getRemiseAbonnement($userId)
        ];
        
        return $this->response->setJSON($response);
    }
}