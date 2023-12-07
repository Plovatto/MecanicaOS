<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipeMecanicoModel extends Model
{
    protected $table = 'equipe_mecanico';
    protected $primaryKey = ['equipe_id', 'mecanico_id'];
    protected $allowedFields = ['equipe_id', 'mecanico_id'];
    public function getAll() 
    {
        return $this->findAll();
    }
    public function getMecanicosPorEquipe($id)
    {
        $result = $this->db->table('equipe_mecanico')
        ->where('equipe_id', $id)
        ->join('user', 'user.id = equipe_mecanico.mecanico_id')
        ->where('user.status !=', 'desativado') 
        ->get()
        ->getResult();

    

    
    
        return $result;
    }
    public function getEquipesPorMecanico($mecanicoId)
    {
        return $this->select('equipe.nome, equipe.descricao, equipe.status as status, equipe.codigo, equipe.id as equipe_id, equipe_mecanico.mecanico_id')
                    ->join('equipe', 'equipe.id = equipe_mecanico.equipe_id')
                    ->where('equipe_mecanico.mecanico_id', $mecanicoId)
                    ->findAll();
    }
}