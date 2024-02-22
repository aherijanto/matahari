<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set("display_errors", "On");
date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/
    
	if($_POST["noinv"]) {

		$noinv = $_POST["noinv"];
        $_custid = $_POST["custid"];
        $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
        $result = mysqli_query($conn2,"SELECT * FROM `wsellhead`,wselltail WHERE wsellhead.s_code='$noinv' AND wsellhead.c_code='$_custid' AND wselltail.s_code='$noinv';");
        if(!$result){
            die();
            echo 'noresult';
        }else{
            $jumrec=mysqli_num_rows($result);
        }
        
        if($jumrec>0){
            if(isset($_SESSION['cart_item'])){
                unset($_SESSION['cart_item']);
            }

            if (!isset($_SESSION['cart_item'])) {
                $_SESSION['cart_item'] = array();
            }
            while($record = mysqli_fetch_array($result)){	
                $scode = $record['s_code'];
                $sdate = $record['s_date'];
                $type = $record['type'];
                $ccode = $record['c_code'];
                $icode = $record['i_code'];
                $iname = $record['i_name'];
                $iqty = $record['i_qty'];
                $isell = $record['i_sell'];
                $disc = $record['i_disc1'];
                $disc2 = $record['i_disc2'];
                $discrp = $record['i_disc3'];
                $resultware = mysqli_query($conn2,"select * from winventory where i_code = '$icode';");
                $jumrecware = mysqli_num_rows($resultware);
                if($jumrecware>0){
                    $recware = mysqli_fetch_array($resultware);
                    $wareid= $recware['ware_id'];
                }

                $resultcustname= mysqli_query($conn2,"select * from wcustomers where c_code = '$ccode';");
                $jumreccustname = mysqli_num_rows($resultcustname);
                if($jumreccustname>0){
                    $reccustname = mysqli_fetch_array($resultcustname);
                    $custname= $reccustname['c_name'];
                }
                
                    $itemArray = array('code'=>$icode,'name'=>$iname, 'artikel'=>'','warna'=>'','qty'=>$iqty,'wareid'=>$wareid,'cogs'=>$isell,'disc'=>$disc,'disc2'=>$disc2,'discrp'=>$discrp);
                    array_push($_SESSION['cart_item'],$itemArray);
                    $profile = array(
                    'noinv'=>$scode,
                    'tanggal'=>$sdate,
                    'status'=>$type,
                    'custid'=>$ccode,
                    'custname'=>$custname
                    );
                
            }
            if(isset($_SESSION['xdate'])){
                unset($_SESSION['xdate']);
            }
            $_SESSION['tag']='edit';
            $_SESSION['xdate'] = $sdate;
            $_SESSION['myinvdrm'] = $scode;
            $_SESSION['cust_id'] = $ccode;
            $_SESSION['cust_name'] = $custname;
            //echo json_encode($profile);
            
            if(isset($_SESSION['cart_origin'])){
                unset($_SESSION['cart_origin']);
            }
            if(!isset($_SESSION['cart_origin'])){
                $_SESSION['cart_origin'] = $_SESSION['cart_item'];
            }
            echo json_encode($profile);
        }
        else{
            echo 'failed';
        }
			
	}
?>