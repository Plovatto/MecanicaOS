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
        'tipo',
    ];
    protected $returnType = 'object';

    protected $validationRules = [
        'codigo' => 'required', 
        'nome_completo' => 'required',
        'email' => 'required|valid_email',
        'senha' => 'required',
        'status' => 'required|in_list[ativo,desativado]',
        'cpf' => 'required|exact_length[11]',
        'especialidade_id' => 'required', 
        'tipo' => 'required',
    ];

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
