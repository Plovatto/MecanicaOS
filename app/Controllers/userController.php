<?php

namespace App\Controllers;

use App\Models\UserModel;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

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
                            $session->set('user_name', $user->nome_completo);
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
        $session->remove(['user_type', 'user_id', 'user_email', 'user_name']);
        return redirect()->to('/');
    }

    public function perfil()
    {
        $session = session();
        $userId = $session->get('user_id');
        $userType = $session->get('user_type');

        $userModel = new UserModel();
        $perfil = $userModel->getPerfilWithEspecialidade($userId);

        return view('perfil', ['userType' => $userType, 'perfil' => $perfil]);
    }

    public function forgotPassword()
    {
       return view('Redefinir');
    }
    

    public function resetSenha()
    {
        return view('ResetSenha');
    }

    public function sendResetCode()
    {
        $email = $this->request->getPost('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->first();

      
        if ($user) {
            $nome = $user->nome_completo;
            $verificationCode = rand(100000, 999999);
            $userModel->updateVerificationCode($user->id, $verificationCode);
    
         
            $message = "
            <html style=\"height: auto; min-height:40rem;\">
            <head>
         
            </head>
            <body style=\"border: solid 1px #3E632C; background-color: #ffffff; height: auto;\">
                <div style=\"width: auto; min-height: 120px; background: url('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSU7fLzjdVA0RezADB2bfz2CCfKwLEefwSKflppqtXwxXofKVZO'); background-size: cover;\"></div>
                <br>
                <h1 style=\"text-align: center; color: #3E632C;\">Redefinição de Senha</h1>
                <p style=\"text-align: center;\">Prezado(a) $nome,</p>
                <div style=\"margin: 1rem 3rem;\">
                    <p>Esperamos que esta mensagem o encontre bem. Para concluir o processo de redefinição de senha em sua conta, por favor, utilize o código de verificação abaixo:</p>
                    <p style=\"text-align: center;\"><span style=\"color: #3E632C;font-size: 18px;font-weight: 600; \">$verificationCode</span></p>                  
                    <p>Agradecemos por sua cooperação e compreensão na manutenção da segurança de sua conta. Estamos à disposição para ajudar caso precise de assistência adicional.</p>
                    <br>
                    <p>Atenciosamente, <span style=\"color: #3E632C; font-weight: 600; font-size: 18px;\">Pista & Parafusos</span>.</p>
                </div>
                <div style=\"background-color: ##3E632C; height: 40px;\"></div>
            </body>
            </html>
            ";
    

            $this->sendEmail($email, 'Código de verificação', $message);
    
            session()->set('email', $email);
    
            return redirect()->to('/user/confirm-code');
        } else {
            session()->set('error', 'E-mail não cadastrado');
            return redirect()->to('/user/forgot-password');
        }
    }

    public function confirmCode()
    {
        return view('ConfirmCode');
    }

    public function verifyCode()
    {
        $code = $this->request->getPost('code');
        $email = session()->get('email');
        $userModel = new UserModel();
        $user = $userModel->where('email', $email)->where('codigo_verificacao', $code)->first();

        if ($user) {
            return redirect()->to('/user/reset-password');
        } else {
            session()->set('error', 'Código de verificação incorreto');
            return redirect()->to('/user/confirm-code');
        }
    }
    public function resetPassword()
    {
        $senha = $this->request->getPost('password');
        $confirmSenha = $this->request->getPost('confirm_password');
        $email = session()->get('email');
        $userModel = new UserModel();

        if ($senha !== $confirmSenha) {
            session()->set('error', 'As senhas não coincidem');
            return redirect()->to('/user/reset-password');
        }

        error_log("Email: $email");
        error_log("Password: $senha");

        if ($userModel->updatePassword($email, $senha)) {
            session()->remove('email');
            return redirect()->to('/');
        }
    }


    private function sendEmail($to, $subject, $body)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'pistaeparafusos@gmail.com';
            $mail->Password = 'rtgy xusb kjle ghgg';
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('pistaeparafusos@gmail.com', 'Pista & Parafusos');
            $mail->addAddress($to);

            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body = $body;

            $mail->send();

        } catch (Exception $e) {
            error_log('Erro no envio de e-mail: ' . $e->getMessage());
        }
    }
}
