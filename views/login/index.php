<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/login.css">
</head>

<body>
    <img src="<?php echo constant('URL'); ?>public/img/login-photos/IMG_20220201_130337.jpg" alt="fotomedia" class="mediaphoto">
    <div class="login-container">
        <div class="login-main">
            <form action="<?php echo constant('URL'); ?>login/authenticate" method="POST">
                <img src="<?php echo constant('URL'); ?>public/img/login-photos/LogoMedia.png" alt="logo">
                <h2>BIENVENIDO</h2>
                <?php $this->showMessages(); ?>
                <div class="input-div one">
                    <div class="i">
                        <i class="fas fa-user"></i>
                    </div>
                    <div>
                        <h5>Usuario</h5>
                        <input type="text" class="input" name="username" id="username" autocomplete="off">
                    </div>
                </div>
                <div class="input-div two">
                    <div class="i">
                        <i class="fas fa-lock"></i>
                    </div>
                    <div>
                        <h5>Contraseña</h5>
                        <input type="password" class="input" name="password" id="password" autocomplete="off">
                    </div>
                </div>
                <input type="submit" class="btn" value="Log In" />
                <a href="<?php echo constant('URL'); ?>signup">Crear nuevo usuario</a>
            </form>
        </div>
    </div>
    <script type="text/javascript" src="<?php echo constant('URL'); ?>public/js/login.js"></script>
</body>

</html>