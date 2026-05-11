<?php

namespace App\Models;

use CodeIgniter\Model;

class AdminModel extends Model
{
    protected $table = 'admins';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'nom', 'email', 'motdepasse'
    ];

    // Dates
    protected $useTimestamps = false;

    // Validation
    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|is_unique[admins.email]',
        'motdepasse' => 'required|min_length[8]',
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // ============ CRUD METHODS ============

    /**
     * CREATE - Créer un admin
     */
    public function createAdmin($data)
    {
        return $this->insert($data);
    }

    /**
     * READ - Récupérer tous les admins
     */
    public function getAllAdmins()
    {
        return $this->findAll();
    }

    /**
     * READ - Récupérer un admin par ID
     */
    public function getAdminById($id)
    {
        return $this->find($id);
    }

    /**
     * READ - Récupérer un admin par email
     */
    public function getAdminByEmail($email)
    {
        return $this->where('email', $email)->first();
    }

    /**
     * Compat: certaines installations utilisent la colonne 'password'
     * au lieu de 'motdepasse' dans la table admins.
     */
    public function getPasswordHashField(): string
    {
        try {
            $columns = $this->db->getFieldNames($this->table);
            // getFieldNames retourne un tableau indexé des noms de colonnes
            if (in_array('password', $columns, true)) {
                return 'password';
            }
            if (in_array('motdepasse', $columns, true)) {
                return 'motdepasse';
            }
        } catch (\Throwable $e) {
            // ignore
        }

        return 'password'; // Défaut: utiliser 'password'
    }

    /**
     * UPDATE - Modifier un admin
     */
    public function updateAdmin($id, $data)
    {
        return $this->update($id, $data);
    }

    /**
     * DELETE - Supprimer un admin
     */
    public function deleteAdmin($id)
    {
        return $this->delete($id);
    }
}

