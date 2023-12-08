
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link rel="stylesheet" href="/style/redefinir.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
    <link rel="stylesheet" href="/style/redefinir.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">  <title>Login</title>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
<script>
    function hideErrors() {
        var errorDivs = document.querySelectorAll('.alert.alert-danger');
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

    <form   id="myForm" method="post">
        <label for="password">Redefinir senha:</label><br><br>
        <div class="password-container">
    <input type="password" placeholder="Nova senha" name="password" id="password">
    <button type="button" id="togglePassword" class="eye-button">
    <span class="material-icons" id="eyeIcon">
        visibility_off
    </span>
</button>
</div><br>
<div class="password-container">
    
    <input type="password" placeholder="Confirme a senha" name="confirm_password" id="confirm_password">
    <button type="button" id="togglePassword2" class="eye-button">
    <span class="material-icons" id="eyeIcon2">
        visibility_off
    </span>
</button>
</div><br>
       <?php if (session()->has('error')): ?>
    <div class="alert alert-danger m-0">
        <?=session('error')?>
    </div>
    <?php session()->remove('error');?>
<?php endif;?><br>
        <input type="submit" value="Redefinir">
    </form>
</div>




</body>
</html>
<script>
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
document.getElementById('togglePassword2').addEventListener('click', function () {
    var passwordInput = document.getElementById('confirm_password');
    var eyeIcon = document.getElementById('eyeIcon2');
    var type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordInput.setAttribute('type', type);

   
    if (type === 'text') {
        eyeIcon.textContent = 'visibility';
    } else {
        eyeIcon.textContent = 'visibility_off';
    }
});
</script>