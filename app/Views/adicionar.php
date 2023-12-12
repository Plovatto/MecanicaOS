<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Adicionar</title>
    <link rel="icon"  type="image/png" href="favicon.ico">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="/style/add.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
</head>
<body>
<?php if (isset($viewData['data']['validation_errors'])): ?>
    <div class="alert alert-danger">
        <ul>
            <?php foreach ($viewData['data']['validation_errors'] as $error): ?>
                <li><?=esc($error)?></li>
            <?php endforeach;?>
        </ul>
    </div>
<?php endif; ?>
<div class="card"><br>
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
<select id="cor" name="cor" required>

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
<select name="cliente_id" id="cliente_id" required>
<?php if (empty($data['clientes'])): ?>
    <option>Nenhum cliente ativo</option>
<?php else: ?>
    <?php foreach ($data['clientes'] as $cliente): ?>
     
        <option value="<?=$cliente->id?>"><?=$cliente->nome_completo?></option>
    <?php endforeach;?>
<?php endif; ?>
</select>
<br>
<label for="marca_id">Marca</label>

<select name="marca_id" id="marca_id" required>

<?php foreach ($marcas as $id => $nome): ?>
 
    <option value="<?=$id?>"><?=esc($nome)?></option>
<?php endforeach;?>
<option value="other">Outro</option>
</select>
<input type="text" id="marca_other" name="marca_other" style="display: none;">

<br>
<label id="modelo" for="modelo_id">Modelo</label>
<select id="modelo_id" name="modelo_id" required>

<?php if (!empty($modelos)): ?>
    <?php foreach ($modelos as $modelo): ?>
        <option value="<?=$modelo->id?>"><?=$modelo->nome?></option>
    <?php endforeach;?>
<?php endif;?>
<option value="other">Outro</option>
</select><br> <label for="descricao">Descrição</label><br>
<textarea required id="descricao" name="descricao" required><?=set_value('descricao')?></textarea>
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
<label for="tipo">Tipo</label>
<input type="text" name="tipo" required>
<br>
<label for="descricao">Descrição</label>
<input type="text" name="descricao" required>
<br>

<input type="submit" value="Adicionar Peça">

<?php echo form_close(); ?>



<?php endif;?>



<?php if ($data['tipo'] === 'especialidade'): ?>

<?php echo form_open('adicionar/especialidade'); ?>

<label for="nome">Nome</label>
<input type="text" name="nome" required>
<br>
<label for="descricao">Descrição</label>
<input type="text" name="descricao" required>
<br>

<input type="submit" value="Adicionar Especialidade">

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
<label for="tipo">Tipo</label>
<input type="text" name="tipo" required>
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
<div class="password-container">
    <input type="password" placeholder="Senha" name="password" id="password">
    <button type="button" id="togglePassword" class="eye-button">
    <span class="material-icons" id="eyeIcon">
        visibility_off
    </span>
</button>
</div>

<script>
    const togglePassword = document.querySelector("#togglePassword");
    const password = document.querySelector("#senha");

    togglePassword.addEventListener('click', function (e) {
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        this.classList.toggle('fa-eye-slash');
    });
</script>
<br>
<label for="cpf">cpf</label>
<input type="text" name="cpf" required>
<br>
<label for="tipo">Tipo</label>
<select name="tipo" required>
 <option value="mecanico">Mecanico</option>
    <option value="admin">Admin</option>
   
</select>
<br>
<br>
<select name="especialidade_id" required>

    <?php
    $especialidadeModel = new \App\Models\EspecialidadeModel();
    $especialidades = $especialidadeModel->where('status', 'ativo')->findAll();

    if (empty($especialidades)) {
        echo "<option value=''>Nenhuma especialidade disponível</option>";
    } else {
        foreach ($especialidades as $especialidade) {
            echo "<option value='{$especialidade['id']}'>{$especialidade['nome']}</option>";
        }
    }
    ?>
</select>
<br>
<input type="submit" value="Adicionar mecânico">

<?php echo form_close(); ?>



<?php endif;?>

<?php if ($data['tipo'] === 'equipe'): ?>
  
<?php echo form_open('adicionar/equipe'); ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?=session()->getFlashdata('error')?>
    </div>
<?php endif;?>
<br>
<label for="nome">Nome</label>
<input type="text" name="nome" required>
<br>
<label for="descricao">Descrição</label>
<input type="text" name="descricao" required>
<br>
<br>
<label for="mecanico_id">Mecânicos disponíveis</label>
<select  id="mecanicos_disponiveis" multiple="multiple">
    <?php foreach ($data['mecanicos'] as $mecanico): ?>
        <option value="<?= $mecanico->id ?>"><?= $mecanico->nome_completo ?></option>
    <?php endforeach; ?>
</select>

<label for="mecanicos_selecionados">Mecânicos na equipe</label>
<select required id="mecanicos_selecionados" name="mecanico_id[]" multiple="multiple">

</select>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<br>
<label for="especialidade_id">Especialidade</label>
<select name="especialidade_id" required>
    <?php 
    if (isset($data['especialidades'])) {
        foreach ($data['especialidades'] as $especialidade): ?>
       <option value="<?=$especialidade['id']?>"><?=$especialidade['nome']?></option>0
        <?php endforeach;
    } ?>
</select>
<br>
<input type="submit" value="Adicionar Equipe">

<?php echo form_close(); ?>

<?php endif;?>
</div>
<br><br>
<br><br><br><br><br><br><br><br><br><br><br><br><b><br><br><br><br></b>
<br><br><br><a  href="/orders">Home</a>
</body>
</html>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    $('#mecanicos_disponiveis').on('click', 'option', function() {
        var selectedOption = $(this).detach();
        $('#mecanicos_selecionados').append(selectedOption);
    });

    $('#mecanicos_selecionados').on('click', 'option', function() {
        var selectedOption = $(this).detach();
        $('#mecanicos_disponiveis').append(selectedOption);
    });

    $('form').on('submit', function() {
        $('#mecanicos_selecionados option').prop('selected', true);
    });

    $('#marca_id').change(function() {
        var marca_id = this.value;
        var select = $('#modelo_id');
        var modelin = $('#modelo');
        if (marca_id) {
            fetch('/modelos_by_marca/' + marca_id)
                .then(response => response.json())
                .then(data => {
                    select.empty();
                    for (var i = 0; i < data.length; i++) {
                        var option = $('<option></option>').val(data[i].id).text(data[i].nome);
                        select.append(option);
                    }

                    var option = $('<option></option>').val('Outro').text('Outro');
                    select.append(option);
                });

            select.show();
            modelin.show();
        } else {
            select.hide();
            modelin.hide();
        }
    });

    $('#marca_id').change(function() {
        var marca_id = this.value;
        var marca_other = $('#marca_other');
        if (marca_id === 'Outro') {
            marca_other.show();
        } else {
            marca_other.hide();
        }
    });

    $('#modelo_id').change(function() {
        var modelo_id = this.value;
        var modelo_other = $('#modelo_other');
        if (modelo_id === 'Outro') {
            modelo_other.show();
        } else {
            modelo_other.hide();
        }
    });

    $('#cliente_id').select2();
});
</script><style>
#modelo_id {
    display: none;
}#modelo{
    display: none;
}
</style><script>
document.getElementById('togglePassword').addEventListener('click', function () {
    var passwordInput = document.getElementById('password');
    var eyeIcon = document.getElementById('eyeIcon');
    var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

   
    if (type === 'text') {
        eyeIcon.textContent = 'visibility';
    } else {
        eyeIcon.textContent = 'visibility_off';
    }
});
</script><style>.password-container {
    position: relative;
}

.eye-button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: none;
    cursor: pointer;
}</style>