<?php
global $pdo;
try
{
	$pdo = new PDO('mysql:host=103.247.8.177;dbname=waletmas', 'root', 'root');

}
catch (PDOException $e)
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
?>
