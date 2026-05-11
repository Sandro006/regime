<?php

namespace App\Controllers\Admin;

use App\Models\UserModel;
use App\Models\AchatsRegimeModel;
use App\Models\RegimeModel;
use App\Controllers\BaseController;

class Dashboard extends BaseController
{
    protected $userModel;
    protected $achatsRegimeModel;
    protected $regimeModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
        $this->achatsRegimeModel = new AchatsRegimeModel();
        $this->regimeModel = new RegimeModel();
    }

    /**
     * Afficher le dashboard admin
     */
    public function index()
    {
        // Vérifier si l'admin est connecté
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login')->with('error', 'Vous devez être connecté');
        }

        // Récupérer les données pour le dashboard
        $data = [
            'total_users' => $this->getTotalUsers(),
            'total_revenue' => $this->getTotalRevenue(),
            'total_gold_users' => $this->getTotalGoldUsers(),
            'top_regimes' => $this->getTopRegimes(3),
            'admin_name' => session()->get('admin_nom')
        ];

        return view('admin/dashboard/index', $data);
    }

    /**
     * Récupérer le nombre total d'utilisateurs
     */
    private function getTotalUsers()
    {
        return $this->userModel->countAll();
    }

    /**
     * Récupérer le revenu total (somme des achats)
     */
    private function getTotalRevenue()
    {
        $result = $this->achatsRegimeModel
            ->selectSum('prix_paye')
            ->get()
            ->getRow();

        return $result->prix_paye ?? 0;
    }

    /**
     * Récupérer le nombre d'utilisateurs Gold
     */
    private function getTotalGoldUsers()
    {
        return $this->userModel
            ->where('gold', 1)
            ->countAllResults();
    }

    /**
     * Récupérer les TOP 3 régimes les plus vendus
     */
    private function getTopRegimes($limit = 3)
    {
        $db = \Config\Database::connect();
        $builder = $db->table('achats_regimes');
        $builder->select('regimes.id, regimes.nom_regime, regimes.prix, COUNT(achats_regimes.id) as ventes')
                ->join('regimes', 'achats_regimes.regime_id = regimes.id')
                ->groupBy('regimes.id')
                ->orderBy('ventes', 'DESC')
                ->limit($limit);

        return $builder->get()->getResultArray();
    }
}
