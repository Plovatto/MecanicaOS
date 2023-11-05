<?php

namespace App\Controllers;

use App\Models\ClienteModel;

class ClienteController extends BaseController
{

    public function alterarStatus($clienteID)
    {
        $clienteModel = new ClienteModel();
        $cliente = $clienteModel->find($clienteID);

        if ($cliente) {

            $novoStatus = ($cliente->status === 'ativo') ? 'desativado' : 'ativo';

            $data = ['status' => $novoStatus];
            $clienteModel->update($clienteID, $data);

            return redirect()->to(base_url("detalhes/cliente/$clienteID"));
        } else {

            return redirect()->to(base_url('clientes'));
        }
    }

}
