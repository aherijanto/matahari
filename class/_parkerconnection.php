<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//read conf
$i=0;
$conf = array();

if ($_SESSION['reports']== '1'){
    $dir="../class/serv";
}

if ($_SESSION['reports']== '0'){
    $dir="./class/serv";
}

if ($_SESSION['reports']== '2'){
    $upone = dirname(__DIR__, 1);
    $dir=$upone."/class/serv";
}

if ($file = fopen($dir, "r")) {

    while(!feof($file)) {
        $conf[$i] = fgets($file);
        $i++;
    }
    fclose($file);
}

$db=trim($conf[0]);
$user=trim($conf[1]);
$pwd=trim($conf[2]);
//define('USER',$user);
//define('PWD',$pwd);
//define('DB',$db);

try 
{
	$pdo = new PDO('mysql:host=103.247.8.177;dbname='.$db, $user, $pwd);//103.247.8.177//103.247.8.177
    
}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}
