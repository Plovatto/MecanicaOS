<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipeMecanicoModel extends Model
{
    protected $table = 'equipe_mecanico';
    protected $primaryKey = ['equipe_id', 'mecanico_id'];
    protected $allowedFields = ['equipe_id', 'mecanico_id'];

    public function getMecanicosPorEquipe($equipeId)
    {
        return $this->where('equipe_id', $equipeId)->findAll();
    }

    public function getEquipesPorMecanico($mecanicoId)
    {
        return $this->where('mecanico_id', $mecanicoId)->findAll();
    }
}