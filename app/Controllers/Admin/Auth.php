<?php

namespace App\Controllers\Admin;

use App\Models\AdminModel;
use App\Controllers\BaseController;

class Auth extends BaseController
{
    protected $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    /**
     * Afficher la page de login admin
     */
    public function login()
    {
        // Vérifier si l'admin est déjà connecté
        if (session()->has('admin_id')) {
            return redirect()->to('/admin/dashboard');
        }

        return view('admin/auth/login');
    }

    /**
     * Traiter l'authentification admin (POST)
     */
    public function authenticate()
    {
        // Est-ce une requête AJAX ?
        $isAjax = $this->request->isAJAX();

        // Récupérer les champs email et password
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // Valider les champs
        if (empty($email) || empty($password)) {
            if ($isAjax) {
                return $this->response->setStatusCode(400)->setJSON([
                    'success' => false,
                    'message' => 'Email et mot de passe requis'
                ]);
            }
            session()->setFlashdata('error', 'Email et mot de passe requis');
            return redirect()->back()->withInput();
        }

        // Vérifier les identifiants
        $admin = $this->adminModel->verifyCredentials($email, $password);

        if (!$admin) {
            if ($isAjax) {
                return $this->response->setStatusCode(401)->setJSON([
                    'success' => false,
                    'message' => 'Identifiants invalides'
                ]);
            }
            session()->setFlashdata('error', 'Identifiants invalides');
            return redirect()->back()->withInput();
        }

        // Stocker l'admin en session
        session()->set([
            'admin_id' => $admin['id'],
            'admin_nom' => $admin['nom'],
            'admin_email' => $admin['email'],
            'admin_logged_in' => true
        ]);

        if ($isAjax) {
            return $this->response->setStatusCode(200)->setJSON([
                'success' => true,
                'message' => 'Authentification réussie',
                'redirect' => '/admin/dashboard'
            ]);
        }

        return redirect()->to('/admin/dashboard')->with('success', 'Bienvenue ' . $admin['nom'] . '!');
    }

    /**
     * Déconnecter l'admin
     */
    public function logout()
    {
        session()->destroy();
        return redirect()->to('/admin/login')->with('success', 'Vous avez été déconnecté avec succès');
    }
}
