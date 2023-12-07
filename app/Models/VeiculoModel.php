<?php

namespace App\Models;

use CodeIgniter\Model;

class VeiculoModel extends Model
{
    protected $table = 'veiculo';
    protected $primaryKey = 'id'; 
    protected $useAutoIncrement = true;
    protected $returnType = 'object';
    protected $allowedFields = ['marca_nome','modelo_nome','codigo', 'marca_id', 'modelo_id', 'cor', 'placa', 'status', 'ano', 'descricao', 'cliente_id'];

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
    public function getTodosVeiculosWithMarcaModelo()
    {
        return $this->db->table('veiculo')
            ->select('veiculo.*, marca.nome as marca_nome, modelo.nome as modelo_nome')
            ->join('marca', 'marca.id = veiculo.marca_id', 'left')
            ->join('modelo', 'modelo.id = veiculo.modelo_id', 'left')
            ->get()->getResult();
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
    public function getVeiculoByPlaca($placa)
    {
        return $this->where('placa', $placa)->where('veiculo.status !=', 'desativado')->first();
    }
    
    
}
