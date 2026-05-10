<?php

namespace App\Controllers;

use App\Models\ActiviteSportiveModel;
use App\Models\ObjectifModel;
use App\Models\UtilisateurObjectifModel;

class Activite extends BaseController
{
    protected $activiteModel;
    protected $objectifModel;
    protected $utilisateurObjectifModel;

    public function __construct()
    {
        $this->activiteModel = new ActiviteSportiveModel();
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
    }

    public function list()
    {
        $activites = $this->activiteModel->getAllActivites();

        return view('activite/list', ['activites' => $activites]);
    }

    public function recommended()
    {
        $sessionUser = session()->get('user');
        $userId = $this->request->getGet('user_id') ?? ($sessionUser['id'] ?? null);

        if (!$userId) {
            return redirect()->back()->with('error', 'Utilisateur non connecte');
        }

        $association = $this->utilisateurObjectifModel
            ->where('user_id', $userId)
            ->orderBy('date_choix', 'DESC')
            ->first();

        if (!$association) {
            $activites = $this->activiteModel->getAllActivites();

            return view('activite/list', [
                'activites' => $activites,
                'info' => 'Aucun objectif selectionne. Voici toutes les activites.'
            ]);
        }

        $objectif = $this->objectifModel->getObjectifById($association['objectif_id']);
        $objectifName = $objectif['objectif'] ?? '';

        $activites = $this->getRecommendedActivities($objectifName);

        return view('activite/list', [
            'activites' => $activites,
            'objectif' => $objectifName
        ]);
    }

    private function getRecommendedActivities(string $objectifName): array
    {
        $objectif = strtolower($objectifName);

        if (strpos($objectif, 'perdre') !== false) {
            return $this->findByKeywords(['Cardio', 'HIIT', 'Jogging']);
        }

        if (strpos($objectif, 'gagner') !== false) {
            return $this->findByKeywords(['Muscu', 'Musculation', 'Force']);
        }

        return $this->activiteModel->getAllActivites();
    }

    private function findByKeywords(array $keywords): array
    {
        $builder = $this->activiteModel->builder();
        $builder->groupStart();

        foreach ($keywords as $index => $keyword) {
            if ($index === 0) {
                $builder->like('nom', $keyword);
            } else {
                $builder->orLike('nom', $keyword);
            }
        }

        $builder->groupEnd();

        return $builder->get()->getResultArray();
    }
}
