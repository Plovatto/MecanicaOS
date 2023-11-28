<?php namespace App\Models;

use CodeIgniter\Model;

class OsPecaModel extends Model
{
    protected $table = 'ordemdeservico_peca';

    protected $primaryKey = ['ordemdeservico_id', 'peca_id'];

    protected $allowedFields = ['ordemdeservico_id', 'peca_id', 'quantidade'];

    protected $returnType = 'array';

    public function getPecasForOrdem($ordemdeservico_id)
    {
        return $this->db->table('ordemdeservico_peca')
                        ->select('ordemdeservico_peca.*, peca.nome')
                        ->join('peca', 'peca.id = ordemdeservico_peca.peca_id')
                        ->where('ordemdeservico_id', $ordemdeservico_id)
                        ->get()
                        ->getResultArray();
    }
}