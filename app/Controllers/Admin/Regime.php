<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Models\RegimeModel;

class Regime extends BaseController
{
    protected $regimeModel;

    public function __construct()
    {
        $this->regimeModel = new RegimeModel();
    }

    /**
     * Lister tous les régimes
     */
    public function list()
    {
        // Vérifier que l'utilisateur est admin (connecté via session)
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'regimes' => $this->regimeModel->findAll(),
            'admin_name' => session()->get('admin_nom'),
        ];

        return view('admin/regime/list', $data);
    }

    /**
     * Afficher le formulaire de création (vide)
     */
    public function create()
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        $data = [
            'regime' => null,
            'admin_name' => session()->get('admin_nom'),
            'mode' => 'create',
        ];

        return view('admin/regime/form', $data);
    }

    /**
     * Sauvegarder un nouveau régime (POST)
     */
    public function store()
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        $validation = \Config\Services::validation();
        
        // Validation
        if (!$this->validate([
            'nom_regime' => 'required|string|min_length[3]',
            'description' => 'required|string|min_length[5]',
            'prix' => 'required|numeric|greater_than[0]',
            'duree' => 'required|numeric|greater_than[0]',
            'variation_poids' => 'required|integer',
            'pourcentage_viande' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_poisson' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_volaille' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
        ])) {
            // Vérifier que la somme des pourcentages = 100
            $viande = (float)$this->request->getPost('pourcentage_viande');
            $poisson = (float)$this->request->getPost('pourcentage_poisson');
            $volaille = (float)$this->request->getPost('pourcentage_volaille');
            
            if (abs(($viande + $poisson + $volaille) - 100) > 0.01) {
                return redirect()->back()->with('errors', 'La somme des pourcentages doit égaler 100%');
            }

            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Vérifier la somme des pourcentages
        $viande = (float)$this->request->getPost('pourcentage_viande');
        $poisson = (float)$this->request->getPost('pourcentage_poisson');
        $volaille = (float)$this->request->getPost('pourcentage_volaille');
        
        if (abs(($viande + $poisson + $volaille) - 100) > 0.01) {
            return redirect()->back()->withInput()->with('errors', ['pourcentages' => 'La somme des pourcentages (Viande + Poisson + Volaille) doit égaler 100%']);
        }

        $data = [
            'nom_regime' => $this->request->getPost('nom_regime'),
            'description' => $this->request->getPost('description'),
            'prix' => $this->request->getPost('prix'),
            'duree' => $this->request->getPost('duree'),
            'variation_poids' => $this->request->getPost('variation_poids'),
            'pourcentage_viande' => $viande,
            'pourcentage_poisson' => $poisson,
            'pourcentage_volaille' => $volaille,
        ];

        if ($this->regimeModel->insert($data)) {
            return redirect()->to('/admin/regime/list')->with('success', 'Régime créé avec succès!');
        } else {
            return redirect()->back()->withInput()->with('errors', 'Erreur lors de la création du régime');
        }
    }

    /**
     * Afficher le formulaire d'édition (pré-rempli)
     */
    public function edit($id)
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        $regime = $this->regimeModel->find($id);
        
        if (!$regime) {
            return redirect()->to('/admin/regime/list')->with('errors', 'Régime non trouvé');
        }

        $data = [
            'regime' => $regime,
            'admin_name' => session()->get('admin_nom'),
            'mode' => 'edit',
        ];

        return view('admin/regime/form', $data);
    }

    /**
     * Sauvegarder les modifications (POST)
     */
    public function update($id)
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        $regime = $this->regimeModel->find($id);
        
        if (!$regime) {
            return redirect()->to('/admin/regime/list')->with('errors', 'Régime non trouvé');
        }

        // Validation
        if (!$this->validate([
            'nom_regime' => 'required|string|min_length[3]',
            'description' => 'required|string|min_length[5]',
            'prix' => 'required|numeric|greater_than[0]',
            'duree' => 'required|numeric|greater_than[0]',
            'variation_poids' => 'required|integer',
            'pourcentage_viande' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_poisson' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
            'pourcentage_volaille' => 'required|numeric|greater_than_equal_to[0]|less_than_equal_to[100]',
        ])) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // Vérifier la somme des pourcentages
        $viande = (float)$this->request->getPost('pourcentage_viande');
        $poisson = (float)$this->request->getPost('pourcentage_poisson');
        $volaille = (float)$this->request->getPost('pourcentage_volaille');
        
        if (abs(($viande + $poisson + $volaille) - 100) > 0.01) {
            return redirect()->back()->withInput()->with('errors', ['pourcentages' => 'La somme des pourcentages (Viande + Poisson + Volaille) doit égaler 100%']);
        }

        $data = [
            'nom_regime' => $this->request->getPost('nom_regime'),
            'description' => $this->request->getPost('description'),
            'prix' => $this->request->getPost('prix'),
            'duree' => $this->request->getPost('duree'),
            'variation_poids' => $this->request->getPost('variation_poids'),
            'pourcentage_viande' => $viande,
            'pourcentage_poisson' => $poisson,
            'pourcentage_volaille' => $volaille,
        ];

        if ($this->regimeModel->update($id, $data)) {
            return redirect()->to('/admin/regime/list')->with('success', 'Régime modifié avec succès!');
        } else {
            return redirect()->back()->withInput()->with('errors', 'Erreur lors de la modification du régime');
        }
    }

    /**
     * Supprimer un régime
     */
    public function delete($id)
    {
        if (!session()->has('admin_id')) {
            return redirect()->to('/admin/login');
        }

        $regime = $this->regimeModel->find($id);
        
        if (!$regime) {
            return redirect()->to('/admin/regime/list')->with('errors', 'Régime non trouvé');
        }

        // Soft delete ou hard delete - ici on fait un hard delete
        if ($this->regimeModel->delete($id)) {
            return redirect()->to('/admin/regime/list')->with('success', 'Régime supprimé avec succès!');
        } else {
            return redirect()->back()->with('errors', 'Erreur lors de la suppression du régime');
        }
    }
}
