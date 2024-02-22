<?php
    session_start();
    unset($_SESSION['cart_item']);
    echo 'OK';
?>