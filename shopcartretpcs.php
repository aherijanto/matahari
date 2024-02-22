<html>
<head>
</head>
<body>
<?php
ob_start();
session_start();
include "class/_parkerpurchase.php";
include "class/_parkerinvent.php";

if (!empty($_GET['action'])){
	switch ($_GET['action']) {
		case 'back':
			echo '<script> window.open("retpcsdetail.php","_self");</script>';
			header("Location: retpcsdetail.php");			
			break;
		case 'save':
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
					unset($_SESSION["cart_pcsreturn"]);
					echo '<script> window.open("retpcs.php","_self");</script>';
					header("Location: retpcs.php");	//
			}
			break;

		case 'clear':
			unset($_SESSION["cart_pcsreturn"]);
			header("Location: retpcs.php");			
			break;
		case 'remove':
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

	}
}


	if(!empty($_SESSION["cart_pcsreturn"])){
		
			echo '<br/><br/><div><table width="100%" >
				  <th align="left" width="100px" style="background-color:#F5B7B1;">BARCODE</th>
				  <th align="center" style="background-color:#F5B7B1;">ITEM NAME</th>
				  <th align="center" style="background-color:#F5B7B1;">QTY</th>
				  <th align="center" style="background-color:#F5B7B1;">ACTION</th>';

			foreach ($_SESSION["cart_pcsreturn"] as $itemRet)
    		{

					echo '<tr>';
					echo '<td>'.$itemRet['code'].'</td>';
					echo '<td>'.$itemRet["name"].'</td>'; 
					echo '<td align="center">'.$itemRet["qty"].'</td>';
?>
					<td align="center" style="padding-top: 22px;"><a href="/shopcartretpcs.php?action=remove&codetr=<?php echo $itemRet["code"]; ?>" style="color:white;background-color:  #8e44ad; border-radius: 5px;text-decoration: none;padding: 10px 5px;margin:5px;">Remove Item</a></td>
<?php
					echo '</tr>';	

			}//

			echo '</table></div>';
			echo '<hr/>';
			echo '<div align="right" style="margin-top:20px;"><a id="btnNew" href="/shopcartretpcs.php?action=back" style="color:white;background-color:   #2874a6   ; border-radius: 5px;text-decoration: none;padding: 10px; font-size: 16px;" width="120px">Back</a>     
			<a id="btnEmpty" href="/shopcartretpcs.php?action=save" style="color:white;background-color: #229954; border-radius: 5px;text-decoration: none;padding: 10px;font-size: 16px;">Save</a> 
			<a id="btnEmpty" href="/shopcartretpcs.php?action=clear" style="color:white;background-color:  #cb4335  ; border-radius: 5px;text-decoration: none;padding: 10px;font-size: 16px;">Clear</a>';
			echo '</div>';
		}else{
			echo 'No data';
		}
	
?>
	
</body>
</html>
