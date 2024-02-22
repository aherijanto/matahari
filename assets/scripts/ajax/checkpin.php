<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    session_start();
    if($_POST){
        $installedPIN = $_SESSION['pin'];
        $yourPIN = $_POST['pin'];
        
        if($yourPIN==$installedPIN){
            echo "ok";
        }else{
            echo "failed";
        }
        //echo "yours:".$yourPIN."   "."pin : ".$installedPIN;
    }
?>