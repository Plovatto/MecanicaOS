<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="/style/add.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ver <?=esc($tipo)?></title>
    <link rel="stylesheet" href="/style/ver.css">
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
</head>
<body>

<form id="searchForm" method="get" style="<?=$tipo === 'graficos' ? 'display: none;' : ''?>">
    <input  type="hidden" name="tipo" value="<?=esc($tipo)?>">
    <input  onblur="this.form.submit()" type="text" name="pesquisa" placeholder="Pesquisar" oninput="submitForm()">

    <button type="reset" onclick="this.form.submit()">Limpar pesquisa</button>
</form>
<a href="/orders">Home</a>
<div style="<?=$tipo === 'graficos' ? 'display: none;' : ''?>" class="card">
<?php if ($tipo === 'cliente'): ?>
    <h4>Lista de Clientes</h4>

    <?php foreach ($dados as $cliente): ?>
        <?php if (!$pesquisa || stripos($cliente->nome_completo, $pesquisa) !== false || stripos($cliente->cnh, $pesquisa) !== false): ?>

                <a href="/detalhes/cliente/<?=$cliente->id?>" class="<?=$cliente->status == 'desativado' ? 'desativado' : ''?>">
                    <?=esc($cliente->nome_completo);?>
                <?=esc($cliente->cnh);?></a>


        <?php endif;?>
    <?php endforeach;?>

<?php endif;?>
<?php
if (session()->getFlashdata('success')): ?>
    <div class="alert alert-success">
        <?=session()->getFlashdata('success')?>
    </div>
<?php endif;?>



<?php if ($tipo === 'veiculo'): ?>
        <h4>Veículos</h4>
        <?php foreach ($dados as $veiculo): ?>
            <?php if (!$pesquisa || stripos($veiculo->placa, $pesquisa) !== false || stripos($veiculo->modelo_nome, $pesquisa) !== false || stripos($veiculo->marca_nome, $pesquisa) !== false): ?>

            <a href="/detalhes/veiculo/<?=$veiculo->id?>"class="<?=$veiculo->status == 'desativado' ? 'desativado' : ''?>">
            <?=esc($veiculo->marca_nome);?>
            <?=esc($veiculo->modelo_nome);?>
                     <?=esc($veiculo->placa);?>

                </a>


            <?php endif;?>
         <?php endforeach;?>
    <?php endif;?>



    <?php if ($tipo === 'os'): ?>
    <h4>Ordens de Serviço</h4>
    <?php foreach ($dados as $order): ?>


            <a href="/detalhesOS/<?=$order['id']?>"class="<?=$order['situacao'] == 'concluído' ? 'concluído' : ''?>">
            <?=esc($order['codigo']);?>
            <?=esc($order['data_previsao']);?>
        </a>
    <?php endforeach;?>
<?php endif;?>



<?php if ($tipo === 'mecanico'): ?>
    <h4>Mecânicos</h4>
    <?php foreach ($dados as $user): ?>
        <?php if ($user->tipo === 'mecanico'): ?>
            <a href="/detalhes/mecanico/<?=$user->id?>"class="<?=$user->status == 'desativado' ? 'desativado' : ''?>">
            <?=esc($user->nome_completo);?>
            <?=esc($user->especialidade_nome);?>
        </a><?php endif;?>
    <?php endforeach;?>
<?php endif;?>



    <?php if ($tipo === 'peca'): ?>
    <h4>Peças</h4>
    <?php foreach ($dados as $peca): ?>

                <a href="/detalhes/peca/<?=$peca['id']?>"class="<?=$peca['status'] == 'desativado' ? 'desativado' : ''?>">
        <?=esc($peca['nome']);?>
        <?=esc($peca['valor']);?></a>
    <?php endforeach;?>
<?php endif;?>

<?php if ($tipo === 'especialidade'): ?>
    <h4>Especialidades</h4>
    <?php foreach ($dados as $especialidade): ?>

                <a href="/detalhes/especialidade/<?=$especialidade['id']?>"class="<?=$especialidade['status'] == 'desativado' ? 'desativado' : ''?>">
        <?=esc($especialidade['nome']);?>
        <?=esc($especialidade['codigo']);?></a>
    <?php endforeach;?>
<?php endif;?>

<?php if ($tipo === 'equipe'): ?>
    <h4>Equipes</h4>
    <?php foreach ($dados as $equipe): ?>

                <a href="/detalhes/equipe/<?=$equipe['id']?>"class="<?=$equipe['status'] == 'desativado' ? 'desativado' : ''?>">
                <?=esc($equipe['nome']);?>
                <?=esc($equipe['codigo']);?>
    </a>
    <?php endforeach;?>
<?php endif;?>


<?php if ($tipo === 'admin'): ?>
    <h4>Administradores</h4>
    <?php foreach ($dados as $user): ?>
        <?php if ($user->tipo === 'admin'): ?>

                <a href="/detalhes/admin/<?=$user->id?>">
                <?=esc($user->nome_completo);?>
            <?=esc($user->tipo);?>
        </a>
        <?php endif;?>
    <?php endforeach;?>
<?php endif;?>


       <?php if ($tipo === 'servico'): ?>
        <h4>Serviços</h4>
        <?php foreach ($dados as $servico): ?>
            <a href="/detalhes/servico/<?=$servico['id']?>"class="<?=$servico['status'] == 'desativado' ? 'desativado' : ''?>">
            <?=esc($servico['nome']);?>
        <?=esc($servico['valor']);?>
        </a>
    <?php endforeach;?>
       <?php endif;?>
       </div>



       <?php if ($tipo === 'graficos'): ?><br>
  <H3 style="margin-left:60px;">Estatísticas de utilização</H3><br><br>
        <div style="display: flex; justify-content: space-between;margin-left:60px;">
        <div style="width: 33%;">
            <canvas id="partsChart" style="width: 100%; height: 400px;"></canvas>
        </div>
        <div style="width: 33%;">
            <canvas id="servicesChart" style="width: 100%; height: 400px;"></canvas>
        </div>
        <div style="width: 33%;">
            <canvas id="teamsChart" style="width: 100%; height: 400px;"></canvas>
        </div>
    </div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
var partsData = <?php echo json_encode($partsData); ?>;
var servicesData = <?php echo json_encode($servicesData); ?>;
var teamsData = <?php echo json_encode($teamsData); ?>;



new Chart(document.getElementById('partsChart'), {
    type: 'bar',
    data: {
        labels: partsData.map(function(item) { return item.nome; }),
        datasets: [{
            label: 'Peças',
            data: partsData.map(function(item) { return item.count; }),
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        title: {
            display: true,
            text: 'Distribuição de Peças'
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        },
        hover: {
            mode: 'nearest',
            intersect: true
        },
        scales: {
            xAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Nome da Peça'
                }
            }],
            yAxes: [{
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Quantidade'
                },
                ticks: {
                    beginAtZero: true
                }
            }]
        }
    }
});

new Chart(document.getElementById('servicesChart'), {
    type: 'bar',
    data: {
        labels: servicesData.map(function(item) { return item.nome; }),
        datasets: [{
            label: 'Serviços',
            data: servicesData.map(function(item) { return item.count; }),
            backgroundColor: 'rgba(153, 102, 255, 0.2)',
            borderColor: 'rgba(153, 102, 255, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});

new Chart(document.getElementById('teamsChart'), {
    type: 'bar',
    data: {
        labels: teamsData.map(function(item) { return item.nome; }),
        datasets: [{
            label: 'Equipes',
            data: teamsData.map(function(item) { return item.count; }),
            backgroundColor: 'rgba(255, 159, 64, 0.2)',
            borderColor: 'rgba(255, 159, 64, 1)',
            borderWidth: 1
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>





<?php endif;?>







</body>
</html>
<style>
canvas {
    max-width: 400px;
    max-height: 400px;
}


/style>