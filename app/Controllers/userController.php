<?php

namespace App\Controllers;

use App\Models\UserModel;

class userController extends BaseController
{
    public function index()
    {
        $data = [];
        $data['emailError'] = '';
        $data['passwordError'] = '';
        $data['loginError'] = '';

        if ($this->request->getMethod() === 'post') {
            $email = $this->request->getPost('email');
            $password = $this->request->getPost('password');

            if (empty($email)) {
                $data['emailError'] = 'O campo de e-mail é obrigatório.';
            }
            if (empty($password)) {
                $data['passwordError'] = 'O campo de senha é obrigatório.';
            }

            if (empty($data['emailError']) && empty($data['passwordError'])) {

                $userModel = new UserModel();
                $user = $userModel->where('email', $email)->first();

                if ($user) {
                    if (password_verify($password, $user->senha)) {
                        if ($user->status === 'ativo') {
                            $session = session();
                            if ($user->tipo === 'admin') {
                                $userType = 'admin';
                            } elseif ($user->tipo === 'mecanico') {
                                $userType = 'mecanico';
                            }
                            $session->set('user_type', $userType);
                            $session->set('user_id', $user->id);
                            $session->set('user_email', $user->email);
                            return redirect()->to('/orders');
                        } else {
                            $data['loginError'] = 'Conta desativada';
                        }
                    } else {
                        $data['loginError'] = 'Senha incorreta.';
                    }
                } else {
                    $data['loginError'] = 'Usuário não encontrado';
                }}
        }

        return view('login', $data);
    }

    public function logout()
    {
        $session = session();
        $session->remove(['user_type', 'user_id', 'user_email']);
        return redirect()->to('/');
    }

    public function perfil()
    {
        $session = session();
        $userId = $session->get('user_id');

        if (!$userId) {

            return redirect()->to('/pagina_de_erro');
        }

        $userModel = new UserModel();
        $perfil = $userModel->getPerfilWithEspecialidade($userId);

        return view('perfil', ['perfil' => $perfil]);
    }


}
