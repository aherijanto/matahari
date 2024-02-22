<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
date_default_timezone_set("Asia/Bangkok");
$error='no';
$myinvno = $_POST['myinvno'];

if(!empty($_SESSION["accp"])){
	foreach($_SESSION["accp"] as $myItem)
	 {
        $mydate=$myItem['mydate'];;
        $mytype=$myItem['mytype'];//;
        $mynocheque=$myItem['mynocheque'];//$_POST['change'];
        $myamount = $myItem['myamount'];
	 	// 
		 $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
         $result = mysqli_query($conn2,"insert into waccountp(s_code, r_date,r_type,r_nocheque, r_amount) values ('$myinvno', '$mydate','$mytype','$mynocheque','$myamount');");
        
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
	 unset($_SESSION["accp"]);
   
}else{
    echo 'Failed';
}
?>