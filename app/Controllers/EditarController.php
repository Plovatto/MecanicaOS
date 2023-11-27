<?php

namespace App\Controllers;


use App\Models\ClienteModel;
use App\Models\PecaModel;
use App\Models\ServicoModel;

class EditarController extends BaseController
{
    public function editar($tipo, $id)
    {$cliente = null;
        $peca = null;
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
        }
        return view('editar', ['cliente' => $cliente, 'data' => $data, 'tipo' => $tipo, 'peca'=>$peca, 'servico'=>$servico]);

    }

    public function atualizar($tipo, $id)
    {switch ($tipo) {

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

                return redirect()->to(base_url('detalhes/cliente/' . $id));
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
        
                        return redirect()->to(base_url('detalhes/servico/' . $id));
                    }break;
    }

    }
}
