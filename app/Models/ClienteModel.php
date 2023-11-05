<?php

namespace App\Models;

use CodeIgniter\Model;

class ClienteModel extends Model
{
    protected $table = 'cliente';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['codigo', 'nome_completo', 'endereco', 'email', 'status', 'cpf', 'cnh', 'telefone'];

    public function getClientes()
    {
        return $this->findAll();
    }

    public function getClienteById($id)
    {
        return $this->find($id);
    }
}
