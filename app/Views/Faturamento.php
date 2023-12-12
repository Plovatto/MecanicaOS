<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="icon"  type="image/png" href="favicon.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Faturamento</title> <link rel="stylesheet" href="/style/add.css">
</head>
<body>
<!DOCTYPE html>
<html lang="en">
<head>
    <body class="body"> <?php if (!isset($isPdf2) || !$isPdf2): ?><?php else: ?> <div style="display:block;" class="linha"><div class="linha3"> </div>
    <br><br>  <div class="linha1">
  <p><strong>Número da Ordem de Serviço : </strong> <?=$order['codigo']?>  </p> <br>
   <p><strong>Data de Emissão : </strong> <?=$order['data_emissao']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Data de Previsão de Conclusão: </strong><?=$order['data_previsao']?></p>
<p><strong>Nome do Cliente : </strong><?=$order['cliente_nome']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>CPF: </strong><?=$order['cliente_cpf']?></p>
<p><strong>Nome do Mecânico : </strong><?=$order['mecanico_nome']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong> Equipe : </strong><?=$order['equipe_nome']?></p>

 <p><strong> Placa do Veículo : </strong><?=$order['veiculo_placa']?></p>
   <p><strong>Status : </strong><?=$order['veiculo_status']?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Código : </strong><?=$order['veiculo_codigo']?></p>

     <p><strong>Marca e modelo : </strong><?=$order['marca_nome']?>&nbsp;<?=$order['modelo_nome']?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<strong>Ano : </strong><?=$order['veiculo_ano']?></p>

</div></div><?php endif;?><br>
<div class="tabelinha"><div class="table-responsive" style="max-width: 70%; ">    <table class="table" style="border:0.8px solid #000;">
        <thead class="table-dark">

            <tr>
                <th>Nome da Peça</th>
                <th>Preço por Unidade</th>
                <th>Quantidade</th>
                <th  style="border-right: 1px solid #000;">Preço Total</th>
                <th >Nome do Serviço</th>

                <th>Preço do Serviço</th>
            </tr>
        </thead>
        <tbody>
        <?php
$totalPecas = 0;
$totalServicos = 0;
$maxRows = max(count($pecas), count($servicos));
for ($i = 0; $i < $maxRows; $i++):
    $peca = $pecas[$i] ?? null;
    $servico = $servicos[$i] ?? null;
    $precoTotalPeca = $peca ? $peca['peca_valor'] * $peca['quantidade'] : 0;
    if ($peca) {
        $totalPecas += $precoTotalPeca;
    }
    if ($servico) {
        $totalServicos += $servico['servico_valor'];
    }
    ?>
		              <tr>
		    <td><?=$peca['nome'] ?? ''?></td>
		    <td><?=$peca['peca_valor'] ?? ''?></td>
		    <td><?=$peca['quantidade'] ?? ''?></td>
		    <td style="border-right: 1px solid #000;"><?=$precoTotalPeca?></td>
		    <td ><?=$servico['nome'] ?? ''?></td>
		    <td><?=$servico['servico_valor'] ?? ''?></td>
		</tr>
		            <?php endfor;?>
            <tr style="border-bottom: 2px solid #000;">

    <td colspan="3">Total R$</td>
    <td style="border-right: 1px solid #000; padding-right: 10px;"><?=$totalPecas?></td>
    <td>Total R$</td>
    <td><?=$totalServicos?></td>
</tr>
            <tr>
                <td colspan="6">Fatura Total R$ <?=$totalPecas + $totalServicos?></td>
            </tr>
        </tbody>
    </table>
</div></div><?php if (!isset($isPdf) || !$isPdf): ?>
    <div class="text">
<button><a href="/gerarPdf/<?=$order['id']?>">Imprimir em PDF</a></button>
<a href="/detalhesOS/<?=$order['id']?>">Voltar</a>
    <a href="/orders">Home</a><?php endif;?></div>
</body>
</html>
