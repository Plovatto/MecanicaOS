
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/css-spinners/1.1.2/load1.min.css"/>

    <link rel="stylesheet" href="/style/reset.css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
<div class="container animate__animated animate__fadeIn">
        <div class="row ">
            <div class="col-md-6">
                <div class="card p-4 animate__animated animate__fadeInDown">
                    <div class="card-body"><div class="card-body d-flex justify-content-center align-items-center"><img src="data:image/png;base64,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">
                    </div>  <h2 class="text-center animate__animated animate__fadeInDown">Redefinir Senha</h2>
<p class="text-center animate__animated animate__fadeInDown">Agora você pode criar uma nova senha. Certifique-se de que ela seja forte e única para manter sua conta segura.</p>
                        <form id="myForm" method="post" class="animate__animated animate__fadeInDown">
                            <div class="form-group">
                            <br><br>
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
</div>      
             <br>               </div>
                          
             <?php if (session()->has('error')): ?>
    <div class="alert alert-danger mt-2 animate__animated animate__shakeX">
        <?=session('error')?>
    </div>
    <?php session()->remove('error');?>
<?php endif;?>
<div class="form-group mt-3 d-flex justify-content-center align-items-center">
    <input type="submit" value="Confirmar" class="btn" id="submitBtn">
</div> <div class="reg">
                        </form>  <div class="loader" id="spinner" style="display: none;"><img class="gear-icon" src="data:image/png;base64,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"/></div></div>
                    </div>
                </div>
            </div>        
        </div>
    </div>
    <script>
    
    document.getElementById('submitBtn').addEventListener('click', function() {
    this.style.opacity = '0';
    setTimeout(() => {
        this.style.display = 'none';
        document.getElementById('spinner').style.display = 'block';
    }, 500); 
});document.getElementById('togglePassword').addEventListener('click', function () {
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
</body>
</html><style>.password-container {
    position: relative;
}

.eye-button {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
    border: none;
    background: none;
    cursor: pointer;
}</style>