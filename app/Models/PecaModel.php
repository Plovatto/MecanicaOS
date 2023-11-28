<?php

namespace App\Models;

use CodeIgniter\Model;

class PecaModel extends Model
{
    protected $table = 'peca';
    protected $primaryKey = 'id';
    protected $allowedFields = ['status','codigo', 'nome', 'descricao', 'valor'];

    public function getPecas()
    {
        return $this->findAll();
    }

    public function getPecaById($id)
    {
        return $this->find($id);
    }
}
