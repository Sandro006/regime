<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Utilisateur extends BaseController
{
    protected $userModel;

    public function __construct()
    {
        $this->userModel = new UserModel();
    }

    /**
     * Lister tous les utilisateurs
     */
    public function list()
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        try {
            // Récupérer tous les utilisateurs avec les informations de base
            $users = $this->userModel->findAll();
            
            // Enrichir les données
            foreach ($users as &$user) {
                $user['regimes_actifs'] = 0; // Valeur par défaut
            }

            $data = [
                'users' => $users,
                'admin_name' => session()->get('admin_nom') ?? 'Admin',
            ];

            return view('admin/utilisateur/list', $data);
        } catch (\Exception $e) {
            log_message('error', 'Erreur Admin Utilisateur list: ' . $e->getMessage());
            return redirect()->to('/admin/dashboard')->with('errors', 'Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Afficher détails d'un utilisateur
     */
    public function detail($id)
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        try {
            $user = $this->userModel->find($id);
            
            if (!$user) {
                return redirect()->to('/admin/utilisateur/list')->with('errors', 'Utilisateur non trouvé');
            }

            $data = [
                'user' => $user,
                'objectif' => null,
                'regimes' => [],
                'admin_name' => session()->get('admin_nom') ?? 'Admin',
            ];

            return view('admin/utilisateur/detail', $data);
        } catch (\Exception $e) {
            log_message('error', 'Erreur Admin Utilisateur detail: ' . $e->getMessage());
            return redirect()->to('/admin/utilisateur/list')->with('errors', 'Erreur: ' . $e->getMessage());
        }
    }

    /**
     * Activer/Désactiver Gold d'un utilisateur
     */
    public function toggleGold($id)
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        try {
            $user = $this->userModel->find($id);
            
            if (!$user) {
                return redirect()->back()->with('errors', 'Utilisateur non trouvé');
            }

            $newGoldStatus = $user['gold'] ? 0 : 1;
            
            if ($this->userModel->update($id, ['gold' => $newGoldStatus])) {
                $status = $newGoldStatus ? 'activé' : 'désactivé';
                return redirect()->back()->with('success', "Statut Gold $status!");
            } else {
                return redirect()->back()->with('errors', 'Erreur lors de la modification du statut Gold');
            }
        } catch (\Exception $e) {
            log_message('error', 'Erreur Admin Utilisateur toggleGold: ' . $e->getMessage());
            return redirect()->back()->with('errors', 'Erreur: ' . $e->getMessage());
        }
    }
}

