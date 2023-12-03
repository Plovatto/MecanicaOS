<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/style/style.css">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" rel="stylesheet">
    <title>Lista de Ordens de Serviço</title>
</head>

<body class="body2">
    <div class="alinhar">
        <select>
            <option disabled selected>Cadastros</option>
            <option value="Ver" data-url="/Ver?tipo=cliente">Ver clientes</option>
            <option value="Ver" data-url="/Ver?tipo=veiculo">Ver veículos</option>
            <option value="Ver" data-url="/Ver?tipo=os">Ver OS</option>
            <option value="Ver" data-url="/Ver?tipo=mecanico">Ver mecânicos</option>
            <option value="Ver" data-url="/Ver?tipo=servico">Ver serviços</option>
            <option value="Ver" data-url="/Ver?tipo=peca">Ver peças</option>
            <option value="Ver" data-url="/Ver?tipo=equipe">Ver equipes</option>
            <option value="Ver" data-url="/Ver?tipo=admin">Ver Administrador</option>
        </select>
        <a href="/perfil">Perfil</a>
        <a href="/orders">home</a>
        <h1>Lista de Ordens de Serviço</h1>

        <?php if ($userType === 'mecanico' || $userType === 'admin'): ?>
            <a href="<?= site_url('adicionar/cliente') ?>"><button>Adicionar cliente</button></a>
            <a href="<?= site_url('adicionar/veiculo') ?>"><button>Adicionar veículo</button></a>
            <a href="<?= site_url('adicionarOS') ?>"><button>Adicionar OS</button></a>
        <?php endif; ?>
        
        <?php if ($userType === 'admin'): ?>
            <a href="<?= site_url('adicionar/mecanico') ?>"><button>Adicionar mecânico</button></a>
            <a href="<?= site_url('adicionar/servico') ?>"><button>Adicionar serviço</button></a>
            <a href="<?= site_url('adicionar/peca') ?>"><button>Adicionar peça</button></a>
            <a href="<?= site_url('adicionar/equipe') ?>"><button>Adicionar equipe</button></a>
        <?php endif; ?>

       
        <form id="searchForm" method="get">
    <input type="text" name="codigo" placeholder="Pesquisar por código">
    <select name="cliente_nome" onchange="this.form.submit()">
        <option value="">Filtrar por cliente</option>
        <?php foreach ($clientes as $cliente): ?>
            <option value="<?= $cliente->nome_completo ?>"><?= $cliente->nome_completo ?></option>
        <?php endforeach; ?>
    </select>
    <select name="veiculo_placa" onchange="this.form.submit()">
        <option value="">Filtrar por placa do veículo</option>
        <?php foreach ($veiculos as $veiculo): ?>
            <option value="<?= $veiculo->placa ?>"><?= $veiculo->placa ?></option>
        <?php endforeach; ?>
    </select>
    <input type="date" name="data_previsao" placeholder="Pesquisar por data de previsão" oninput="this.form.submit()">
    <button type="reset" onclick="this.form.submit()">Limpar pesquisa</button>

</form>
        <?php if ($searchResults): ?>
            <div class="row m-0">
                <?php foreach ($orders as $order): ?>
                <div class="col-12 col-sm-6 col-md-4 col-lg-2 col-xl-2 m-0 p-0 custom-col">
        <div class="orders">
            <a href="/detalhesOS/<?=$order['id']?>"><div class=" m-0 <?= $order['situacao'] == 'concluído' ? 'border-green' : 'border-red' ?>">
            <div class=" m-0 <?= $order['situacao'] == 'concluído' ? 'bolinha-green' : 'bolinha-red' ?>"></div>
            
            <br>
                   <p> N° <?=$order['codigo']?></p>
                   <p>Previsão  <?=$order['data_previsao']?></p>
                   <p> N° <?=$order['veiculo_placa']?></p>
                   <p>Cliente: <?=$order['cliente_nome']?></p>
            </div> </a>
        </div>
    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <?php if (!$searchPerformed): ?>
            <div class="row m-0">
                <?php foreach ($orders as $order): ?>
      <div class="col-12 col-sm-6 col-md-4 col-lg-2 col-xl-2 m-0 p-0 custom-col">
        <div class="orders">
            <a href="/detalhesOS/<?=$order['id']?>"><div class=" m-0 <?= $order['situacao'] == 'concluído' ? 'border-green' : 'border-red' ?>">
            <div class=" m-0 <?= $order['situacao'] == 'concluído' ? 'bolinha-green' : 'bolinha-red' ?>"></div>
            
            <br>
                   <p> N° <?=$order['codigo']?></p>
                   <p>Previsão  <?=$order['data_previsao']?></p>
                   <p> N° <?=$order['veiculo_placa']?></p>
                   <p>Cliente: <?=$order['cliente_nome']?></p>
            </div> </a>
        </div>
    </div>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>
        
    </div><?php endif; ?>
 
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
</body>

</html>
