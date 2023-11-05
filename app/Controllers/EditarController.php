<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class EditarController extends BaseController
{
    public function editar($tipo, $id)
    {
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
        }
        return view('editar', ['cliente' => $cliente, 'data' => $data, 'tipo' => $tipo]);

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
    }

    }
}
