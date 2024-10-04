<?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    date_default_timezone_set("Asia/Bangkok");
    require_once('./assets/requires/config.php');
    require_once('./assets/requires/header1.php');
?>
<!DOCTYPE html>
<html>
    <body>
        <div class="card">
            <div class="mt-5 text-center">
                <h2 class="text-danger mb-2"> Import Inventory Data</h2>
                <img src="excel.png" id="logoexcel" width="48px">
                <span>
                    <label>Please choose Excel File</label>
                </span>
            </div>
            <div class="mt-1 text-center">
                <span>
                    <input class="input-text" type="text" id="txtfile" readonly />
                </span>
                <input type="file" id="fileexcel" />
            </div>
            <div class=" mt-3 text-center">
                <button class="btn btn-success text-right" id="uploadbtn">Import</button>
                <button id="cancel" name="cancel" class="btn btn-warning">Cancel</button>
            </div>
        </div>
       
        <div class="mt-4" id="importresult"></div>
                
    </body>
    <script src="./assets/scripts/js/mimo.js"></script>
</html>