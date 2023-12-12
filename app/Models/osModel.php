<?php

namespace App\Models;

use CodeIgniter\Model;

class OSModel extends Model
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
    ];
    public function getOrdersByMechanic($mecanico_id, $searchParams) {
        $builder = $this->select('ordemdeservico.*, veiculo.placa as veiculo_placa, cliente.nome_completo as cliente_nome')
                        ->join('equipe_mecanico', 'equipe_mecanico.equipe_id = ordemdeservico.equipe_id')
                        ->join('veiculo', 'veiculo.id = ordemdeservico.veiculo_id')
                        ->join('cliente', 'cliente.id = ordemdeservico.cliente_id')
                        ->where('equipe_mecanico.mecanico_id', $mecanico_id);
    
        foreach ($searchParams as $key => $value) {
            if (!empty($value)) { 
                if ($key == 'cliente_nome') {
                    $builder = $builder->where('cliente.nome_completo', $value);
                } elseif ($key == 'veiculo_placa') {
                    $builder = $builder->where('veiculo.placa', $value);
                } else {
                    $builder = $builder->where('ordemdeservico.' . $key, $value);
                }
            }
        }
    
        $results = $builder->orderBy('ordemdeservico.id', 'DESC')->findAll();
    
        return $results;
    }
    public function getOrdersByCodigo($codigo)
    {
        return $this->select('ordemdeservico.id, ordemdeservico.codigo, ordemdeservico.data_previsao, veiculo.placa as veiculo_placa, cliente.nome_completo as cliente_nome, ordemdeservico.situacao')
                    ->join('veiculo', 'veiculo.id = ordemdeservico.veiculo_id')
                    ->join('cliente', 'cliente.id = ordemdeservico.cliente_id')
                    ->where('ordemdeservico.codigo', $codigo)
                    ->findAll();
    }
    public function getOrderWithDetails($id)
    {
        return $this->select('ordemdeservico.*,
            cliente.nome_completo as cliente_nome,
            cliente.cpf as cliente_cpf,
            cliente.cnh as cliente_cnh,
            cliente.endereco as cliente_endereco,
            cliente.email as cliente_email,
            cliente.status as cliente_status,
            cliente.codigo as cliente_codigo ,
            cliente.telefone as cliente_telefone ,
            veiculo.placa as veiculo_placa,
            veiculo.ano as veiculo_ano,
            veiculo.codigo as veiculo_codigo,
            veiculo.cor as veiculo_cor,
            veiculo.marca_nome  as veiculo_marca,
            veiculo.modelo_nome  as veiculo_modelo,
            veiculo.descricao as veiculo_descricao,
            veiculo.status as veiculo_status,
            user.nome_completo as mecanico_nome,
            equipe.nome as equipe_nome,
            equipe.id as equipe_id,
            equipe.codigo as equipe_codigo,
            peca.nome as peca_id,
            peca.id as peca_nome,
            marca.nome as marca_nome,
            modelo.nome as modelo_nome,
            ordemdeservico_peca.quantidade as quantidade')
            ->join('cliente', 'cliente.id = ordemdeservico.cliente_id', 'left')
            ->join('veiculo', 'veiculo.id = ordemdeservico.veiculo_id', 'left')
            ->join('user', 'user.id = ordemdeservico.mecanico_id', 'left')
            ->join('equipe', 'equipe.id = ordemdeservico.equipe_id', 'left')
            ->join('ordemdeservico_peca', 'ordemdeservico_peca.ordemdeservico_id = ordemdeservico.id', 'left')
            ->join('peca', 'peca.id = ordemdeservico_peca.peca_id', 'left')
            ->join('marca', 'marca.id = veiculo.marca_id', 'left')
        
            ->join('modelo', 'modelo.id = veiculo.modelo_id', 'left')
            ->where('ordemdeservico.id', $id)
            ->first();
            $query = $builder->orderBy('ordemdeservico.id', 'DESC')->get();
            return $query->getResultArray();
    }

    public function getOrdersByVehicle($veiculo_id) {
        return $this->select('ordemdeservico.*, veiculo.placa as veiculo_placa, cliente.nome_completo as cliente_nome ,ordemdeservico.detalhes as ordemdeservico_detalhes')
                    ->join('veiculo', 'veiculo.id = ordemdeservico.veiculo_id')
                    ->join('cliente', 'cliente.id = ordemdeservico.cliente_id')
                    ->where('ordemdeservico.veiculo_id', $veiculo_id)
                    ->findAll();$query = $builder->limit($limit, $offset)->get();
                    echo $query->getLastQuery(); 
                    $result = $query->getResult($this->tempReturnType);
    }


    public function getAllOrdersWithDetails($params)
    {
        $query = $this->select('ordemdeservico.*,
        cliente.nome_completo as cliente_nome,
        cliente.cpf as cliente_cpf,
        veiculo.placa as veiculo_placa,
        veiculo.ano as veiculo_ano,
        veiculo.cor as veiculo_cor,
        veiculo.descricao as veiculo_descricao,
        veiculo.status as veiculo_status,
        user.nome_completo as mecanico_nome,
        equipe.nome as equipe_nome,
        marca.nome as marca_nome,
        modelo.nome as modelo_nome')
        ->join('cliente', 'cliente.id = ordemdeservico.cliente_id', 'left')
        ->join('veiculo', 'veiculo.id = ordemdeservico.veiculo_id', 'left')
        ->join('user', 'user.id = ordemdeservico.mecanico_id', 'left')
        ->join('equipe', 'equipe.id = ordemdeservico.equipe_id', 'left')
        ->join('marca', 'marca.id = veiculo.marca_id', 'left')
        ->join('modelo', 'modelo.id = veiculo.modelo_id', 'left');

            if (empty($params)) {
                return $this->findAll();
            }
        if (!empty($params['codigo'])) {
            $query->where('ordemdeservico.codigo', $params['codigo']);
        }
        if (!empty($params['cliente_nome'])) {
            $query->like('cliente.nome_completo', $params['cliente_nome']);
        }
       
        if (!empty($params['veiculo_placa'])) {
            $query->where('veiculo.placa', $params['veiculo_placa']);
        }
        if (!empty($params['data_previsao'])) {
            $query->where('ordemdeservico.data_previsao', $params['data_previsao']);
        }
    
        $query = $query->orderBy('ordemdeservico.id', 'DESC');

    return $query->findAll();

    }
public function getOrderByCodigo($codigo)
{
    return $this->where('codigo', $codigo)->first();
}public function getUniquePlacas()
{
    return $this->select('veiculo.placa')
                ->join('veiculo', 'veiculo.id = ordemdeservico.veiculo_id')
                ->distinct()
                ->findAll();
}

public function getUniqueClientes()
{
    return $this->select('cliente.nome_completo')
                ->join('cliente', 'cliente.id = ordemdeservico.cliente_id')
                ->distinct()
                ->findAll();
}

public function getUniqueDatas()
{
    return $this->select('ordemdeservico.data_previsao')
                ->distinct()
                ->findAll();
}

public function getOrdersByFilters($placa, $cliente)
{
    $builder = $this->db->table('os');
    $builder->join('veiculos', 'os.veiculo_id = veiculos.id');

    if (!empty($placa)) {
        $builder->where('veiculos.placa', $placa);
    }

    if (!empty($cliente)) {
        $builder->where('os.cliente', $cliente);
    }

    return $builder->get()->getResult();
}public function getPecas($orderId) {
    $builder = $this->db->table('pecas');
    $builder->where('order_id', $orderId);
    $query = $builder->get();

    if ($query === false) {
    
        return [];
    }

    return $query->getResult();
}
} 