<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    session_start();
    $upone = dirname(__DIR__);

    $barcode = $_POST['barcode'];
    $iqty =  $_POST['iqty'];
    $icogs = $_POST['icogs'];
    $isell1 = $_POST['isell1'];
    $isell2 = $_POST['isell2'];
    $isell3 = $_POST['isell3'];
    $isell4 = $_POST['isell4'];
    $isell5 = $_POST['isell5'];
    $isell6 = $_POST['isell6'];
    $isell7 = $_POST['isell7'];
    $isell8 = $_POST['isell8'];
    $isell9 = $_POST['isell9'];
    $isell10 = $_POST['isell10'];


    $editedbarcode = $_POST['edited'];

    $db='mimj5729_matahari';$user='mimj5729_myroot';$pwd='myroot@@##';
    try 
    {
	    $pdo = new PDO('mysql:host=localhost;dbname='.$db, $user, $pwd);
    }
        catch (PDOException $e) 
    {
        echo 'Error: ' . $e->getMessage();
        exit();
    }

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $selectpcsGlob = "UPDATE winventory SET i_barcode = '$editedbarcode',
        i_qty='$iqty',
        i_cogs='$icogs',
        i_sell='$isell1',
        i_sell2='$isell2',
        i_sell3='$isell3',
        i_sell4='$isell4',
        i_sell5='$isell5',
        i_sell6='$isell6',
        i_sell7='$isell7',
        i_sell8='$isell8',
        i_sell9='$isell9',
        i_sell10='$isell10' 
        WHERE i_barcode = '$barcode'";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
   
    

//$_SESSION['reports'] '0';
?>
