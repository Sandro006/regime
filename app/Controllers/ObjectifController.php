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

        return view('objectifs/list', ['objectifs' => $objectifs]);
    }

    /**
     * Sauvegarder le choix d'un objectif pour un utilisateur (POST)
     */
    public function save()
    {
        $userId = $this->request->getPost('user_id');
        $objectifId = $this->request->getPost('objectif_id');

        if (!$userId || !$objectifId) {
            return $this->response->setStatusCode(400)->setJSON([
                'success' => false,
                'message' => 'Paramètres manquants (user_id, objectif_id)'
            ]);
        }

        // Vérifier si l'association existe déjà
        $existing = $this->utilisateurObjectifModel
            ->where('user_id', $userId)
            ->where('objectif_id', $objectifId)
            ->first();

        if ($existing) {
            return $this->response->setStatusCode(409)->setJSON([
                'success' => false,
                'message' => 'Cet objectif est déjà assigné à cet utilisateur'
            ]);
        }

        try {
            $this->utilisateurObjectifModel->createAssociation([
                'user_id' => $userId,
                'objectif_id' => $objectifId
            ]);

            return $this->response->setStatusCode(201)->setJSON([
                'success' => true,
                'message' => 'Objectif assigné avec succès'
            ]);
        } catch (\Exception $e) {
            return $this->response->setStatusCode(500)->setJSON([
                'success' => false,
                'message' => 'Erreur lors de l\'assignation',
                'error' => $e->getMessage()
            ]);
        }
    }
}