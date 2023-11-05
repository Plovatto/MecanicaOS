<?php

namespace App\Controllers;

use App\Models\osModel;
use App\Models\UserModel;
use App\Models\ClienteModel;
use App\Models\VeiculoModel;
use App\Models\ModeloModel;
use App\Models\MarcaModel;
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
                            'status' => $this->request->getPost('status'),
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
                            'status' => $this->request->getPost('status'),
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
