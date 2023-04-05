<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/default.css">
<link rel="stylesheet" href="<?php echo constant('URL'); ?>public/css/dashboard.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@600&family=Roboto:wght@100;300;400;700&display=swap" rel="stylesheet">
    
<div id="header">
    <ul class="header-left">
        <li>
            <img class="logo" src="<?php echo constant('URL'); ?>public/img/login-photos/LogoMedia2.png" alt="logo">
        </li>
        <li><a href="<?php echo constant('URL');?>dashboard">Inicio</a></li>
        <li><a href="<?php echo constant('URL');?>expenses">Historial</a></li>
    </ul>
    <div id="profile-container">
        <a href="<?php echo constant('URL');?>user">
            <div class="name"><?php echo $user->getName(); ?></div>
            <div class="photo">
                <?php if($user->getPhoto() == ''){?>
                    <i class="material-icons">account_circle</i>
                <?php }else{ ?> 
                    <img src="<?php echo constant('URL'); ?>public/img/photos/<?php echo $user->getPhoto() ?>"/>
                <?php }
                ?>
            </div>
        </a>
        <div id="submenu">
            <ul>
                <li><a href="<?php echo constant('URL');?>user">Ver perfil</a></li>
                <li class='divisor'></li>
                <li><a href="<?php echo constant('URL');?>logout">Cerrar sesión</a></li>
            </ul>
        </div>
    </div>
</div>
