<?php

namespace App\Models;

use CodeIgniter\Model;

class VeiculoModel extends Model
{
    protected $table = 'veiculo';
    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['codigo', 'marca_id', 'modelo_id', 'cor', 'placa', 'status', 'ano', 'descricao', 'cliente_id'];

    public function getVeiculos()
    {
        return $this->findAll();
    }

    public function getVeiculoWithMarcaModelo($id)
    {
        return $this->select('veiculo.*, marca.nome as marca_nome, modelo.nome as modelo_nome')
            ->join('marca', 'marca.id = veiculo.marca_id', 'left') 
            ->join('modelo', 'modelo.id = veiculo.modelo_id', 'left') 
            ->where('veiculo.id', $id)
            ->first();
    }

    public function getVeiculosDoCliente($cliente_id)
    {
        return $this->where('cliente_id', $cliente_id)->findAll(); 
    }

    public function getClienteFromVeiculo($veiculoCodigo)
    {
        return $this->select('cliente.*')
            ->join('cliente', 'cliente.id = veiculo.cliente_id', 'left') 
            ->where('veiculo.id', $veiculoCodigo)
            ->first();
    }
}
