<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver <?=esc($tipo)?></title>
    
</head>
<body>

<form method="get">
    <input  type="hidden" name="tipo" value="<?=esc($tipo)?>">
    <input  onblur="this.form.submit()" type="text" name="pesquisa" placeholder="Pesquisar">

    <button type="reset" onclick="this.form.submit()">Limpar pesquisa</button>
</form>
<a href="/orders">Home</a>
<?php if ($tipo === 'cliente'): ?>
    <h2>Lista de Clientes</h2>
    <ul>
    <?php foreach ($dados as $cliente): ?>
        <?php if (!$pesquisa || stripos($cliente->nome_completo, $pesquisa) !== false || stripos($cliente->cnh, $pesquisa) !== false): ?>            <li>
                <a href="/detalhes/cliente/<?=$cliente->id?>">
                    <?=esc($cliente->nome_completo);?>
                </a>
                <?=esc($cliente->cnh);?>
            </li>
        <?php endif; ?>
    <?php endforeach;?>
    </ul>
<?php endif;?>



<?php if ($tipo === 'veiculo'): ?>
        <h1></h1>
        <?php foreach ($dados as $veiculo): ?>
            <?php if (!$pesquisa || stripos($veiculo->placa, $pesquisa) !== false || stripos($veiculo->modelo_nome, $pesquisa) !== false || stripos($veiculo->marca_nome, $pesquisa) !== false): ?>            <li>
            <li>
            <a href="/detalhes/veiculo/<?=$veiculo->id?>">Detalhes do Veículo
            <?=esc($veiculo->marca_nome);?>
            <?=esc($veiculo->modelo_nome);?>
                     <?=esc($veiculo->placa);?>
                   
                </a>

            </li>
            <?php endif; ?>
         <?php endforeach;?>
    <?php endif;?>



    <?php if ($tipo === 'os'): ?>
    <h1>Ordens de Serviço</h1>
    <?php foreach ($dados as $order): ?>
        
        <li>
            <a href="/detalhesOS/<?=$order['id']?>">Detalhes da Ordem de Serviço </a>
            <?=esc($order['codigo']);?>
            <?=esc($order['data_previsao']);?>
        </li>
    <?php endforeach;?>
<?php endif;?>



<?php if ($tipo === 'mecanico'): ?>
    <h1>mecanico</h1>
    <?php foreach ($dados as $user): ?>
        <li>
            <a href="/detalhes/mecanico/<?=$user->id?>">Detalhes </a>
            <?=esc($user->nome_completo);?>
            <?=esc($user->especialidade_nome);?>
        </li>
    <?php endforeach;?>
<?php endif;?>



    <?php if ($tipo === 'peca'): ?>
    <h1>Peças</h1>
    <?php foreach ($dados as $peca): ?>
        <li>
                <a href="/detalhes/peca/<?=$peca['id']?>">Detalhes </a>
        </li><?=esc($peca['nome']);?>
        <?=esc($peca['valor']);?>
    <?php endforeach;?>
<?php endif;?>


<?php if ($tipo === 'equipe'): ?>
    <?php foreach ($dados as $equipe): ?>
        <li>
                <a href="/detalhes/equipe/<?=$equipe['id']?>">Detalhes </a>
                <?=esc($equipe['nome']);?>
                <?=esc($equipe['codigo']);?>
            </li>
    <?php endforeach;?>
<?php endif;?>


<?php if ($tipo === 'admin'): ?>
    <?php foreach ($dados as $user): ?>
        <?php if ($user->tipo === 'admin'): ?>
            <li>
                <a href="/detalhes/admin/<?=$user->id?>">Detalhes </a>
                <?=esc($user->nome_completo);?>
            <?=esc($user->tipo);?>
            </li>
        <?php endif; ?>
    <?php endforeach;?>
<?php endif;?>


       <?php if ($tipo === 'servico'): ?>
        <?php foreach ($dados as $servico): ?>
        <li>
            <a href="/detalhes/servico/<?=$servico['id']?>">Detalhes </a>
            <?=esc($servico['nome']);?>
        <?=esc($servico['valor']);?>
        </li>
    <?php endforeach;?>
       <?php endif;?>
       
</body>
</html>
