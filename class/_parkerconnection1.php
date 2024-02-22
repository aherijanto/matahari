<?php
try 
{
	$pdo = new PDO('mysql:host=localhost;dbname=mimj5729_utama', 'mimj5729_myroot', 'myroot@@##');

}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
?>