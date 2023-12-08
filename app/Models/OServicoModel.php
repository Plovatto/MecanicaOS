<?php namespace App\Models;

use CodeIgniter\Model;

class OServicoModel extends Model
{
    protected $table = 'ordemdeservico_servico';
   

    protected $primaryKey = ['ordemdeservico_id', 'servico_id'];

    protected $allowedFields = ['ordemdeservico_id', 'servico_id'];

    protected $returnType = 'array';

  
    public function getServicosForOrdem($ordemdeservico_id)
    {
        return $this->db->table('ordemdeservico_servico')
                ->select('ordemdeservico_servico.*, servicos.nome,servicos.tipo as servico_tipo, servicos.valor as servico_valor,servicos.id as servico_id, servicos.codigo as servico_codigo ,servicos.descricao as servico_descricao , servicos.status as servico_status')
                ->join('servicos', 'servicos.id = ordemdeservico_servico.servico_id')
                ->where('ordemdeservico_id', $ordemdeservico_id)
                ->get()
                ->getResultArray();
    }
}