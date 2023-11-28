<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipeModel extends Model
{
    protected $table = 'equipe';
    protected $primaryKey = 'id';
    protected $allowedFields = ['status', 'codigo', 'nome', 'descricao', 'especialidade_id','mecanico_id'];

    public function getEquipes()
    {
        return $this->findAll();
    }

    public function getEquipeById($id)
    {
        return $this->find($id);
    }
}
