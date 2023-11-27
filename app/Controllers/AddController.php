<?php

namespace App\Controllers;
use App\Models\EquipeModel;
use App\Models\osModel;
use App\Models\UserModel;
use App\Models\ClienteModel;
use App\Models\VeiculoModel;
use App\Models\ModeloModel;
use App\Models\MarcaModel;
use App\Models\PecaModel;
use App\Models\ServicoModel;
use Config\Validation;

class AddController extends BaseController
{
    public function adicionar($tipo)
    {
        $data = ['tipo' => $tipo];
        $marcas = [];
        $modelos = [];

        switch ($tipo) {
            case 'cliente':
                $data['tipo'] = $tipo;
                helper('form');
                $clienteModel = new ClienteModel();
try{
                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('cliente');
                     $validation->setRules($rules);

                    if ($validation->withRequest($this->request)->run()) {
                        $newData = [
                            'nome_completo' => $this->request->getPost('nome_completo'),
                            'endereco' => $this->request->getPost('endereco'),
                            'email' => $this->request->getPost('email'),
                            'cpf' => $this->request->getPost('cpf'),
                            'cnh' => $this->request->getPost('cnh'),
                            'telefone' => $this->request->getPost('telefone'),
                        ];
                      
                        $clienteModel->insert($newData);
                    
                        return redirect()->to(base_url('Ver?tipo=cliente'));
                    } else {
                        
                        $errors = $validation->getErrors();
                        $data['validation_errors'] = $errors;
                    }
                }   $viewData = [
                    'data' => $data,
                    'marcas' => $marcas,
                    'modelos' => $modelos,
                    
                ];
                return view('adicionar', $viewData,);
               }  
               catch (\Exception $e) {
                $error = $e->getMessage();
                $viewData = [
                            'data' => $data,
                            'marcas' => $marcas,
                            'modelos' => $modelos,
                            'error' => $error,
                        ];
         
            } break;


            case 'mecanico':
                $data['tipo'] = $tipo;
                helper('form');
                $userModel = new UserModel();
                
                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('mecanico');
                    
                   
                    $newData = [
                        'nome_completo' => $this->request->getPost('nome_completo'),
                        'endereco' => $this->request->getPost('endereco'),
                        'email' => $this->request->getPost('email'),
                        'cpf' => $this->request->getPost('cpf'),
                        'senha' => $this->request->getPost('senha'),
                        'tipo' => $this->request->getPost('tipo'),
                    ];
                        $inserted = $userModel->insert($newData);
                        $viewData = [
                            'data' => $data,
                            'user' => isset($user) ? $user : null,
                        ];
                        
            
                        if ($inserted === false) {
                           $errors = $validation->getErrors(); 
                        $session = \Config\Services::session(); 
                        $session->setFlashdata('errors', $errors); 
                        $errors = $validation->getErrors();
                        $data['validation_errors'] = $errors;
                        } else {
                            return redirect()->to(base_url('Ver?tipo=mecanico'));
                        }
            
                        return view('adicionar', $viewData);
                    }
                
                    $viewData = [
                        'data' => $data,
                        'user' => isset($user) ? $user : null,
                    ];
                    
                    return view('adicionar', $viewData);
            
             
            break;

            case 'servico':
                $data['tipo'] = $tipo;
                helper('form');
                $servicoModel = new ServicoModel();
                
                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('servico');
                    
                   
                        $newData = [
                            'nome' => $this->request->getPost('nome'),
                            'descricao' => $this->request->getPost('descricao'),
                            'valor' => $this->request->getPost('valor'),
                          
                        ];
                        $inserted = $servicoModel->insert($newData);
                        $viewData = [
                            'data' => $data,
                            'servico' => isset($servico) ? $servico : null,
                        ];
                        
            
                        if ($inserted === false) {
                            $viewData['errors'] = $servicoModel->errors();
                        } else {
                            return redirect()->to(base_url('Ver?tipo=servico'));
                        }
            
                        return view('adicionar', $viewData);
                    }
                
                    $viewData = [
                        'data' => $data,
                        'servico' => isset($servico) ? $servico : null,
                    ];
                    
                    return view('adicionar', $viewData);
            
             
            break;


            case 'peca':
                $data['tipo'] = $tipo;
                helper('form');
                $pecaModel = new PecaModel();
                
                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('peca');
                    
                   
                        $newData = [
                            'nome' => $this->request->getPost('nome'),
                            'descricao' => $this->request->getPost('descricao'),
                            'valor' => $this->request->getPost('valor'),
                          
                        ];
                        $inserted = $pecaModel->insert($newData);
                        $viewData = [
                            'data' => $data,
                            'peca' => isset($peca) ? $peca : null,
                        ];
                        
            
                        if ($inserted === false) {
                            $viewData['errors'] = $pecaModel->errors();
                        } else {
                            return redirect()->to(base_url('Ver?tipo=peca'));
                        }
            
                        return view('adicionar', $viewData);
                    }
                
                    $viewData = [
                        'data' => $data,
                        'peca' => isset($peca) ? $peca : null,
                    ];
                    
                    return view('adicionar', $viewData);
            
             
            break;

            case 'equipe':
                $data['tipo'] = $tipo;
                helper('form');
                $equipeModel = new EquipeModel();
            
                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('equipe');
            
                    $newData = [
                       
                        'nome' => $this->request->getPost('nome'),
                        'descricao' => $this->request->getPost('descricao'),
                        
                        'mecanico_id' => session('user_id'), 
                        'especialidade_id' => $this->request->getPost('especialidade_id'),
                    ];
            
                    $inserted = $equipeModel->insert($newData);
                    $viewData = [
                        'data' => $data,
                        'equipe' => isset($equipe) ? $equipe : null,
                    ];
            
                    if ($inserted === false) {
                        $viewData['errors'] = $equipeModel->errors();
                    } else {
                        return redirect()->to(base_url('Ver?tipo=equipe'));
                    }
            
                    return view('adicionar', $viewData);
                }
            
                $viewData = [
                    'data' => $data,
                    'equipe' => isset($equipe) ? $equipe : null,
                ];
            
                return view('adicionar', $viewData);
            
            break;

            case 'veiculo':
                $data['tipo'] = $tipo;
                helper('form');
                $veiculoModel = new VeiculoModel();
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
                        $modelo_id= $this->request->getPost('modelo_id');

                        $marcaModel = new MarcaModel();
                        $marca = $marcaModel->find($marca_id);

                        if ($marca_id === 'other') {
                            $marcaModel = new MarcaModel();
                            $marca_id = $marcaModel->insert(['nome' => $this->request->getPost('marca_other')]);
                            if ($marca_id === false || $marca_id === 0) {
                               
                            }
                        }

                        if ($modelo_id === 'other') {
                            $modeloModel = new ModeloModel();
                            $modelo_id = $modeloModel->insert([
                                'nome' => $this->request->getPost('modelo_other'),
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
                    }else {
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
            
                return view('adicionar', $viewData);
                break;



                
        }

        return view('adicionar', $data);
    }

    public function getModelosByMarca($marca_id)
    {
        $modeloModel = new ModeloModel();
        $modelos = $modeloModel->getModelosByMarca($marca_id);
        return $this->response->setJSON($modelos);
    }
    
}
