<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

<head><link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/css/bootstrap-multiselect.css">

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-multiselect/0.9.15/js/bootstrap-multiselect.min.js"></script>

</head>
<body>
<form method="post" action="/os/editar/<?=$order['id']?>">
   <br><br>
<label for="placa">Placa do Veículo:</label><br>
        <input type="text" name="placa" id="placa" >
        <button type="button" onclick="searchVeiculo()">Pesquisar Veículo</button>
      <br><br><p id="error_message" style="color: red;"></p>
        <button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#clienteDetails" aria-expanded="false" aria-controls="clienteDetails" style="display: none;" id="btnClienteDetails">
        <span id="btn_cliente_nome"></span>
</button><br>
<?php if (session()->getFlashdata('error')): ?>
    <div class="alert alert-danger">
        <?=session()->getFlashdata('error')?>
    </div>
<?php endif;?>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#clienteDetails" aria-expanded="false" aria-controls="clienteDetails" id="btnClienteDetails2">
<?=$order['cliente_nome']?>
</button><div class="collapse" id="clienteDetails">
<div class="card card-body">
<p>Cliente: <?=$order['cliente_nome']?></p>
<p>Cliente: <?=$order['cliente_endereco']?></p>
<p>Cliente: <?=$order['cliente_email']?></p>
<p>Cliente: <?=$order['cliente_status']?></p>
<p>Cliente: <?=$order['cliente_cpf']?></p>
<p>Cliente: <?=$order['cliente_cnh']?></p>
<p>Cliente: <?=$order['cliente_telefone']?></p>
</div>
</div>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#veiculoDetails" aria-expanded="false" aria-controls="veiculoDetails"  id="btnVeiculoDetails2">
<?=$order['veiculo_placa']?>
</button><br>
<div class="collapse" id="veiculoDetails">
  <div class="card card-body">
<p>Veículo: <?=$order['veiculo_placa']?></p>
<p>Veículo: <?=$order['veiculo_marca']?></p>
<p>Veículo: <?=$order['veiculo_modelo']?></p>
<p>Veículo: <?=$order['veiculo_cor']?></p>
<p>Veículo: <?=$order['veiculo_ano']?></p>
<p>Veículo: <?=$order['veiculo_descricao']?></p>
<p>Veículo: <?=$order['veiculo_status']?></p>
</div>
</div>

<div class="collapse" id="clienteDetails">
  <div class="card card-body">
  <p><strong>Nome:</strong> <span id="cliente_nome"></span></p>
    <p><strong>Endereço:</strong> <span id="cliente_endereco"></span></p>
    <p><strong>Email:</strong> <span id="cliente_email"></span></p>
    <p><strong>Status:</strong> <span id="cliente_status"></span></p>
    <p><strong>CPF:</strong> <span id="cliente_cpf"></span></p>
    <p><strong>CNH:</strong> <span id="cliente_cnh"></span></p>
    <p><strong>Telefone:</strong> <span id="cliente_telefone"></span></p>
  </div>
</div><br>
<button class="btn btn-primary" type="button" data-toggle="collapse" data-target="#veiculoDetails" aria-expanded="false" aria-controls="veiculoDetails" style="display: none;" id="btnVeiculoDetails">
<span id="btn_veiculo_placa"></span>
</button><br>
<div class="collapse" id="veiculoDetails">
  <div class="card card-body">
  <p><strong>Placa:</strong> <span id="veiculo_placa"></span></p>
    <p><strong>Marca:</strong> <span id="veiculo_marca"></span></p>
    <p><strong>Modelo:</strong> <span id="veiculo_modelo"></span></p>
    <p><strong>Cor:</strong> <span id="veiculo_cor"></span></p>
    <p><strong>Ano:</strong> <span id="veiculo_ano"></span></p>
    <p><strong>Descrição:</strong> <span id="veiculo_descricao"></span></p>
    <p><strong>Status:</strong> <span id="veiculo_status"></span></p>
  </div>
</div>
<br>
<input type="text" name="defeito" value="<?=$order['defeito']?>" required><br>
    <input type="text" name="solucao" value="<?=$order['solucao']?>" required><br>
    <input type="text" name="detalhes" value="<?=$order['detalhes']?>" required><br>
    <input type="date" name="data_previsao" value="<?=$order['data_previsao']?>" required><br>
    <input type="hidden" type="date" name="data_emissao" value="<?=$order['data_emissao']?>" required><br>
    <input type="hidden" type="text" name="valor_servicos" id="valor_servicos2" value="<?=$order['valor_servicos']?>" required>
    <input type="hidden"  name="cliente_id" value="<?=$order['cliente_id']?>" id="cliente_id">
    <input type="hidden"   name="veiculo_id" id="veiculo_id" value="<?=$order['veiculo_id']?>" >
    <input type="hidden"   id="valor_pecas" type="text" name="valor_pecas" value="<?=$order['valor_pecas']?>" required>
    <input type="hidden"  id="quantidade_peca" name="quantidade_peca" min="1">
    <input type="hidden" name="peca_codigo[]" id="peca_codigo_hidden"  required>
    <label for="data_previsao">Data de Previsão de Conclusão:</label><br>

<input type="hidden" id="selected_services_ids" name="servico_codigo[]"required>



    <br>
<label for="equipe_codigo">Equipe:</label><br>

<select name="equipe_codigo" id="equipe_codigo" required>
    <?php foreach ($equipes as $equipe): ?>
        <option disable >Selecione uma equipe</option>

        <option value="<?=$equipe['id']?>" <?=$order['equipe_id'] == $equipe['id'] ? 'selected' : ''?>><?=esc($equipe['nome'])?></option>  <?php endforeach;?>


    </select>

<br><br>
<label>Serviços</label><br>
    <select id="servico_codigo" name="servico_codigo[]" multiple="multiple" required>
<?php foreach ($servicos as $servico): ?>
    <option value="<?=$servico['id']?>" <?=in_array($servico['id'], $selectedServiçosIds) ? 'selected' : ''?> data-price="<?=$servico['valor']?>"><?=esc($servico['nome'])?> </option>
<?php endforeach;?>
</select>
<p id="valor_servicos"></p>



<br><label for="peca_codigo">Peças:</label><br>
<select id="peca_codigo" name="peca_codigo[]" multiple="multiple" required>
<?php foreach ($pecas as $peca): ?>
    <?php
$quantity = 0;
foreach ($selectedPecas as $selectedPeca) {
    if ($selectedPeca['peca_id'] == $peca['id']) {
        $quantity = $selectedPeca['quantidade'];
        break;
    }
}
?>
    <option value="<?=$peca['id']?>" <?=in_array($peca['id'], $selectedPecaIds) ? 'selected' : ''?> data-quantity="<?=$quantity?>" data-price="<?=$peca['valor']?>"><?=esc($peca['nome'])?></option>
<?php endforeach;?>
</select>

<br>
<ul id="selected_parts"></ul>
<br>
<p id="quantidade_peca2"></p><br>
<p id="valor_pecas2" ></p><br>
<button type="submit">Editar OS</button>
</form>
<a href="/orders">Home</a>
 <a href="/detalhesOS/<?=$order['id']?>">Voltar</a>
</body>
</html>

<script>
     function getSelectedOptions() {
        var select = document.getElementById('peca_codigo');
        var result = [];
        var options = select && select.options;
        var opt;

        for (var i = 0, iLen = options.length; i < iLen; i++) {
            opt = options[i];

            if (opt.selected) {
                result.push(opt.value || opt.text);
            }
        }
        return result;
    }


    $(document).ready(function () {
    var quantities = {};
    var prices = {};

    $('#peca_codigo').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '400px',
        onChange: function (option, checked) {
            var id = $(option).val();
            var name = $(option).text();
            var price = parseFloat($(option).data('price'));
            console.log('Price for part ' + id + ': ' + price);
            if (checked) {
                prices[id] = price;
                var $input = $('<input>')
                    .attr('type', 'number')
                    .attr('min', '1')
                    .attr('step', '1')
                    .attr('id', 'quantity_' + id)
                    .val('1')
                    .on('input', function () {
                        quantities[id] = parseInt($(this).val());

                        var totalQuantity = 0;
                        var totalValue = 0;
                        for (var partId in quantities) {
                            var quantity = quantities[partId] || 0;
                            totalQuantity += quantity;
                            totalValue += quantity * prices[partId];
                        }

                        $('#valor_pecas2').text('Valor total de peças: ' + totalValue.toFixed(2));
                        $('#valor_pecas').val(totalValue.toFixed(2));
                        $('#quantidade_peca').val(JSON.stringify(quantities));
                        $('#quantidade_peca2').text('Quantidade total: ' + totalQuantity);

                        // Show fields
                        $('#valor_pecas2').show();
                        $('#quantidade_peca2').show();
                    }).trigger('input');

                var $li = $('<li>')
                    .attr('id', 'part_' + id)
                    .text(name)
                    .append($input);

                $('#selected_parts').append($li);
            } else {
                delete prices[id];
                delete quantities[id];
                $('#part_' + id).remove();

                if (Object.keys(quantities).length === 0) {
                    $('#valor_pecas2').hide();
                    $('#quantidade_peca2').hide();
                }
            }
        }
    });
});

$(document).ready(function () {
    $('#placa').on('input', function () {
        $('#btnClienteDetails2').css('display', 'none');
        $('#btnVeiculoDetails2').css('display', 'none');
    });
});
$(document).ready(function () {
    var prices = {};

    $('#servico_codigo').multiselect({
        enableFiltering: true,
        enableCaseInsensitiveFiltering: true,
        buttonWidth: '400px',
        onChange: function (option, checked) {
            var id = $(option).val();
            var price = parseFloat($(option).data('price'));
            console.log('Price for service ' + id + ': ' + price);
            if (checked) {
                prices[id] = price;
                var totalValue = 0;
                for (var serviceId in prices) {
                    totalValue += prices[serviceId];
                }

                $('#valor_servicos').text('Valor total de serviços: ' + totalValue.toFixed(2));
                $('#valor_servicos').val(totalValue.toFixed(2));

                $('#valor_servicos').show();
            } else {
                delete prices[id];

                if (Object.keys(prices).length === 0) {
                    $('#valor_servicos').hide();
                }
            }
        }
    });

    document.querySelectorAll('input').forEach(function (input) {
        input.addEventListener('input', displayFormData);
    });
});
    function searchVeiculo() {
        var placa = document.getElementById('placa').value;

        var timeoutId = setTimeout(function() {
        var errorMessageElement = document.getElementById('error_message');
        errorMessageElement.innerText = 'A pesquisa está demorando muito. Por favor, tente novamente mais tarde.';
        setTimeout(function() {
            errorMessageElement.innerText = '';
        }, 4000);
    }, 6000);


        $.ajax({
            url: '/searchVeiculo',
            method: 'POST',
            data: { placa: placa },
            dataType: 'json',
            success: function (response) {
                clearTimeout(timeoutId);
            console.log('Resposta recebida:', response);
            if (response.error) {
                var errorMessageElement = document.getElementById('error_message');
                errorMessageElement.innerText = response.error;
                setTimeout(function() {
                    errorMessageElement.innerText = '';
                }, 2000);
            } else {
                document.getElementById('error_message').innerText = '';
            }
                if (response.cliente_id !== undefined && response.veiculo_id !== undefined) {
                    document.getElementById('cliente_id').value = response.cliente_id;
                    document.getElementById('veiculo_id').value = response.veiculo_id;

                    document.getElementById('btn_cliente_nome').innerText = response.cliente.nome_completo;
                    document.getElementById('btn_veiculo_placa').innerText = response.veiculo.placa;
                    document.getElementById('cliente_nome').innerText = response.cliente.nome_completo;
                    document.getElementById('cliente_endereco').innerText = response.cliente.endereco;
                    document.getElementById('cliente_email').innerText = response.cliente.email;
                    document.getElementById('cliente_status').innerText = response.cliente.status;
                    document.getElementById('cliente_cpf').innerText = response.cliente.cpf;
                    document.getElementById('cliente_cnh').innerText = response.cliente.cnh;
                    document.getElementById('cliente_telefone').innerText = response.cliente.telefone;

                    document.getElementById('veiculo_placa').innerText = response.veiculo.placa;
                    document.getElementById('veiculo_marca').innerText = response.veiculo.marca_nome;
                    document.getElementById('veiculo_modelo').innerText = response.veiculo.modelo_nome;
                    document.getElementById('veiculo_cor').innerText = response.veiculo.cor;
                    document.getElementById('veiculo_ano').innerText = response.veiculo.ano;
                    document.getElementById('veiculo_descricao').innerText = response.veiculo.descricao;
                    document.getElementById('veiculo_status').innerText = response.veiculo.status;

                    $('#btnClienteDetails').show();
                    $('#btnVeiculoDetails').show();
                } else {
                    console.error('Valores de cliente_id ou veiculo_id estão indefinidos na resposta.');
                }
            },
            error: function (error) {
            clearTimeout(timeoutId);
            var errorMessageElement = document.getElementById('error_message');
            errorMessageElement.innerText = 'Ocorreu um erro na pesquisa.';
            setTimeout(function() {
                errorMessageElement.innerText = '';
            }, 2000);
        }
    });
    }
</script>