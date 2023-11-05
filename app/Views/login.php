<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <script>

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
<body onload="hideErrors();">
    <h1>Login</h1>

    <?php if (!empty($emailError)): ?>
        <div class="alert alert-danger">
            <?=$emailError?>
        </div>
    <?php endif;?>

    <?php if (!empty($passwordError)): ?>
        <div class="alert alert-danger">
            <?=$passwordError?>
        </div>
    <?php endif;?>

    <?php if (!empty($loginError)): ?>
        <div class="alert alert-danger">
            <?=$loginError?>
        </div>
    <?php endif;?>

    <form method="post" action="/">

        <label for="email">Email:</label>
        <input type="text" name="email" id="email">

        <label for="password">Senha:</label>
        <input type="password" name="password" id="password">

        <button type="submit">Login</button>
    </form>
</body>
</html>
