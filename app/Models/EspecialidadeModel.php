<?php

namespace App\Models;

use CodeIgniter\Model;

class EspecialidadeModel extends Model
{
    protected $table = 'especialidade';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'status', 'nome', 'descricao'];

    public function getEspecialidades()
    {
        return $this->findAll();
    }

    public function getEspecialidadeById($id)
    {
        return $this->find($id);
    }
}