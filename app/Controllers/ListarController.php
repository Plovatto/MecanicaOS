<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\osModel;
use App\Models\UserModel;
use App\Models\VeiculoModel;

class ListarController extends BaseController
{
    public function listar()
    {
        $tipo = $this->request->getGet('tipo');

        if ($tipo === 'cliente') {
            $clienteModel = new ClienteModel();
            $clientes = $clienteModel->orderBy('codigo', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'clientes' => $clientes]);
        } elseif ($tipo === 'veiculo') {
            $veiculoModel = new VeiculoModel();
            $veiculos = $veiculoModel->orderBy('codigo', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'veiculos' => $veiculos]);
        } elseif ($tipo === 'os') {
            $osModel = new osModel();
            $orders = $osModel->orderBy('numero', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'orders' => $orders]);
        } elseif ($tipo === 'mecanico') {
            $userModel = new UserModel();
            $users = $userModel->orderBy('codigo', 'DESC')->findAll();

            return view('Ver', ['tipo' => $tipo, 'users' => $users]);
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
        $user = null;
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

            default:

                break;
        }

        return view('detalhes', ['tipo' => $tipo, 'veiculo' => $veiculo, 'veiculos' => $veiculos, 'cliente' => $cliente, 'clienteDoVeiculo' => $clienteDoVeiculo]);

    }

}
