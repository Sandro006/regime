<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        // Vérifier si l'utilisateur est connecté
        $session = session();
        $isLoggedIn = $session->has('estConnecte') && $session->get('estConnecte');
        
        return view('accueil/index', [
            'isLoggedIn' => $isLoggedIn,
            'user' => $isLoggedIn ? $session->get('user') : null
        ]);
    }

}
