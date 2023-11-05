<!-- app/Views/cliente/editarCliente.php -->

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

    <?php echo form_close(); ?>    <?php endif;?>
    <a href="/Ver?tipo=cliente">Voltar</a>

</body>
</html>
