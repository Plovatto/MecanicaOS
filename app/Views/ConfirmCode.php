



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/css-spinners/1.1.2/load1.min.css"/>

    <link rel="stylesheet" href="/style/codigo.css">
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
            }, 3000);
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
                    <div class="card-body"><div class="card-body d-flex justify-content-center align-items-center">
<img src="data:image/png;base64,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">                   
 </div>   <h2 class="text-center animate__animated animate__fadeInDown">Digite o Código</h2>
<p class="text-center animate__animated animate__fadeInDown">Verifique seu e-mail e insira o código de 6 dígitos que enviamos para você. Este código irá permitir que você redefina sua senha.</p>
                        <form id="myForm" action="/user/verify-code" method="post" class="animate__animated animate__fadeInDown">
                            <div class="form-group">
                            <br>
                              
                                <div class="inputContainer">

<div class="codeInputContainer">
  <input type="text" class="otp-input" maxlength="1" name="code1" required>
  <input type="text" class="otp-input" maxlength="1" name="code2" required>
  <input type="text" class="otp-input" maxlength="1" name="code3" required>
  <input type="text" class="otp-input" maxlength="1" name="code4" required>
  <input type="text" class="otp-input" maxlength="1" name="code5" required>
  <input type="text" class="otp-input" maxlength="1" name="code6" required>  
  <input type="hidden" placeholder="Código" id="code" name="code" class="form-control" required>
</div>
</div>
                            </div>
                            <?php if (session()->has('error')): ?>
    <div class="alert alert-danger mt-2 animate__animated animate__shakeX">
        <?=session('error')?>
    </div>
    <?php session()->remove('error');?>
<?php endif;?>
<div class="form-group mt-3 d-flex justify-content-center align-items-center">
    <input type="submit" value="Enviar Código" class="btn" id="submitBtn">
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
}); const otpInputs = document.querySelectorAll('.otp-input');

otpInputs.forEach((input, index) => {
  input.addEventListener('input', () => {
    if (input.value.length === 1 && index < otpInputs.length - 1) {
      otpInputs[index + 1].focus();
    }

    document.getElementById('code').value = Array.from(otpInputs).map(input => input.value).join('');
  });

  input.addEventListener('paste', (e) => {
    e.preventDefault();
    const pastedData = e.clipboardData.getData('text/plain');

    for (let i = 0; i < pastedData.length && index + i < otpInputs.length; i++) {
      otpInputs[index + i].value = pastedData[i];
    }

    if (index + pastedData.length < otpInputs.length) {
      otpInputs[index + pastedData.length].focus();
    }

    // Concatenate all input values and put the result in the hidden input
    document.getElementById('code').value = Array.from(otpInputs).map(input => input.value).join('');
  });
});
</script>
</body>
</html>