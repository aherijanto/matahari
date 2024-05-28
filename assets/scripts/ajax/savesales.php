<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
date_default_timezone_set("Asia/Bangkok");


if(!empty($_SESSION["cart_item"])){
			
	 $myinvno=$_SESSION['myinvdrm'];
	 $myrefno=$myinvno;
	 $mydate1=date('Y-m-d');
	 
	 $myuser='ary';//$_SESSION['user'];
	 $mysupp=$_POST['status'];;
	 $mybayar=$_POST['pay'];//;
	 $mykembali=$_POST['change'];//$_POST['change'];
	 $mytype = $_POST['status'];
	 $myclient=$_POST['client'];

	 //$myduedate = strtotime(date('Y-m-d',$_POST['duedate']));
	 if ($mytype=='Cash'){
		$mydateon=date('Y-m-d');
	 }

	 if($mytype=='A/R'){
		$mydateon=$_POST['duedate'];
	 }
	 	
     $conn2 = mysqli_connect('103.247.8.177','mimj5729_myroot','myroot@@##','mimj5729_matahari');
	 $tag = $_POST['tag'];
	 
	 switch ($tag) {
		case 'new':
			# code...
			break;
		case 'edit':
			foreach($_SESSION["cart_origin"] as $myOri)
			{
				$myInvNoOri=$myinvno;
				$myItemCodeOri= $myOri["code"];//
				$myItemNameOri= $myOri["name"];
				$myQtyOri= $myOri["qty"];//$_SESSION["cart_item"][$k]["name"];
				$myPriceOri=$myOri["cogs"];
				$myDisc1Ori=$myOri["disc"];
				$myDisc2Ori=$myOri["disc2"];
				$myDisc3Ori=$myOri["discrp"];

				$resultselect = mysqli_query($conn2,"select * from winventory where i_code = '$myItemCodeOri'");
		 		$rowSelect = mysqli_fetch_array($resultselect);
				$iqty = $rowSelect['i_qty'];
				$balance = $iqty + $myQtyOri;
				$resultupdate = mysqli_query($conn2,"update winventory set i_qty = '$balance' where i_code = '$myItemCodeOri'");
				//$updateinvent = mysqli_query($conn2,"UPDATE winventory SET i_qty = i_qty + '$myQtyOri' WHERE i_code='$myInvNoOri'");
				
			}
			$deletehead = mysqli_query($conn2,"delete from wsellhead where s_code='$myinvno';");
			$deletetail = mysqli_query($conn2,"delete from wselltail where s_code='$myinvno';");
			$mydate1 = $_POST['dateedit'];
			break;
	}
	 $result = mysqli_query($conn2,"insert into wsellhead (s_code, s_date,s_dateinput,type,c_code, u_code,s_premi,s_deduct) values ('$myinvno', '$mydate1','$mydateon', '$mytype','$myclient','$myuser','$mybayar', '$mykembali');");
    
     if($result){
         echo 'OKsave';
     }else{
         echo 'Failed';
     }

	
	foreach($_SESSION["cart_item"] as $myItem)
	 {
	 	$myInvNo=$myinvno;
	 	$myItemCode= $myItem["code"];//
	 	$myItemName= $myItem["name"];
	 	$myQty= $myItem["qty"];//$_SESSION["cart_item"][$k]["name"];
	 	$myPrice=$myItem["cogs"];
	 	$myDisc1=$myItem["disc"];
	 	$myDisc2=$myItem["disc2"];
	 	$myDisc3=$myItem["discrp"];
		$iqty = 0;
		$balance = 0;
	 	// 
		 $conn2 = mysqli_connect('103.247.8.177','mimj5729_myroot','myroot@@##','mimj5729_matahari');
		 $result = mysqli_query($conn2,"insert into wselltail (s_code,i_code,i_name, i_qty, i_sell,i_disc1,i_disc2,i_disc3) values ('$myInvNo', '$myItemCode','$myItemName', '$myQty','$myPrice','$myDisc1', '$myDisc2','$myDisc3');");

		 //$connDB = mysqli_connect('103.247.8.177','mimj5729_myroot','myroot@@##','mimj5729_matahari');
		 $resultselect = mysqli_query($conn2,"select * from winventory where i_code = '$myItemCode'");
		 $rowSelect = mysqli_fetch_array($resultselect);
		 $iqty = $rowSelect['i_qty'];
		 $balance = $iqty - $myQty;
		 $resultupdate = mysqli_query($conn2,"update winventory set i_qty = '$balance' where i_code = '$myItemCode'");

	 }
	 unset($_SESSION["cart_origin"]);
	 unset($_SESSION["cart_item"]);
	 unset($_SESSION["xdate"]);
	 unset($_SESSION["myinvdrm"]);
	 $_SESSION["xdate"]=date('Y-m-d');
	// $_SESSION["myinvdrm"]=setnoinv();

   
}else{
    echo 'Failed';
}
?>