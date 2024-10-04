<?php
ob_start();
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
include "class/_parkerpurchase.php";
include "class/_parkerinvent.php";

$GLOBALS['itemcart'] = 0;
$GLOBALS['qty']=0;
$_SESSION['reports']='0';
if(!empty($_SESSION["cart_pcsreturn"])){
		$GLOBALS['itemcart'] = count($_SESSION['cart_pcsreturn']);

				foreach ($_SESSION["cart_pcsreturn"] as $myitem) {
					$GLOBALS['qty']=$myitem['qty']+$GLOBALS['qty'];
					# code...
				}

}
if (!empty($_GET['action'])){
	switch ($_GET['action']) {
		case 'addret':
			if (isset($_POST['retsubmit'])){
				$noBarcode=$_POST['itemcode'];
				$itemName=$_POST['itemname'];
				$qtyReturn=$_POST['qtyret'];

					$itemArrayRet = array($noBarcode=>array('code'=>$noBarcode,'name'=>$itemName,'qty'=>$qtyReturn));

            	if(!empty($_SESSION["cart_pcsreturn"])){
					$itemcheck=$_SESSION['cart_pcsreturn'];
					if(in_array($noBarcode, array_column($itemcheck, 'code'))) {
    					
					}else{
						$_SESSION['cart_pcsreturn']=array_merge($_SESSION['cart_pcsreturn'],$itemArrayRet);
					}
				}else{
					$_SESSION["cart_pcsreturn"] = $itemArrayRet;
				}
				$GLOBALS['itemcart'] = 0;
				$GLOBALS['qty']=0;

				$GLOBALS['itemcart'] = count($_SESSION['cart_pcsreturn']);

				foreach ($_SESSION["cart_pcsreturn"] as $myitem) {
					$GLOBALS['qty']=$myitem['qty']+$GLOBALS['qty'];
					# code...
				}

			}		
			break;


		case "new":
			unset($_SESSION["cart_pcsreturn"]);			
			break;
		

		case "remove":
				if(isset($_SESSION["cart_pcsreturn"]))
				

			{	
				foreach($_SESSION["cart_pcsreturn"] as $k=>$v) 
				{
				//	echo 'forearch';
					if($_GET["codetr"] == $_SESSION["cart_pcsreturn"][$k]["code"]){
						
				//		echo "<script type='text/javascript'>alert('ifff');</script)";
						unset($_SESSION["cart_pcsreturn"][$k]);
					}

				if(empty($_SESSION["cart_pcsreturn"])){
					unset($_SESSION["cart_pcsreturn"]);
					}
				}
			}
			break;

		case "save":

				if(!empty($_SESSION["cart_pcsreturn"])) {
					$retdate=date('Y-m-d');
					$myinvNo=$_SESSION['myinv'];

					foreach($_SESSION["cart_pcsreturn"] as $myItem) 
					{
						$myRetNo='test';
						$myItemCode= $myItem["code"];//
						$myItemName= $myItem["name"];
						$myQty= $myItem["qty"];//$_SESSION["cart_item"][$k]["name"];
						
						
						

						$saveRetPurchase = new Purchase('0','0','0','0','0','0','0','0','0','0','0','0','0','0'); 
				
						$saveRetPurchase->save_return_pcs($myRetNo,$retdate,$myinvNo,$myItemCode,$myItemName,$myQty);
						

					/*UPDATE INVENTORY*/
						$myinvent=new Inventory('','','','','','','','','','','','','','','','');
							
						$myinvent->update_inventory_purchase_return($myItemCode,$myQty);
					
					
					}
					$myInvNo=$_SESSION['myinv'];
					header ("Location:printrspcstable.php?invno=$myInvNo");

					unset($_SESSION['cart_pcsreturn']);
					
			} //if not empty cart_return

			break;



	
	}//switch
}


if(!empty($_GET['invtext'])){
	$myinv=$_GET['invtext'];
	$_SESSION['myinv']=$myinv;
	unset($_SESSION["cart_retpcs"]);
	//$myinvsession=$_SESSION['myinv'];

}
	unset($_SESSION["cart_retpcs"]);
	include ('class/_parkerconnection.php');
       $myinvsession=$_SESSION['myinv'];
       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob="SELECT * FROM wbuytail WHERE b_code='$myinvsession'";
                $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtpcsGlob->execute();
                $totalpcsGlob = $stmtpcsGlob->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

         $itemcode1=$_SESSION['myinv'];
        
         
         echo '<table width="100%">';
         echo '<tr style="background-color:#1565C0;color:white;border-radius:3px;font-weigth:bold;">
         		<td width="auto" style="color:white;font-weigth:bold">'.$_SESSION['myinv'].'</td>';
         echo '<td style="color:white;"><a href="shopcartretpcs.php"><img src="shopcrt.png" style="width:38px;height:38px;"></a>'.$GLOBALS['itemcart'].' Invoice(s);'.$GLOBALS['qty'].' Item(s)</td>';
       
         echo '<form action="retpcs.php" method="post">
         			<td align="right" styles="paddding-left:10px;">
         				<input align="right" type="submit" value="Cancel" name="retCancel" style="background-color:red;color:white;paddding:10px;border:none;align:right;border-radius:3px;width:100px;height:40px;" >';
         echo '</td></form></tr></table>';
        

         while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
            $barcode=$rowpcsGlob->g_code;
            $itemname=$rowpcsGlob->i_name;
            $itemqty=$rowpcsGlob->i_qty;
            $itemprice=$rowpcsGlob->i_cogs;
            $itemdisc1=$rowpcsGlob->i_disc1;
            $itemdisc2=$rowpcsGlob->i_disc2;
            $itemdisc3=$rowpcsGlob->i_disc3;

            
            $itemArray = array($barcode=>array('code'=>$barcode,'name'=>$itemname,'qty'=>$itemqty,'price'=>$itemprice,'disc1'=>$itemdisc1,'disc2'=>$itemdisc2,'disc3'=>$itemdisc3));

            if(!empty($_SESSION["cart_retpcs"])){
					$itemcheck=$_SESSION['cart_retpcs'];
					if(in_array($itemcode1, array_column($itemcheck, 'code'))) {
    					
					}else{
						$_SESSION['cart_retpcs']=array_merge($_SESSION['cart_retpcs'],$itemArray);
					}
				}else{
					$_SESSION["cart_retpcs"] = $itemArray;
				}


          }//while

        $grandtotal=0;
		$totItem=0;

    	echo '<html>
				<head>
				<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
				<link rel = "stylesheet" type = "text/css" href = "css/list_row.css" />
				<link rel = "stylesheet" type = "text/css" href = "css/tablereturn.css" />
				<link rel = "stylesheet" type = "text/css" href = "css/badge_cart.css" />
				<link href="https://fonts.googleapis.com/css?family=Alegreya Sans SC" rel="stylesheet">
				</head>
				<body>
				 
				<div>';
					
    	
    	foreach ($_SESSION["cart_retpcs"] as $item)
    	{
?>
		
		<form action="retpcsdetail.php?action=addret" method="post">
		
<?php 
				
					echo '<div class="row">';
					echo '<div style="padding:10px;">'.$item['code'].'</div>';
					echo '<div style="padding:10px;">'.$item["name"].'</div>'; 
					
					echo '<input type="text" name="itemcode" value="'.$item['code'].'"  hidden/>';
					echo '<input type="text" name="itemname" value="'.$item['name'].'"  hidden/>';
					$disc1=$item['disc1'];
					$disc2=$item['disc2'];
					$disc3=$item['disc3'];

					$mysubtotal= $item["qty"] * $item["price"];
					$totaldisc1 = $mysubtotal*(1-($item['disc1']/100));
					$totaldisc2 = $totaldisc1*(1-($item['disc2']/100));
					$totaldisc3 = $totaldisc2-$item['disc3'];
        			
        			if($disc1<>0 || $disc2<>0 || $disc3<>0){
        				$totaldisc1ex=$mysubtotal*$disc1/100;
						$subtotaldisc1=$mysubtotal-$totaldisc1ex;
						$totaldisc2ex=$subtotaldisc1*($disc2/100);
						$subtotaldisc2=$subtotaldisc1-$totaldisc2ex;

					$gtotaldisc=$totaldisc1ex+$totaldisc2ex-$disc3;
        				echo '<div style="padding:10px;">'.$item["qty"].' x '.number_format($item["price"]).'</div>';
        				echo '<div style="padding:10px;">DISCOUNT  '.number_format($gtotaldisc).'</div>';

						echo '<div style="padding:10px;">SUB TOTAL&nbsp&nbsp&nbsp&nbsp&nbsp'.number_format($totaldisc3).'</div>';
					}else{
						echo $item["qty"].' x '.number_format($item["price"]);
						echo '<div><hr></div>';
						echo 'SUB TOTAL&nbsp&nbsp&nbsp&nbsp&nbsp'.number_format($totaldisc3);
					}

					/*echo '<div class="card-text">Rp. '.number_format($mysubtotal,0).'</div>';
					echo '<div class="card-text">'.number_format($item['disc1'],2).'</div>';
					echo '<div class="card-text">'.number_format($item['disc2'],2).'</div>';

					echo '<div class="card-text">'.$item['disc3'].'</div>';
					echo '<div class="card-text">'.number_format($totaldisc3).'</div>';*/

					echo '<div style="padding:10px;"><input type="number" name="qtyret" style="width:40px; text-align:center; font-size:20px;color:red;font-weigth:bold;" placeholder="1"></div>';
					echo '<input type="submit" name="retsubmit" value="Add to Cart" style="paddding-left:30px;text-decoration:none;color:white;font-size:14px;border-style:none; border-radius:5px;height:30px; background-color:green;" >';
				echo '</div></form>';
									
		

        		$totItem++;
				$grandtotal=$grandtotal+$totaldisc3;
				$_SESSION['totalcart']=$grandtotal;


		}//for each show array

		echo '</div></div>
			<div><hr></div>

			<div align="right" style="font-size:28px;font-weigth:bold;align:right;">'.number_format($grandtotal).'<div>
			<div align="right" style="font-size:28px;font-weigth:bold;align:right;">'.number_format($totItem).' Item(s)</div></body>';




?>



</html>



