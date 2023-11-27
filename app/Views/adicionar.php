<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
<?php if (isset($data['validation_errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($data['validation_errors'] as $error): ?>
                <li><?=esc($error)?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif;?>
<?php if ($data['tipo'] === 'cliente'): ?>

    <?php echo form_open('adicionar/cliente'); ?>

<label for="nome_completo">Nome Completo</label>
<input type="text" name="nome_completo" required>
<br>
<label for="endereco">Endereço</label>
<input type="text" name="endereco" required>
<br>
<label for="email">Email</label>
<input type="email" name="email" required>
<br>
<label for="cpf">CPF</label>
<input type="text" name="cpf" required>
<br>
<label for="cnh">CNH</label>
<input type="text" name="cnh" required>
<br>
<label for="telefone">Telefone</label>
<input type="text" name="telefone" required>
<br>
<input type="submit" value="Adicionar Cliente">

<?php echo form_close(); ?>



    <?php endif;?>





    <?php if ($data['tipo'] === 'veiculo'): ?>

    <h2>Adicionar veículo</h2><br>


     <?php echo form_open('adicionar/veiculo'); ?>

     <label for="placa">Placa</label>
    <input type="text" id="placa" name="placa" value="<?=set_value('placa')?>" required>
   <br>
    <label for="ano">Ano</label>
 <?=form_dropdown('ano', (new \App\Helpers\FormHelpers())->generate_years_dropdown(), set_value('ano'), 'id="ano" required')?>
<br>

    <label for="cor">Cor</label>
<select id="cor" name="cor">
    <option value="Branco">Branco</option>
    <option value="Preto">Preto</option>
    <option value="Prata">Prata</option>
    <option value="Cinza">Cinza</option>
    <option value="Azul">Azul</option>
    <option value="Vermelho">Vermelho</option>
    <option value="Verde">Verde</option>
    <option value="Amarelo">Amarelo</option>
    <option value="Laranja">Laranja</option>
    <option value="Marrom">Marrom</option>
    <option value="Roxo">Roxo</option>
    <option value="Outra">Outra</option>
</select>
<br>


<label for="cliente_id">Cliente</label>
    <select name="cliente_id" id="cliente_id">
    <?php foreach ($data['clientes'] as $cliente): ?>
        <option value="<?=$cliente->id?>"><?=$cliente->nome_completo?></option>
    <?php endforeach;?>
</select>
<br>
    <label for="marca_id">Marca</label>

<select name="marca_id" id="marca_id">
<option>Marca</option>
    <?php foreach ($marcas as $id => $nome): ?>
        <option value="<?=$id?>"><?=esc($nome)?></option>
    <?php endforeach;?>
    <option value="other">Other</option>
</select>
<input type="text" id="marca_other" name="marca_other" style="display: none;">

<br>
<label id="modelo" for="modelo_id">Modelo</label>
<select id="modelo_id" name="modelo_id">
    <option>Modelo</option>
    <?php if (!empty($modelos)): ?>
        <?php foreach ($modelos as $modelo): ?>
            <option value="<?=$modelo->id?>"><?=$modelo->nome?></option>
        <?php endforeach;?>
    <?php endif;?>
    <option value="other">Other</option>
</select><br> <label for="descricao">Descrição</label><br>
    <textarea id="descricao" name="descricao" required><?=set_value('descricao')?></textarea>
<br>
<input type="text" id="modelo_other" name="modelo_other" style="display: none;">
    <input type="submit" value="Criar Veículo">

    <?=form_close();?>
<?php endif;?> 


<?php if ($data['tipo'] === 'peca'): ?>

<?php echo form_open('adicionar/peca'); ?>

<label for="nome">Nome</label>
<input type="text" name="nome" required>
<br>
<label for="valor">Valor</label>
<input type="text" name="valor" required>
<br>
<label for="descricao">Descrição</label>
<input type="text" name="descricao" required>
<br>

<input type="submit" value="Adicionar Peça">

<?php echo form_close(); ?>



<?php endif;?>

<?php if ($data['tipo'] === 'servico'): ?>

<?php echo form_open('adicionar/servico'); ?>

<label for="nome">Nome</label>
<input type="text" name="nome" required>
<br>
<label for="valor">Valor</label>
<input type="text" name="valor" required>
<br>
<label for="descricao">Descrição</label>
<input type="text" name="descricao" required>
<br>

<input type="submit" value="Adicionar Serviço">

<?php echo form_close(); ?>



<?php endif;?>


<?php if ($data['tipo'] === 'mecanico'): ?>

<?php echo form_open('adicionar/mecanico'); ?>

<label for="nome_completo">Nome</label>
<input type="text" name="nome_completo" required>
<br>
<label for="endereco">endereco</label>
<input type="text" name="endereco" required>
<br>
<label for="email">email</label>
<input type="text" name="email" required>
<br>
<label for="senha">senha</label>
<input type="text" name="senha" required>
<br>
<label for="cpf">cpf</label>
<input type="text" name="cpf" required>
<br>
<label for="tipo">tipo</label>
<input type="text" name="tipo" required>
<br>
<label for="especialidade_codigo">especialidade_codigo</label>
<input type="text" name="especialidade_codigo" required>
<br>
<input type="submit" value="Adicionar mecânico">

<?php echo form_close(); ?>



<?php endif;?>

<?php if ($data['tipo'] === 'equipe'): ?>

<?php echo form_open('adicionar/equipe'); ?>

<label for="codigo">Código</label>
<input type="text" name="codigo" required>
<br>
<label for="nome">Nome</label>
<input type="text" name="nome" required>
<br>
<label for="descricao">Descrição</label>
<input type="text" name="descricao" required>
<br>
<br>
<label for="mecanico_id">Mecânico</label>
<select name="mecanico_id" required>
    <?php 
    if (isset($data['mecanicos'])) {
        foreach ($data['mecanicos'] as $mecanico): ?>
            <option value="<?=$mecanico->id?>"><?=$mecanico->nome_completo?></option>
        <?php endforeach;
    } ?>
</select>
<br>
<label for="especialidade_id">Especialidade</label>
<select name="especialidade_id" required>
    <?php 
    if (isset($data['especialidades'])) {
        foreach ($data['especialidades'] as $especialidade): ?>
            <option value="<?=$especialidade->id?>"><?=$especialidade->nome?></option>
        <?php endforeach;
    } ?>
</select>
<br>
<input type="submit" value="Adicionar Equipe">

<?php echo form_close(); ?>

<?php endif;?>


<a href="/orders">Home</a>
</body>
</html>

<script>
document.getElementById('marca_id').addEventListener('change', function() {
    var marca_id = this.value;
    var select = document.getElementById('modelo_id');
    var modelin = document.getElementById('modelo');
    if (marca_id) {
        fetch('/modelos_by_marca/' + marca_id)
            .then(response => response.json())
            .then(data => {
                select.innerHTML = '';
                for (var i = 0; i < data.length; i++) {
                    var option = document.createElement('option');
                    option.value = data[i].id;
                    option.text = data[i].nome;
                    select.appendChild(option);
                }

                var option = document.createElement('option');
                option.value = 'other';
                option.text = 'Other';
                select.appendChild(option);
            });

        select.style.display = 'block';
        modelin.style.display = 'block';
    } else {

        select.style.display = 'none';
        modelin.style.display = 'none';
    }
});

document.getElementById('marca_id').addEventListener('change', function() {
    var marca_id = this.value;
    var marca_other = document.getElementById('marca_other');
    if (marca_id === 'other') {
        marca_other.style.display = 'block';
    } else {
        marca_other.style.display = 'none';

    }
});

document.getElementById('modelo_id').addEventListener('change', function() {
    var modelo_id = this.value;
    var modelo_other = document.getElementById('modelo_other');
    if (modelo_id === 'other') {
        modelo_other.style.display = 'block';
    } else {
        modelo_other.style.display = 'none';
    }
});
</script><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#cliente_id').select2();
});
</script><style>
#modelo_id {
    display: none;
}#modelo{
    display: none;
}
</style>