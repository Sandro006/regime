<?php

namespace App\Models;

use CodeIgniter\Model;

class ParametreModel extends Model
{
    protected $table = 'parametres';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $allowedFields = ['cle', 'valeur'];

    protected $useTimestamps = false;

    /**
     * Récupère une valeur de paramètre par clé
     */
    public function get($cle)
    {
        $param = $this->where('cle', $cle)->first();
        return $param ? $param['valeur'] : null;
    }

    /**
     * Récupère tous les paramètres d'abonnement
     */
    public function getAbonnementOptions()
    {
        $options = $this->where('cle', 'LIKE', 'abonnement_%')
                        ->findAll();
        
        $result = [];
        foreach ($options as $option) {
            $result[$option['cle']] = $option['valeur'];
        }
        
        return $result;
    }

    /**
     * Récupère toutes les options d'abonnement formatées
     */
    public function getFormattedAbonnementOptions()
    {
        $plans = [];
        
        // Gold plan
        $goldPrice = $this->get('abonnement_gold_prix');
        $goldRemise = $this->get('abonnement_gold_remise');
        $goldDuree = $this->get('abonnement_gold_duree');
        
        if ($goldPrice) {
            $plans['gold'] = [
                'nom'      => 'Gold',
                'prix'     => $goldPrice,
                'remise'   => $goldRemise ?? 15,
                'duree'    => $goldDuree ?? 30,
                'benefits' => [
                    'Réduction de ' . ($goldRemise ?? 15) . '% sur les régimes',
                    'Accès prioritaire aux nouveaux régimes',
                    'Support client prioritaire'
                ]
            ];
        }
        
        // Platine plan (optionnel)
        $platinePrix = $this->get('abonnement_platine_prix');
        if ($platinePrix) {
            $platineRemise = $this->get('abonnement_platine_remise');
            $platineDuree = $this->get('abonnement_platine_duree');
            
            $plans['platine'] = [
                'nom'      => 'Platine',
                'prix'     => $platinePrix,
                'remise'   => $platineRemise ?? 20,
                'duree'    => $platineDuree ?? 30,
                'benefits' => [
                    'Réduction de ' . ($platineRemise ?? 20) . '% sur les régimes',
                    'Accès à tous les régimes premium',
                    'Coaching personnalisé illimité',
                    'Support 24/7 prioritaire'
                ]
            ];
        }
        
        return $plans;
    }

    /**
     * Met à jour ou crée un paramètre
     */
    public function setOrUpdate($cle, $valeur)
    {
        $existing = $this->where('cle', $cle)->first();
        
        if ($existing) {
            return $this->update($existing['id'], ['valeur' => $valeur]);
        } else {
            return $this->insert(['cle' => $cle, 'valeur' => $valeur]);
        }
    }
}
