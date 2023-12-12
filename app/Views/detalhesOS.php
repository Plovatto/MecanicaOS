<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon"  type="image/png" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes</title><link rel="stylesheet" href="/style/detalhes.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  <title>Login</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</head>
<body>
<div class="accordion" id="orderDetailsAccordion">
    <div class="card">
        <div class="card-header" id="headingOne">
        <h2 class="mb-0 header">
    <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
        <?=$order['codigo']?>
    </button>
    <div>
        <a href="/Ver?tipo=os">Voltar</a>
        <a href="/orders">Home</a>
    </div>
</h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#orderDetailsAccordion">
            <div class="card-body">  <p><strong>Número da OS : </strong><?=$order['codigo']?></p><p><strong>Criado por : </strong><?=$order['mecanico_nome']?> em <?=$order['data_emissao']?></p>

            <p><strong>Data de Previsão de Conclusão :</strong> <?=$order['data_previsao']?></p>
<p><strong>Defeito : </strong> <?=$order['defeito']?></p>
<p><strong>Solução : </strong> <?=$order['solucao']?></p>
<p><strong>Detalhes : </strong> <?=$order['detalhes']?></p>
<p><strong>Status  :</strong> <?=$order['situacao']?></p>
<p><strong>Valor Total : R$</strong> <?=$order['total']?></p></p><div class="accordion" id="partsDetailsAccordion">
   <br>
<div class="card">
        <div class="card-header" id="headingTotalParts">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTotalParts" aria-expanded="true" aria-controls="collapseTotalParts">
              Peças
                </button>
            </h2>
        </div>
        <div id="collapseTotalParts" class="collapse show" aria-labelledby="headingTotalParts" data-parent="#partsDetailsAccordion">
            <div class="card-body">

                <div class="accordion" id="partsAccordion">
                    <?php foreach ($pecas as $index => $peca): ?>
                        <div class="card">
                            <div class="card-header" id="headingPart<?=$index?>">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapsePart<?=$index?>" aria-expanded="false" aria-controls="collapsePart<?=$index?>">
                                        <?=$peca['nome']?>

                                    </button>
                                    <a href="/detalhes/peca/<?=esc($peca['peca_id']);?>">
    <button class="btn btn-primary float-right">un <?=$peca['quantidade']?></button>
</a>
                                </h2>
                            </div>
                            <div id="collapsePart<?=$index?>" class="collapse" aria-labelledby="headingPart<?=$index?>" data-parent="#partsAccordion">
                                <div class="card-body">
                                <p><strong>Nome :</strong> <?=$peca['nome']?></p>
                                <p><strong>Codigo : </strong> <?=esc($peca['peca_codigo']);?></p>
                                <p><strong>Valor Un : </strong>  R$ <?=esc($peca['peca_valor']);?></p>
                                <p><strong>Tipo : </strong>  <?=esc($peca['peca_tipo']);?></p>
        <p><strong>Descrição : </strong> <?=esc($peca['peca_descricao']);?></p>
        <p><strong>Status : </strong> <?=esc($peca['peca_status']);?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div><br> <strong> <p>Valor total das Peças: <?=$order['valor_pecas']?></p></strong>
            </div>
        </div>
    </div>
</div>
                <div class="accordion" id="serviceDetailsAccordion">
    <div class="card">
        <div class="card-header" id="headingTotal">
            <h2 class="mb-0">
                <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseTotal" aria-expanded="true" aria-controls="collapseTotal">
                Serviços
                </button>
            </h2>
        </div>
        <div id="collapseTotal" class="collapse show" aria-labelledby="headingTotal" data-parent="#serviceDetailsAccordion">
            <div class="card-body">

                <div class="accordion" id="serviceAccordion">
                    <?php foreach ($servicos as $index => $servico): ?>
                        <div class="card">
                            <div class="card-header" id="headingService<?=$index?>">
                                <h2 class="mb-0">
                                    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseService<?=$index?>" aria-expanded="false" aria-controls="collapseService<?=$index?>">
                                        <?=$servico['nome']?>
                                    </button>
                                    <a href="/detalhes/servico/<?=esc($servico['servico_id']);?>">
    <button class="btn float-right">Detalhes</button>
</a>
                                </h2>
                            </div>
                            <div id="collapseService<?=$index?>" class="collapse" aria-labelledby="headingService<?=$index?>" data-parent="#serviceAccordion">
                                <div class="card-body">
                                <p><strong>Codigo : </strong> <?=esc($servico['servico_codigo']);?></p>
                                    <p><strong>Nome : </strong> <?=esc($servico['nome']);?></p>
                                    <p><strong>Valor Un : R$ </strong> <?=esc($servico['servico_valor']);?></p>
                                    <p><strong>Tipo : </strong> <?=esc($servico['servico_tipo']);?></p> 

                                    <p><strong>Descrição : </strong> <?=esc($servico['servico_descricao']);?></p> 
                                   <p><strong>Status : </strong> <?=esc($servico['servico_status']);?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach;?>
                </div> <br>    <strong> <p>Valor total dos Serviços: <?=$order['valor_servicos']?></p></strong>
            </div>
        </div>
    </div>
</div>
<div class="accordion" id="vehicleDetailsAccordion">
    <div class="card">
        <div class="card-header" id="headingTwo">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                <?=$order['veiculo_placa']?>
                </button>
                <a href="/detalhes/veiculo/<?=$order['veiculo_id']?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
            </h2>
        </div>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#vehicleDetailsAccordion">
            <div class="card-body">
            <p><strong>Placa do Veículo:</strong> <?=$order['veiculo_placa']?></p>
<p><strong>Descrição do Veículo:</strong> <?=$order['veiculo_descricao']?></p>
<p><strong>Cor do Veículo:</strong> <?=$order['veiculo_cor']?></p>
<p><strong>Ano do Veículo:</strong> <?=$order['veiculo_ano']?></p>
<p><strong>Status do Veículo:</strong> <?=$order['veiculo_status']?></p>
<p><strong>Nome da Marca:</strong> <?=$order['marca_nome']?></p>
<p><strong>Nome do Modelo:</strong> <?=$order['modelo_nome']?></p>
            </div>
        </div>
    </div>
</div>




<div class="accordion" id="clientDetailsAccordion">
    <div class="card">
        <div class="card-header" id="headingThree">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <?=$order['cliente_nome']?>
                </button>
                <a href="/detalhes/cliente/<?=$order['cliente_id']?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
            </h2>
        </div>
        <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#clientDetailsAccordion">
            <div class="card-body">
            <p><strong>Código do Cliente: </strong><?=$order['cliente_codigo']?></p>
            <p><strong>Nome do Cliente:</strong> <?=$order['cliente_nome']?></p>
<p><strong>Código do Cliente:</strong> <?=$order['cliente_id']?></p>
<p><strong>Endereço do Cliente:</strong> <?=$order['cliente_endereco']?></p>
<p><strong>Email do Cliente:</strong> <?=$order['cliente_email']?></p>
<p><strong>Status do Cliente:</strong> <?=$order['cliente_status']?></p>
<p><strong>CPF do Cliente:</strong> <?=$order['cliente_cpf']?></p>
<p><strong>CNH do Cliente:</strong> <?=$order['cliente_cnh']?></p>
<p><strong>Telefone do Cliente:</strong> <?=$order['cliente_telefone']?></p>
            </div>
        </div>
    </div>
</div>
<div class="accordion" id="teamDetailsAccordion">
    <div class="card">
        <div class="card-header" id="headingFour">
            <h2 class="mb-0">
                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                <?=$order['equipe_nome']?>
                </button>
                <a href="/detalhes/equipe/<?=$order['equipe_id']?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
            </h2>
        </div>
        <div id="collapseFour" class="collapse" aria-labelledby="headingFour" data-parent="#teamDetailsAccordion">
            <div class="card-body">
               <p><strong>Equipe Código: </strong><?=$order['equipe_codigo']?></p> 
               <p><strong>Nome da Equipe:</strong><?=$order['equipe_nome']?></p>
                
                <br>
              <strong>Mecânicos da equipe</strong>
                <div class="accordion" id="mechanicDetailsAccordion">
    <?php foreach ($mecanicos as $index => $mecanico): ?>
        <div class="card">
            <div class="card-header" id="headingMechanic<?=$index?>">
            <h2 class="mb-0">
    <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseMechanic<?=$index?>" aria-expanded="false" aria-controls="collapseMechanic<?=$index?>">
        <?=$mecanico->nome_completo?>
    </button>
    <a href="/detalhes/mecanico/<?=$mecanico->id?>" >
    <button class="btn btn-primary float-right">Detalhes</button>
</a>

</h2>
            </div>
            <div id="collapseMechanic<?=$index?>" class="collapse" aria-labelledby="headingMechanic<?=$index?>" data-parent="#mechanicDetailsAccordion">
                <div class="card-body">

                <p><strong>Código:</strong> <?=esc($mecanico->codigo);?></p>
<p><strong>Nome Completo:</strong> <?=esc($mecanico->nome_completo);?></p>
<p><strong>Email:</strong> <?=esc($mecanico->email);?></p>
<p><strong>CPF:</strong> <?=esc($mecanico->cpf);?></p>
<p><strong>Tipo:</strong> <?=esc($mecanico->tipo);?></p>
<p><strong>Especialidade:</strong> <?=esc($mecanico->especialidade_nome);?></p>
<p><strong>Status:</strong> <?=esc($mecanico->status);?></p>
                </div>
            </div>
        </div>
    <?php endforeach;?>
</div>
            </div>
        </div>
    </div>
</div><br><br>
      <a href="<?php echo base_url('alterar-status-os/' . $order['id']); ?>">
    <button class="aaa" style="background-color: <?=($order['situacao'] === 'A concluir') ? 'green' : 'red'?>; color: white;">
        <?=($order['situacao'] === 'A concluir') ? 'Concluir' : 'Reabrir'?> OS
    </button>
</a><a href="/faturamento/<?=$order['id']?>">
    <button class="billing-button">Ver Faturamento</button>
</a>
<a href="<?php echo base_url('os/editar/' . $order['id']); ?>">
    <button class="edit-button">Editar OS</button>
</a>
</body>
</html>
