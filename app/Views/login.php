<!DOCTYPE html>
<html>
<head><meta name="viewport" content="width=device-width, initial-scale=1">
<link href="https://fonts.googleapis.com/icon?family=Material+Icons"
      rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link rel="stylesheet" href="/style/login.css"><link rel="preconnect" href="https://fonts.googleapis.com">
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
<body class="body animate__animated animate__fadeIn" onload="hideErrors();">
    <div class="container animate__animated animate__fadeIn">
        <div class="row  no-gutters animate__animated animate__fadeIn">
            <div class="col-md-6 animate__animated animate__fadeIn">
                <div class="card p-4 animate__animated animate__backInDown">
                    <div class="card-body animate__animated animate__fadeIn">
                        <div class="card-body d-flex justify-content-center align-items-center animate__animated animate__fadeIn">
<img width="100" src="data:image/png;base64,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">                       
 </div>
                       <h3 class="text-center animate__animated animate__fadeIn">Acesse sua conta</h3>
                        <p class="text-center animate__animated animate__fadeIn" data-aos="fade-up" data-aos-duration="1000">Bem-vindo de volta! Por favor, insira suas credenciais para acessar sua conta.</p>
                        <form method="post" action="/" class="animate__animated animate__fadeIn" data-aos="fade-up" data-aos-duration="1500">
                            <div class="form-group animate__animated animate__fadeIn" data-aos="fade-up" data-aos-duration="2000">
                               
                            <br>
        <input type="email" placeholder="Email" name="email" class="mt-3" id="email">
<br>
      <div class="password-container">
    <input type="password" placeholder="Senha" name="password" id="password">
    <button  type="button" id="togglePassword" class="eye-button" >
    <span class="material-icons" id="eyeIcon">
        visibility_off
    </span>
</button>
</div>  </div>
<br>

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

    <div class="form-group mt-3 d-flex justify-content-center align-items-center">
    <input type="submit" value="Entrar" class="btn animate__animated animate__fadeIn" id="submitBtn" data-aos="fade-up" data-aos-duration="1500">
</div><br><div class="text animate__animated animate__backInDown " > Esqueceu a senha? <a href="/user/forgot-password">Clique aqui</a></div> <div class="reg">
                        </form>   <div class="loader" id="spinner" style="display: none;"><img class="gear-icon" src="data:image/png;base64,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"/></div></div>
                    </div>
                </div>
            </div>        
        </div>
    </div>

   
 
</body>
</html>
<script> AOS.init();
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
}); document.getElementById('submitBtn').addEventListener('click', function() {
    this.style.opacity = '0';
    setTimeout(() => {
        this.style.display = 'none';
        document.getElementById('spinner').style.display = 'block';
    }, 500); 
});
</script><style>.password-container {
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