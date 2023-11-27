<?php namespace App\Models;

use CodeIgniter\Model;

class OServicoModel extends Model
{
    protected $table = 'ordemdeservico_servico';
    protected $primaryKey = ['ordemdeservico_id', 'servico_id'];

    protected $returnType = 'array';
    protected $useSoftDeletes = false;

    protected $allowedFields = ['ordemdeservico_id', 'servico_id'];

    protected $useTimestamps = false;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [];
    protected $validationMessages = [];
    protected $skipValidation     = false;

    public function getServicosForOrdem($ordemdeservico_id)
    {
        return $this->db->table('ordemdeservico_servico')
        ->select('ordemdeservico_servico.*, servicos.nome')
        ->join('servicos', 'servicos.id = ordemdeservico_servico.servico_id')
        ->where('ordemdeservico_id', $ordemdeservico_id)  
        ->get()
        ->getResultArray();
    }
}