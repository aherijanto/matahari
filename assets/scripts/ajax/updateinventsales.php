<?php
session_start();
foreach($_SESSION["cart_item"] as $myItem)
{
    $myCode = $myItem['code'];

$connUpdateSales = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
$resultSelect = mysqli_query($conn2,"SELECT * FROM winventory ");
}
?>