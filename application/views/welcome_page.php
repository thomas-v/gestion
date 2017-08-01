<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Looking for Work - Accueil</title>

    <link rel="stylesheet" href="<?php echo base_url();?>public/css/base.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/welcome.css"/>
</head>
<body>

<div id="welcome_page">
    <div id="main" class="bloc">
        <div class="title">Looking for Work</div>
    </div>
    <div id="category" class="bloc">
        <span>Ajouter une catégorie d'emploi</span> <br>(magasinier, comptable, informatique ...)
        <?= form_open('category/add'); ?>
            <?php
                echo form_error('category');
                $category = array('name'=>'category', 'placeholder'=>'Nouvelle catégorie', 'value'=>set_value('category'));
                echo form_input($category);
            ?>
        <?= form_submit('submit', 'Ajouter'); ?>
        <?= form_close(); ?>
    </div>
    <div id="list" class="bloc">
        <span>Accéder à la liste des demandes d'emploi</span> <br>(par catégorie)
        <?= form_open('jobs/list'); ?>
        <select>
            <option>Select an Option</option>
            <option>Option 1</option>
            <option>Option 2</option>
        </select>
        <?= form_submit('submit', 'Visualiser'); ?>
        <?= form_close(); ?>
    </div>
    <div id="delete_category" class="bloc">
        <span>Supprimer une catégorie d'emploi</span> <br>(cela aura pour conséquence de supprimer toutes les demandes d'emploi de cette catégorie)
        <?= form_open('category/delete'); ?>
        <select>
            <option>Select an Option</option>
            <option>Option 1</option>
            <option>Option 2</option>
        </select>
        <?= form_submit('submit', 'Supprimer'); ?>
        <?= form_close(); ?>
    </div>
    <div id="jobs">
    </div>
</div>
<script src="<?php echo base_url();?>public/javascript/jquery-3.2.1.min.js"></script>


</body>
</html>