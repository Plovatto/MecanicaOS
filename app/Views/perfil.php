<!DOCTYPE html>
<html lang="en">
<head>  <link rel="stylesheet" href="/style/perfil.css">
    <meta charset="UTF-8">
    <link rel="icon"  type="image/png" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil</title>
</head>
<body>
<h1>Perfil do Usuário</h1>

<div class="info">
    <label>Codigo</label>
    <p><?=esc($perfil->id)?></p>
</div>
<div class="info">
    <label>Nome</label>
    <p><?=esc($perfil->nome_completo)?></p>
</div>
<div class="info">
    <label>Email</label>
    <p><?=esc($perfil->email)?></p>
</div>
<div class="info">
    <label>Endereço</label>
    <p><?=esc($perfil->endereco)?></p>
</div>
<div class="info">
    <label>Cpf</label>
    <p><?=esc($perfil->cpf)?></p>
</div>
<div class="info">
    <label>Tipo</label>
    <p><?=esc($perfil->tipo)?></p>
</div>
<div class="info">
    <label>Status :</label>
    <p><?=esc($perfil->status)?></p>
</div>
<div class="info">
    <label>Especialidade</label>
    <p><?=esc($perfil->especialidade_nome)?></p>
</div>

<a href="/logout">Logout</a>


    <?php if ($userType === 'admin'): ?>


    <a href="<?php echo base_url('editar/admin/' . $perfil->id); ?>"><button>Editar Administrador</button></a>
  <?php endif;?>


<button><a href="/orders">home</a></button>
</body>
</html>
