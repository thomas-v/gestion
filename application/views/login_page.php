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
        <?= form_open('home/register_validation', array('class' => 'register-form')); ?>
            <?php
                $pseudo = array('name'=>'pseudo', 'placeholder'=>'pseudo');
                echo form_input($pseudo);
            ?>
            <?php
                $password = array('name'=>'password', 'placeholder'=>'mot de passe');
                echo form_input($password);
            ?>
            <?php
                $email = array('name'=>'email', 'placeholder'=>'Adresse mail');
                echo form_input($email);
            ?>
            <?= form_submit('submit', 'Enregistrer'); ?>
            <p class="message">Déjà enregistré? <a href="#">Connectez vous</a></p>
        <?= form_close(); ?>
        <?= form_open('home/login_validation', array('class' => 'login-form')); ?>
            <?php
                $pseudo = array('name'=>'pseudo', 'placeholder'=>'pseudo');
                echo form_input($pseudo);
            ?>
            <?php
                $password = array('name'=>'password', 'placeholder'=>'mot de passe');
                echo form_input($password);
            ?>
            <?= form_submit('submit', 'Se connecter'); ?>
            <p class="message">Pas enregistré? <a href="">Créez un compte</a></p>
        <?= form_close(); ?>
    </div>
</div>
<script src="<?php echo base_url();?>public/javascript/jquery-3.2.1.min.js"></script>
<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        return false;
    });
</script>

</body>
</html>