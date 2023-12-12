<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Redefinir senha</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/css-spinners/1.1.2/load1.min.css"/>

    <link rel="stylesheet" href="/style/redefinir.css">
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
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card p-4 animate__animated animate__fadeInDown">
                    <div class="card-body"><div class="card-body d-flex justify-content-center align-items-center"><img  src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAEAAAABACAYAAACqaXHeAAAACXBIWXMAAAsTAAALEwEAmpwYAAAFaElEQVR4nO1aa2wUVRQeUBPURNsYjJJGje3CD8E/Teqjc3cboRKonamVuWfTrUHTCtIXdEZq6wxOTTQBEpVCGomJBCHUVDHgD1qNCoQmhvIw2irdQkNV3t3ZdksDu/joNXeZrdu623a3s7vtdr7k+zV39pzz3XPOPTM7DGPCRNyQuWbNXdkAKxDG7yOMj7AYX0YANxDAMMK4nwXoZAGaEUCFDeAxJlnACsJ8hPF7CKAPAZBJcpgFOEwFY2YsVHWuFWA9wnhwVHAY/4MwPsli/CUC2I4AtrAAuxHGrQjja2PFYDH+ngVYyEw3uN1DiwcGBlJCXVtaUPAAi/E3owIBOIEwLn2muPjBsD+qqnNZjLNZgA/18gjcO2QFKGKmC9xuD9a0QeJyeX4Ze83mcKSxGJ8J2vEeFkBgGGZOJDaetdsXIICP/RmjlwUC2MhMB7jdHkEXoDPEzo8EzwIcynI47puKLRbjApoBQSVRFm4tJyl2XpJdvKj8+qJUt5iJJdzuoSf6+/vvH5O+I2nPAnwkCMIdRthi7fYnA02UBfgLYWwNtY6TlD5eUgglJ8rNTDxhpQ0vaOeNCj4AGjQCuKXb+D23uPjesWs4ST4TJEAjE+ejbjBQ81NN+3CgM0JQb3l37HWa9nTnafB5tbWpsfAhJPRzPrD7tOHFBDSr6MCk27rOFhXFJshHOkiqpdtXaOn2Pj6ZCS+oPk9E2u0jBbLb80bEtturDDfw8CVyj8Xp67F0+4jF6fUu6rq1ZLz1VoxXBqVlKRN7zGExvqAL/oPhv57e9WemP3idC50+cbz1/tlen/BsgvCQ4Q6FsgnQqAvwt43nQw5jUSPtD3K3xek7p2fAzYkyAAEc1TPgFBMnZGOcP1IGgmAz3MCjvSSF9oBFXd4Jn8oQwEV9N/YzcYJVEJYEjdklTCKBAG7qJdAQL5t04gwSYFLjsaYNPu1yeTRNG2wy1Bn0nyP1TPwwJ2g0Vidzg6Z5Kuj4rmmevmQQgInUbm8vmedyeco0zZOVUEdmut3/wRQAzAwgZglAkveAvNraVO4NeVkoPrf6VUKZW7JmT7g1seBEdgukTZmGCcBLck7gRcNMIScqR0wBjAJvZoBslgA/Dera7AFSgppgepc3J/gt0Yyg03fUFMAopJsZ4DVLwDKbewBvzgFycs8BnLTpKU6Uy22qOm9WZgAnKtrtm+Ty2SmApDTRLysKqt/KmpUCTASjBajY0kBa206Q3y5cJVevuclPZ3pIY/NBUlijJr8A9Ts/9Qd9+0+K0Ww73UlW1dQnrwCr1c3k0hUtZPABNrV8l7wCfHKgddzgKalAq958JzkFONz+44QCUFZt3ZGkAhyfnACVW7cnpwC7DrYkrAQyzt5Iszi9+zOc3rLENsHL4zfBfYe+nbKdUAJYun0SfUjK6PZeT5gAvKQQdeduciXMMXjsVAd5KUbHoD8Dur1fZDi96xIqAC8ppGxzA2lpayd9fQP0gwVy7vxFsuOzA6Rw49uG2TC0B+TYHSPf5kVCq91Olq+tCOtkZ6fTz4a9n4cOorqO5DhejtguZU6R46xhAmQLAhuNE5RLXymJWoAXqmqisqmzzTABlq2rtOWWrB1+vvR1EgmXv1ZG8jfURi0A5YqyDRHZDDC3ZN0xwwTg16spRvaAADs6uvwCbNsTXoCoKcofGCYABS8qp412ct9XX5PjJ38m5Zu3GS9AtbKSMRK8qJTGIgtiQlE5b1PVOw3/VJ2TlPaEBzcxhw3f/QC4jeoCTpJ7p0GQYcmJci0TSwiVdfM5UW6ZdoFL8kB+tVLMxAs8nQ5FZRcnKj28KHsTtNvXOElp40W5hp5UcQveBJMc+Bf3v4uR9MQiYgAAAABJRU5ErkJggg==">
                    </div>   <h2 class="text-center animate__animated animate__fadeInDown">Esqueceu sua senha?</h2>
<p class="text-center animate__animated animate__fadeInDown">Não se preocupe! Digite seu e-mail abaixo e enviaremos um código para você redefinir sua senha.</p>
                        <form id="myForm" action="/user/send-reset-code" method="post" class="animate__animated animate__fadeInDown">
                            <div class="form-group">
                            <br>
                                <input type="email" placeholder="Email" id="email" name="email" class="form-control" required>
                          
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
                        </form>  <div class="loader" id="spinner" style="display: none;"></div></div>
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
});
</script>
</body>
</html>