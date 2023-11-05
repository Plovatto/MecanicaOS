<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver <?=esc($tipo)?></title>
</head>
<body>



<a href="/orders">Home</a>
<?php if ($tipo === 'cliente'): ?>
    <h2>Lista de Clientes</h2>
    <ul>
        <?php foreach ($clientes as $cliente): ?>
            <li>
            <a href="/detalhes/cliente/<?=$cliente->id?>">

                    <?=esc($cliente->nome_completo);?>
                </a>
                <?=esc($cliente->cnh);?>
            </li>
        <?php endforeach;?>
    </ul>
<?php endif;?>





<?php if ($tipo === 'veiculo'): ?>
        <h1></h1>
        <?php foreach ($veiculos as $veiculo): ?>
            <li>
            <a href="/detalhes/veiculo/<?=$veiculo->id?>">Detalhes do Veículo
                    <?=esc($veiculo->placa);?>
                </a>

            </li>
        <?php endforeach;?>
    <?php endif;?>

    <?php if ($tipo === 'os'): ?>
    <h1>Ordens de Serviço</h1>
    <?php foreach ($orders as $order): ?>
        <li>
            <a href="/detalhesOS/<?=$order['id']?>">Detalhes da Ordem de Serviço <?=esc($order['id']);?></a>
        </li>
    <?php endforeach;?>
<?php endif;?>


<?php if ($tipo === 'mecanico'): ?>
    <h1>mecanico</h1>
    <?php foreach ($users as $user): ?>
        <li>
            <a href="/detalhes/mecanico/<?=$user->id?>">Detalhes <?=esc($user->id);?></a>
        </li>
    <?php endforeach;?>
<?php endif;?>

    <?php if ($tipo === 'equipe'): ?>

    <?php endif;?>

    <?php if ($tipo === 'peca'): ?>

    <?php endif;?>
    <?php if ($tipo === 'admin'): ?>

       <?php endif;?>
</body>
</html>
