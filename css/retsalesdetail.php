<?php
session_start();

if (!empty($_GET['action'])){
	switch ($_GET['action']) {
		case 'addret':
			if (isset($_POST['retsubmit'])){
				$noBarcode=$_POST['itemcode'];
				$itemName=$_POST['itemname'];
				$qtyReturn=$_POST['qtyret'];

								$itemArrayRet = array($noBarcode=>array('code'=>$noBarcode,'name'=>$itemName,'qty'=>$qtyReturn));

            	if(!empty($_SESSION["cart_return"])){
					$itemcheck=$_SESSION['cart_return'];
					if(in_array($noBarcode, array_column($itemcheck, 'code'))) {
    					
					}else{
						$_SESSION['cart_return']=array_merge($_SESSION['cart_return'],$itemArrayRet);
					}
				}else{
					$_SESSION["cart_return"] = $itemArrayRet;
				}

			}		
			break;
		
		
	}





	
}

if(!empty($_GET['invtext'])){
	$myinv=$_GET['invtext'];
	$_SESSION['myinv']=$myinv;
	//$myinvsession=$_SESSION['myinv'];
}
	try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=utama', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }

       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob="SELECT * FROM wselltail WHERE s_code='$myinvsession'";
                $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtpcsGlob->execute();
                $totalpcsGlob = $stmtpcsGlob->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

         $itemcode1=$_SESSION['myinv'];
         echo '<table width="100%">';
         echo '<tr style="background-color:#1565C0;color:white;border-radius:3px;font-weigth:bold;"><td width="auto" style="color:white;font-weigth:bold">'.$_SESSION['myinv'].'</td>';
         echo '<form action="retsales.php" method="post"><td align="right" styles="paddding-left:10px;">
         <input align="right" type="submit" value="Cancel" name="retCancel" style="background-color:red;color:white;paddding:10px;border:none;align:right;border-radius:3px;width:100px;height:40px;">';
         echo '</td></form></tr></table>';

         while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
            $barcode=$rowpcsGlob->i_code;
            $itemname=$rowpcsGlob->i_name;
            $itemqty=$rowpcsGlob->i_qty;
            $itemprice=$rowpcsGlob->i_sell;
            $itemdisc1=$rowpcsGlob->i_disc1;
            $itemdisc2=$rowpcsGlob->i_disc2;
            $itemdisc3=$rowpcsGlob->i_disc3;

            
            $itemArray = array($barcode=>array('code'=>$barcode,'name'=>$itemname,'qty'=>$itemqty,'price'=>$itemprice,'disc1'=>$itemdisc1,'disc2'=>$itemdisc2,'disc3'=>$itemdisc3));

            if(!empty($_SESSION["cart_retsales"])){
					$itemcheck=$_SESSION['cart_retsales'];
					if(in_array($itemcode1, array_column($itemcheck, 'code'))) {
    					
					}else{
						$_SESSION['cart_retsales']=array_merge($_SESSION['cart_retsales'],$itemArray);
					}
				}else{
					$_SESSION["cart_retsales"] = $itemArray;
				}


          }//while

        $grandtotal=0;
		$totItem=0;

    	echo '<html>
				<head>
				<link rel = "stylesheet" type = "text/css" href = "css/retsales.css" />
				<link rel = "stylesheet" type = "text/css" href = "css/tablereturn.css" />
				</head>
				<body>
				<div class="flex-containermf">';
					
    	
    	foreach ($_SESSION["cart_retsales"] as $item)
    	{
?>
		
		<form action="retsalesdetail.php?action=addret" method="post">
		
<?php 
				//echo '<div>';
					echo '<div class="cards-item">';
					echo '<div class="card-texttitle">'.$item['code'].'</div>';
					echo '<div class="card-textname">'.$item["name"].'</div>'; 
					
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
        				echo '<div class="card-textname">'.$item["qty"].' x '.number_format($item["price"]).'</div>';
        				echo '<div class="card-textname">DISCOUNT  '.number_format($gtotaldisc).'</div>
						 <div><hr></div>
						<div class="card-texttotal" align="right">SUB TOTAL&nbsp&nbsp&nbsp&nbsp&nbsp'.number_format($totaldisc3).'</div>';
					}else{
						echo '<div class="card-textname">'.$item["qty"].' x '.number_format($item["price"]).'</div>
						<div><hr></div>
						<div class="card-texttotal" align="right">SUB TOTAL&nbsp&nbsp&nbsp&nbsp&nbsp'.number_format($totaldisc3).'</div>';
					}

					/*echo '<div class="card-text">Rp. '.number_format($mysubtotal,0).'</div>';
					echo '<div class="card-text">'.number_format($item['disc1'],2).'</div>';
					echo '<div class="card-text">'.number_format($item['disc2'],2).'</div>';

					echo '<div class="card-text">'.$item['disc3'].'</div>';
					echo '<div class="card-text">'.number_format($totaldisc3).'</div>';*/

					echo '<br/><br/><div align="center">INPUT QTY RETURN<br/><input type="number" name="qtyret" style="width:40px; text-align:center; font-size:20px;color:red;font-weigth:bold;" placeholder="1"></div>';
					echo '<div align="center" class="card-processdiv">
							<input type="submit" name="retsubmit" value="Process" style="text-decoration:none;color:white;font-size:20px;border-style:none; background-color:transparent;">
							</div>';
				echo '</div></form>';
									
		

        		$totItem++;
				$grandtotal=$grandtotal+$totaldisc3;
				$_SESSION['totalcart']=$grandtotal;


		}//for each show array

		echo '</div>
			<div><hr></div>

			<div align="right" style="font-size:28px;font-weigth:bold;align:right;">'.number_format($grandtotal).'<div>
			<div align="right" style="font-size:28px;font-weigth:bold;align:right;">'.number_format($totItem).' Item(s)</div></body>';

#----------------------------------------------------------------------------------------------------------------------------------

		if (!empty($_SESSION['cart_return'])){

		
			echo '<br/><br/><div><table width="100%" >
				  <th align="left" width="100px" style="background-color:#F5B7B1;">BARCODE</th><th align="center" style="background-color:#F5B7B1;"">ITEM NAME</th><th align="center" style="background-color:#F5B7B1;">QTY</th>';
			foreach ($_SESSION["cart_return"] as $itemRet)
    		{

					echo '<tr>';
					echo '<td>'.$itemRet['code'].'</td>';
					echo '<td>'.$itemRet["name"].'</td>'; 
					echo '<td align="center">'.$itemRet["qty"].'</td>';
					echo '</tr>';
									
		

        		

			}//

			echo '</table></div>';
		}


?>



</html>



