<?php

namespace App\Models;

use CodeIgniter\Model;

class HistoryModel extends Model
{
    protected $table = 'user_metrics_history';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'poids', 'taille', 'bmi'];
    protected $useTimestamps = false;
    protected $createdField = 'created_at';
    
    public function getUserHistory($userId, $days = 30)
    {
        return $this->where('user_id', $userId)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }
    
    public function getHistoryByPeriod($userId, $startDate, $endDate)
    {
        return $this->where('user_id', $userId)
                    ->where('created_at >=', $startDate)
                    ->where('created_at <=', $endDate)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }
    
    public function getWeightTrend($userId, $days = 30)
    {
        $startDate = date('Y-m-d H:i:s', strtotime("-$days days"));
        
        return $this->select('poids, taille, bmi, DATE(created_at) as date')
                    ->where('user_id', $userId)
                    ->where('created_at >=', $startDate)
                    ->orderBy('created_at', 'ASC')
                    ->findAll();
    }
}