
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

    <?php if ($tipo === 'especialidade'): ?>
    <h1>Editar Especialidade</h1>

    <?php echo form_open('editar/especialidade/' . $especialidade['id']); ?>
    <input type="hidden" name="_method" value="post">

    <label for="nome">Nome</label>
    <input type="text" name="nome" value="<?php echo $especialidade['nome']; ?>" required>

    <label for="descricao">descricao</label>
    <input type="text" name="descricao" value="<?php echo $especialidade['descricao']; ?>" required>



    <input type="submit" value="Atualizar Especialidade">

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
    <?php if ($data['tipo'] === 'mecanico'): ?>

<?php echo form_open('editar/mecanico/' . $user->id); ?>

<label for="nome_completo">Nome</label>
<input type="text" name="nome_completo" value="<?php echo $user->nome_completo; ?>" required>
<br>
<label for="endereco">Endereço</label>
<input type="text" name="endereco" value="<?php echo $user->endereco; ?>" required>
<br>
<label for="email">Email</label>
<input type="text" name="email" value="<?php echo $user->email; ?>" required>
<br>
<label for="cpf">CPF</label>
<input type="text" name="cpf" value="<?php echo $user->cpf; ?>" required>
<br>
<label for="tipo">Tipo</label>
<select name="tipo" required>
    <option value="admin" <?php echo $user->tipo === 'admin' ? 'selected' : ''; ?>>Admin</option>
    <option value="mecanico" <?php echo $user->tipo === 'mecanico' ? 'selected' : ''; ?>>Mecânico</option>
</select>
<br>
<br>
<label for="especialidade_id">Especialidade</label>
<select name="especialidade_id" required>
    <?php
$especialidadeModel = new \App\Models\EspecialidadeModel();
$especialidades = $especialidadeModel->findAll();

foreach ($especialidades as $especialidade) {
    echo "<option value='{$especialidade['id']}'" . ($user->especialidade_id === $especialidade['id'] ? ' selected' : '') . ">{$especialidade['nome']}</option>";
}
?>
</select>
<br>
<input type="submit" value="Atualizar Mecânico">

<?php echo form_close(); ?>
<?php endif;?>


<?php if ($data['tipo'] === 'admin'): ?>

<?php echo form_open('editar/admin/' . $user->id); ?>

<label for="nome_completo">Nome</label>
<input type="text" name="nome_completo" value="<?php echo $user->nome_completo; ?>" required>
<br>
<label for="endereco">Endereço</label>
<input type="text" name="endereco" value="<?php echo $user->endereco; ?>" required>
<br>
<label for="email">Email</label>
<input type="text" name="email" value="<?php echo $user->email; ?>" required>
<br>
<label for="cpf">CPF</label>
<input type="text" name="cpf" value="<?php echo $user->cpf; ?>" required>
<br>
<label for="tipo">Tipo</label>
<select name="tipo" required>
    <option value="admin" <?php echo $user->tipo === 'admin' ? 'selected' : ''; ?>>Admin</option>
    <option value="mecanico" <?php echo $user->tipo === 'mecanico' ? 'selected' : ''; ?>>Mecânico</option>
</select>
<br>
<br>
<label for="especialidade_id">Especialidade</label>
<select name="especialidade_id" required>
    <?php
$especialidadeModel = new \App\Models\EspecialidadeModel();
$especialidades = $especialidadeModel->findAll();

foreach ($especialidades as $especialidade) {
    echo "<option value='{$especialidade['id']}'" . ($user->especialidade_id === $especialidade['id'] ? ' selected' : '') . ">{$especialidade['nome']}</option>";
}
?>
</select>
<br>
<input type="submit" value="Atualizar Mecânico">

<?php echo form_close(); ?>
<?php endif;?>


<?php if ($data['tipo'] === 'veiculo'): ?>
    <?php echo form_open('editar/veiculo/' . $veiculo->id); ?>

<label for="placa">Placa</label>
<input type="text" id="placa" name="placa" value="<?=$veiculo->placa?>" required>
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
<br><label for="cliente_id">Cliente</label>
<select name="cliente_id" id="cliente_id">
<?php foreach ($data['clientes'] as $cliente): ?>
    <option value="<?=$cliente->id?>" <?=$veiculo->cliente_id == $cliente->id ? 'selected' : ''?>><?=$cliente->nome_completo?></option>
<?php endforeach;?>
</select>
<br>
<label for="marca_id">Marca</label>

<select name="marca_id" id="marca_id">
<option>Marca</option>
<?php foreach ($data['marcas'] as $id => $nome): ?>
    <option value="<?=$id?>" <?=$veiculo->marca_id == $id ? 'selected' : ''?>><?=esc($nome)?></option>
<?php endforeach;?>
<option value="other">Other</option>
</select>
<input type="text" id="marca_other" name="marca_other" style="display: none;">

<br>
<label id="modelo" for="modelo_id">Modelo</label>
<select id="modelo_id" name="modelo_id">
<option>Modelo</option>
<?php if (!empty($data['modelos'])): ?>
    <?php foreach ($data['modelos'] as $modelo): ?>
        <option value="<?=$modelo->id?>" <?=$veiculo->modelo_id == $modelo->id ? 'selected' : ''?>><?=$modelo->nome?></option>
    <?php endforeach;?>
<?php endif;?>
<option value="other">Other</option>
</select><br> <label for="descricao">Descrição</label><br>
<textarea id="descricao" name="descricao" required><?=$veiculo->descricao?></textarea>
<br>
<input type="text" id="modelo_other" name="modelo_other" style="display: none;"><input type="submit" value="Atualizar Veículo">

<?=form_close();?>
    <?php endif;?>


    <?php if ($data['tipo'] === 'equipe'): ?>
        <?php echo form_open('editar/equipe/' . $data['equipe']['id']); ?>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?=session()->getFlashdata('error')?>
    </div>
<?php endif;?>
<br>
<label for="nome">Nome</label>
<input type="text" name="nome" value="<?=$data['equipe']['nome']?>" required>
<br>
<label for="descricao">Descrição</label>
<input type="text" name="descricao" value="<?=$data['equipe']['descricao']?>" required>
<br>
<br>
<select id="mecanicos_disponiveis" name="mecanico_id[]" multiple="multiple">
    <?php
$teamMechanicsIds = array_map(function ($mecanico) {
    return $mecanico->id;
}, $data['equipe']['mecanicos']);

foreach ($data['all_mecanicos'] as $mecanico):
    if (!in_array($mecanico->id, $teamMechanicsIds)): ?>
	            <option class="clickable-option" value="<?=$mecanico->id?>"><?=$mecanico->nome_completo?></option>
	        <?php endif;
endforeach;?>
</select>

<label for="mecanicos_selecionados">Mecânicos na equipe</label>
<select id="mecanicos_selecionados" name="mecanico_id[]" multiple="multiple">
    <?php foreach ($data['equipe']['mecanicos'] as $mecanico): ?>
        <option class="clickable-option" value="<?=$mecanico->id?>"><?=$mecanico->nome_completo?></option>
    <?php endforeach;?>
</select>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<br>
<label for="especialidade_id">Especialidade</label>
<select name="especialidade_id" required>
    <?php
if (isset($data['especialidades'])) {
    foreach ($data['especialidades'] as $especialidade): ?>
<option value="<?=$especialidade['id']?>" <?=$data['equipe']['especialidade_id'] == $especialidade['id'] ? 'selected' : ''?>><?=$especialidade['nome']?></option>        <?php endforeach;
}?>
</select>
<input type="submit" value="Atualizar Veículo">

<?=form_close();?>
    <?php endif;?>
</body>
</html><script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function() {


        function moveMecanico(option, fromSelect, toSelect) {
        option.detach();
        $(toSelect).append(option);
    }

    $('#mecanicos_disponiveis').on('click', 'option', function() {
        moveMecanico($(this), '#mecanicos_disponiveis', '#mecanicos_selecionados');
    });
    $('#mecanicos_selecionados').on('click', 'option', function() {
        moveMecanico($(this), '#mecanicos_selecionados', '#mecanicos_disponiveis');
    });

    $('form').on('submit', function() {
        $('#mecanicos_selecionados option').prop('selected', true);
        $('#mecanicos_disponiveis option').prop('selected', false);
        $('#mecanicos_disponiveis option:not(:selected)').remove();
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

                    var option = $('<option></option>').val('other').text('Other');
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
        if (marca_id === 'other') {
            marca_other.show();
        } else {
            marca_other.hide();
        }
    });

    $('#modelo_id').change(function() {
        var modelo_id = this.value;
        var modelo_other = $('#modelo_other');
        if (modelo_id === 'other') {
            modelo_other.show();
        } else {
            modelo_other.hide();
        }
    });

    $('#cliente_id').select2();
});
</script><style>
    .clickable-option {
        color: blue;
        cursor: pointer;
        text-decoration: underline;
    }
</style>