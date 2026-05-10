<?php

namespace App\Models;

use CodeIgniter\Model;

class RegimeModel extends Model
{
	protected $table = 'regimes';
	protected $primaryKey = 'id';
	protected $useAutoIncrement = true;
	protected $returnType = 'array';
	protected $useSoftDeletes = false;
	protected $protectFields = true;
	protected $allowedFields = [
		'nom',
		'description',
		'prix',
		'duree',
		'variation_poids',
		'pourcentage_viande',
		'pourcentage_poisson',
		'pourcentage_volaille'
	];

	protected $useTimestamps = false;

	protected $validationRules = [
		'nom' => 'required|max_length[255]',
		'description' => 'permit_empty',
		'prix' => 'required|decimal',
		'duree' => 'required|integer',
		'variation_poids' => 'required|decimal',
		'pourcentage_viande' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
		'pourcentage_poisson' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]',
		'pourcentage_volaille' => 'required|decimal|greater_than_equal_to[0]|less_than_equal_to[100]'
	];

	protected $validationMessages = [];
	protected $skipValidation = false;

	public function createRegime($data)
	{
		return $this->insert($data);
	}

	public function getAllRegimes()
	{
		return $this->findAll();
	}

	public function getRegimeById($id)
	{
		return $this->find($id);
	}

	public function updateRegime($id, $data)
	{
		return $this->update($id, $data);
	}

	public function deleteRegime($id)
	{
		return $this->delete($id);
	}
}
