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
                try {
                    if ($this->request->getMethod() === 'post') {
                        $validation = \Config\Services::validation();
                        $rules = $validation->getRuleGroup('cliente');
                        $validation->setRules($rules);

                        if ($validation->withRequest($this->request)->run()) {
                            $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

                            $newData = [
                                'codigo' => $codigo,
                                'nome_completo' => $this->request->getPost('nome_completo'),
                                'endereco' => $this->request->getPost('endereco'),
                                'email' => $this->request->getPost('email'),
                                'cpf' => $this->request->getPost('cpf'),
                                'cnh' => $this->request->getPost('cnh'),
                                'telefone' => $this->request->getPost('telefone'),
                            ];

                            $clienteModel->insert($newData);
                            session()->setFlashdata('success', 'Cliente criado com sucesso!');
                            return redirect()->to(base_url('Ver?tipo=cliente'));
                        } else {

                            $errors = $validation->getErrors();
                            $data['validation_errors'] = $errors;
                        }
                    }$viewData = [
                        'data' => $data,
                        'marcas' => $marcas,
                        'modelos' => $modelos,

                    ];
                    return view('adicionar', $viewData, );
                } catch (\Exception $e) {
                    $error = $e->getMessage();
                    $viewData = [
                        'data' => $data,
                        'marcas' => $marcas,
                        'modelos' => $modelos,
                        'error' => $error,
                    ];

                }break;

            case 'mecanico':
                $data['tipo'] = $tipo;
                helper('form');
                $userModel = new UserModel();
                $especialidadeModel = new EspecialidadeModel();
                $especialidades = $especialidadeModel->where('status', 'ativo')->findAll();
                $options = [];
                foreach ($especialidades as $especialidade) {
                    $options[$especialidade['id']] = $especialidade['nome'];
                }
                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('mecanico');

                    if (!$validation->run($this->request->getPost(), 'mecanico')) {
                        $errors = $validation->getErrors();
                        $session = \Config\Services::session();
                        $session->setFlashdata('errors', $errors);
                        $data['validation_errors'] = $errors;
                    } else {
                        $especialidade_id = $this->request->getPost('especialidade_id');
                        $especialidade = $especialidadeModel->where('status', 'ativo')->find($especialidade_id);
                        $senha = $this->request->getPost('senha');
                        $senha_hashed = password_hash($senha, PASSWORD_DEFAULT);
                        $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

                        $newData = [
                            'codigo' => $codigo,
                            'nome_completo' => $this->request->getPost('nome_completo'),
                            'endereco' => $this->request->getPost('endereco'),
                            'email' => $this->request->getPost('email'),
                            'cpf' => $this->request->getPost('cpf'),
                            'senha' => $senha_hashed,
                            'tipo' => $this->request->getPost('tipo'),
                            'especialidade_id' => $especialidade_id,
                            'especialidade_nome' => $especialidade['nome'],
                        ];
                        $inserted = $userModel->insert($newData);
                        $viewData = [
                            'data' => $data,
                            'user' => isset($user) ? $user : null,
                        ];

                        {
                            if ($this->request->getPost('tipo') === 'admin') {
                                session()->setFlashdata('success', 'Administrador criado com sucesso!');
                                return redirect()->to(base_url('Ver?tipo=admin'));
                            } else {
                                session()->setFlashdata('success', 'Mecânico criado com sucesso!');
                                return redirect()->to(base_url('Ver?tipo=mecanico'));
                            }
                        }

                        return view('adicionar', $viewData);
                    }

                    $viewData = [
                        'data' => $data,
                        'user' => isset($user) ? $user : null,
                    ];
                    echo form_dropdown('especialidade_id', $options, $this->request->getPost('especialidade_id'));

                    return view('adicionar', $viewData);

                    break;
                }
            case 'servico':
                $data['tipo'] = $tipo;
                helper('form');
                $servicoModel = new ServicoModel();

                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('servico');
                    $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

                    $newData = [
                        'codigo' => $codigo,
                        'nome' => $this->request->getPost('nome'),
                        'descricao' => $this->request->getPost('descricao'),
                        'valor' => $this->request->getPost('valor'),
                        'tipo'=> $this->request->getPost('tipo'),

                    ];
                    $inserted = $servicoModel->insert($newData);
                    $viewData = [
                        'data' => $data,
                        'servico' => isset($servico) ? $servico : null,
                    ];

                    if ($inserted === false) {
                        $viewData['errors'] = $servicoModel->errors();
                    } else {session()->setFlashdata('success', 'Serviço criado com sucesso!');
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

            case 'especialidade':
                $data['tipo'] = $tipo;
                helper('form');
                $especialidadeModel = new EspecialidadeModel();

                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('especialidade');
                    $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

                    $newData = [ 'codigo' => $codigo,
                        'nome' => $this->request->getPost('nome'),
                        'descricao' => $this->request->getPost('descricao'),

                    ];
                    $inserted = $especialidadeModel->insert($newData);
                    $viewData = [
                        'data' => $data,
                        'especialidade' => isset($especialidade) ? $especialidade : null,
                    ];

                    if ($inserted === false) {
                        $viewData['errors'] = $especialidadeModel->errors();
                    } else {session()->setFlashdata('success', 'Especialidade criada com sucesso!');
                        return redirect()->to(base_url('Ver?tipo=especialidade'));
                    }

                    return view('adicionar', $viewData);
                }

                $viewData = [
                    'data' => $data,
                    'especialidade' => isset($especialidade) ? $especialidade : null,
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
                    $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

                    $newData = [ 'codigo' => $codigo,
                        'nome' => $this->request->getPost('nome'),
                        'descricao' => $this->request->getPost('descricao'),
                        'valor' => $this->request->getPost('valor'),
                        'tipo'=> $this->request->getPost('tipo'),

                    ];
                    $inserted = $pecaModel->insert($newData);
                    $viewData = [
                        'data' => $data,
                        'peca' => isset($peca) ? $peca : null,
                    ];

                    if ($inserted === false) {
                        $viewData['errors'] = $pecaModel->errors();
                    } else {session()->setFlashdata('success', 'Peça criada com sucesso!');
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
                $mecanicoModel = new UserModel();
                $especialidadeModel = new EspecialidadeModel();
                
                $data['mecanicos'] = $mecanicoModel->getMecanicos();
                $data['especialidades'] = $especialidadeModel->where('status', 'ativo')->getEspecialidades();

                if ($this->request->getMethod() === 'post') {
                    $validation = \Config\Services::validation();
                    $rules = $validation->getRuleGroup('equipe');
                    $equipeModel = new EquipeModel();
                    $equipeMecanicoModel = new EquipeMecanicoModel();
                    $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

                    $newData = [ 'codigo' => $codigo,
                        'nome' => $this->request->getPost('nome'),
                        'descricao' => $this->request->getPost('descricao'),
                        'especialidade_id' => $this->request->getPost('especialidade_id'),
                    ];

                    $viewData = [
                        'data' => $data,
                        'equipe' => isset($equipe) ? $equipe : null,
                    ];
                    var_dump($data);
                    $inserted = $equipeModel->insert($newData);
                    if ($inserted === false) {
                        $viewData['errors'] = $equipeModel->errors();
                        var_dump($equipeModel->errors());
                    } else {
                        $equipeId = $equipeModel->insertID();
                        $mecanicos = $this->request->getPost('mecanico_id');
                        foreach ($mecanicos as $mecanicoId) {
                            $equipeMecanicoModel->insert([
                                'equipe_id' => $equipeId,
                                'mecanico_id' => $mecanicoId,
                            ]);
                        }session()->setFlashdata('success', 'Equipe criada com sucesso!');
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
                $clientes = $clienteModel->where('status', 'ativo')->findAll();
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
                        $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);

                        $newData = [
                             'codigo' => $codigo,
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
                        } else {session()->setFlashdata('success', 'Veículo criado com sucesso!');

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
