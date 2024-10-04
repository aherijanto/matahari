<!DOCTYPE html>

<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
require_once('./assets/requires/config.php');
require_once('./assets/requires/header1.php');
?>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;

        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    input[type=submit] {
        background-color: #0a9396;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
    }

    .me_date {
        padding: 5px 5px;
        color: black;
        font-size: 16px;
    }
</style>
<div align="center">
    <img src="./img/logo/animat-printer-color.gif" alt="print" width="200" />
</div>
<div><br></div>
<div><br></div>
<div align="center" style="padding:15px;">INVOICE NO</div>

<div id="invno" align="center"><input type="text" id="inputinv" width="250px" name="inputinv"></div>
<div align="center"><input type="submit" id="btnprocess" name="datesubmit" value="Process">
    <div id="reprintdetail" class="mt-4"></div>
    <div id="btnactions">
        <div class="row mt-3">
            <div class="col">
                <button id="btnreprintdo" class="btn btn-primary">Print DO</button>
            </div>
            <div class="col">
                <button id="btnreprintinv" class="btn btn-success">Print Invoice</button>
            </div>
        </div>
    </div>




    <footer align="center">
        <label id="back" style="color:blue;cursor:pointer;padding:12px 12px;" onclick="window.open('/reginvent.php','_self')">
            &copyMatahari</label>
    </footer>

</html>
<script src="./assets/scripts/js/reprint.js"></script>