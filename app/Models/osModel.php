<?php

namespace App\Models;

use CodeIgniter\Model;

class OsModel extends Model
{
    protected $table = 'ordemdeservico';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'codigo',
        'situacao',
        'defeito',
        'solucao',
        'detalhes',
        'data_emissao',
        'quantidade_peca',
        'valor_servicos',
        'valor_pecas',
        'status',
        'situacao',
        'total',
        'data_previsao',
        'cliente_id',
        'veiculo_id',
        'mecanico_id',
        'equipe_id',
        'peca_id',
    ];

    public function getOrderWithDetails($id)
    {
        return $this->select('ordemdeservico.*,
            cliente.nome_completo as cliente_nome,
            veiculo.placa as veiculo_placa,
            veiculo.ano as veiculo_ano,
            veiculo.cor as veiculo_cor,
            veiculo.descricao as veiculo_descricao,
            veiculo.status as veiculo_status,
            user.nome_completo as mecanico_nome,
            equipe.nome as equipe_nome,
            peca.nome as peca_nome,
            marca.nome as marca_nome,
            modelo.nome as modelo_nome')
            ->join('cliente', 'cliente.id = ordemdeservico.cliente_id', 'left')
            ->join('veiculo', 'veiculo.id = ordemdeservico.veiculo_id', 'left')
            ->join('user', 'user.id = ordemdeservico.mecanico_id', 'left')
            ->join('equipe', 'equipe.id = ordemdeservico.equipe_id', 'left')
            ->join('peca', 'peca.id = ordemdeservico.peca_id', 'left')
            ->join('marca', 'marca.id = veiculo.marca_id', 'left')
            ->join('modelo', 'modelo.id = veiculo.modelo_id', 'left')
            ->where('ordemdeservico.id', $id)
            ->first();
    }
}
