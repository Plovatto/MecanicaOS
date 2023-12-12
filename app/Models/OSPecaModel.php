<?php namespace App\Models;

use CodeIgniter\Model;

class OSPecaModel extends Model
{
    protected $table = 'ordemdeservico_peca';

    protected $primaryKey = ['ordemdeservico_id', 'peca_id'];

    protected $allowedFields = ['ordemdeservico_id', 'peca_id', 'quantidade'];

    protected $returnType = 'array';


    public function getPecasForOrdem($ordemdeservico_id)
    {
        return $this->db->table('ordemdeservico_peca')
        ->select('ordemdeservico_peca.*, peca.nome, peca.valor as peca_valor,peca.tipo as peca_tipo, peca.id as peca_id, peca.codigo as peca_codigo, peca.descricao as peca_descricao, peca.status as peca_status')                ->join('peca', 'peca.id = ordemdeservico_peca.peca_id')
                ->where('ordemdeservico_id', $ordemdeservico_id)
                ->get()
                ->getResultArray();
    }
}
