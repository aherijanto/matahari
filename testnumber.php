<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

include 'class/number.php';

$number=setnumber("wcustomers");
echo 'The number is'.' '.$number;
?>
