<?php
global $pdo;
try
{
	$pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

}
catch (PDOException $e)
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
?>
