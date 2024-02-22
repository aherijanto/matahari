<?php
$myfile = fopen("../cn.cfg", "r") or die("Unable to open file!");
// Output one line until end-of-file
$cfg=array();
$i=0;
while(!feof($myfile)) {
  $cfg[$i]=fgets($myfile);
  

  $i=$i+1;
  //echo fgets($myfile) . "<br>";
}
fclose($myfile);
$_SESSION['host']=$cfg[0];
$_SESSION['db']=$cfg[1];
$_SESSION['usrname']=$cfg[2];
$_SESSION['pwd']=$cfg[3];


?>