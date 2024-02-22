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
            <img src="./img/logo/mutation.gif" width="200"/>
        </div>
        <div align="center">
            <label id="mutation" class="text-primary" style="font-size: 24px;">Item Mutation</label>
        </div>
        <div class="row  mt-2">
            <div class="col-6">
                <label id="srctext">Source :</label>
            </div>
            <div class="col-6">
            <label id="desttext">Destination :</label>
            </div>
        </div>
        <div class="row ">
            <div class="col-6">
                <select class="form-control form-control-md" aria-label=".form-control-md source" id="source" name="source">
                    <option value="0" selected>Select Item...</option>
                </select>
            </div>
            <div class="col-6">
                <select class="form-control form-control-md" aria-label=".form-control-md destination" id="destination" name="detination">
                     <option value="0" selected>Select Item...</option>
                </select>
            </div>
        </div>
        <div class="row  mt-2">
            <div class="col-6">
                <div id="srcdetail" class="text-primary"></div>
            </div>
            <div class="col-6">
                <div id="destdetail" class="text-danger"></div>
            </div>
        </div>
        <div align="center" class="mt-4">
            <button id="process" name="process" class="btn btn-primary">Process</button>
            <button id="cancel" name="cancel" class="btn btn-warning">Cancel</button>
        </div>
    </body>
    <div id="detail"></div>
 </html>
<script src="./assets/scripts/js/mutation.js"></script>




