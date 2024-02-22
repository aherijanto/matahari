<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();
    if(isset($_GET['noinv'])){
        $noinv = $_GET['noinv'];
        $conn=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
        $warehousequery = "select * from wwarehouse";
        $showwarehouse = mysqli_query($conn,$warehousequery);
        while($rowresult = mysqli_fetch_array($showwarehouse)){
            $wareid = $rowresult['ware_id'];
            
            unset($_SESSION[$wareid]);
            $itemfromselltail = "select wsellhead.s_code,wsellhead.s_date,wsellhead.c_code,wsellhead.u_code,wselltail.i_code,wselltail.i_name,wselltail.i_qty, wselltail.i_sell,wselltail.i_disc1,wselltail.i_disc3,winventory.i_unit,winventory.ware_id from wsellhead,wselltail,winventory where wselltail.s_code=wsellhead.s_code and wselltail.i_code=winventory.i_code and wselltail.s_code = '$noinv'";
            $showitem = mysqli_query($conn,$itemfromselltail);
            while($rowitem = mysqli_fetch_array($showitem)){
                //$wareArray = array{'warename'=>}
                if($rowitem['ware_id'] == $wareid){
                    if(!isset($_SESSION[$wareid])){
                        $_SESSION[$wareid] = array();
                    }
                    $itemArray = array('code'=>$rowitem["i_code"],'name'=>$rowitem['i_name'], 'qty'=>$rowitem["i_qty"],'unit'=>$rowitem['i_unit'],'wareid'=>$rowitem['ware_id']);
	                array_push($_SESSION[$wareid],$itemArray);
                }
            }
            
            if(!isset($_SESSION[$wareid])){

            }else{
               // var_dump($_SESSION[$wareid]);
               // echo '<br/>';
                echo "<script>window.open('createdo.php?wareid=$wareid&noinv=$noinv');</script>";
            }
            
        }

    }
?>