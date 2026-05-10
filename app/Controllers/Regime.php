<?php

namespace App\Controllers;

use App\Models\ObjectifModel;
use App\Models\RegimeModel;
use App\Models\UtilisateurObjectifModel;

class Regime extends BaseController
{
    protected $regimeModel;
    protected $objectifModel;
    protected $utilisateurObjectifModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
        $this->objectifModel = new ObjectifModel();
        $this->utilisateurObjectifModel = new UtilisateurObjectifModel();
    }

    public function list()
    {
        $regimes = $this->regimeModel->getAllRegimes();

        return view('regime/list', ['regimes' => $regimes]);
    }

    public function detail($id)
    {
        $regime = $this->regimeModel->getRegimeById($id);

        if (!$regime) {
            return redirect()->back()->with('error', 'Regime introuvable');
        }

        return view('regime/detail', ['regime' => $regime]);
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
            $regimes = $this->regimeModel->getAllRegimes();

            return view('regime/list', [
                'regimes' => $regimes,
                'info' => 'Aucun objectif selectionne. Voici tous les regimes.'
            ]);
        }

        $objectif = $this->objectifModel->getObjectifById($association['objectif_id']);
        $objectifName = $objectif['objectif'] ?? '';

        $regimes = $this->getRecommendedRegimes($objectifName);

        return view('regime/list', [
            'regimes' => $regimes,
            'objectif' => $objectifName
        ]);
    }

    private function getRecommendedRegimes(string $objectifName): array
    {
        $objectif = strtolower($objectifName);

        if (strpos($objectif, 'perdre') !== false) {
            return $this->filterByVariation('<', 0);
        }

        if (strpos($objectif, 'gagner') !== false) {
            return $this->filterByVariation('>', 0);
        }

        if (strpos($objectif, 'imc') !== false) {
            return $this->filterByVariation('between', [-1, 1]);
        }

        return $this->regimeModel->getAllRegimes();
    }

    private function filterByVariation(string $operator, $value): array
    {
        $builder = $this->regimeModel->builder();

        if ($operator === 'between' && is_array($value) && count($value) === 2) {
            $builder->where('variation_poids >=', $value[0])
                ->where('variation_poids <=', $value[1]);
        } else {
            $builder->where("variation_poids {$operator}", $value);
        }

        return $builder->get()->getResultArray();
    }
}
