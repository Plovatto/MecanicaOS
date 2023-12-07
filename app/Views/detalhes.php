<!DOCTYPE html>

 <html>
 <head>
    <title>Detalhes</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  <title>Login</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function hideErrors() {
        var errorDivs = document.querySelectorAll('.alert.alert-success');
        errorDivs.forEach(function(errorDiv) {
            setTimeout(function() {
                errorDiv.style.display = 'none';
            }, 2000);
        });
    }

    window.onload = hideErrors;
</script>

</head>
 <body>
 <?php
if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?=session()->getFlashdata('success')?>
    </div>
<?php endif;?>

 <?php if ($tipo === 'cliente' && $cliente !== null): ?>
    <h3>Detalhes do Cliente</h3><br>
    <p><strong>Nome:</strong> <?=esc($cliente->nome_completo);?></p>
    <p><strong>Endereço:</strong> <?=esc($cliente->endereco);?></p>
    <p><strong>Email:</strong> <?=esc($cliente->email);?></p>
    <p><strong>Status:</strong> <?=esc($cliente->status);?></p>
    <p><strong>CPF:</strong> <?=esc($cliente->cpf);?></p>
    <p><strong>CNH:</strong> <?=esc($cliente->cnh);?></p>
    <p><strong>Telefone:</strong> <?=esc($cliente->telefone);?></p>


    <?php if (!empty($veiculos)): ?>
    <h4>Veículos do Cliente</h4>
    <div id="accordion">
        <?php foreach ($veiculos as $index => $veiculo): ?>
            <div class="card">
                <div class="card-header" id="heading<?=$index?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link collapsed" type="button"  data-toggle="collapse" data-target="#collapse<?=$index?>" aria-expanded="true" aria-controls="collapse<?=$index?>">
                            <?=esc($veiculo->placa);?>
                        </button>
                        <a href="/detalhes/veiculo/<?=$veiculo->id;?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
                    </h5>
                </div>

                <div id="collapse<?=$index?>" class="collapse" aria-labelledby="heading<?=$index?>" data-parent="#accordion">
                    <div class="card-body">
                    <p><strong>Placa:</strong> <?=esc($veiculo->placa);?></p>
                        <strong>Marca:</strong> <?=esc($veiculo->marca_nome);?><br>
                        <strong>Modelo:</strong> <?=esc($veiculo->modelo_nome);?><br>
                        <strong>Cor:</strong> <?=esc($veiculo->cor);?><br>

                        <strong>Ano:</strong> <?=esc($veiculo->ano);?><br>
                        <strong>Descrição:</strong> <?=esc($veiculo->descricao);?><br>
                        <strong>Status:</strong> <?=esc($veiculo->status);?><br>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php else: ?>

<?php endif;?><br>
        <a href="<?php echo base_url('editar/cliente/' . $cliente->id); ?>"><button>Editar Cliente</button></a>

        <a href="<?php echo base_url('alterar-status-cliente/' . $cliente->id); ?>">
        <button style="background-color: <?=($cliente->status === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($cliente->status === 'ativo') ? 'Desativar' : 'Ativar'?> Cliente
        </button>
    </a>


        <a href="/Ver?tipo=cliente">Voltar</a><?php else: ?>

<?php endif;?>




<?php if ($tipo === 'veiculo' && $veiculo !== null): ?>
    <h3>Detalhes do Veículo</h3><br>
    <p><strong>Placa:</strong> <?=esc($veiculo->placa);?></p>

    <p><strong>Marca:</strong> <?=esc($veiculo->marca_nome);?></p>
    <p><strong>Modelo:</strong> <?=esc($veiculo->modelo_nome);?></p>
    <p><strong>Cor:</strong> <?=esc($veiculo->cor);?></p>
    <p><strong>Ano:</strong> <?=esc($veiculo->ano);?></p>
    <p><strong>Descrição:</strong> <?=esc($veiculo->descricao);?></p>
<p><strong>Status:</strong> <?=esc($veiculo->status);?></p>
<h2>Cliente</h2>
<div class="accordion" id="clienteAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOrder">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseCliente" aria-expanded="true" aria-controls="collapseCliente">
            <?=esc($clienteDoVeiculo->nome_completo);?>
            </button>
            <a href="/detalhes/cliente/<?=($clienteDoVeiculo->id);?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
        </h2>
        <div id="collapseCliente" class="accordion-collapse collapse" aria-labelledby="headingOrder" data-parent="#clienteAccordion">            <div class="accordion-body">
                <div class="accordion" id="innerclienteAccordion">
                    <?php if ($clienteDoVeiculo !== null): ?>

                        <p><strong>Nome:</strong> <?=esc($clienteDoVeiculo->nome_completo);?></p>
                        <p><strong>Endereço:</strong> <?=esc($clienteDoVeiculo->endereco);?></p>
                        <p><strong>Email:</strong> <?=esc($clienteDoVeiculo->email);?></p>
                        <p><strong>Status:</strong> <?=esc($clienteDoVeiculo->status);?></p>
                        <p><strong>CPF:</strong> <?=esc($clienteDoVeiculo->cpf);?></p>
                        <p><strong>CNH:</strong> <?=esc($clienteDoVeiculo->cnh);?></p>
                        <p><strong>Telefone:</strong> <?=esc($clienteDoVeiculo->telefone);?></p>
                    <?php else: ?>

                    <?php endif;?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="accordion" id="orderAccordion">
    <?php if (!empty($order)): ?>
        <div class="accordion-item">
            <h2 class="accordion-header" id="headingOrder">
              <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOrder">
                    Ordens de Serviço do veículo
                </button>

            </h2>
            <div id="collapseOrder" class="accordion-collapse collapse" data-bs-parent="#orderAccordion">
                <div class="accordion-body">
                    <div class="accordion" id="innerOrderAccordion">
                        <?php foreach ($order as $index => $ordem): ?>
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingInnerOrder<?=$index?>">
                                <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseService<?=$index?>" aria-expanded="false" aria-controls="collapseService<?=$index?>">
                                        <?=$ordem['codigo']?>  -  <?=$ordem['data_emissao']?>
                                    </button>
                                    <a href="/detalhesOS/<?=esc($ordem['id']);?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
                                </h2>
                                <div id="collapseService<?=$index?>" class="accordion-collapse collapse" data-bs-parent="#innerOrderAccordion">
                                    <div class="accordion-body">
                                        <strong>N° : </strong> <?=esc($ordem['codigo']);?><br>
                                        <strong>Criada em : </strong> <?=esc($ordem['data_emissao']);?><br>
                                        <strong>Previsão de conclusão : </strong> <?=esc($ordem['data_previsao']);?><br>
                                        <strong>Defeito : </strong> <?=esc($ordem['defeito']);?><br>
                                        <strong>Solução : </strong> <?=esc($ordem['solucao']);?><br>
                                        <strong>Descrição : </strong> <?=esc($ordem['ordemdeservico_detalhes']);?>
                                        <strong>Valor em peças : R$ </strong> <?=esc($ordem['valor_pecas']);?><br>
                                        <strong>Valor em serviços : R$ </strong> <?=esc($ordem['valor_servicos']);?><br>
                                        <strong>Total : R$</strong> <?=esc($ordem['total']);?><br>
                                        <strong>Status : </strong> <?=esc($ordem['situacao']);?><br>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach;?>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>

    <?php endif;?>
</div>
        </div> <a href="<?php echo base_url('editar/veiculo/' . $veiculo->id); ?>"><button>Editar veículo</button></a>
    </div>    <a href="<?php echo base_url('alterar-status-veiculo/' . $veiculo->id); ?>">
        <button style="background-color: <?=($veiculo->status === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($veiculo->status === 'ativo') ? 'Desativar' : 'Ativar'?> Veículo
        </button>
    </a>
    <a href="/Ver?tipo=veiculo">Voltar</a>
<?php endif;?>



<?php if ($tipo === 'peca' && $peca !== null): ?>
    <h1>Detalhes da peça</h1>
    <p><strong>Codigo : </strong> <?=esc($peca['codigo']);?></p>
        <p><strong>Nome : </strong> <?=esc($peca['nome']);?></p>
        <p><strong>Valor : R$ </strong> <?=esc($peca['valor']);?></p>
        <p><strong>Descrição:</strong> <?=esc($peca['descricao']);?></p>
        <p><strong>Status:</strong> <?=esc($peca['status']);?></p>
        <a href="<?php echo base_url('alterar-status-peca/' . $peca['id']); ?>">

    </a><?php if ($userType === 'admin'): ?> <button style="background-color: <?=($peca['status'] === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($peca['status'] === 'ativo') ? 'Desativar' : 'Ativar'?> Peça
        </button> <a href="<?php echo base_url('editar/peca/' . $peca['id']); ?>"><button>Editar Peça</button></a><?php endif;?>

    <a href="/Ver?tipo=peca">Voltar</a>
<?php endif;?>

<?php if ($tipo === 'especialidade' && $especialidade !== null): ?>
    <h1>Detalhes da especialidade</h1>
        <p><strong>Codigo : </strong> <?=esc($especialidade['codigo']);?></p>
        <p><strong>Nome : </strong> <?=esc($especialidade['nome']);?></p>

        <p><strong>Descrição:</strong> <?=esc($especialidade['descricao']);?></p>
        <p><strong>Status:</strong> <?=esc($especialidade['status']);?></p>
      <?php if ($userType === 'admin'): ?>
        <a href="<?php echo base_url('alterar-status-especialidade/' . $especialidade['id']); ?>">

        <button style="background-color: <?=($especialidade['status'] === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($especialidade['status'] === 'ativo') ? 'Desativar' : 'Ativar'?> Especialidade
        </button>
        </a>
        <a href="<?php echo base_url('editar/especialidade/' . $especialidade['id']); ?>">
        <button>Editar Especialidade</button></a>
        <?php endif;?>
      </a>
    <a href="/Ver?tipo=especialidade">Voltar</a>
<?php endif;?>


<?php if ($tipo === 'equipe' && $equipe !== null): ?>
    <h1>Detalhes da equipe</h1>

<p><strong>Nome : </strong> <?=esc($equipe['nome']);?></p>

<p><strong>Descrição : </strong> <?=esc($equipe['descricao']);?></p>
<p><strong>Status : </strong> <?=esc($equipe['status']);?></p>

<div class="accordion" id="mecanicoAccordion">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingMecanico">
            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseMecanico" aria-expanded="true" aria-controls="collapseMecanico">
                Mecânicos
            </button>
        </h2>
        <div id="collapseMecanico" class="accordion-collapse collapse show" aria-labelledby="headingMecanico" data-bs-parent="#mecanicoAccordion">
            <div class="accordion-body">
                <?php foreach ($equipe['mecanicos'] as $key => $mecanico): ?>
                    <div class="accordion" id="individualMecanicoAccordion<?=$key?>">
                        <div class="accordion-item">
                            <h2 class="accordion-header" id="headingIndividualMecanico<?=$key?>">
                                <button class="btn btn-link collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseIndividualMecanico<?=$key?>" aria-expanded="true" aria-controls="collapseIndividualMecanico<?=$key?>">
                                    <?=esc($mecanico->nome_completo);?>
                                </button>
                                <a href="/detalhes/mecanico/<?=esc($mecanico->id);?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
                            </h2>
                            <div id="collapseIndividualMecanico<?=$key?>" class="accordion-collapse collapse" aria-labelledby="headingIndividualMecanico<?=$key?>" data-bs-parent="#individualMecanicoAccordion<?=$key?>">
                                <div class="accordion-body">
                                <p><strong>Código : </strong> <?=esc($mecanico->codigo);?></p>
    <p><strong>Nome : </strong> <?=esc($mecanico->nome_completo);?></p>
    <p><strong>CPF : </strong> <?=esc($mecanico->cpf);?></p>
    <p><strong>Especialidade : </strong> <?=esc($mecanico->especialidade_nome);?></p>
    <p><strong>status : </strong> <?=esc($mecanico->status);?></p>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </div>
</div>  <?php if ($userType === 'admin'): ?>


      <a href="<?php echo base_url('alterar-status-equipe/' . $equipe['id']); ?>">
    <button style="background-color: <?=($equipe['status'] === 'ativo') ? 'red' : 'green'?>; color: white;">
        <?=($equipe['status'] === 'ativo') ? 'Desativar' : 'Ativar'?> Equipe
    </button>
</a> <a href="<?php echo base_url('editar/equipe/' . $equipe['id']); ?>"><button>Editar Equipe</button></a><?php endif;?>
<a href="/Ver?tipo=equipe">Voltar</a>

<?php endif;?>

<?php if ($tipo === 'servico' && $servico !== null): ?>
    <h1>Detalhes da serviço</h1>
 <p><strong>Codigo : </strong> <?=esc($servico['codigo']);?></p>
        <p><strong>Nome : </strong> <?=esc($servico['nome']);?></p>
        <p><strong>Valor : R$ </strong> <?=esc($servico['valor']);?></p>
        <p><strong>Descrição : </strong> <?=esc($servico['descricao']);?></p>
        <p><strong>Status : </strong> <?=esc($servico['status']);?></p>
        <a href="<?php echo base_url('alterar-status-servico/' . $servico['id']); ?>">

    </a><?php if ($userType === 'admin'): ?> <button style="background-color: <?=($servico['status'] === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($servico['status'] === 'ativo') ? 'Desativar' : 'Ativar'?> serviço
        </button><a href="<?php echo base_url('editar/servico/' . $servico['id']); ?>"><button>Editar Serviço</button></a><?php endif;?>
    <a href="/Ver?tipo=servico">Voltar</a>
<?php endif;?>


<?php if ($tipo === 'mecanico'): ?>
    <h3>Detalhes do mecânico</h3>
    <p><strong>Código : </strong> <?=esc($user->codigo);?></p>
    <p><strong>Nome : </strong> <?=esc($user->nome_completo);?></p>
    <p><strong>CPF : </strong> <?=esc($user->cpf);?></p>
    <p><strong>Especialidade : </strong> <?=esc($user->especialidade_nome);?></p>
    <p><strong>status : </strong> <?=esc($user->status);?></p>

    <div class="accordion" id="equipeAccordion">
    <div class="accordion-item">
        <?php foreach ($equipes as $equipe): ?>  <h2 class="accordion-header" id="headingEquipe">

             <button class="btn btn-link collapsed" type="button"  data-toggle="collapse" data-target="#collapseEquipe" aria-expanded="true" aria-controls="collapseEquipe">
            <?=esc($equipe['nome']);?>
            </button>
            <a href="/detalhes/equipe/<?=esc($equipe['equipe_id']);?>">
    <button class="btn btn-primary float-right">Detalhes</button>
</a>
        </h2>
        <div id="collapseEquipe" class="accordion-collapse collapse" aria-labelledby="headingEquipe" data-parent="#equipeAccordion">
            <div class="accordion-body">
            <?php if (!empty($equipes)): ?>

                    <p><strong>Nome:</strong> <?=esc($equipe['nome']);?></p>
                    <p><strong>Descrição:</strong> <?=esc($equipe['descricao']);?></p>
                    <p><strong>Status:</strong> <?=esc($equipe['status']);?></p>

            <?php else: ?>

            <?php endif;?>
            </div>
        </div><?php endforeach;?>
    </div>
</div>
<?php if ($userType === 'admin'): ?>




    <a href="<?php echo base_url('editar/mecanico/' . $user->id); ?>"><button>Editar Mecânico</button></a>
    <a href="<?php echo base_url('alterar-status-mecanico/' . $user->id); ?>">
        <button style="background-color: <?=($user->status === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($user->status === 'ativo') ? 'Desativar' : 'Ativar'?> Mecânico
        </button>
    </a> <?php endif;?><a href="/Ver?tipo=mecanico">Voltar</a>
<?php endif;?>
<?php if ($tipo === 'admin'): ?>
    <h1>Detalhes do administrador</h1>

    <?php if ($user): ?>
        <p><strong>Tipo:</strong> <?=esc($user->tipo);?></p>
        <p><strong>Nome:</strong> <?=esc($user->nome_completo);?></p>
        <p><strong>Especialidade:</strong> <?=esc($user->especialidade_nome);?></p>
        <p><strong>status:</strong> <?=esc($user->status);?></p>
    <?php else: ?>

    <?php endif;?>
    <a href="#" id="request-part-button2"><button>Solicitar um serviço</button></a>
   <div id="request-part-form2" style="display: none;">
    <form action="/request_part2" method="post">
        <label for="part2">Serviço:</label>
        <input type="text" id="part2" name="part2">
        <input type="submit" value="Solicitar">
    </form>
</div>
<a href="#" id="request-part-button"><button>Solicitar uma peça</button></a>
<div id="request-part-form" style="display: none;">
    <form action="/request_part" method="post">
        <label for="part">Peça:</label>
        <input type="text" id="part" name="part">
        <input type="submit" value="Solicitar">
    </form>
</div>


  <a href="/Ver?tipo=admin">Voltar</a>

<script>
document.getElementById('request-part-button').addEventListener('click', function() {
    var form = document.getElementById('request-part-form');
    if (form.style.display === 'block') {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
});

document.getElementById('request-part-button2').addEventListener('click', function() {
    var form = document.getElementById('request-part-form2');
    if (form.style.display === 'block') {
        form.style.display = 'none';
    } else {
        form.style.display = 'block';
    }
});
</script>
<?php endif;?>
<a href="/orders">Home</a>
</body>
</html>
