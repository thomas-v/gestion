<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>Looking for Work - Connection</title>

        <link rel="stylesheet" href="<?php echo base_url();?>public/css/base.css"/>
        <link rel="stylesheet" href="<?php echo base_url();?>public/css/login.css"/>
    </head>
<body>

<div class="login-page">
    <div class="form">
        <div class="title">Looking for Work</div>
        <?= form_open('home/register_validation', array('class' => 'register-form')); ?>
            <?php
                echo form_error('pseudo_register');
                $pseudo = array('name'=>'pseudo_register', 'placeholder'=>'pseudo', 'value'=>set_value('pseudo_register'));
                echo form_input($pseudo);
            ?>
            <?php
                echo form_error('password_register');
                $password = array('name'=>'password_register', 'placeholder'=>'mot de passe', 'value'=>set_value('password_register'), 'type' => 'password');
                echo form_input($password);
            ?>
            <?php
                echo form_error('confirm_password_register');
                $confirmation_password = array('name'=>'confirm_password_register', 'placeholder'=>'confirmation du mot de passe', 'type' => 'password');
                echo form_input($confirmation_password);
            ?>
            <?php
                echo form_error('email_register');
                $email = array('name'=>'email_register', 'placeholder'=>'Adresse mail', 'value'=>set_value('email_register'));
                echo form_input($email);
            ?>
            <?= form_submit('submit', 'Enregistrer'); ?>
            <p class="message">Déjà enregistré? <a href="#">Connectez vous</a></p>
        <?= form_close(); ?>
        <?= form_open('home/login_validation', array('class' => 'login-form')); ?>
            <?php
                echo "<p>".$this->session->flashdata('error_message')."</p>";
                echo form_error('email_login');
                $pseudo = array('name'=>'email_login', 'placeholder'=>'Adresse mail', 'value'=>set_value('email_login'));
                echo form_input($pseudo);
            ?>
            <?php
                echo form_error('password_login');
                $password = array('name'=>'password_login', 'placeholder'=>'mot de passe', 'value'=>set_value('password_login'), 'type' => 'password');
                echo form_input($password);
            ?>
            <?= form_submit('submit', 'Se connecter'); ?>
            <p class="message">Pas enregistré? <a href="">Créez un compte</a></p>
        <?= form_close(); ?>
    </div>
</div>
<script src="<?php echo base_url();?>public/javascript/jquery-3.2.1.min.js"></script>

<?php if(isset($register) && $register == true){
    ?>
    <script> $('form').animate({height: "toggle", opacity: "toggle"}, 1); </script>
    <?php
} ?>

<script>
    $('.message a').click(function(){
        $('form').animate({height: "toggle", opacity: "toggle"}, "slow");
        return false;
    });
</script>

</body>
</html>