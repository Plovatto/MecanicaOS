<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\EquipeMecanicoModel;
use App\Models\EquipeModel;
use App\Models\EspecialidadeModel;
use App\Models\OSModel;
use App\Models\PecaModel;
use App\Models\ServicoModel;
use App\Models\UserModel;
use App\Models\VeiculoModel;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\PHPMailer;

class ListarController extends BaseController
{
    public function listar()
    {
        $tipo = $this->request->getGet('tipo');
        $pesquisa = $this->request->getGet('pesquisa') ?? '';
        $data = [];
        $partsData = [];
        $servicesData = [];
        $teamsData = [];
        $campoPesquisa = 'nome';
        $campoPesquisa2 = null;
        $campoPesquisa3 = null;
        if ($tipo === 'cliente') {
            $model = new ClienteModel();
            $campoPesquisa = 'nome_completo';
            $campoPesquisa2 = 'cnh';
            $campoPesquisa3 = 'codigo';
        } elseif ($tipo === 'veiculo') {
            $model = new VeiculoModel();
            $campoPesquisa = 'placa';
            $campoPesquisa2 = 'modelo_nome';
            $campoPesquisa3 = 'marca_nome';

        } elseif ($tipo === 'os') {

            $campoPesquisa2 = 'codigo';
            $campoPesquisa = 'data_previsao';
            $model = new OSModel();
        } elseif ($tipo === 'mecanico') {
            $campoPesquisa = 'nome_completo';
            $campoPesquisa2 = 'especialidade_nome';
            $campoPesquisa3 = 'codigo';
            $model = new UserModel();
        } elseif ($tipo === 'peca') {
            $campoPesquisa = 'nome';
            $campoPesquisa2 = 'valor';
            $campoPesquisa3 = 'codigo';
            $model = new PecaModel();
        } elseif ($tipo === 'especialidade') {
            $campoPesquisa = 'nome';
            $campoPesquisa3 = 'codigo';
            $model = new EspecialidadeModel();
        } elseif ($tipo === 'equipe') {
            $campoPesquisa = 'nome';
            $campoPesquisa3 = 'codigo';

            $model = new EquipeModel();

        } elseif ($tipo === 'admin') {
            $model = new UserModel();
            $campoPesquisa3 = 'codigo';
            $campoPesquisa = 'nome_completo';
            $campoPesquisa2 = 'tipo';
        } elseif ($tipo === 'servico') {
            $model = new ServicoModel();
            $campoPesquisa3 = 'codigo';
            $campoPesquisa2 = 'valor';
            $campoPesquisa = 'nome';
        } elseif ($tipo === 'graficos') {
            $model = new ServicoModel();
            $db = \Config\Database::connect();
            $campoPesquisa3 = 'codigo';
            $campoPesquisa = 'nome_completo';
            $campoPesquisa2 = 'tipo';
            $carQuery = $db->query('SELECT veiculo.placa, COUNT(*) as count FROM veiculo JOIN ordemdeservico ON veiculo.id = ordemdeservico.veiculo_id GROUP BY veiculo.placa ORDER BY count DESC');

            $servicesQuery = $db->query('SELECT servicos.nome, COUNT(*) as count FROM servicos JOIN ordemdeservico_servico ON servicos.id = ordemdeservico_servico.servico_id GROUP BY servicos.nome ORDER BY count DESC');
            $teamsQuery = $db->query('SELECT equipe.nome, COUNT(*) as count FROM equipe INNER JOIN ordemdeservico ON equipe.id = ordemdeservico.equipe_id GROUP BY equipe.nome ORDER BY count DESC');
            $partsQuery = $db->query('SELECT peca.nome, SUM(ordemdeservico_peca.quantidade) as count FROM peca JOIN ordemdeservico_peca ON peca.id = ordemdeservico_peca.peca_id GROUP BY peca.nome ORDER BY count DESC');if ($partsQuery === false) {
                die(print_r($db->error(), true));
            }
            if ($servicesQuery === false) {
                die(print_r($db->error(), true));
            }

            $servicesData = $servicesQuery->getResultArray();

            if ($teamsQuery === false) {
                die(print_r($db->error(), true));
            }
            $teamsData = $teamsQuery->getResultArray();

            $partsData = $partsQuery->getResultArray();

            $data['teamsData'] = $teamsData;
            $data['servicesData'] = $servicesData;
            $data['partsData'] = $partsData;
        }

        $dados = [];
        if ($model) {
            try {
                if ($pesquisa) {
                    if ($campoPesquisa == 'cnh') {
                        $query = $model->where($campoPesquisa, $pesquisa);
                    } else {
                        $query = $model->like($campoPesquisa, $pesquisa);
                    }
                    if ($campoPesquisa2) {
                        $query = $query->orLike($campoPesquisa2, $pesquisa);
                    }
                    if ($campoPesquisa3) {
                        $query = $query->orLike($campoPesquisa3, $pesquisa);
                    }
                    $dados = $query->orderBy('id', 'DESC')->findAll();
                } else {
                    $dados = $model->orderBy('id', 'DESC')->findAll();
                }
            } catch (\Exception $e) {
                error_log($e->getMessage());
            }
        }

        return view('Ver', ['data' => $data, 'tipo' => $tipo, 'dados' => $dados, 'pesquisa' => $pesquisa, 'partsData' => $partsData, 'servicesData' => $servicesData, 'teamsData' => $teamsData]);
    }

    public function detalhes($tipo, $id)
    {$equipes = null;
        $item = null;
        $cliente = null;
        $clientes = null;
        $clienteDoVeiculo = null;
        $veiculo = null;
        $order = null;
        $veiculos = null;
        $peca = null;
        $user = null;
        $servico = null;
        $especialidade = null;
        $equipe = null;
        $session = session();
        $userType = $session->get('user_type');
        switch ($tipo) {

            case 'cliente':
                $clienteModel = new ClienteModel();
                $cliente = $clienteModel->find($id);
                $veiculoModel = new VeiculoModel();
                $veiculos = $veiculoModel->getVeiculosDoCliente($id);

                $item = $cliente;
                break;
            case 'veiculo':
                $veiculoModel = new VeiculoModel();
                $veiculoCodigo = $id;
                $clienteDoVeiculo = $veiculoModel->getClienteFromVeiculo($veiculoCodigo);
                $veiculo = $veiculoModel->getVeiculoWithMarcaModelo($id);
                $item = $veiculo;
                $osModel = new OSModel();
                $order = $osModel->getOrdersByVehicle($veiculo->id);

                break;

            case 'os':
                $osModel = new osModel();
                $order = $osModel->find($id);
                $item = $order;
                $order = $osModel->getOrderWithDetails($id);

                break;

            case 'mecanico':
                $userModel = new userModel();
                $user = $userModel->find($id);
                $item = $user;
                $user = $userModel->getPerfilWithEspecialidade($id);
                $equipeModel = new EquipeMecanicoModel();
                $equipes = $equipeModel->getEquipesPorMecanico($id);

                break;
            case 'peca':
                $pecaModel = new PecaModel();
                $peca = $pecaModel->find($id);
                $item = $peca;

                break;
            case 'especialidade':
                $especialidadeModel = new EspecialidadeModel();
                $especialidade = $especialidadeModel->find($id);
                $item = $especialidade;

                break;
            case 'servico':
                $servicoModel = new ServicoModel();
                $servico = $servicoModel->find($id);
                $item = $servico;

                break;
            case 'equipe':
                $equipeModel = new EquipeModel();
                $equipeMecanicoModel = new EquipeMecanicoModel();
                $userModel = new UserModel();

                $equipe = $equipeModel->find($id);
                $mecanicosIds = $equipeMecanicoModel->getMecanicosPorEquipe($id);

                $equipe['mecanicos'] = [];
                foreach ($mecanicosIds as $mecanicoId) {
                    $mecanico = $userModel->find($mecanicoId->mecanico_id);
                    if ($mecanico) {
                        $equipe['mecanicos'][] = $mecanico;
                    }
                }

                $item = $equipe;
                break;
            case 'admin':
                $userModel = new userModel();
                $user = $userModel->find($id);
                $item = $user;
                $user = $userModel->getPerfilWithEspecialidade($id);
                $adminEmail = $user->email;
                $adminName = $user->nome_completo;
                $session = session();
                $session->set('admin_email', $adminEmail);
                $session->set('admin_name', $adminName);
                break;

            default:

                break;
        }

        return view('detalhes', ['especialidade' => $especialidade, 'equipes' => $equipes, 'order' => $order, 'tipo' => $tipo, 'userType' => $userType, 'servico' => $servico, 'user' => $user, 'equipe' => $equipe, 'veiculo' => $veiculo, 'veiculos' => $veiculos, 'cliente' => $cliente, 'clienteDoVeiculo' => $clienteDoVeiculo, 'peca' => $peca]);

    }

    public function requestPart()
    {
        if ($this->request->getMethod() === 'post') {
            $part = $this->request->getPost('part');

            $session = session();
            $mechanicEmail = $session->get('user_email');
            $mechanicName = $session->get('user_name');
            $adminEmail = $session->get('admin_email');
            $adminName = $session->get('admin_name');
            $subject = "Solicitação de peça";
            $message = "
        <html style=\"height: auto; min-height:40rem;\">
        <head>
        </head>
        <body style=\"border: solid 1px #3E632C; background-color: #ffffff; height: auto;\">
            <div style=\"width: auto; min-height: 120px; background: url('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSU7fLzjdVA0RezADB2bfz2CCfKwLEefwSKflppqtXwxXofKVZO'); background-size: cover;\"></div>
            <br>
            <h1 style=\"text-align: center; color: #3E632C;\">Solicitação de peça:</h1>
            <p style=\"text-align: center;\">Prezado(a) $adminName,</p>
            <div style=\"margin: 1rem 3rem;\">
                <p> Gostaríamos de informar que foi feito um pedido de adicionar uma nova peça em nosso sistema. Por favor verifique o pedido abaixo:</p>
                <p><span style=\"color: #3E632C;\">Peça solicitada : </span> $part</p>
                <p><span style=\"color: #3E632C;\">Nome do solicitante : </span> $mechanicName</p>
                <p><span style=\"color: #3E632C;\">Email do solicitante : </span> $mechanicEmail</p>



                <p>            Agradecemos antecipadamente pela sua atenção a este assunto.</p>
                <br>
                <p>Atenciosamente, <span style=\"color: #3E632C; font-weight: 600; font-size: 18px;\">Pista & Parafusos</span>.</p>
            </div>
            <div style=\"background-color: ##3E632C; height: 40px;\"></div>
        </body>
        </html>
        ";

            $this->sendEmail($adminEmail, $subject, $message);
        }

        session()->setFlashdata('success', 'Solicitação de peça enviada com sucesso! Aguarde a resposta do administrador');
        return redirect()->back();
    }

    public function requestPart2()
    {
        if ($this->request->getMethod() === 'post') {
            $part2 = $this->request->getPost('part2');

            $session = session();
            $mechanicEmail = $session->get('user_email');
            $mechanicName = $session->get('user_name');
            $adminEmail = $session->get('admin_email');
            $adminName = $session->get('admin_name');
            $subject = "Solicitação de serviço";
            $message = "
        <html style=\"height: auto; min-height:40rem;\">
        <head>
        </head>
        <body style=\"border: solid 1px #3E632C; background-color: #ffffff; height: auto;\">
            <div style=\"width: auto; min-height: 120px; background: url('https://encrypted-tbn1.gstatic.com/images?q=tbn:ANd9GcSU7fLzjdVA0RezADB2bfz2CCfKwLEefwSKflppqtXwxXofKVZO'); background-size: cover;\"></div>
            <br>
            <h1 style=\"text-align: center; color: #3E632C;\">Solicitação de serviço:</h1>
            <p style=\"text-align: center;\">Prezado(a) $adminName,</p>
            <div style=\"margin: 1rem 3rem;\">
                <p> Gostaríamos de informar que foi feito um pedido de adicionar um novo serviço em nosso sistema. Por favor verifique o pedido abaixo:</p>
                <p><span style=\"color: #3E632C;\">Serviço solicitado : </span> $part2</p>
                <p><span style=\"color: #3E632C;\">Nome do solicitante : </span> $mechanicName</p>
                <p><span style=\"color: #3E632C;\">Email do solicitante : </span> $mechanicEmail</p>



                <p>            Agradecemos antecipadamente pela sua atenção a este assunto.</p>
                <br>
                <p>Atenciosamente, <span style=\"color: #3E632C; font-weight: 600; font-size: 18px;\">Pista & Parafusos</span>.</p>
            </div>
            <div style=\"background-color: ##3E632C; height: 40px;\"></div>
        </body>
        </html>
        ";

            $this->sendEmail($adminEmail, $subject, $message);
        }

        session()->setFlashdata('success', 'Solicitação de serviço enviada com sucesso! Aguarde a resposta do administrador');
        return redirect()->back();
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
    public function alterarStatus($tipo, $id)
    {
        $item = null;
        $cliente = null;
        $clientes = null;
        $clienteDoVeiculo = null;
        $veiculo = null;
        $order = null;
        $veiculos = null;
        $peca = null;
        $user = null;
        $especialidade = null;
        $servico = null;
        $item = $cliente;
        switch ($tipo) {

            case 'cliente':

                $clienteModel = new ClienteModel();
                $cliente = $clienteModel->find($id);

                if ($cliente) {

                    $novoStatus = ($cliente->status === 'ativo') ? 'desativado' : 'ativo';

                    $data = ['status' => $novoStatus];
                    $clienteModel->update($id, $data);

                    return redirect()->to(base_url("detalhes/cliente/$id"));
                } else {

                    return redirect()->to(base_url('clientes'));
                }
                break;

            case 'mecanico':

                $userModel = new UserModel();
                $user = $userModel->find($id);

                if ($user) {

                    $novoStatus = ($user->status === 'ativo') ? 'desativado' : 'ativo';

                    $data = ['status' => $novoStatus];
                    $userModel->update($id, $data);

                    return redirect()->to(base_url("detalhes/mecanico/$id"));
                } else {

                    return redirect()->to(base_url('mecanicos'));
                }
                break;
            case 'servico':

                if ($tipo === 'servico') {
                    $servicoModel = new ServicoModel();
                    $servico = $servicoModel->find($id);

                    if ($servico) {
                        $novoStatus = 'ativo';
                        if ($servico['status'] === 'ativo') {
                            $novoStatus = 'desativado';
                        } else if ($servico['status'] === 'desativado') {
                            $novoStatus = 'ativo';
                        }

                        $data = ['status' => $novoStatus];
                        if (!empty($data['status'])) {
                            $servicoModel->update($id, $data);
                        }

                        return redirect()->to(base_url("detalhes/servico/$id"));
                    } else {
                        return redirect()->to(base_url("detalhes/servico/$id"));
                    }
                }

                break;
            case 'os':
                $osModel = new OSModel();
                $order = $osModel->find($id);

                if ($order) {
                    $novoStatus = 'A concluir';
                    if ($order['situacao'] === 'A concluir') {
                        $novoStatus = 'concluído';
                    } else if ($order['situacao'] === 'concluído') {
                        $novoStatus = 'A concluir';
                    }

                    $data = ['situacao' => $novoStatus];
                    $osModel->update($id, $data);

                    return redirect()->to(base_url("detalhesOS/$id"));
                } else {
                    return redirect()->to(base_url('os'));
                }
                break;
            case 'peca':

                $pecaModel = new PecaModel();
                $peca = $pecaModel->find($id);

                if ($peca) {

                    $novoStatus = ($peca['status'] === 'ativo') ? 'desativado' : 'ativo';

                    $data = ['status' => $novoStatus];
                    $pecaModel->update($id, $data);

                    return redirect()->to(base_url("detalhes/peca/$id"));
                } else {

                    return redirect()->to(base_url('peca'));
                }
                break;
            case 'especialidade':

                $especialidadeModel = new EspecialidadeModel();
                $especialidade = $especialidadeModel->find($id);

                if ($especialidade) {

                    $novoStatus = ($especialidade['status'] === 'ativo') ? 'desativado' : 'ativo';

                    $data = ['status' => $novoStatus];
                    $especialidadeModel->update($id, $data);

                    return redirect()->to(base_url("detalhes/especialidade/$id"));
                } else {

                    return redirect()->to(base_url('especialidade'));
                }
                break;
            case 'equipe':
                $equipeModel = new EquipeModel();
                $equipe = $equipeModel->find($id);

                if ($equipe) {
                    $novoStatus = ($equipe['status'] === 'ativo') ? 'desativado' : 'ativo';

                    $data = ['status' => $novoStatus];
                    echo "Updating equipe with ID $id: ";
                    print_r($data);

                    $equipeModel->update($id, $data);

                    return redirect()->to(base_url("detalhes/equipe/$id"));
                } else {
                    return redirect()->to(base_url('equipe'));
                }
                break;
            case 'veiculo':

                $veiculoModel = new VeiculoModel();
                $veiculo = $veiculoModel->find($id);

                if ($veiculo) {

                    $novoStatus = ($veiculo->status === 'ativo') ? 'desativado' : 'ativo';

                    $data = ['status' => $novoStatus];
                    $veiculoModel->update($id, $data);

                    return redirect()->to(base_url("detalhes/veiculo/$id"));
                } else {

                    return redirect()->to(base_url('veiculo'));
                }
                break;

        }

    }

}
