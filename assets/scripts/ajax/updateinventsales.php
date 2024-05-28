<?php
session_start();
foreach($_SESSION["cart_item"] as $myItem)
{
    $myCode = $myItem['code'];

$connUpdateSales = mysqli_connect('103.247.8.177','mimj5729_myroot','myroot@@##','mimj5729_matahari');
$resultSelect = mysqli_query($conn2,"SELECT * FROM winventory ");
}
?>