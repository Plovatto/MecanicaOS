<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="/style/home.css"><link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  <title>Login</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>  <script>

        function hideErrors() {
            var errorDivs = document.querySelectorAll('.alert.alert-danger');
            errorDivs.forEach(function(errorDiv) {
                setTimeout(function() {
                    errorDiv.style.display = 'none';
                }, 4000);
            });
        }
    </script>
</head>
<body class="body" onload="hideErrors();">


    <div class="aling">
<div class="form">

<img src="/imagens/icon.svg">
    <form method="post" action="/">
<h2>Login</h2>

        <input type="text" placeholder="Email" name="email" class="mt-3" id="email">
<br>
      <br>
        <input type="password" placeholder="Senha"  name="password" id="password">
<br><br>

 <?php if (!empty($emailError)): ?>
        <div class="alert alert-danger m-0">
            <?=$emailError?>
        </div>
    <?php endif;?>

    <?php if (!empty($passwordError)): ?>
        <div class="alert alert-danger m-0">
            <?=$passwordError?>
        </div>
    <?php endif;?>

    <?php if (!empty($loginError)): ?>
        <div class="alert alert-danger m-0">
            <?=$loginError?>
        </div>
    <?php endif;?>

        <button class="btn" type="submit">Entrar</button>

    </form><br><div class="text"> Esqueceu a senha? <a href="/user/forgot-password">Clique aqui</a></div></div>
    <br>
   </div>
</body>
</html>
