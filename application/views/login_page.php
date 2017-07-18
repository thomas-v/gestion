<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Welcome to CodeIgniter</title>

    <link rel="stylesheet" href="<?php echo base_url();?>public/css/base.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/login.css"/>
</head>
<body>

<div class="login-page">
    <div class="form">
        <form class="register-form">
            <input type="text" placeholder="pseudo"/>
            <input type="password" placeholder="mot de passe"/>
            <input type="text" placeholder="email address"/>
            <button>create</button>
            <p class="message">Already registered? <a href="#">Sign In</a></p>
        </form>
        <form class="login-form">
            <input type="text" placeholder="pseudo"/>
            <input type="password" placeholder="mot de passe"/>
            <button>Se connecter</button>
            <p class="message">Pas enregistré? <a href="#">Créez un compte</a></p>
        </form>
    </div>
</div>
<script src="<?php echo base_url();?>public/javascript/jquery-3.2.1.min.js"></script>
<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
    });
</script>

</body>
</html>