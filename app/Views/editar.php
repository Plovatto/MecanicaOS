
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Cliente</title>
</head>
<body><?php if ($tipo === 'cliente'): ?>
    <h1>Editar Cliente</h1>

    <?php echo form_open('editar/cliente/' . $cliente->id); ?>
    <input type="hidden" name="_method" value="post">

    <label for="nome_completo">Nome Completo</label>
    <input type="text" name="nome_completo" value="<?php echo $cliente->nome_completo; ?>" required>

    <label for="endereco">Endereço</label>
    <input type="text" name="endereco" value="<?php echo $cliente->endereco; ?>" required>

    <label for="email">Email</label>
    <input type="email" name="email" value="<?php echo $cliente->email; ?>" required>

    <label for="status">Status</label>
    <?php
$status_options = [
    'ativo' => 'Ativo',
    'desativado' => 'Desativado',
];
echo form_dropdown('status', $status_options, $cliente->status);
?>

    <label for="cpf">CPF</label>
    <input type="text" name="cpf" value="<?php echo $cliente->cpf; ?>" required>

    <label for="cnh">CNH</label>
    <input type="text" name="cnh" value="<?php echo $cliente->cnh; ?>" required>

    <label for="telefone">Telefone</label>
    <input type="text" name="telefone" value="<?php echo $cliente->telefone; ?>" required>

    <input type="submit" value="Atualizar Cliente">
<a href="/Ver?tipo=cliente">Voltar</a>
    <?php echo form_close(); ?>    <?php endif;?>
    


    <?php if ($tipo === 'peca'): ?>
    <h1>Editar Cliente</h1>

    <?php echo form_open('editar/peca/' . $peca['id']); ?>
    <input type="hidden" name="_method" value="post">

    <label for="nome">Nome</label>
    <input type="text" name="nome" value="<?php echo $peca['nome']; ?>" required>

    <label for="valor">Valor</label>
    <input type="text" name="valor" value="<?php echo $peca['valor']; ?>" required>

    <label for="descricao">descricao</label>
    <input type="text" name="descricao" value="<?php echo $peca['descricao']; ?>" required>

   

    <input type="submit" value="Atualizar Peça">

    <?php echo form_close(); ?>    <?php endif;?>

    <?php if ($tipo === 'servico'): ?>
    <h1>Editar Cliente</h1>

    <?php echo form_open('editar/servico/' . $servico['id']); ?>
    <input type="hidden" name="_method" value="post">

    <label for="nome">Nome</label>
    <input type="text" name="nome" value="<?php echo $servico['nome']; ?>" required>

    <label for="valor">Valor</label>
    <input type="text" name="valor" value="<?php echo $servico['valor']; ?>" required>

    <label for="descricao">descricao</label>
    <input type="text" name="descricao" value="<?php echo $servico['descricao']; ?>" required>

   

    <input type="submit" value="Atualizar Peça">

    <?php echo form_close(); ?>    <?php endif;?>

</body>
</html>
