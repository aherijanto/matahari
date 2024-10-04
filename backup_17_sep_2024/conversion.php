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
            <img src="./img/generating.gif" width="600" height="400"/>
        </div>
        <div class="row  mt-5">
            <div class="col-12 mr-5">
                <h2>Please wait while creating database updates...it takes more times...</h2>
            </div>
        </div>
        
    </body>
    <div id="detail"></div>
 </html>
<!-- <script src="./assets/scripts/js/exportinvent.js"></script> -->