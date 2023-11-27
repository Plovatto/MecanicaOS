<?php

namespace App\Controllers;
use App\Models\ClienteModel;
use App\Models\EquipeModel;
use App\Models\OsModel;
use App\Models\OsPecaModel;
use App\Models\UserModel;
use App\Models\PecaModel; 
use App\Models\VeiculoModel;
use App\Models\ModeloModel;
use App\Models\MarcaModel;
use App\Models\ServicoModel;
use App\Models\OServicoModel;
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
            $orders = $osModel->orderBy('id', 'DESC')->findAll();
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
       
        $osServicoModel = new OServicoModel();
        $osModel = new OsModel();
        $osPecaModel = new OsPecaModel();
        $order = $osModel->find($id); 
        $order = $osModel->getOrderWithDetails($id); 
        $pecas = $osPecaModel->getPecasForOrdem($id);
        $servicos = $osServicoModel->getServicosForOrdem($id);
    
        if ($order) {
            $data = [
                'order' => $order,
                'pecas' => $pecas,
                'servicos' => $servicos
            ];
            return view('detalhesOS', $data);
        } else {
            return redirect()->to('/orders')->with('error', 'A Ordem de Serviço não foi encontrada.');
        }
    }

    public function adicionarOS()
{    $servicoModel = new ServicoModel();
    $pecaModel = new PecaModel();
    $pecas = $pecaModel->findAll();
    $servicos = $servicoModel->findAll();
    $equipeModel = new EquipeModel();
$equipes = $equipeModel->findAll();
    $formData = $this->request->getPost();

  
    $pecaIds = isset($formData['peca_codigo']) ? $formData['peca_codigo'] : [];
    $servicosIds = isset($formData['servico_codigo']) ? $formData['servico_codigo'] : [];
    if ($this->request->getMethod() === 'post') {
        $osModel = new OsModel();
        
        $data = [
            'defeito' => $this->request->getPost('defeito'),
            'solucao' => $this->request->getPost('solucao'),
            'detalhes' => $this->request->getPost('detalhes'),
            'valor_servicos' => $this->request->getPost('valor_servicos'),
            'quantidade_peca' => $this->request->getPost('quantidade_peca'),
            'valor_pecas' => $this->request->getPost('valor_pecas'),
            'data_previsao' => $this->request->getPost('data_previsao'),
            'cliente_id' => $this->request->getPost('cliente_id'),
                'veiculo_id' => $this->request->getPost('veiculo_id'),
                'mecanico_id' => session('user_id'),
                'equipe_id' => $this->request->getPost('equipe_codigo'), 
                
               
            ];
     var_dump($data);
     $osId = $osModel->insert($data);

     if ($osId === false) {
         var_dump($osModel->errors());
     } else {
         $pecaIds = $this->request->getPost('peca_codigo[]');
         $servicoIds = $this->request->getPost('servico_codigo[]');
         $quantidade_peca = $this->request->getPost('quantidade_peca');
         $osServicoModel = new OServicoModel();
         $osPecaModel = new OsPecaModel();
     
         $servicoIds = $this->request->getPost('servico_codigo[]');

         if ($servicoIds === null) {
             $servicoIds = [];
         }
         foreach ($servicoIds as $servicoId) {
            $osServicoData = [
                'ordemdeservico_id' => $osId,
                'servico_id' => $servicoId,
            ];

            if ($osServicoModel->insert($osServicoData) === false) {
                var_dump($osServicoModel->errors());
            }
        }

         foreach ($pecaIds as $pecaId) {
             $osPecaData = [
                 'ordemdeservico_id' => $osId,
                 'peca_id' => $pecaId,
                 'quantidade' => $quantidade_peca, 
             ];
     
             if ($osPecaModel->insert($osPecaData) === false) {
                 var_dump($osPecaModel->errors());
             }
         }
     
         return redirect()->to('/orders')->with('success', 'Ordem de Serviço adicionada com sucesso.');
     }
        }

        return view('adicionarOS', ['pecas' => $pecas, 'servicos' => $servicos, 'equipes' => $equipes]);
    }
    public function searchVeiculo()
    {
        $clienteModel = new ClienteModel();
        $veiculoModel = new VeiculoModel();
    
        $placa = $this->request->getPost('placa');
        log_message('debug', 'Recebida solicitação de pesquisa de veículo para a placa: ' . $placa);
    
        $veiculo = $veiculoModel->getVeiculoByPlaca($placa);
        
    
        if ($veiculo) {
            $cliente = $clienteModel->find($veiculo->cliente_id);
            $cliente_id = $veiculo->cliente_id;
            $veiculo_id = $veiculo->id;
            $veiculo = $veiculoModel->getVeiculoWithMarcaModelo($veiculo_id);
            log_message('debug', 'Veículo encontrado! Cliente ID: ' . $cliente_id . ', Veículo ID: ' . $veiculo_id);
    
            
            echo json_encode(['cliente_id' => $cliente_id, 'veiculo_id' => $veiculo_id, 'veiculo' => $veiculo, 'cliente' => $cliente]);
        } else {
            log_message('debug', 'Veículo não encontrado para a placa ' . $placa);
    

            echo json_encode(['cliente_id' => null, 'veiculo_id' => null]);
        }
    }
}
