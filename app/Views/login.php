<!DOCTYPE html>
<html>
<head><meta name="viewport" content="width=device-width, initial-scale=1">.
<link rel="icon"  type="image/png" href="favicon.ico">
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
        <div class="row justify-content-center no-gutters animate__animated animate__fadeIn">
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
</div><br><div class="text animate__animated animate__backInDown " > Esqueceu a senha? <a href="/user/forgotpassword">Clique aqui</a></div> <div class="reg">
                        </form>  <div class="loader" id="spinner" style="display: none;"></div></div>
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