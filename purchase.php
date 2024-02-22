<?php
ob_start();
session_start();
date_default_timezone_set('Asia/Jakarta');
error_reporting(E_ALL);
ini_set("display_errors","On");
//if (isset($_SESSION['user'])!="" ){
$_SESSION['reports']='0';
include "class/_parkerpurchase.php";
include "class/_parkerinvent.php";

include 'class/number.php';

//$t_number="";
//$icode="";
$itemcode1="";
//$t_cust="";



//$db_handle = new DBController();
$item_total = 0;



if (isset($_SESSION["scode"])){
	$_SESSION["scode"]=$_SESSION['scode'];
}else
	{$_SESSION["scode"]='';
}

function subtotal($qty,$price)
{
$subtotal1=0;
 $subtotal1 = $qty * $price;
return $subtotal1;
}

if(!empty($_GET["action"]))
{
	switch($_GET["action"])
	{
		case "new":
			unset($_SESSION["cart_item"]);
				unset($_SESSION["myrefno"]);
				unset($_SESSION["invdue"]);
				unset($_SESSION["xdate"]);
				unset($_SESSION["scode"]);
				unset($_SESSION["invno"]);


			$_SESSION["xdate"]=date('Y-m-d');

			$_SESSION["invdue"]=date('Y-m-d');
			$_SESSION["myrefno"]='';
			$_SESSION["myinvno"]='';
			$_SESSION["scode"]='';
			break;

		case "add":
			if (isset($_POST['addtolist']))
			{
				$itemcode1=$_POST['code'];
				$barcode1=$_POST['barcode'];
				$tglexp=$_POST['tglexp'];

				if ($tglexp==''){
					$tglexp=date('Y-m-d');
				}
				else{
					$tglexp=$_POST['tglexp'];
					}

				$disc1=$_POST['disc1'];//discpersen
				$disc2=$_POST['disc2'];
				$disc3=$_POST['disc3'];//discrp
				if ($disc1=='') {
					$disc1=0;
				}

				if ($disc2=='') {
					$disc2=0;
				}

				if ($disc3=='') {
					$disc3=0;
				}

				if ($disc3 == '0'){
					$disc3 = $disc1 * $_POST['cogs']/100;
				}
			
				if ($disc1 == '0'){
					$disc1 = $disc3 / $_POST['cogs']*100;
				}
				//echo $_POST['code'];
				//echo '<br/>'.$_POST['barcode'];
				//echo '<br/>'.$_POST["qty"];

				//echo $_POST['groupitem'];
				//echo $itemcode1;
				$itemArray = array($itemcode1=>array('barcode'=>$_POST["barcode"],'code'=>$_POST["code"],'name'=>$_POST['itemname'], 'qty'=>$_POST["qty"],'cogs'=>$_POST["cogs"],'disc1'=>$disc1,'disc2'=>0,'disc3'=>$disc3,'tglexp'=>$tglexp));


					if(!empty($_SESSION["cart_item"]))
					{
						if(in_array($itemcode1,$_SESSION["cart_item"]))
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
								$_SESSION["cart_item"] = array_merge($_SESSION["cart_item"],$itemArray);
							}
					} else
						{
							$_SESSION["cart_item"] = $itemArray;
						}


			}
			break;

		case "remove":
				if(isset($_SESSION["cart_item"]))

			{

				foreach($_SESSION["cart_item"] as $k=>$v)
				{

					if($_GET["codetr"] == $_SESSION["cart_item"][$k]["barcode"]){

				//		echo "<script type='text/javascript'>alert('ifff');</script)";
						unset($_SESSION["cart_item"][$k]);
					}

				if(empty($_SESSION["cart_item"])){
					unset($_SESSION["cart_item"]);
					}
				}
			}


						break;


		case "save":

			if(!empty($_SESSION["cart_item"]))
			{
				$myinvno=$_SESSION['myinvno'];
				$myrefno=$_SESSION['myrefno'];
				$mydate1=$_SESSION['xdate'];
				$mydateon=$_SESSION['invdue'];
				$mysupp=$_SESSION['scode'];
				$myuser=$_SESSION['user'];

				if ($myrefno == ''){
					echo '<script>
							alert("Kolom Reference No Harus Diisi...");
						  </script>';
					
					header('Location:purchase.php?action=new');
				}

				if ($mysupp == ''){
					echo '<script>
							alert("Kolom Supplier Harus Diisi...");
						  </script>';
					
					header('Location:purchase.php?action=new');
				}

				$purchasing = new Purchase($myinvno,$myrefno,$mydate1,$mydateon,$mysupp,$myuser,'0','0','0','0','0','0','0','0','0');
				$purchasing->save_purchase_head();

				var_dump($myinvno);
				foreach($_SESSION["cart_item"] as $myItem)
				{
						$myInvNo=$myinvno;
						$myItemCode= $myItem["code"];//
						$myBarcode=$myItem["barcode"];
						$myItemName= $myItem["name"];
						$myQty= $myItem["qty"];//$_SESSION["cart_item"][$k]["name"];
						$myPrice=$myItem["cogs"];
						$myDisc1=$myItem["disc1"];
						$myDisc2=$myItem["disc2"];
						$myDisc3=$myItem["disc3"];
						$myExp=$myItem["tglexp"];
						
						echo $myInvNo.'-'.$myItemCode.'-'.$myBarcode;
						$purchaseDetail = new Purchase($myInvNo,$myrefno,$mydate1,$mydateon,$mysupp,$myuser,$myItemCode,$myBarcode,$myItemName,$myQty,$myPrice,$myDisc1,$myDisc2,$myDisc3);
						$purchaseDetail->save_purchase_tail($myExp);

						/*UPDATE INVENTORY*/
						$myinvent=new Inventory('','','','','','','','','','','','','','','','','','','','','','','','','','');
						$myinvent->update_inventory_purchase($myItemCode,$myQty);
				}
				
				header ("Location:printpurchase.php?invno=$myInvNo");
				unset($_SESSION["cart_item"]);
				unset($_SESSION["myrefno"]);
				unset($_SESSION["invdue"]);
				unset($_SESSION["xdate"]);
				unset($_SESSION["scode"]);
				unset($_SESSION["invno"]);
				$_SESSION["xdate"]=date('Y-m-d');
				$_SESSION["invdue"]=date('Y-m-d');
				$_SESSION["myrefno"]='';
				$_SESSION["myinvno"]='';
				$_SESSION["scode"]='';
			}
				break;
		case "empty":
			unset($_SESSION["cart_item"]);

		break;
	}

}
?>

<html >
 <head>
 <?php
        require_once('./assets/requires/config.php');
        require_once('./assets/requires/header1.php');
    ?> 

<script type="text/javascript">
function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blah')
                  .attr('src', e.target.result)
                  .width(150)
                  .height(100);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
  </script>

<style type="text/css">
.auto-style1 {
	font-family: Calibri;
	font-size:medium;
}
.auto-style2 {
	border-style: none;
	border-color: inherit;
	border-width: 0;
	color: #D60202;
	padding: 2px 10px;
	font-size: small;
}
.auto-style3 {
	font-family: Calibri;
	font-size: medium;

}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;

    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<style>

			html {
               background-color: white;
             }
             .card__image {
               background-position: center center;
               background-repeat: no-repeat;
               background-size: cover;
               border-top-left-radius: 0.25rem;
               border-top-right-radius: 0.25rem;
               max-width: 220px;
               max-height: 100px;

               filter: contrast(70%);
               //filter: saturate(180%);
               overflow: hidden;
               position: relative;
               transition: filter 0.5s cubic-bezier(.43,.41,.22,.91);;
               &::before {
                 content: "";
             	  display: block;
                 padding-top: 56.25%; // 16:9 aspect ratio
               }

               @media(min-width: 40rem) {
                 &::before {
                   padding-top: 66.6%; // 3:2 aspect ratio
                 }
               }
             }

             .card__image--customer {
               background-image: url("customer.png");
             }
             .card {
               background-color: white;
               border-radius: 0.25rem;
               box-shadow: 0 30px 60px -14px rgba(0,0,0,0.25);

             }

               .cards {
                 display:flex;
                 flex-wrap: wrap;
                 list-style: none;
                 margin: 0;
                 padding: 0;
               }
               .cards__item {
                 display: flex;
                 padding: 1rem;
                 @media(min-width: 40rem) {
                   width: 50%;
                 }

             .card:hover {
               box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
             }

             img {
               border-radius: 5px 5px 0 0;
             }

             .container {
               padding: 2px 16px;

               .card__title {
                 color: @gray-dark;
                 font-size: 1.25rem;
                 font-weight: 300;
                 letter-spacing: 2px;
                 text-transform: uppercase;
               }

               .card__text {
                 flex: 1 1 auto;
                 font-size: 0.875rem;
                 line-height: 1.5;
                 margin-bottom: 1.25rem;
               }
 </style>

<body bgcolor="#FFFAF1">
	<div>
		<table height="40px" width="100%">
		<tr><td bgcolor="#FFBD33" align="center">PURCHASING</td></tr>
		</table>
	</div>


	<div>

	<form action="" method="post">

		<?php
			if (isset($_POST['invdate'])){
					$mydateM=strtotime($_POST['invdate']);
					$mydateconvert=date('Y-m-d',$mydateM);
					$_SESSION['xdate']=$mydateconvert;
					//$_SESSION['scode']=$_POST['mysupp'];
					$myRandNo=rand(10000,99999);
					$mydaternd=date('Ymd',$mydateM);
					$xdate='PCS'.$mydaternd.$myRandNo;
					$_SESSION['myinvno']=$xdate;
				}

			if (isset($_POST['mysupp'])){
					$_SESSION['scode']=$_POST['mysupp'];
				}

			if (isset($_POST['invdue'])){
					$mydateD=strtotime($_POST['invdue']);
					$mydateconvertD=date('Y-m-d',$mydateD);
					$_SESSION['invdue']=$mydateconvertD;
					$_SESSION['myinvno']=$xdate;
				}

			if (isset($_POST['myrefno'])){
				$_SESSION['myrefno']=$_POST['myrefno'];
			}
		?>

		<table width="100%" font="calibri">
		<th>INVOICE NO</th><th>REFERENCE NO</th><th>INVOICE DATE</th><th>DUE DATE</th><th>SUPPLIER</th>
		<tr>
			<td align="center"><input type="text" name="invno" value="<?php echo $_SESSION['myinvno']; ?>"  readonly/></td>

			<td align="center"><input type="text" name="myrefno" onblur="this.form.submit();" value="<?php echo $_SESSION['myrefno']; ?>" /></td>



			<td align="center"><input type="date" name="invdate" id="invdate" onchange="this.form.submit();" value="<?php echo $_SESSION['xdate']; ?>" /></td>


			<td align="center"><input type="date" name="invdue"  id="invdue" onchange="this.form.submit();" value="<?php echo $_SESSION['invdue']; ?>"/></td>


			<?php

				include ('class/_parkerconnection.php');

					$group_param='c_code';

					try
					{
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM wsuppliers ORDER BY s_code";
							$stmt = $pdo->prepare($sql);
							//$stmt->bindParam(':c_order', $group_param, PDO::PARAM_STR);
							$stmt->execute();
							$total = $stmt->rowCount();
					} catch(PDOException $e) {
								echo $e->getMessage();
						}

				echo '<td align="center"><select name="mysupp" id="mysupp" onchange="this.form.submit();" >
				<option value=""  disabled selected> Select Supplier...</option>';

				while ($row = $stmt->fetchObject()) {
							//echo $row->c_code;
							$mycode=$row->s_code;
				?>
							<option value="<?php echo $mycode ?>" <?php if( $mycode == $_SESSION['scode'] ): ?>  selected="selected" <?php endif;?>><?php echo $row->s_name ?></option>
				<?php
					 }
					echo '</td>';
				?>
		</tr>
		</table>
		</form>
		<br/>
		<div class="txt-heading"><a id="btnNew" href="/purchase.php?action=new" style="color:white;background-color:   #2874a6   ; border-radius: 5px;text-decoration: none;padding: 10px">New</a>     <a id="btnEmpty" href="/purchase.php?action=save" style="color:white;background-color: #229954; border-radius: 5px;text-decoration: none;padding: 10px">Save</a> <a id="btnEmpty" href="/purchase.php?action=empty" style="color:white;background-color:  #cb4335  ; border-radius: 5px;text-decoration: none;padding: 10px">Clear</a>
	</div>
	</div>
<div class="product-item">

<table>
	<th>SEARCH BY ID</th><th>SEARCH BY NAME</th>
	<tr>
		<td align="center">
			<form method="post" action="/purchase.php?action=search" >
				<input name="itemcode" type="text" align="center" id="itemcode"><input type="submit" name="idsubmit" value="Search ID" />
			</form>
		</td>
		<td align="center">
			<form method="post" action="/purchase.php?action=search" >
				<input name="itemname" type="text" align="center" id="itemname"><input type="submit" name="namesubmit" value="Search Name" />
			</form>
		</td>
	<tr>
</table>
</div>


<hr/>
<div id="shopping-cart">


<?php

if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>
<table cellpadding="10" cellspacing="1" width="100%">
<tbody>
<tr>
<th align="center" class="auto-style1"><strong>KODE BARANG</strong></th>
<th class="auto-style1"><strong>NAMA BARANG</strong></th>
<th class="auto-style1"><strong>QTY</strong></th>
<th class="auto-style1"><strong>HARGA</strong></th>
<th class="auto-style1"><strong>JUMLAH</strong></th>
<th class="auto-style1"><strong>DISC #1</strong></th>
<th class="auto-style1"><strong>DISC #2</strong></th>
<th class="auto-style1"><strong>DISC #3</strong></th>
<th class="auto-style1"><strong>TGL.EXP</strong></th>
<th class="auto-style1"><strong>SUBTOTAL</strong></th>
<th class="auto-style1"><strong>ACTION</strong></th>
</tr>
<?php
$grandtotal=0;
    foreach ($_SESSION["cart_item"] as $item){
		?>

				<tr>
				<td class="auto-style3"><strong><?php echo $item["barcode"]; ?></strong></td>
				<td align="left" class="auto-style3"><?php echo $item["name"]; ?></td>
				<td align="center" class="auto-style3"><?php echo $item["qty"]; ?></td>
				<td align="right" class="auto-style3"><?php echo "Rp. ".number_format($item["cogs"]); ?></td>
				<?php
					$mysubtotal=0;
					$mysubtotal=subtotal($item['qty'],$item['cogs']);
					$totaldisc3 = $mysubtotal - ($item['qty']*$item['disc3']);
				?>

				<td align="right" class="auto-style3"> <?php echo 'Rp. '.number_format($mysubtotal,0); ?> </td>
				<td align="right" class="auto-style3"><?php echo number_format($item["disc1"],2); ?></td>
				<td align="right" class="auto-style3"><?php echo number_format($item["disc2"],2); ?></td>
				<td align="right" class="auto-style3"><?php echo number_format($item["disc3"],2); ?></td>
				<td align="right" class="auto-style3"><?php echo $item["tglexp"]; ?></td>
				<td align="right" class="auto-style3"><?php echo number_format($totaldisc3); ?></td>
				<td align="center" class="auto-style3"><a href="/purchase.php?action=remove&codetr=<?php echo $item["barcode"]; ?>" class="auto-style2" style="color:white;background-color:  #8e44ad; border-radius: 5px;text-decoration: none;padding: 10px">Remove Item</a></td>



				</tr>

				<?php

				$grandtotal=$grandtotal+$totaldisc3;

		}
		?>
				<tr>
					<td colspan="11" align="right" class="auto-style3"><font size="18" ><?php echo number_format($grandtotal); ?></font></td>
				</tr>
</tbody>
</table>
  <?php
}
?>
</div>
<br/>
<?php

if($_GET["action"]='search'){
       if (isset($_POST['idsubmit']))
        {

            $i_code=$_POST['itemcode'];
            //$mcode=$i_code.'%';

            include ('class/_parkerconnection.php');

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM winventory WHERE i_barcode LIKE '%$i_code%'";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
       	}

       	if (isset($_POST['namesubmit']))
        {
            $i_name=$_POST['itemname'];
			include ('class/_parkerconnection.php');

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `winventory` WHERE i_name LIKE '%$i_name%'";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_name', $mname, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
         }

           echo '<html><table width="100%;">';
             while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $mycode=$row->i_code;
               $mygroup=$row->g_code;
               $mycogs=$row->i_cogs;
               $myqty=$row->i_qty;
               $itemname=$row->i_name;
               $ibarcode=$row->i_barcode;
              	echo '<tr><form method="post" action="purchase.php?action=add">';
                echo '<td width="100px">'.$mycode.'</td><input type="hidden" name="code" value="'.$mycode.'" />';
                echo '<td width="100px">'.$ibarcode.'</td><input type="hidden" name="barcode" value="'.$ibarcode.'" />';
                echo '<td width="250px">'.$itemname.'</td><input type="hidden" name="itemname" value="'.$itemname.'" />';


                echo '<td width="80px" align="center"><input type="text" name="qty" style="text-align: center;width:80px;" value="1" autofocus/></td>';
                echo '<td width="100px" align="center"><input type="text" name="cogs" style="text-align: center;width:100px;" value="'.$mycogs.'"/></td>';
                echo '<td width="50px" align="center"><input type="text" name="disc1" style="text-align: center;width:200px;" placeholder="disc%"/></td>';
                echo '<td width="50px"align="center"><input type="text" name="disc2" style="text-align: center;width:20px;" value="0" readonly /></td>';
                echo '<td width="50px" align="center"><input type="text" name="disc3" style="text-align: center;width:200px;" placeholder="discRp"/></td>';
                echo '<td width="100px" align="center"><input type="date" name="tglexp" /></td>';
               	echo '<td><input type="submit" name="addtolist" style="text-align: center;" value="Add to cart"/></td>';
               	echo '</tr></form>';
                }
              echo '</table></html>';
}
?>

</body>
 </head>
</html>
