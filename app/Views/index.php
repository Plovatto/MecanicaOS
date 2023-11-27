<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Ordens de Serviço</title>
</head>
<body>
<select>
    <option disable>Cadastros</option>
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
        <a href="<?=site_url('adicionar/cliente')?>"><button>Adicionar cliente</button></a>

        <a href="<?=site_url('adicionar/veiculo')?>"><button>Adicionar veículo</button></a>
    <a href="<?=site_url('adicionarOS')?>"><button>Adicionar OS</button></a>
<?php endif;?>
    <?php if ($userType === 'admin'): ?>

    <a href="<?=site_url('adicionar/mecanico')?>"><button>Adicionar mecânico</button></a>
    <a href="<?=site_url('adicionar/servico')?>"><button>Adicionar serviço</button></a>
    <a  href="<?=site_url('adicionar/peca')?>"><button>Adicionar peça</button></a>
    <a href="<?=site_url('adicionar/equipe')?>"><button>Adicionar equipe</button></a><?php endif;?>

<ul>
    <?php foreach ($orders as $order): ?>
        <li>
            <a href="/detalhesOS/<?=$order['id']?>">
                OS #<?=$order['id']?>
            </a>
        </li>
    <?php endforeach;?>
</ul>

</body>
</html>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
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
