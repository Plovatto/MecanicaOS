<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/home.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  <title>Login</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function hideErrors() {
        var errorDivs = document.querySelectorAll('.alert.alert-success');
        errorDivs.forEach(function(errorDiv) {
            setTimeout(function() {
                errorDiv.style.display = 'none';
            }, 2000);
        });
    }

    window.onload = hideErrors;
</script>
    <title>Home</title>
</head>

<body class="body2">
<nav class="navba bg-body-tertiary">
  <div class="container-fluid"> <div class="left">    <a class="home" href="/orders">home</a>  <select class="cadastros">
            <option class="option" disabled selected>Cadastros</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=graficos"> Ver gráficos</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=cliente"> Ver clientes</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=veiculo"> Ver veículos</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=os"> Ver OS</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=mecanico"> Ver mecânicos</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=servico"> Ver serviços</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=peca"> Ver peças</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=equipe"> Ver equipes</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=especialidade"> Ver especialidades</option>
            <option class="option" value="Ver" data-url="/Ver?tipo=admin"> Ver Administradores</option>
        </select>
        <a class="perfil" href="/perfil">Perfil</a>
      </div>
  </div>
</nav>
    <div class="alinhar">

       <br>
<div class="alinhacenter">
        <?php if ($userType === 'mecanico' || $userType === 'admin'): ?>
            <a href="<?=site_url('adicionar/cliente')?>"><button class="buttonzin">Adicionar cliente</button></a>
            <a href="<?=site_url('adicionar/veiculo')?>"><button class="buttonzin">Adicionar veículo</button></a>
            <a href="<?=site_url('adicionarOS')?>"><button class="buttonzin">Adicionar OS</button></a>
        <?php endif;?>

        <?php if ($userType === 'admin'): ?>
            <a href="<?=site_url('adicionar/mecanico')?>"><button class="buttonzin">Adicionar mecânico</button></a>
            <a href="<?=site_url('adicionar/servico')?>"><button class="buttonzin"> Adicionar serviço</button></a>
            <a href="<?=site_url('adicionar/peca')?>"><button class="buttonzin">Adicionar peça</button></a>
            <a href="<?=site_url('adicionar/equipe')?>"><button class="buttonzin">Adicionar equipe</button></a>
            <a href="<?=site_url('adicionar/especialidade')?>"><button class="buttonzin">Adicionar especialidade</button></a>
        <?php endif;?>
</div>
       <div class="alinhacenter2">
        <form id="searchForm" method="get">
    <input type="text" name="codigo" class="pesquisa"  onblur="this.form.submit()" placeholder="Pesquisar por código">

    <select  class="filtro" name="cliente_nome" onchange="this.form.submit()">
        <option  value="">Pesquisar cliente</option>
        <?php foreach ($clientes as $cliente): ?>
            <option value="<?=$cliente->nome_completo?>"><?=$cliente->nome_completo?></option>
        <?php endforeach;?>
    </select>
    <select class="filtro"  name="veiculo_placa" onchange="this.form.submit()">
        <option value="">Pesquisar veículo</option>
        <?php foreach ($veiculos as $veiculo): ?>
            <option value="<?=$veiculo->placa?>"><?=$veiculo->placa?></option>
        <?php endforeach;?>
    </select>
    <input class="filtro" type="date" name="data_previsao" placeholder="Pesquisar data de previsão" oninput="this.form.submit()">
    <button class="filtro2"  type="reset" onclick="this.form.submit()">Limpar pesquisa</button>

</form></div><br><br>  <?php
if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?=session()->getFlashdata('success')?>
    </div>
<?php endif;?><div class="alinhacenter3">
        <?php if ($searchResults): ?>
            <div class="row m-0">
                <?php foreach ($orders as $order): ?>
                <div class="col-8 col-sm-5 col-md-4 col-lg-4 col-xl-3 col-xxl-2 m-0 p-0 d-flex justify-content-center">
        <div class="orders">
            <a class="a" href="/detalhesOS/<?=$order['id']?>"><div class=" m-0 <?=$order['situacao'] == 'concluído' ? 'border-green' : 'border-red'?>">
            <div class=" m-0 <?=$order['situacao'] == 'concluído' ? 'bolinha-green' : 'bolinha-red'?>"></div>

            <br>
                   <p> N° <?=$order['codigo']?></p>
                   <p>Previsão  <?=$order['data_previsao']?></p>
                   <p> N° <?=$order['veiculo_placa']?></p>
                   <p>Cliente: <?=$order['cliente_nome']?></p>
            </div> </a>
        </div>
    </div>
                <?php endforeach;?>
            </div>
        <?php else: ?>
            <?php if (!$searchPerformed): ?>
            <div class="row m-0 custom-row ">
                <?php foreach ($orders as $order): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-2 col-xl-2 m-0 p-0 d-flex justify-content-center custom-col">
        <div class="orders">
            <a  class="a"  href="/detalhesOS/<?=$order['id']?>"><div class=" m-0 <?=$order['situacao'] == 'concluído' ? 'border-green' : 'border-red'?>">
            <div class=" m-0 <?=$order['situacao'] == 'concluído' ? 'bolinha-green' : 'bolinha-red'?>"></div>

            <br>
                   <p> N° <?=$order['codigo']?></p>
                   <p>Previsão  <?=$order['data_previsao']?></p>
                   <p> N° <?=$order['veiculo_placa']?></p>
                   <p>Cliente: <?=$order['cliente_nome']?></p>
            </div> </a>
        </div>
    </div>
                <?php endforeach;?>
            </div>
        <?php endif;?>

    </div><?php endif;?></div>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="/path/to/your/script.js"></script>

    <script>
        $(document).ready(function () {
            $('select').change(function () {
                var selectedOption = $(this).find('option:selected');
                var url = selectedOption.data('url');
                if (url) {
                    window.location.href = url;
                }
            });
        });


    </script>
    <br>
    <br>
</body>

</html>