<?php

namespace App\Controllers;

class Profile extends BaseController{

    public function profile(){
        // Vérifier si l'utilisateur est connecté
        $session = session();
        if (!$session->get('estConnecte')) {
            return redirect()->to('/login')->with('error', 'Veuillez vous connecter');
        }
        
        return view('profile/user', [
            'user' => $session->get('user')
        ]);
    }

}