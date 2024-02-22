<?php
session_start();
    if($_POST['id']){
        $id = $_POST['id'];
        foreach($_SESSION["cart_item"] as $k=>$v)
				{
					if($id == $_SESSION["cart_item"][$k]["code"]){

						unset($_SESSION["cart_item"][$k]);
                        echo 'OK';
					}
                }
    } 
?>