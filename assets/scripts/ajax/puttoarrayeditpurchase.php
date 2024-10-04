<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set("display_errors", "On");
date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/
    
	if($_POST["noinv"]) {
        $noinvmf = $_POST['noinv'];
        echo $noinvmf;
        $conn3=mysqli_connect('103.247.8.177','mimj5729_myroot','myroot@@##','mimj5729_matahari');
        $sqlpurchase="SELECT * FROM `wbuyhead` bd JOIN wbuytail bt ON bd.b_code = bt.b_code WHERE bd.b_code = '$noinvmf'";
        $showpurchase= mysqli_query($conn3,$sqlpurchase) or die(mysql_error());
        $rowcount=mysqli_num_rows($showpurchase);
        if ($rowcount > 0){
            $_SESSION['cart_item'] = '';
            $_SESSION['status_pcs'] = 'edit';
            while ($row =mysqli_fetch_array($showpurchase)){
                $codemf 			 = $row['g_code'];
                $barcodemf 			 = $row['i_code'];
                $itemnamemf 		 = $row['i_name'];
                $qtymf 				 = $row['i_qty'];
                $cogsmf				 = $row['i_cogs'];
                $disc1mf			 = $row['i_disc1'];
                $disc2mf			 = $row['i_disc2'];
                $disc3mf			 = $row['i_disc3'];
                $tglexpmf			 = $row['tglexp'];
                $_SESSION['myinvno'] = $noinvmf;
                $_SESSION['myrefno'] = $row['b_refno'];
                $_SESSION['xdate'] 	 = $row['b_date'];
                $_SESSION['invdue']  = $row['b_dateinput'];
                $_SESSION['scode']	 = $row['s_code'];
                $itemArraymf = array($codemf=>array('barcode'=>$barcodemf,'code'=>$codemf,'name'=>$itemnamemf, 'qty'=>$qtymf,'cogs'=>$cogsmf,'disc1'=>$disc1mf,'disc2'=>0,'disc3'=>$disc3mf,'tglexp'=>$tglexpmf));
                if(!empty($_SESSION["cart_item"]))
                    {
                        if(in_array($codemf,$_SESSION["cart_item"]))
                        {
                            foreach($_SESSION["cart_item"] as $k => $v)
                            {
                                if($itemcode == $k)
                                {
                                    $_SESSION["cart_item"][$k]["qty"] = $_POST["qty"];
                                    $_SESSION["cart_item"][$k]["cogs"] = $_POST["cogs"];
                                //$_SESSION["cart_item"][$k]["discitem"] = $_POST["discitem"];
                                //$_SESSION["cart_item"][$k]["unit"]= $productByCode[0]["itemunit"];
                                }
                            }
                        } else
                            {
                                $_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArraymf);
                            }
                    } else{
                            $_SESSION["cart_item"] = $itemArraymf;
                    }
            }
            var_dump($_SESSION['cart_item']);
        }else{
            echo 'failed';
        }	
	}
?>