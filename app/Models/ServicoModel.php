<?php

namespace App\Models;

use CodeIgniter\Model;

class ServicoModel extends Model
{
    protected $table = 'servicos';
    protected $primaryKey = 'id';
    protected $allowedFields = ['codigo', 'nome', 'descricao', 'valor','especialidade_id'];

    public function getServicos()
    {
        return $this->findAll();
    }

    public function getServicoById($id)
    {
        return $this->find($id);
    }
}
