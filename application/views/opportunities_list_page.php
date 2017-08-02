<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Looking for Work - Opportunités d'emploi</title>

    <link rel="stylesheet" href="<?php echo base_url();?>public/css/base.css"/>
    <link rel="stylesheet" href="<?php echo base_url();?>public/css/opportunities_list.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/datatables.min.css"/>
</head>
<body>

<div id="opportunities_list_page">
    <div id="main" class="bloc">
        <div class="title"><a href="<?= base_url() ?>index.php/welcome">Looking for Work</a></div>
    </div>
    <div id="list" class="bloc">
        <span><?= $category_name ?></span><br>Liste des demandes d'emploi affiliées

        <table id="example" class="display" cellspacing="0" width="100%">
            <thead>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </thead>
            <tfoot>
            <tr>
                <th>Name</th>
                <th>Position</th>
                <th>Office</th>
                <th>Age</th>
                <th>Start date</th>
                <th>Salary</th>
            </tr>
            </tfoot>
            <tbody>
            <tr>
                <td>Tiger Nixon</td>
                <td>System Architect</td>
                <td>Edinburgh</td>
                <td>61</td>
                <td>2011/04/25</td>
                <td>$320,800</td>
            </tr>
            <tr>
                <td>Garrett Winters</td>
                <td>Accountant</td>
                <td>Tokyo</td>
                <td>63</td>
                <td>2011/07/25</td>
                <td>$170,750</td>
            </tr>
            </tbody>
        </table>
    </div>
</div>
<script src="<?php echo base_url();?>public/javascript/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/jq-2.2.4/dt-1.10.15/datatables.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable();
    } );
</script>


</body>
</html>