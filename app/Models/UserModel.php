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
        'codigo_verificacao',
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
    return $this->where('tipo', 'mecanico')->where('user.status !=', 'desativado')->findAll();
}


public function updateVerificationCode($userId, $code)
{
    return $this->update($userId, ['codigo_verificacao' => $code]);
}
public function updatePassword($email, $newPassword)
{
    $data = [
        'senha' => password_hash($newPassword, PASSWORD_DEFAULT)
    ];

    error_log(": $email");
    error_log(" " . $data['senha']);

    return $this->where('email', $email)->set($data)->update();
}
}
