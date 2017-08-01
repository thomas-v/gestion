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
        <div class="title"><a href="<?= base_url() ?>index.php/welcome">Looking for Work</a></div>
    </div>
    <div id="category" class="bloc">
        <span>Ajouter une catégorie d'emploi</span> <br>(magasinier, comptable, informatique ...)
        <?= form_open('category/add'); ?>
            <?php
                if(!isset($add_no_success)){
                    echo "<p class='success'>".$this->session->flashdata('add_success')."</p>";
                }
                echo form_error('category');
                if(isset($add_no_success)) {
                    $category = array('name' => 'category', 'placeholder' => 'Nouvelle catégorie', 'value' => set_value('category'));
                }
                else{
                    $category = array('name' => 'category', 'placeholder' => 'Nouvelle catégorie');
                }
                echo form_input($category);
            ?>
            <?= form_submit('submit', 'Ajouter'); ?>
        <?= form_close(); ?>
    </div>
    <div id="list" class="bloc">
        <span>Accéder à la liste des demandes d'emploi</span> <br>(par catégorie)

        <?php if(!empty($categorys)) {?>
            <?= form_open('jobs/list'); ?>
            <select>
                <?php foreach ($categorys as $category){?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php }?>
            </select>
            <?= form_submit('submit', 'Visualiser'); ?>
            <?= form_close(); ?>
        <?php } else {?>
            <p class="main_message">Vous n'avez ajouté aucune catégorie d'emploi</p>
        <?php } ?>
    </div>
    <div id="delete_category" class="bloc">
        <span>Supprimer une catégorie d'emploi</span> <br>(cela aura pour conséquence de supprimer toutes les demandes d'emploi de cette catégorie)

        <?php if(!empty($categorys)) {?>

            <?= form_open('category/delete'); ?>
            <?php if(isset($delete_success)){ ?>
                    <?php if($delete_success == true) {?>
                        <p class='success'><?= $validate_form_message ?></p>
                    <?php } else { ?>
                        <p><?= $validate_form_message ?></p>
                    <?php } ?>
            <?php }
            else {?>
                <p></p>
            <?php } ?>
            <select name='category'>
                <?php foreach ($categorys as $category){?>
                    <option value="<?= $category->id ?>"><?= $category->name ?></option>
                <?php }?>
            </select>
            <?= form_submit('submit', 'Supprimer'); ?>
            <?= form_close(); ?>

        <?php } else {?>
            <p class="main_message">Vous n'avez ajouté aucune catégorie d'emploi</p>
        <?php } ?>
    </div>
    <div id="jobs">
    </div>
</div>
<script src="<?php echo base_url();?>public/javascript/jquery-3.2.1.min.js"></script>


</body>
</html>