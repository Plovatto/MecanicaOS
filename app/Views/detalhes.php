<!DOCTYPE html>

 <html>
 <head>
    <title>Detalhes</title>
 <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
 </head>
 <body>


 <?php if ($tipo === 'cliente' && $cliente !== null): ?>
    <h1>Detalhes do Cliente</h1>
    <p><strong>Nome:</strong> <?=esc($cliente->nome_completo);?></p>
    <p><strong>Endereço:</strong> <?=esc($cliente->endereco);?></p>
    <p><strong>Email:</strong> <?=esc($cliente->email);?></p>
    <p><strong>Status:</strong> <?=esc($cliente->status);?></p>
    <p><strong>CPF:</strong> <?=esc($cliente->cpf);?></p>
    <p><strong>CNH:</strong> <?=esc($cliente->cnh);?></p>
    <p><strong>Telefone:</strong> <?=esc($cliente->telefone);?></p>


    <?php if (!empty($veiculos)): ?>
    <h2>Veículos do Cliente</h2>
    <div id="accordion">
        <?php foreach ($veiculos as $index => $veiculo): ?>
            <div class="card">
                <div class="card-header" id="heading<?=$index?>">
                    <h5 class="mb-0">
                        <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?=$index?>" aria-expanded="true" aria-controls="collapse<?=$index?>">
                            <?=esc($veiculo->placa);?>
                        </button>
                    </h5>
                </div>

                <div id="collapse<?=$index?>" class="collapse" aria-labelledby="heading<?=$index?>" data-parent="#accordion">
                    <div class="card-body">
                        <strong>Marca:</strong> <?=esc($veiculo->marca_id);?><br>
                        <strong>Modelo:</strong> <?=esc($veiculo->modelo_id);?><br>
                        <strong>Cor:</strong> <?=esc($veiculo->cor);?><br>
                        <strong>Status:</strong> <?=esc($veiculo->status);?><br>
                        <strong>Ano:</strong> <?=esc($veiculo->ano);?><br>
                        <strong>Descrição:</strong> <?=esc($veiculo->descricao);?><br>
                    </div>
                </div>
            </div>
        <?php endforeach;?>
    </div>
<?php else: ?>
    <p>Nenhum veículo associado a este cliente.</p>
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
    <h1>Detalhes do Veículo</h1>
    <p><strong>Placa:</strong> <?=esc($veiculo->placa);?></p>

    <p><strong>Marca:</strong> <?=esc($veiculo->marca_nome);?></p>
    <p><strong>Modelo:</strong> <?=esc($veiculo->modelo_nome);?></p>
    <p><strong>Cor:</strong> <?=esc($veiculo->cor);?></p>
    <p><strong>Ano:</strong> <?=esc($veiculo->ano);?></p>
    <p><strong>Descrição:</strong> <?=esc($veiculo->descricao);?></p>
<p><strong>Status:</strong> <?=esc($veiculo->status);?></p>

    <div id="accordion">
        <div class="card">
            <div class="card-header" id="headingCliente">
                <h5 class="mb-0">
                    <button class="btn btn-link" data-toggle="collapse" data-target="#collapseCliente" aria-expanded="true" aria-controls="collapseCliente">
                        Cliente Associado
                    </button>
                </h5>
            </div>

            <div id="collapseCliente" class="collapse" aria-labelledby="headingCliente" data-parent="#accordion">
    <div class="card-body">
    <?php if ($clienteDoVeiculo !== null): ?>
        <h2>Cliente Associado</h2>
        <p><strong>Nome:</strong> <?=esc($clienteDoVeiculo->nome_completo);?></p>
        <p><strong>Endereço:</strong> <?=esc($clienteDoVeiculo->endereco);?></p>
        <p><strong>Email:</strong> <?=esc($clienteDoVeiculo->email);?></p>
        <p><strong>Status:</strong> <?=esc($clienteDoVeiculo->status);?></p>
        <p><strong>CPF:</strong> <?=esc($clienteDoVeiculo->cpf);?></p>
        <p><strong>CNH:</strong> <?=esc($clienteDoVeiculo->cnh);?></p>
        <p><strong>Telefone:</strong> <?=esc($clienteDoVeiculo->telefone);?></p>
    <?php else: ?>
        <p>Nenhum cliente associado a este veículo.</p>
    <?php endif;?>
    </div>
</div>

        </div>
    </div>    <a href="<?php echo base_url('alterar-status-veiculo/' . $veiculo->id); ?>">
        <button style="background-color: <?=($veiculo->status === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($veiculo->status === 'ativo') ? 'Desativar' : 'Ativar'?> Veículo
        </button>
    </a>
    <a href="/Ver?tipo=veiculo">Voltar</a>
<?php endif;?>



<?php if ($tipo === 'peca' && $peca !== null): ?>
    <h1>Detalhes da peça</h1>

        <p><strong>Placa:</strong> <?=esc($peca['nome']);?></p>
        <p><strong>Marca:</strong> <?=esc($peca['valor']);?></p>
        <p><strong>Descrição:</strong> <?=esc($peca['descricao']);?></p>
        <p><strong>Status:</strong> <?=esc($peca['status']);?></p>
        <a href="<?php echo base_url('alterar-status-peca/' . $peca['id']); ?>">
        <button style="background-color: <?=($peca['status'] === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($peca['status'] === 'ativo') ? 'Desativar' : 'Ativar'?> Peça
        </button>
    </a><?php if ($userType === 'admin'): ?> <a href="<?php echo base_url('editar/peca/' . $peca['id']); ?>"><button>Editar Cliente</button></a><?php endif;?>

    <a href="/Ver?tipo=peca">Voltar</a>
<?php endif;?>
<?php if ($tipo === 'equipe' && $equipe !== null): ?>
    <h1>Detalhes da equipe</h1>

<p><strong>Nome:</strong> <?=esc($equipe['nome']);?></p>

<p><strong>Descrição:</strong> <?=esc($equipe['descricao']);?></p>
<p><strong>Status:</strong> <?=esc($equipe['status']);?></p>
<a href="<?php echo base_url('alterar-status-equipe/' . $equipe['id']); ?>">
    <button style="background-color: <?=($equipe['status'] === 'ativo') ? 'red' : 'green'?>; color: white;">
        <?=($equipe['status'] === 'ativo') ? 'Desativar' : 'Ativar'?> Equipe
    </button>
</a>
<a href="/Ver?tipo=equipe">Voltar</a>
<h2>Mecânicos na equipe</h2>
<ul>
    <?php foreach ($equipe['mecanicos'] as $mecanico): ?>
        <li><?= esc($mecanico->nome_completo); ?></li>
    <?php endforeach; ?>
</ul>
<?php endif;?>

<?php if ($tipo === 'servico' && $servico !== null): ?>
    <h1>Detalhes da serviço</h1>

        <p><strong>Placa:</strong> <?=esc($servico['nome']);?></p>
        <p><strong>Marca:</strong> <?=esc($servico['valor']);?></p>
        <p><strong>Descrição:</strong> <?=esc($servico['descricao']);?></p>
        <p><strong>Status:</strong> <?=esc($servico['status']);?></p>
        <a href="<?php echo base_url('alterar-status-servico/' . $servico['id']); ?>">
        <button style="background-color: <?=($servico['status'] === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($servico['status'] === 'ativo') ? 'Desativar' : 'Ativar'?> servico  
        </button>
    </a><?php if ($userType === 'admin'): ?> <a href="<?php echo base_url('editar/servico/' . $servico['id']); ?>"><button>Editar Cliente</button></a><?php endif;?>
    <a href="/Ver?tipo=servico">Voltar</a>
<?php endif;?>


<?php if ($tipo === 'mecanico'): ?>
    <h1>Detalhes da os</h1>
    <p><strong>Código:</strong> <?=esc($user->codigo);?></p>
    <p><strong>Nome:</strong> <?=esc($user->nome_completo);?></p>
    <p><strong>Especialidade:</strong> <?=esc($user->especialidade_nome);?></p>
    <p><strong>status:</strong> <?=esc($user->status);?></p>
    <a href="/Ver?tipo=mecanico">Voltar</a>


    <a href="<?php echo base_url('alterar-status-mecanico/' . $user->id); ?>">
        <button style="background-color: <?=($user->status === 'ativo') ? 'red' : 'green'?>; color: white;">
            <?=($user->status === 'ativo') ? 'Desativar' : 'Ativar'?> Mecânico
        </button>
    </a>
<?php endif;?>
<?php if ($tipo === 'admin'): ?>
    <h1>Detalhes da os</h1>
    
    <?php if ($user): ?>
        <p><strong>Tipo:</strong> <?=esc($user->tipo);?></p>
        <p><strong>Nome:</strong> <?=esc($user->nome_completo);?></p>
        <p><strong>Especialidade:</strong> <?=esc($user->especialidade_nome);?></p>
        <p><strong>status:</strong> <?=esc($user->status);?></p>
    <?php else: ?>
        <p>Usuário não encontrado.</p>
    <?php endif; ?>
    <a href="/Ver?tipo=admin">Voltar</a>


<?php endif;?>
<a href="/orders">Home</a>
</body>
</html>
