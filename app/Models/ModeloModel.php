<?php

namespace App\Models;

use CodeIgniter\Model;

class ModeloModel extends Model
{
    protected $table = 'modelo';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['codigo', 'nome', 'marca_id', 'status'];

    public function getModelos()
    {
        return $this->findAll();
    }

    public function getModeloById($id)
    {
        return $this->find($id);
    }

    public function createModelo($data)
    {
        return $this->insert($data);
    }

    public function getModelosByMarca($marca_id)
    {
        return $this->where('marca_id', $marca_id)->findAll();
    }
}
