<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
date_default_timezone_set("Asia/Bangkok");
$error='no';
$myinvno = $_POST['myinvno'];

if(!empty($_SESSION["discaccr"])){
	foreach($_SESSION["discaccr"] as $myItem)
	 {
        $mydate=$myItem['datedisc'];;
        $mytype=$myItem['descdisc'];//;
        $myamount = $myItem['amountdisc'];
	 	// 
		 $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
         $result = mysqli_query($conn2,"insert into wdiscaccountr(s_code, r_date,r_desc,r_amount) values ('$myinvno', '$mydate','$mytype','$myamount');");
        
         if($result){
             $error='no';
         }else{$error='yes';}
	 }
	 if($error=='no'){
        echo 'OKsave';
     }
     
     if($error=='yes'){
         echo 'Failed';
     }
	 unset($_SESSION["discaccr"]);
   
}else{
    echo 'Failed';
}
?>