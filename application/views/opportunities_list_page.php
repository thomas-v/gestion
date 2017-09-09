<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Looking for Work - Opportunités d'emploi</title>

    <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/base.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/opportunities_list.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/datatables.min.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/jquery-ui-timepicker-addon.css"/>
</head>
<body>

<div id="opportunities_list_page">
    <div id="main" class="bloc">
        <div class="title"><a href="<?= base_url() ?>index.php/welcome">Looking for Work</a></div>
    </div>
    <div id="list" class="bloc">
        <span><?= $category_name ?></span><br>Liste des demandes d'emploi affiliées

        <div id="opportunities_table">
            <table id="example" class="display" cellspacing="0" width="100%">
                <thead>
                <tr>
                    <th>Entreprise</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Code postal</th>
                    <th>Contact par courrier</th>
                    <th>Contact par email</th>
                    <th>Contact téléphonique</th>
                    <th>Relance téléphonique</th>
                    <th>Entretien</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>

                <?php if(isset($opportunities_list)){ ?>
                    <tbody>
                        <?php foreach ($opportunities_list as $opportunitie){ ?>
                            <tr>
                                <td><?= $opportunitie['company'] ?></td>
                                <td><?= $opportunitie['adress'] ?></td>
                                <td><?= $opportunitie['city'] ?></td>
                                <td><?= $opportunitie['postal_code'] ?></td>
                                <td><?php if(isset($opportunitie['post'])){ $opportunitie['post'] = str_replace(' 00:00:00', '', $opportunitie['post']);echo $opportunitie['post'];} else{echo '-';}  ?></td>
                                <td><?php if(isset($opportunitie['email'])){$opportunitie['email'] = str_replace(' 00:00:00', '', $opportunitie['email']); echo $opportunitie['email'];} else{echo '-';}  ?></td>
                                <td><?php if(isset($opportunitie['phone'])){$opportunitie['phone'] = str_replace(' 00:00:00', '', $opportunitie['phone']);echo $opportunitie['phone'];} else{echo '-';}  ?></td>
                                <td><?php if(isset($opportunitie['phone_relaunch'])){$opportunitie['phone_relaunch'] = str_replace(' 00:00:00', '', $opportunitie['phone_relaunch']);echo $opportunitie['phone_relaunch'];} else{echo '-';}  ?></td>
                                <td><?php if(isset($opportunitie['interview'])){$opportunitie['interview'] = substr($opportunitie['interview'], 0, -3);echo $opportunitie['interview'];} else{echo '-';}  ?></td>
                            	<td>Modifier</td>
                            	<td class="hover delete" data-id="<?= $opportunitie['id'] ?>">Supprimer</td>
                            </tr>
                        <?php } ?>
                    </tbody>
                <?php } ?>

                <tfoot>
                <tr>
                    <th>Entreprise</th>
                    <th>Adresse</th>
                    <th>Ville</th>
                    <th>Code postal</th>
                    <th>Contact par courrier</th>
                    <th>Contact par email</th>
                    <th>Contact téléphonique</th>
                    <th>Relance téléphonique</th>
                    <th>Entretien</th>
                    <th></th>
                    <th></th>
                </tr>
                </tfoot>
                <tbody>

                </tbody>
            </table>
        </div>
    </div>

    <div id="add_opportunitie" class="bloc">
        <span>Ajouter une société</span>
        <?= form_open('opportunities/add'); ?>
        <?php
            if(isset($add_success)){
                echo "<p class='success'>".$add_success."</p>";
            }
            echo form_error('name');
            echo form_error('adress');
            echo form_error('city');
            echo form_error('postal_code');
            echo form_error('post_date');
            echo form_error('email_date');
            echo form_error('phone_date');
            echo form_error('phone_relaunch_date');
            echo form_error('interview_date');
            $name = array('name' => 'name', 'placeholder' => 'Entreprise', 'value' => set_value('name'));
            echo form_input($name);

            $adress = array('name' => 'adress', 'placeholder' => 'Adresse', 'value' => set_value('adress'));
            echo form_input($adress);

            $city = array('name' => 'city', 'placeholder' => 'Ville', 'value' => set_value('city'));
            echo form_input($city);

            $postal_code = array('name' => 'postal_code', 'placeholder' => 'Code postal', 'value' => set_value('postal_code'));
            echo form_input($postal_code);

        ?>

        <div class="checkbox_date">
            <div class="checkbox">
                <input type="checkbox" id="post" value="1" name="post"<?= set_checkbox('post', '1', false) ?>/>
                <label for='post'>Contact par courrier</label>";
            </div>
            <div class="date">
                <?php
                    $post_date = array('name' => 'post_date', 'placeholder' => 'AAAA-MM-JJ', 'value' => set_value('post_date'), 'id' => 'post_date');
                    echo form_input($post_date);
                ?>
            </div>
        </div>

        <div class="checkbox_date">
            <div class="checkbox">
                <input type="checkbox" id="email" value="1" name="email"<?= set_checkbox('email', '1', false) ?>/>
                <label for='email'>Contact par email</label>

            </div>
            <div class="date">
                <?php
                $email_date = array('name' => 'email_date', 'placeholder' => 'AAAA-MM-JJ', 'value' => set_value('email_date'), 'id' => 'email_date');
                echo form_input($email_date);
                ?>
            </div>
        </div>

        <div class="checkbox_date">
            <div class="checkbox">
                <input type="checkbox" id="phone" value="1" name="phone"<?= set_checkbox('phone', '1', false) ?>/>
                <label for='phone'>Contact par téléphone</label>
            </div>
            <div class="date">
                <?php
                $phone_date = array('name' => 'phone_date', 'placeholder' => 'AAAA-MM-JJ', 'value' => set_value('phone_date'), 'id' => 'phone_date');
                echo form_input($phone_date);
                ?>
            </div>
        </div>

        <div class="checkbox_date">
            <div class="checkbox">
                <input type="checkbox" id="phone_relaunch" value="1" name="phone_relaunch"<?= set_checkbox('phone_relaunch', '1', false) ?>/>
                <label for='phone_relaunch'>Relance par téléphone</label>

            </div>
            <div class="date">
                <?php
                $phone_relaunch_date = array('name' => 'phone_relaunch_date', 'placeholder' => 'AAAA-MM-JJ', 'value' => set_value('phone_relaunch_date'), 'id' => 'phone_relaunch_date');
                echo form_input($phone_relaunch_date);
                ?>
            </div>
        </div>

        <div class="checkbox_date">
            <div class="checkbox">
                <input type="checkbox" id="interview" value="1" name="interview"<?= set_checkbox('interview', '1', false) ?>/>
                <label for='interview'>Entretien d'embauche</label>
            </div>
            <div class="date">
                <?php
                $interview_date = array('name' => 'interview_date', 'placeholder' => 'AAAA-MM-JJ HH-MM', 'value' => set_value('interview_date'), 'id' => 'interview_date');
                echo form_input($interview_date);
                ?>
            </div>
        </div>

        <input type="hidden" name="category_id" value="<?= $category_id ?>">

        <?= form_submit('submit', 'Ajouter'); ?>
        <?= form_close(); ?>
        
        <div id="dialog-confirm" title="Etes vous certain de vouloir supprimer cette opportunitée ?">
          <p><span class="ui-icon ui-icon-alert" style="float:left; margin:0px 12px 20px 0;"></span>Elle ne pourra pas être récupérée.</p>
        </div>
    </div>
</div>
<script src="<?php echo base_url();?>public/javascript/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="<?php echo base_url();?>public/javascript/jquery-ui-timepicker-addon.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            "bLengthChange": false,
            language: {
                processing:     "Traitement en cours...",
                search:         "Rechercher&nbsp;:",
                lengthMenu:     "Afficher _MENU_ &eacute;l&eacute;ments",
                info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                infoPostFix:    "",
                loadingRecords: "Chargement en cours...",
                zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                emptyTable:     "Aucune demande d'emploi n'a été ajouté",
                paginate: {
                    first:      "Premier",
                    previous:   "Pr&eacute;c&eacute;dent",
                    next:       "Suivant",
                    last:       "Dernier"
                },
                aria: {
                    sortAscending:  ": activer pour trier la colonne par ordre croissant",
                    sortDescending: ": activer pour trier la colonne par ordre décroissant"
                }
            }
        });
    } );
</script>

<script>

    $('#post:checkbox').change(function () {
        if ($(this).is(':checked')) {
            $("#post_date").css('visibility', 'visible');
        } else {
            $("#post_date").css('visibility', 'hidden');
            $("#post_date").val("");
        }
    });

    $('#email:checkbox').change(function () {
        if ($(this).is(':checked')) {
            $("#email_date").css('visibility', 'visible');
        } else {
            $("#email_date").css('visibility', 'hidden');
            $("#email_date").val("");
        }
    });

    $('#phone:checkbox').change(function () {
        if ($(this).is(':checked')) {
            $("#phone_date").css('visibility', 'visible');
        } else {
            $("#phone_date").css('visibility', 'hidden');
            $("#phone_date").val("");
        }
    });

    $('#phone_relaunch:checkbox').change(function () {
        if ($(this).is(':checked')) {
            $("#phone_relaunch_date").css('visibility', 'visible');
        } else {
            $("#phone_relaunch_date").css('visibility', 'hidden');
            $("#phone_relaunch_date").val("");
        }
    });

    $('#interview:checkbox').change(function () {
        if ($(this).is(':checked')) {
            $("#interview_date").css('visibility', 'visible');
        } else {
            $("#interview_date").css('visibility', 'hidden');
            $("#interview_date").val("");
        }
    });

    $( document ).ready(function() {
        if ($('#post:checkbox').is(':checked')) {
            $("#post_date").css('visibility', 'visible');
        }

        if ($('#email:checkbox').is(':checked')) {
            $("#email_date").css('visibility', 'visible');
        }

        if ($('#phone:checkbox').is(':checked')) {
            $("#phone_date").css('visibility', 'visible');
        }

        if ($('#phone_relaunch:checkbox').is(':checked')) {
            $("#phone_relaunch_date").css('visibility', 'visible');
        }

        if ($('#interview:checkbox').is(':checked')) {
            $("#interview_date").css('visibility', 'visible');
        }

        //mise en place des datpickers
        $('#post_date').datetimepicker({dateFormat: 'yy-mm-dd', showTimepicker: false});
        $('#email_date').datetimepicker({dateFormat: 'yy-mm-dd', showTimepicker: false});
        $('#phone_date').datetimepicker({dateFormat: 'yy-mm-dd', showTimepicker: false});
        $('#phone_relaunch_date').datetimepicker({dateFormat: 'yy-mm-dd', showTimepicker: false});
        $('#interview_date').datetimepicker({dateFormat: 'yy-mm-dd', timeFormat: 'hh:mm', showTimepicker: true});


        $( ".delete" ).click(function() {
    	  var opportunitie_id = $(this).data('id');

    	  $( "#dialog-confirm" ).dialog({
              resizable: false,
              height: "auto",
              width: 550,
              modal: true,
              buttons: {
                "Supprimer": function() {

				//traitement en ajax de la suppression
                    
                  $( this ).dialog( "close" );
                },
                Annuler: function() {
                  $( this ).dialog( "close" );
                }
              }
            });
    	});
        
        

    });
</script>

</body>
</html>