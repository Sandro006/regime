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
        'nom',
        'email',
        'password'
    ];

    // Validation
    protected $validationRules = [
        'nom' => 'required|min_length[2]|max_length[100]',
        'email' => 'required|valid_email|is_unique[admins.email]',
        'password' => 'required|min_length[8]'
    ];

    protected $validationMessages = [];
    protected $skipValidation = false;

    // ============ CRUD METHODS ============

    /**
     * Créer un nouvel admin
     */
    public function createAdmin($data){
        return $this->insert($data);
    }

    /**
     * Récupérer tous les admins
     */
    public function getAllAdmins(){
        return $this->findAll();
    }

    /**
     * Récupérer un admin par ID
     */
    public function getAdminById($id){
        return $this->find($id);
    }

    /**
     * Récupérer un admin par email
     */
    public function getAdminByEmail($email){
        return $this->where('email', $email)->first();
    }

    /**
     * Mettre à jour un admin
     */
    public function updateAdmin($id, $data){
        return $this->update($id, $data);
    }

    /**
     * Supprimer un admin
     */
    public function deleteAdmin($id){
        return $this->delete($id);
    }

    /**
     * Vérifier les identifiants admin
     */
    public function verifyCredentials($email, $password){
        $admin = $this->getAdminByEmail($email);
        
        if (!$admin) {
            return false;
        }

        if (password_verify($password, $admin['password'])) {
            return $admin;
        }

        return false;
    }
}
