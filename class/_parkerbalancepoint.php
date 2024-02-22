<?php
//session_start();
//include ("class/_parkerconnection.inc");

function countAddPoint($mycustcode)
{
  try
  {
    $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

  }
  catch (PDOException $e)
  {
      echo 'Error: ' . $e->getMessage();
      exit();
  }
    $_custquery = "SELECT sum(p_qty) as mysumadd FROM `waddpoint` WHERE c_code='$mycustcode'";
    $res = $pdo->prepare($_custquery);
    $res->execute();
    if(!$res) {
             //die("Database query failed: " . mysql_error());
             }
    $row=$res->fetchObject();

    $addpoint=$row->mysumadd;

    return $addpoint;
}



function countRedPoint($mycustcode)
{
  try
  {
    $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

  }
  catch (PDOException $e)
  {
      echo 'Error: ' . $e->getMessage();
      exit();
  }
    $_custquery = "SELECT sum(pred_qty) as mysumred FROM `wredpoint` WHERE c_code='$mycustcode'";
    $res = $pdo->prepare($_custquery);
    $res->execute();
    if(!$res) {
             //die("Database query failed: " . mysql_error());
             }
    $row=$res->fetchObject();

    $redpoint=$row->mysumred;

    return $redpoint;
}

?>


