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
    </div>
    <a href="/Ver?tipo=veiculo">Voltar</a>
<?php endif;?>











<?php if ($tipo === 'mecanico'): ?>
    <h1>Detalhes da os</h1>
    <p><strong>Número da OS:</strong> <?=esc($user->codigo);?></p>
    <p><strong>Número da OS:</strong> <?=esc($user->nome_completo);?></p>
    <p><strong>Número da OS:</strong> <?=esc($user->especialidade_nome);?></p>
    <p><strong>status:</strong> <?=esc($user->status);?></p>
    <a href="/Ver?tipo=mecanico">Voltar</a>

    <a href="<?php echo base_url('alterar-status-mecanico/' . $user->codigo); ?>"><button>Alterar Status</button></a>
<?php endif;?>

<a href="/orders">Home</a>
</body>
</html>
