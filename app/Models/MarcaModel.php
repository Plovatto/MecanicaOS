<?php

namespace App\Models;

use CodeIgniter\Model;

class MarcaModel extends Model
{
    protected $table = 'marca';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $allowedFields = ['codigo', 'nome', 'status'];

    public function getMarcas()
    {
        $marcas = $this->findAll();
        $result = [];
        foreach ($marcas as $marca) {
            $result[$marca['id']] = $marca['nome'];
        }
        return $result;
    }

    public function getMarcaById($id)
    {
        return $this->find($id);
    }

    public function createMarca($data)
    {
        return $this->insert($data);
    }

    public function __toString()
    {
        return $this->nome;
    }
}
