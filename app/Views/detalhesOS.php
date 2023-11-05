<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalhes da Ordem de Serviço</title>
</head>
<body>
    <h1>Detalhes da Ordem de Serviço</h1>

    <p>Número da OS: <?=$order['codigo']?></p>
    <p>Defeito: <?=$order['defeito']?></p>
    <p>Solução: <?=$order['solucao']?></p>
    <p>Detalhes: <?=$order['detalhes']?></p>
    <p>Data de Emissão: <?=$order['data_emissao']?></p>
    <p>Data de Previsão de Conclusão: <?=$order['data_previsao']?></p>
    <p>Status: <?=$order['status']?></p>
    <p>Nome da Peça: <?=$order['peca_nome']?></p>
    <p>Valor das Peças: <?=$order['valor_pecas']?></p>
    <p>Valor dos Serviços: <?=$order['valor_servicos']?></p>
    <p>Total: <?=$order['total']?></p>
   <br>
   <p>Placa do Veículo: <?=$order['veiculo_placa']?></p>
   <p>Veículo Código: <?=$order['veiculo_descricao']?></p>
   <p>Veículo Código: <?=$order['veiculo_cor']?></p>
   <p>Veículo Código: <?=$order['veiculo_ano']?></p>
   <p>Veículo Código: <?=$order['veiculo_status']?></p>
   <p>Nome da Marca: <?=$order['marca_nome']?></p>
   <p>Nome do Modelo: <?=$order['modelo_nome']?></p>
<br>
    <p>Nome do Cliente: <?=$order['cliente_nome']?></p>
     <p>Cliente Código: <?=$order['cliente_id']?></p>

    <p>Nome da Equipe: <?=$order['equipe_nome']?></p>
    <p>Equipe Código: <?=$order['equipe_id']?></p>
      <p>Mecânico Código: <?=$order['mecanico_id']?></p> <p>Nome do Mecânico: <?=$order['mecanico_nome']?></p>

    <a href="/orders">Voltar</a>
</body>
</html>
