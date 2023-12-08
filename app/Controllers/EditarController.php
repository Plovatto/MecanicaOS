<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\EquipeMecanicoModel;
use App\Models\EquipeModel;
use App\Models\EspecialidadeModel;
use App\Models\MarcaModel;
use App\Models\ModeloModel;
use App\Models\PecaModel;
use App\Models\ServicoModel;
use App\Models\UserModel;
use App\Models\VeiculoModel;
class EditarController extends BaseController
{
    public function editar($tipo, $id)
    {$cliente = null;
        $peca = null;
        $servico = null;
        $user = null;
$equipe = null;
$especialidade = null;
        $veiculo = null;
        switch ($tipo) {

            case 'cliente':
                $data['tipo'] = $tipo;
                helper('form');
                $clienteModel = new ClienteModel();

                helper('form');

                $cliente = $clienteModel->getClienteById($id);

                if ($cliente === null) {
                    return redirect()->to(base_url('orders'));
                }
                break;
                case 'peca':
                    $data['tipo'] = $tipo;
                    helper('form');
                    $pecaModel = new PecaModel();
    
                    helper('form');
    
                    $peca = $pecaModel->getPecaById($id);
    
                    if ($peca === null) {
                        return redirect()->to(base_url('orders'));
                    }
                    break; case 'especialidade':
                        $data['tipo'] = $tipo;
                        helper('form');
                        $especialidadeModel = new EspecialidadeModel();
        
                        helper('form');
        
                        $especialidade = $especialidadeModel->getEspecialidadeById($id);
        
                        if ($especialidade === null) {
                            return redirect()->to(base_url('orders'));
                        }
                        break;

                    case 'servico':
                        $data['tipo'] = $tipo;
                        helper('form');
                        $servicoModel = new ServicoModel();
        
                        helper('form');
        
                        $servico = $servicoModel->getServicoById($id);
        
                        if ($servico === null) {
                            return redirect()->to(base_url('orders'));
                        }
                        break;
                        case 'mecanico':
                            $data['tipo'] = $tipo;
                            helper('form');
                            $userModel = new UserModel();
                            
                            
                            $especialidadeModel = new EspecialidadeModel();
                            $especialidades = $especialidadeModel->findAll();
                            $options = [];
                            foreach ($especialidades as $especialidade) {
                                $options[$especialidade['id']] = $especialidade['nome'];
                            }
                            helper('form');
                        
                            $user = $userModel->find($id);
                        
                            if ($user === null) {
                                return redirect()->to(base_url('orders'));
                            }
                            break;
                            case 'admin':
                                $data['tipo'] = $tipo;
                                helper('form');
                                $userModel = new UserModel();
                                
                                
                                $especialidadeModel = new EspecialidadeModel();
                                $especialidades = $especialidadeModel->findAll();
                                $options = [];
                                foreach ($especialidades as $especialidade) {
                                    $options[$especialidade['id']] = $especialidade['nome'];
                                }
                                helper('form');
                            
                                $user = $userModel->find($id);
                            
                                if ($user === null) {
                                    return redirect()->to(base_url('orders'));
                                }
                                break;
                            case 'veiculo':
                                $data['tipo'] = $tipo;
                                helper('form');
                                $veiculoModel = new VeiculoModel();
                                $veiculo = $veiculoModel->find($id);
                                
                                $marcaModel = new MarcaModel();
                                $marcas = $marcaModel->getMarcas();
                                $modeloModel = new ModeloModel();
                                $modelos = $modeloModel->getModelos();
                                $data['marcas'] = $marcas;
                                $data['modelos'] = $modelos;
                                $clienteModel = new ClienteModel();
                                $clientes = $clienteModel->findAll();
                                $data['clientes'] = $clientes;
                                if ($this->request->getMethod() === 'post') {
                                    $validation = \Config\Services::validation();
                                    $rules = $validation->getRuleGroup('veiculo');
                
                                    if ($validation->setRules($rules)->withRequest($this->request)->run()) {
                                        $marca_id = $this->request->getPost('marca_id');
                                        $modelo_id = $this->request->getPost('modelo_id');
                
                                        $marca_id = $this->request->getPost('marca_id');
                                        $modelo_id = $this->request->getPost('modelo_id');
                
                                        $marca_nome = '';
                                        $modelo_nome = '';
                
                                        if ($marca_id === 'other') {
                                            $marca_nome = $this->request->getPost('marca_other');
                                            $marca_id = $marcaModel->insert(['nome' => $marca_nome]);
                                        } else {
                                            $marca = $marcaModel->find($marca_id);
                                            if ($marca) {
                                                $marca_nome = $marca['nome'];
                                            }
                                        }
                
                                        if ($modelo_id === 'other') {
                                            $modelo_nome = $this->request->getPost('modelo_other');
                                            $modelo_id = $modeloModel->insert([
                                                'nome' => $modelo_nome,
                                                'marca_id' => $marca_id,
                                            ]);
                                        } else {
                                            $modelo = $modeloModel->find($modelo_id);
                                            if ($modelo) {
                                                $modelo_nome = $modelo->nome;}
                                        }
                
                                        $newData = [
                                            'ano' => $this->request->getPost('ano'),
                                            'placa' => $this->request->getPost('placa'),
                                            'cor' => $this->request->getPost('cor'),
                                            'descricao' => $this->request->getPost('descricao'),
                                            'cliente_id' => $this->request->getPost('cliente_id'),
                                            'marca_id' => $marca_id,
                                            'modelo_id' => $modelo_id,
                                            'modelo_nome' => $modelo_nome,
                                            'marca_nome' => $marca_nome,
                                        ];
                                        $inserted = $veiculoModel->insert($newData);
                                        $viewData = [
                                            'data' => $data,
                                            'marcas' => $marcas,
                                            'modelos' => $modelos,
                                        ];
                
                                        if ($inserted === false) {
                                            $viewData['errors'] = $veiculoModel->errors();
                                        } else {
                                            return redirect()->to(base_url('Ver?tipo=veiculo'));
                
                                        }
                
                                        return view('adicionar', $viewData);
                                    } else {
                                        $errors = $validation->getErrors();
                                        $session = \Config\Services::session();
                                        $session->setFlashdata('errors', $errors);
                                        $errors = $validation->getErrors();
                                        $data['validation_errors'] = $errors;
                                    }
                                }
                
                                $viewData = [
                                    'data' => $data,
                                    'marcas' => $marcas,
                                    'modelos' => $modelos,
                                ];
                
                               
                                break; case 'equipe':  $data['tipo'] = $tipo;
                                helper('form');
                                $equipeModel = new EquipeModel();
                                $userModel = new UserModel();
                                $equipeMecanicoModel = new EquipeMecanicoModel(); 
                                $data['tipo'] = $tipo;
                                $data['equipe'] = $equipeModel->find($id);
                                $data['equipe']['mecanicos'] = $equipeMecanicoModel->getMecanicosPorEquipe($id); 
                                $data['mecanicos'] = $userModel->getMecanicos();
                    
                                    $data['especialidades'] = (new EspecialidadeModel())->getEspecialidades();
                                    $equipe = (new EquipeModel())->find($id);
                                    $allMechanics = $userModel->findAll();

                    
                                    $teamMechanics = $equipeMecanicoModel->getMecanicosPorEquipe($id);
                                    
                               
                                    $teamMechanicsArray = [];
                                    foreach ($teamMechanics as $mechanic) {
                                        $teamMechanicsArray[$mechanic->id] = $mechanic;
                                    }
                                    
                                   
                                    $availableMechanics = array_filter($allMechanics, function($mechanic) use ($teamMechanicsArray) {
                                        return !isset($teamMechanicsArray[$mechanic->id]);
                                    });
                                    
                              
                                  
                                    $data['all_mecanicos'] = $allMechanics;
                                    $data['equipe']['mecanicos'] = $teamMechanics;
                                    
                                    if ($equipe === null) {
                                        return redirect()->to(base_url('Ver?tipo=equipe'));
                                    }
                                    break;
                                
        }
        return view('editar', [ 'especialidade'=>$especialidade,'equipe' => $equipe,'cliente' => $cliente, 'data' => $data, 'tipo' => $tipo, 'peca'=>$peca, 'servico'=>$servico, 'user'=>$user, 'veiculo'=>$veiculo]);
    }

    public function atualizar($tipo, $id)
    {    $data = $this->request->getPost();
        switch ($tipo) {

        case 'cliente':
            $clienteModel = new ClienteModel();
            $data['tipo'] = $tipo;
            if ($this->request->getMethod() === 'post') {
                $data = [
                    'nome_completo' => $this->request->getPost('nome_completo'),
                    'endereco' => $this->request->getPost('endereco'),
                    'email' => $this->request->getPost('email'),
                    'status' => $this->request->getPost('status'),
                    'cpf' => $this->request->getPost('cpf'),
                    'cnh' => $this->request->getPost('cnh'),
                    'telefone' => $this->request->getPost('telefone'),
                ];

                $clienteModel->update($id, $data);
                session()->setFlashdata('success', 'Cliente editado com sucesso!');
                return redirect()->to(base_url('detalhes/cliente/' . $id));
            }break;
            case 'especialidade':
                $especialidadeModel = new EspecialidadeModel();
                $data['tipo'] = $tipo;
                if ($this->request->getMethod() === 'post') {
                    $data = [
                        'nome' => $this->request->getPost('nome'),
                    
                        'descricao' => $this->request->getPost('descricao'),
                        
                    ];
    
                    $especialidadeModel->update($id, $data);
                    session()->setFlashdata('success', 'Especialidade editada com sucesso!');
                    return redirect()->to(base_url('detalhes/especialidade/' . $id));
                }break;
            case 'peca':
                $pecaModel = new PecaModel();
                $data['tipo'] = $tipo;
                if ($this->request->getMethod() === 'post') {
                    $data = [
                        'nome' => $this->request->getPost('nome'),
                        'valor' => $this->request->getPost('valor'),
                        'descricao' => $this->request->getPost('descricao'),
                        
                    ];
    
                    $pecaModel->update($id, $data);
                    session()->setFlashdata('success', 'Peça editada com sucesso!');
                    return redirect()->to(base_url('detalhes/peca/' . $id));
                }break;
                case 'servico':
                    $servicoModel = new ServicoModel();
                    $data['tipo'] = $tipo;
                    if ($this->request->getMethod() === 'post') {
                        $data = [
                            'nome' => $this->request->getPost('nome'),
                            'valor' => $this->request->getPost('valor'),
                            'descricao' => $this->request->getPost('descricao'),
                            
                        ];
        
                        $servicoModel->update($id, $data);
                        session()->setFlashdata('success', 'Serviço editado com sucesso!');
                        return redirect()->to(base_url('detalhes/servico/' . $id));
                    }break;
                    case 'mecanico':
                        $userModel = new UserModel();
                        $data['tipo'] = $tipo;
                        if ($this->request->getMethod() === 'post') {    $especialidadeModel = new EspecialidadeModel();     $especialidade_id = $this->request->getPost('especialidade_id');
                            $especialidade = $especialidadeModel->find($especialidade_id);

                            $data = [
                                'nome_completo' => $this->request->getPost('nome_completo'),
                                'endereco' => $this->request->getPost('endereco'),
                                'email' => $this->request->getPost('email'),
                                'cpf' => $this->request->getPost('cpf'),
                                
                                'tipo' => $this->request->getPost('tipo'),
                                'especialidade_id' => $especialidade_id,
                                'especialidade_nome' => $especialidade['nome'],
                            ];

                            $userModel->update($id, $data);
                            session()->setFlashdata('success', 'Mecânico editado com sucesso!');
                            return redirect()->to(base_url('detalhes/mecanico/' . $id));
                        }
                        break;
                        case 'admin':
                            $userModel = new UserModel();
                            $data['tipo'] = $tipo;
                            if ($this->request->getMethod() === 'post') {    $especialidadeModel = new EspecialidadeModel();     $especialidade_id = $this->request->getPost('especialidade_id');
                                $especialidade = $especialidadeModel->find($especialidade_id);
    
                                $data = [
                                    'nome_completo' => $this->request->getPost('nome_completo'),
                                    'endereco' => $this->request->getPost('endereco'),
                                    'email' => $this->request->getPost('email'),
                                    'cpf' => $this->request->getPost('cpf'),
                                    
                                    'tipo' => $this->request->getPost('tipo'),
                                    'especialidade_id' => $especialidade_id,
                                    'especialidade_nome' => $especialidade['nome'],
                                ];
    
                                $userModel->update($id, $data);
                                session()->setFlashdata('success', 'Administrador editado com sucesso!');
                                return redirect()->to(base_url('detalhes/admin/' . $id));
                            }
                            break;
                        case 'veiculo':
                            if ($this->request->getMethod() === 'post') {
                                $veiculoModel = new VeiculoModel();
                                $marcaModel = new MarcaModel();
                                $modeloModel = new ModeloModel();
                            
                                $marca_id = $this->request->getPost('marca_id');
                                $modelo_id = $this->request->getPost('modelo_id');
                            
                                if ($marca_id === 'other') {
                                    $marca_nome = $this->request->getPost('marca_other');
                                    $marca_id = $marcaModel->insert(['nome' => $marca_nome]);
                                }
                            
                                if ($modelo_id === 'other') {
                                    $modelo_nome = $this->request->getPost('modelo_other');
                                    $modelo_id = $modeloModel->insert([
                                        'nome' => $modelo_nome,
                                        'marca_id' => $marca_id,
                                    ]);
                                }
                            
                                $newData = [
                                    'ano' => $this->request->getPost('ano'),
                                    'placa' => $this->request->getPost('placa'),
                                    'cor' => $this->request->getPost('cor'),
                                    'descricao' => $this->request->getPost('descricao'),
                                    'cliente_id' => $this->request->getPost('cliente_id'),
                                    'marca_id' => $marca_id,
                                    'modelo_id' => $modelo_id,
                                ];
                            
                                $updated = $veiculoModel->update($id, $newData);
                            
                                if ($updated === false) {
                                    echo "Erro ao atualizar o veículo.";
                                } else {         session()->setFlashdata('success', 'Veiculo editado com sucesso!');
                                    return redirect()->to(base_url('detalhes/veiculo/' . $id));
                                }
                            }
                                        return redirect()->to(base_url('detalhes/veiculo/' . $id));
                                        break;
                                        case 'equipe':
                                            $equipeModel = new EquipeModel();
                                            $equipeMecanicoModel = new EquipeMecanicoModel();
                                            $submittedMechanicIds = $this->request->getPost('mecanico_id') ?? [];
                                            
                                     
                                            $equipeModel->update($id, [
                                                'nome' => $data['nome'],
                                                'descricao' => $data['descricao'],
                                                'especialidade_id' => $data['especialidade_id'],
                                             
                                            ]);
                                            
                                          
                                            $equipeMecanicoModel->where('equipe_id', $id)->delete();
                                            
                                          
                                            foreach ($submittedMechanicIds as $mechanicId) {
                                                $equipeMecanicoModel->insert([
                                                    'equipe_id' => $id,
                                                    'mecanico_id' => $mechanicId,
                                                ]);
                                            }
                                            session()->setFlashdata('success', 'Equipe editada com sucesso!');
                                            return redirect()->to(base_url('detalhes/equipe/' . $id));
                                            break;    
                                        
    }

    }
}
