<?php

namespace App\Controllers;

use App\Models\ClienteModel;
use App\Models\EquipeMecanicoModel;
use App\Models\EquipeModel;
use App\Models\OServicoModel;
use App\Models\OSModel;
use App\Models\OSPecaModel;
use App\Models\PecaModel;
use App\Models\ServicoModel;
use App\Models\VeiculoModel;

class OsController extends BaseController
{
    public function index($id = null)
    {
        $osModel = new OsModel();
        $clienteModel = new ClienteModel();
        $veiculoModel = new VeiculoModel();
        $clientes = $clienteModel->findAll();
        $veiculos = $veiculoModel->findAll();

        $searchParams = $this->request->getGet();

        $session = session();
        $userType = $session->get('user_type');
        $userId = $session->get('user_id');

        $orders = $osModel->getAllOrdersWithDetails($searchParams);

        if ($userType == 'mecanico') {
            $orders = $osModel->getOrdersByMechanic($userId, $searchParams ?? []);
        } else {
            $orders = $osModel->getAllOrdersWithDetails($searchParams ?? []);
        }

        usort($orders, function ($a, $b) {
            return $b['id'] <=> $a['id'];
        });

        $searchPerformed = !empty($searchParams);
        $searchResults = $searchPerformed ? $orders : null;

        $data['searchPerformed'] = $searchPerformed;
        $data['userType'] = $userType;
        $data['searchResults'] = $searchResults;
        $data['orders'] = $orders;
        $data['clientes'] = $clientes;
        $data['veiculos'] = $veiculos;

        echo view('index', $data);

    }

    public function detalhes($id)
    {$equipeMecanicoModel = new EquipeMecanicoModel();

        $osServicoModel = new OServicoModel();
        $osModel = new OsModel();
        $osPecaModel = new OsPecaModel();
        $order = $osModel->find($id);
        $order = $osModel->getOrderWithDetails($id);
        $pecas = $osPecaModel->getPecasForOrdem($id);
        $servicos = $osServicoModel->getServicosForOrdem($id);
        $mecanicos = $equipeMecanicoModel->getMecanicosPorEquipe($order['equipe_id']);
        if ($order) {
            $data = [
                'order' => $order,
                'pecas' => $pecas,
                'servicos' => $servicos,
                'mecanicos' => $mecanicos,
            ];
            return view('detalhesOS', $data);
        } else {
            return redirect()->to('/orders')->with('error', 'A Ordem de Serviço não foi encontrada.');
        }
    }

    public function adicionarOS()
    {$servicoModel = new ServicoModel();
        $pecaModel = new PecaModel();
        $pecas = $pecaModel->where('status', 'ativo')->findAll();
        $servicos = $servicoModel->where('status', 'ativo')->findAll();
        $equipeModel = new EquipeModel();
        $equipes = $equipeModel->where('status', 'ativo')->findAll();
        $formData = $this->request->getPost();
        $osServicoModel = new OServicoModel();

        $pecaIds = isset($formData['peca_codigo']) ? $formData['peca_codigo'] : [];
        $servicosIds = isset($formData['servico_codigo']) ? $formData['servico_codigo'] : [];
        if ($this->request->getMethod() === 'post') {

            $osModel = new OsModel();
            $codigo = str_pad(mt_rand(0, 999999), 6, '0', STR_PAD_LEFT);
            date_default_timezone_set('America/Sao_Paulo');

            $data = [
                'codigo' => $codigo,
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
                'total' => $this->request->getPost('valor_servicos') + $this->request->getPost('valor_pecas'),
                'data_emissao' => date('Y-m-d'),  

            ];
            var_dump($data);
            $osId = $osModel->insert($data);

            if ($osId === false) {
                var_dump($osModel->errors());
            } else {
                $pecaIds = $this->request->getPost('peca_codigo');
                $servicoIds = $this->request->getPost('servico_codigo[]');

                $quantidades = json_decode($this->request->getPost('quantidade_peca'), true);

                $osPecaModel = new OsPecaModel();

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
                    if (!empty($pecaId)) {
                        $osPecaData = [
                            'ordemdeservico_id' => $osId,
                            'peca_id' => $pecaId,
                            'quantidade' => $quantidades[$pecaId],
                        ];

                        if ($osPecaModel->insert($osPecaData) === false) {
                            var_dump($osPecaModel->errors());
                        }
                    }
                }
                session()->setFlashdata('success', 'Ordem de |Serviço criada com sucesso!');
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

            echo json_encode(['cliente_id' => null, 'veiculo_id' => null, 'error' => 'Placa não encontrada']);
        }
    }
    public function searchOS()
    {
        $codigo = $this->request->getGet('codigo');

        $osModel = new OSModel();
        $order = $osModel->getOrderByCodigo($codigo);

        return view('search_results', ['order' => $order]);
    }
    public function Faturamento($id)
    {
        $osModel = new OSModel();
        $order = $osModel->getOrderWithDetails($id);
        $osServicoModel = new OServicoModel();
        $osModel = new OsModel();
        $osPecaModel = new OsPecaModel();
        $ServicoModel = new ServicoModel();
        $order = $osModel->find($id);
        $order = $osModel->getOrderWithDetails($id);
        $pecas = $osPecaModel->getPecasForOrdem($id);
        $servicos = $osServicoModel->getServicosForOrdem($id);
        $servico = $ServicoModel->getServicoById($id);

        if ($order) {
            $data = [
                'order' => $order,
                'pecas' => $pecas,
                'servicos' => $servicos,
            ];
            return view('Faturamento', $data);
        }
    }
    public function gerarPdf($orderId)
    {
        $osModel = new OSModel();
        $osServicoModel = new OServicoModel();
        $osPecaModel = new OsPecaModel();
        $ServicoModel = new ServicoModel();
        $order = $osModel->getOrderWithDetails($orderId);
        $pecas = $osPecaModel->getPecasForOrdem($orderId);
        $servicos = $osServicoModel->getServicosForOrdem($orderId);
        $servico = $ServicoModel->getServicoById($orderId);
        $bootstrapCss = file_get_contents('https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css');
        $addCss = file_get_contents('style/fatura.css');
        $dompdf = new \Dompdf\Dompdf();

        $html = view('faturamento', ['order' => $order, 'pecas' => $pecas, 'servicos' => $servicos, 'isPdf' => true, 'isPdf2' => true]);
        $html = '<style>' . $addCss . '</style>' . '<style>' . $bootstrapCss . '</style>' . $html;
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A3', 'landscape');
        $dompdf->render();
$this->response->setHeader('Content-Type', 'application/pdf');
$this->response->setBody($dompdf->output());

        $dompdf->stream("Faturamento.pdf", array("Attachment" => false));

    }
    
    public function editar($id)
    {$osModel = new OsModel();
        $order = $osModel->getOrderWithDetails($id);
        $servicoModel = new ServicoModel();
        $pecaModel = new PecaModel();
        $pecas = $pecaModel->where('status', 'ativo')->findAll();
        $servicos = $servicoModel->where('status', 'ativo')->findAll();
        $equipeModel = new EquipeModel();
        $equipes = $equipeModel->where('status', 'ativo')->findAll();
        $formData = $this->request->getPost();
        $osPecaModel = new OsPecaModel();

        $osServicoModel = new OServicoModel();
        $selectedPecas = $osPecaModel->where('ordemdeservico_id', $id)->findAll();
        $selectedServiços = $osServicoModel->where('ordemdeservico_id', $id)->findAll();
        $selectedPecaIds = array_column($selectedPecas, 'peca_id');
        $selectedServiçosIds = array_column($selectedServiços, 'servico_id');
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
                $pecaIds = $this->request->getPost('peca_codigo');
                $servicoIds = $this->request->getPost('servico_codigo[]');

                $quantidades = json_decode($this->request->getPost('quantidade_peca'), true);

                $osPecaModel = new OsPecaModel();

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
                    if (!empty($pecaId)) {
                        $osPecaData = [
                            'ordemdeservico_id' => $osId,
                            'peca_id' => $pecaId,
                            'quantidade' => isset($quantidades[$pecaId]) ? $quantidades[$pecaId] : 0,
                        ];

                        if ($osPecaModel->insert($osPecaData) === false) {
                            var_dump($osPecaModel->errors());
                        }
                    }
                }
                session()->setFlashdata('success', 'Ordem de |Serviço criada com sucesso!');
                return redirect()->to('/orders')->with('success', 'Ordem de Serviço adicionada com sucesso.');
            }
        }

        return view('editarOS', ['order' => $order, 'pecas' => $pecas, 'servicos' => $servicos, 'equipes' => $equipes, 'selectedPecas' => $selectedPecas, 'selectedPecaIds' => $selectedPecaIds, 'selectedServiçosIds' => $selectedServiçosIds]);
    }
    public function atualizar($id)
    {
        $servicoModel = new ServicoModel();
        $pecaModel = new PecaModel();
        $pecas = $pecaModel->where('status', 'ativo')->findAll();
        $servicos = $servicoModel->where('status', 'ativo')->findAll();
        $equipeModel = new EquipeModel();
        $equipes = $equipeModel->where('status', 'ativo')->findAll();
        $formData = $this->request->getPost();
        $osServicoModel = new OServicoModel();

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
                $pecaIds = $this->request->getPost('peca_codigo');
                $servicoIds = $this->request->getPost('servico_codigo[]');

                $quantidades = json_decode($this->request->getPost('quantidade_peca'), true);

                $osPecaModel = new OsPecaModel();

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
                    if (!empty($pecaId)) {
                        $osPecaData = [
                            'ordemdeservico_id' => $osId,
                            'peca_id' => $pecaId,
                            'quantidade' => $quantidades[$pecaId],
                        ];

                        if ($osPecaModel->insert($osPecaData) === false) {
                            var_dump($osPecaModel->errors());
                        }
                    }
                }
                session()->setFlashdata('success', 'Ordem de |Serviço criada com sucesso!');
                return redirect()->to('/orders')->with('success', 'Ordem de Serviço adicionada com sucesso.');
            }
        }

        return view('editarOS', ['pecas' => $pecas, 'servicos' => $servicos, 'equipes' => $equipes]);
    }
}
