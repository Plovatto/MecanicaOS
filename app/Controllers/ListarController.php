<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\EquipeMecanicoModel;
use App\Models\osModel;
use App\Models\UserModel;
use App\Models\VeiculoModel;
use App\Models\PecaModel;
use App\Models\EquipeModel;
use App\Models\ServicoModel;

class ListarController extends BaseController
{
    public function listar()
    {
        $tipo = $this->request->getGet('tipo');

        if ($tipo === 'cliente') {
            $clienteModel = new ClienteModel();
            $clientes = $clienteModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'clientes' => $clientes]);
        } elseif ($tipo === 'veiculo') {
            $veiculoModel = new VeiculoModel();
            $veiculos = $veiculoModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'veiculos' => $veiculos]);
        } elseif ($tipo === 'os') {
            $osModel = new osModel();
            $orders = $osModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'orders' => $orders]);
        } elseif ($tipo === 'mecanico') {
            $userModel = new UserModel();
            $users = $userModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'users' => $users]);
        }
        elseif ($tipo === 'peca') {
            $pecaModel = new PecaModel();
            $pecas = $pecaModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'pecas' => $pecas]);

        }   elseif ($tipo === 'equipe') {
            $equipeModel = new EquipeModel();
            $equipes = $equipeModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'equipes' => $equipes]);
        }
        elseif ($tipo === 'admin') {
            $userModel = new UserModel();
            $users = $userModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'users' => $users]);
        }
        elseif ($tipo === 'servico') {
            $servicoModel = new ServicoModel();
            $servicos = $servicoModel->orderBy('id', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'servicos' => $servicos]);
        }
    }

    public function detalhes($tipo, $id)
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
        $servico = null;
        $equipe = null;          $session = session(); $userType = $session->get('user_type');
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

                break;
                case 'peca':
                    $pecaModel = new PecaModel();
                    $peca = $pecaModel->find($id);
                    $item = $peca;
                    
    
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
                                $mecanico = $userModel->find($mecanicoId['mecanico_id']);
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
                                break;
            default:

                break;
        }

        return view('detalhes', ['tipo' => $tipo, 'userType'=> $userType ,'servico'=>$servico,'user'=>$user,'equipe'=>$equipe  ,'veiculo' => $veiculo, 'veiculos' => $veiculos, 'cliente' => $cliente, 'clienteDoVeiculo' => $clienteDoVeiculo, 'peca' => $peca]);

    }


  public function alterarStatus($tipo,$id)
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
                    $osModel = new osModel();
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
                    case 'equipe':
                        $equipeModel = new EquipeModel();
                        $equipe = $equipeModel->find($id);
                    
                        if ($equipe) {
                            $novoStatus = ($equipe['status'] === 'ativo') ? 'desativado' : 'ativo';
                    
                            $data = ['status' => $novoStatus];
                            echo "Updating equipe with ID $id: ";
                            print_r($data);
                    
                            // Uncomment this line
                            $equipeModel->update($id, $data);
                    
                            // Uncomment this line
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
 