<?php

namespace App\Controllers;

use App\Models\OsModel;
use App\Models\UserModel;
use App\Models\PecaModel; 

class OsController extends BaseController 
{
    public function index()
    {
        $osModel = new OsModel();
        $session = session();
        $userType = $session->get('user_type');
        $userId = $session->get('user_id');
        $orders = [];

        if ($userType === 'admin') {
            $orders = $osModel->orderBy('codigo', 'DESC')->findAll();
        } elseif ($userType === 'mecanico') {
            try {
                $orders = $osModel->where('mecanico_id', $userId)->findAll(); 
            } catch (\Exception $e) {
                log_message('error', 'Error: ' . $e->getMessage());
            }
        }

        return view('index', ['userType' => $userType, 'orders' => $orders]);
    }

    public function detalhes($id) 
    {
        $osModel = new OsModel();
        $order = $osModel->find($id); 
        $order = $osModel->getOrderWithDetails($id); 

        if ($order) {
            $data = [
                'order' => $order,
            ];

            return view('detalhesOS', $data);
        } else {
            return redirect()->to('/orders')->with('error', 'A Ordem de Serviço não foi encontrada.');
        }
    }

    public function adicionarOS()
    {
        if ($this->request->getMethod() === 'post') {
            $osModel = new OsModel();
            $pecaModel = new PecaModel();
            $pecas = $pecaModel->findAll();
            
            $data = [
                'defeito' => $this->request->getPost('defeito'),
                'solucao' => $this->request->getPost('solucao'),
                'detalhes' => $this->request->getPost('detalhes'),
                
                'valor_servicos' => $this->request->getPost('valor_servicos'),
                'valor_pecas' => $this->request->getPost('valor_pecas'),
                'data_previsao' => $this->request->getPost('data_previsao'),
                'cliente_id' => $this->request->getPost('cliente_codigo'), 
                'veiculo_id' => $this->request->getPost('veiculo_codigo'),
                'mecanico_id' => $this->request->getPost('mecanico_codigo'), 
                'equipe_id' => $this->request->getPost('equipe_codigo'), 
                'peca_id' => $this->request->getPost('peca_codigo'), 
            ];

            $osModel->insert($data);

            return redirect()->to('/orders')->with('success', 'Ordem de Serviço adicionada com sucesso.');
        }

        return view('adicionarOS'); 
    }
}
