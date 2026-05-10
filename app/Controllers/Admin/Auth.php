<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\AdminModel;
use CodeIgniter\HTTP\RedirectResponse;

class Auth extends BaseController
{
    protected AdminModel $adminModel;

    public function __construct()
    {
        $this->adminModel = new AdminModel();
    }

    /**
     * Affiche la page de login admin.
     */
    public function login()
    {
        return view('admin/auth/BackOffice/login');
    }


    /**
     * Vérification (POST) - authentification admin.
     */
    public function authenticate()
    {
        $email = (string) $this->request->getPost('email');
        $motdepasse = (string) $this->request->getPost('motdepasse');

        // Certains formulaires utilisent 'password' (compat)
        if ($motdepasse === '') {
            $motdepasse = (string) $this->request->getPost('password');
        }

        // Nettoyage éventuel (espaces)
        $email = trim($email);
        $motdepasse = trim($motdepasse);

        if ($email === '' || $motdepasse === '') {

            return redirect()->back()->with('error', 'Email et mot de passe requis');
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return redirect()->back()->with('error', 'Email invalide');
        }

        $admin = $this->adminModel->getAdminByEmail($email);

        if (!$admin) {
            return redirect()->back()->with('error', 'Identifiants admin incorrects');
        }

        // IMPORTANT: selon la structure, le hash est dans 'motdepasse' ou 'password'
        $hashField = $this->adminModel->getPasswordHashField();
        $hash = $admin[$hashField] ?? '';

        // Vérifier le mot de passe
        if ($hash === '' || !password_verify($motdepasse, $hash)) {
            return redirect()->back()->with('error', 'Identifiants admin incorrects');
        }




        // Démarre/régénère la session (si supporté)
        $session = session();
        if (method_exists($session, 'regenerate')) {
            $session->regenerate(true);
        }

        $session->set([
            'isAdmin' => true,
            'admin' => [
                'id' => $admin['id'] ?? null,
                'nom' => $admin['nom'] ?? null,
                'email' => $admin['email'] ?? $email,
            ],
        ]);

        return redirect()->to('/admin/authenticate')->with('success', 'Connexion admin réussie');

    }

    /**
     * Déconnexion admin.
     */
    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to('/admin/login')->with('success', 'Vous êtes déconnecté');
    }

    /**
     * Sécurité: vérifier session admin (à appeler au début des pages admin).
     */
    protected function ensureAdmin(): void
    {
        $isAdmin = session()->get('isAdmin');
        if (!$isAdmin) {
            redirect()->to('/admin/login')->with('error', 'Accès refusé');
            exit;
        }
    }
}

