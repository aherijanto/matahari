<?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors","On");
    require_once('./assets/requires/config.php');
    require_once('./assets/requires/headerdshbd.php');
?>
<html>
    <body class="container">
        <div align="center" class="mt-5">
            <img src="./img/logo/excel-icons-animation.gif" width="120"/>
        </div>
        <div class="row  mt-5">
            <div class="col-4">
            </div>
           
        </div>
        <div align="center" class="mt-4">
            <button id="export" name="export" class="btn btn-primary">Export Inventory</button>
            <button id="cancel" name="cancel" class="btn btn-warning">Cancel</button>
        </div>
    </body>
    <div id="detail"></div>
 </html>
<script src="./assets/scripts/js/exportinvent.js"></script>




