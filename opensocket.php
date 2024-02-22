<?php
if(($conn = fsockopen('192.168.1.12',9100,$errno,$errstr))===false){ 
    echo 'Connection Failed' . $errno . $errstr; 
} 
?>
