<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\UtilisateurObjectifModel;

class Objectif extends BaseController
{
    protected $objectifModel;
    protected $utilisateurObjectifModel;

    public function __construct()
    {
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
    }

    /**
     * Lister tous les objectifs disponibles
     */
    public function list()
    {
        $objectifs = $this->objectifModel->getAllObjectifs();

        return view('objectif/list', ['objectifs' => $objectifs]);
    }

    /**
     * Sauvegarder le choix d'un objectif pour un utilisateur (POST)
     */
    public function save()
    {
        $objectifId = $this->request->getPost('objectif_id');
        $userId = $this->request->getPost('user_id');
        $sessionUser = session()->get('user');

        if (!$userId && !empty($sessionUser['id'])) {
            $userId = $sessionUser['id'];
        }

        if (!$userId || !$objectifId) {
            return redirect()->back()->with('error', 'Parametres manquants (user_id, objectif_id)');
        }

        // Vérifier si l'association existe déjà
        $existing = $this->utilisateurObjectifModel
            ->where('user_id', $userId)
            ->where('objectif_id', $objectifId)
            ->first();

        if ($existing) {
            return redirect()->to('/')->with('info', 'Cet objectif est deja assigne a cet utilisateur');
        }

        try {
            $this->utilisateurObjectifModel->createAssociation([
                'user_id' => $userId,
                'objectif_id' => $objectifId,
                'date_choix' => date('Y-m-d')
            ]);

            return redirect()->to('/')->with('success', 'Objectif assigne avec succes');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Erreur lors de l\'assignation');
        }
    }
}