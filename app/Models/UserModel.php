<?php

namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = 'user';
    protected $primaryKey = 'id';
    protected $allowedFields = [
        'codigo',
        'nome_completo',
        'endereco',
        'email',
        'senha',
        'status',
        'cpf',
        'especialidade_id', 
        'especialidade_nome',
        'tipo',
    ];
    protected $returnType = 'object';


    public function getPerfilWithEspecialidade($userId)
    {
        return $this->select('user.*, especialidade.nome as especialidade_nome')
            ->join('especialidade', 'especialidade.id = user.especialidade_id', 'left')
            ->where('user.id', $userId)
            ->first();
    }
    public function getMecanicos()
{
    return $this->where('tipo', 'mecanico')->findAll();
}
}
