<?php
session_start();
$_SESSION['reports']= '0';
error_reporting(E_ALL);
ini_set("display_errors","On");
require_once('./assets/requires/config.php');
require_once('./assets/requires/header1.php');
include './class/_parkerconnection.php';

?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <title> Adjustment Inventory</title>
        <h1 align="center">Inventory Adjustment</h1>
    </head>
    <div class="container">
        <div class="row">
            <div class="col-4">
                <label for="gol">Group Name</label><br/>
                <select id="gol" name="gol" class="form-select form-select-lg mb-3"  aria-label=".form-select-lg" style="height:calc(1.5em + .75rem + 2px);">
                    <?php
                        try{
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                            $query="SELECT * FROM wgroups ";
                            $stmt = $pdo->prepare($query);
                            $stmt->execute();
                            $totalquery = $stmt->rowCount();
                            while($rowquery = $stmt->fetchObject()){ 
                                echo '<option value='.$rowquery->g_code.'>'.$rowquery->g_code.' - '.$rowquery->g_name.'</option>';
                            }
                        }catch(PDOException $e) {
                            echo $e->getMessage();
                        }
                    ?>
                </select>
            </div>
            
            <div class="col">
                <div class="form-floating mb-3">
                    <label for="pluname">PLU Name</label>
                    <input type="text" class="form-control" id="pluname" placeholder="PLU Name">
                    
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-4">
                <button id="golbutton" class="btn btn-success">Search Group</button>
            </div>
            <div class="col-4">
                <button id="plunamebutton" class="btn btn-info">Search PLU</button>
            </div>
        </div>
    </div>
    <div id="queryResult" style="padding:15px 15px;margin-top:15px;">
    </div>
    <div align="center" style="margin-top:10px;margin-bottom:30px;">
        <button id="updateall" class="btn btn-primary">Update All</button>
    </div>
</html>
<script src="./assets/scripts/js/adjustinvent.js"></script>

