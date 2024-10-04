<?php

session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
//if (isset($_SESSION['user'])!="" ){

include "class/_parkersalesar.php";
include "class/_parkerinvent.php";
include 'menuhtml.php';
include 'class/number.php';

$t_number="";
$icode="";
$itemcode="";
$t_cust="";

//$db_handle = new DBController();
$item_total = 0;

if (isset($_GET['c_code']))
{
  $mycode=$_GET['c_code'];
  $_SESSION['mycust']=$mycode;
  $_COOKIE['mycust']=$mycode;
  $t_cust=$_SESSION['mycust'];

}


if (isset($_POST["potbtn"])){
	if(!empty($_POST["potongan"]) || !empty($_POST["premi"])){
				$_SESSION["potongan"]=$_POST["potongan"];
				$_SESSION["premi"]=$_POST["premi"];
			}else {
				$_SESSION["potongan"]=0;
				$_SESSION["premi"]=0;
				}
}

function noinv()
{

$noinv="Generated Automatically";//SL".date('Ymd').".".rand(9999,100000);
return $noinv;
}



function mycustexist()
{
	if (!isset($_SESSION['mycust']))
				{
					echo "Process cannot continue, customer code is empty";
					exit();
					echo '<a href="searchengine1.php">Back to Home</a>';
					$_SESSION['mycust]']='';
				}
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
			unset($_SESSION["discvol"]);
			unset($_SESSION["invdate"]);
			unset($_SESSION["myrefno"]);

			$_COOKIE["invdate"]=date('m/d/Y');
			$_SESSION["invdate"]=date('m/d/Y');
			$_COOKIE["invdue"]=date('m/d/Y');
			$_SESSION["invdue"]=date('m/d/Y');
			$_SESSION['premi']=0;
			$_SESSION['potongan']=0;
			$_SESSION['mycust']="";
			break;
		case "updatearray":

				if (isset($_POST['qtysubmit']))
				{
	
					if ($_POST['xqty']!=''){
	
	
					   foreach ($_SESSION["cart_item"] as $key => &$val) {
	
						  if($_GET["codetr"] == $_SESSION["cart_item"][$key]["code"]){
	
					//		echo "<script type='text/javascript'>alert('ifff');</script)";
							$_SESSION["cart_item"][$key]['qty'] = $_POST['xqty'];
							$_SESSION["cart_item"][$key]['disc1'] = $_POST['xdisc1'];
							$_SESSION["cart_item"][$key]['disc2'] = $_POST['xdisc2'];
							$_SESSION["cart_item"][$key]['disc3'] = $_POST['xdisc3'];
							//unset($_SESSION["cart_item"][$k]);
						}
							// Add this
						}
					}
	
				}
	
				break;
	

		case "add":
			if (isset($_POST['addtolist']))
			{

			if(!empty($_POST["qty"]))
			{


				$group=$_POST['groupitem'];
				$itemcode1=$_POST['code'];
				//$imgfile=$_POST['imgfile'];

				//echo $_POST['groupitem'];
				//echo $itemcode1;
				$itemArray = array($itemcode1=>array('group'=>$_POST['groupitem'],'name'=>$_POST['itemname'],'code'=>$itemcode1, 'qty'=>$_POST["qty"],'cogs'=>$_POST['cogs'],'disc1'=>0,'disc2'=>0,'disc3'=>0));//,'weight'=>$_POST['weight']));//'imgfile'=>$imgfile));



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
			$itemcode1='';
			$imgfile='';
			break;
			}
		case "remove":
			if(!empty($_SESSION["cart_item"]))
			{
				foreach($_SESSION["cart_item"] as $k => $v)
				{
					if($_GET["code"] == $k)
						unset($_SESSION["cart_item"][$k]);
					if(empty($_SESSION["cart_item"]))
						unset($_SESSION["cart_item"]);
				}
			}
			break;


		case "save":

			if(!empty($_SESSION["cart_item"]))
			{

			mycustexist();

			$myinvno=setnumber('wsellarhead');
			$t_cust=$_SESSION['mycust'];
			//$myinvno="SL".date('ymd').".".rand(9999,100000);
			$mydate1=date('Y-m-d');
			//$mydateon=date(strtotime($_SESSION['invdate'],'Y-m-d');

			$mydateon=$_SESSION['invdate'];
			$myuser=$_SESSION['user'];
			$mysupp='debt';

			//$_SESSION["refno"]=$_COOKIE["refno"];



				$mypremi=$_SESSION['premi'];

				$mydeduct=$_SESSION['potongan'];



			$sales = new Sales($myinvno,$mydate1,$mydate1,$t_cust,$myuser,$mypremi,$mydeduct,'0','0','0','0','0','0','0');
			//
			$sales->save_sell_head();


			foreach($_SESSION["cart_item"] as $myitem) {
				//if($productByCode[0]["itemcode"] == $k)

					$mygroup=$myitem['group'];
					
					$myItemCode= $myitem["code"];//$_SESSION["cart_item"][$k]["code"];//$productByCode[0]["itemcode"];
					$myItemName= $myitem["name"];//$_SESSION["cart_item"][$k]["name"];
					$myPrice=$myitem["cogs"];
					

					$myQty= $myitem["qty"];//$_SESSION["cart_item"][$k]["quantity"];
				
					$myDisc1=0;//$myItem["disc1"];
					$myDisc2=0;//$myItem["disc2"];
					$myDisc3=0;//$myItem["disc3"];
					$salesdetail = new Sales($myinvno,$mydate1,$mydateon,$mysupp,$myuser,'0','0',$myItemCode,$myItemName,$myQty,$myPrice,$myDisc1,$myDisc2,$myDisc3);

					$salesdetail->save_sell_tail();
					

					/*UPDATE INVENTORY*/
					$myinvent=new Inventory('','','','','','','','','','','','','','','','');
					$myinvent->update_inventory($myItemCode,$myQty);

					//$mysub=$myprice*$myqty;
					//$itemtotal=$itemtotal+$mysub;

			}
			header ("Location:printsales.php?invno=$myinvno");


		unset($_SESSION["cart_item"]);
		unset($_SESSION["discvol"]);

		unset($_SESSION["invdate"]);
		unset($_SESSION["mycust"]);
		$_SESSION['premi']=0;
		$_SESSION['potongan']=0;



		}


		case "empty":
		unset($_SESSION["cart_item"]);
		unset($_SESSION["discvol"]);
		unset($_SESSION["myrefno"]);
		unset($_SESSION["invdate"]);
		unset($_SESSION["mycust"]);
		$_SESSION['premi']=0;
		$_SESSION['potongan']=0;

		break;
	}

}
?>



<html >
 <head>
 	<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script type"text/javascript">
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
		<tr><td bgcolor="#FFBD33" align="center">CREATE YOUR SALES</td></tr>
		</table>
	</div>


	<div>

		<table width="100%" font="calibri">
		<th>INVOICE NO</th><th>INVOICE DATE</th><th>DUE DATE</th><th>CUSTOMER</th>
		<tr><td align="center"><input type="text" name="invno" value="<?php echo noinv();?>"  readonly/></td>


			<script type="text/javascript">
				function myrefno() {
					var x = document.getElementById("refno");
					document.cookie="myrefno=" + x.value;
					//document.getElementById('jsform').submit();
				}

				function myinvdate() {
					var dateinv = document.getElementById("invdate");
					document.cookie="invdate=" + dateinv.value;
					//document.getElementById('jsform').submit();
				}

				function myinvdue() {
					var datedue = document.getElementById("invdue");
					document.cookie="invdue=" + datedue.value;
					//document.getElementById('jsform').submit();
				}



			</script>

			<?php
				function myblurvalue(){
					if (isset($_COOKIE["myrefno"]))
					{
						//echo 'cookie id:'.$_COOKIE["myrefno"];
						$_SESSION["myrefno"]=$_COOKIE["myrefno"];
						//echo '<br/>session id:'.$_SESSION["myblur1"];
						$t_number=$_SESSION["myrefno"];
						echo $t_number;
					}
					else{
						$_COOKIE["myrefno"]="";
						$_SESSION["myrefno"]="";
						$t_number=$_SESSION["myrefno"];
						echo $t_number;
					}
					//return $t_number;
				}
			?>

			<td align="center"><input type="date" name="invdate" id="invdate" onblur="myinvdate()" value="<?php mydateinv(); ?>" /></td>

			<?php
				function mydateinv(){
					if (isset($_COOKIE["invdate"]))
					{
						//echo 'cookie id:'.$_COOKIE["myrefno"];
						$_SESSION["invdate"]=$_COOKIE["invdate"];
						//echo '<br/>session id:'.$_SESSION["myblur1"];
						$t_invdate=$_SESSION["invdate"];
						echo $t_invdate;
					}
					else{
						$_COOKIE["invdate"]=date('m/d/Y');
						$_SESSION["invdate"]=date('m/d/Y');

					}
					return $t_invdate;
				}
			?>


			<td align="center"><input type="date" name="invdue"  id="invdue" onblur="myinvdue()" value="<?php mydatedue(); ?>"/></td>

			<?php
				function mydatedue(){
					if (isset($_COOKIE["invdue"]))
					{
						//echo 'cookie id:'.$_COOKIE["myrefno"];
						$_SESSION["invdue"]=$_COOKIE["invdue"];
						//echo '<br/>session id:'.$_SESSION["myblur1"];
						$t_invdue=$_SESSION["invdue"];
						echo $t_invdue;
					}
					else{
						$_COOKIE["invdue"]=date('m/d/Y');
						$_SESSION["invdue"]=date('m/d/Y');

					}
					return $t_invdue;
				}
				include ('class/_parkerconnection.php');

					$group_param='c_code';

					try
					{
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM wcustomers ORDER BY :c_order";
							$stmt = $pdo->prepare($sql);
							$stmt->bindParam(':c_order', $group_param, PDO::PARAM_STR);
							$stmt->execute();
							$total = $stmt->rowCount();
					} catch(PDOException $e) {
								echo $e->getMessage();
						}

				//echo '<td align="center"><select name="mycust" id="mycust" onchange="changecust();" disabled="disabled">
				//<option value=""  disabled selected> Select Customer...</option>';

				while ($row = $stmt->fetchObject()) {
							//echo $row->c_code;
							$mycode=$row->c_code;
							//echo '<option value="'.$row->c_code.'">'. $row->c_name. '</option>';

					 }

				if (isset($_SESSION['mycust']))
				{

				echo '<td align="center"><input type="text" style="text-align: center;" value="'.$_SESSION['mycust'].'" readonly></td>';
				}else{
				echo "Process cannot continue, Customer ID does not exist";

				echo '<br/><a href="searchengine1.php">Back to Home</a>';
				exit();
			}

			?>





		</tr>
		</table>

		<br/>
		<br/>
		<div class="txt-heading"><a id="btnNew" href="/sales.php?action=new"><img src="/newbutton.png" alt="New Record" style="width:70px;height:40px;border:0;"></a>     <a id="btnEmpty" href="/sales.php?action=save"><img src="/save.jpg" alt="Save Record" style="width:70px;height:40px;border:0;"></a>     <a id="btnEmpty" href="/sales.php?action=empty">
	<img src="/clear.jpg" alt="Clear List" style="width:70px;height:40px;border:0;"></a></div>


	</div>




<div class="product-item">
<form method="post" action="" >
<table>
	<th>SEARCH BY ID</th><th>SEARCH BY NAME</th>
	<tr>

		<td align="center">
			<input name="itemcode" type="text" align="center" id="itemcode"><input type="submit" name="idsubmit" value="Search ID" />
		</td>
		<td align="center">
			<input name="itemname" type="text" align="center" id="itemname"><input type="submit" name="namesubmit" value="Search Name" />
		</td>


	<tr>

</table>
</form>
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
<th align="center" class="auto-style1"><strong>KODE ITEM</strong></th>
<th class="auto-style1"><strong>NAMA ITEM</strong></th>
<th class="auto-style1"><strong>QUANTITY</strong></th>
<th class="auto-style1"><strong>HARGA JUAL</strong></th>
<th class="auto-style1"><strong>SUB TOTAL</strong></th>
<th class="auto-style1"><strong>DISC %1</strong></th>
<th class="auto-style1"><strong>DISC %2</strong></th>
<th class="auto-style1"><strong>DISC RP</strong></th>


<th class="auto-style1"><strong>TOTAL</strong></th>
<th class="auto-style1"><strong>ACTION</strong></th>
</tr>
<?php
$grandtotal=0;
$totItem=0;
    foreach ($_SESSION["cart_item"] as $item){
		?>
			<form action="sales.php?action=updatearray&codetr=<?php echo $item["code"]; ?>" method="post">
				<tr>
				<td class="auto-style3"><strong><?php echo $item["code"]; ?></strong></td>
				<td align="left" class="auto-style3"><?php echo $item["name"]; ?></td>
				<td align="left" class="auto-style3"><input type="text" name="xqty" value="<?php echo $item['qty'] ?>" style="width:50px;text-align: center;font-size: 12px;"></td>
				<td align="right" class="auto-style3"><?php echo "Rp. ".number_format($item["cogs"]); ?></td>
				<?php
					$mysubtotal= $item["qty"] * $item["cogs"];
					$totaldisc1 = $mysubtotal*(1-($item['disc1']/100));
					$totaldisc2 = $totaldisc1*(1-($item['disc2']/100));
					$totaldisc3 = $totaldisc2-$item['disc3'];
        			//$totaldisc3 = $totaldisc2*(1-($item['disc3']/100));
				?>
				<td align="right" class="auto-style3"> <?php echo 'Rp. '.number_format($mysubtotal,0); ?> </td>


				<td align = "center"><input type="text" name="xdisc1" value="<?php echo number_format($item['disc1'],2) ?>" style="width:60px;text-align: center;font-size: 12px;"></td>

				<td align = "center"><input type="text" name="xdisc2" value="<?php echo number_format($item['disc2'],2) ?>" style="width:60px;text-align: center;font-size: 12px;"></td>

				<td align = "center"><input type="text" name="xdisc3" value="<?php echo $item['disc3'] ?>" style="width:60px;text-align: center;font-size: 12px;"></td>

				<td align="right" class="auto-style3"><?php echo "Rp.".number_format($totaldisc3); ?></td>
				<td align="center" class="auto-style3"><a href="/sales.php?action=remove&code=<?php echo $item["code"]; ?>" class="auto-style2">Remove Item</a></td>
				<input type="submit" name="qtysubmit" value="qtysubmit" hidden="true">
				</tr>
			</form>
				<?php
        $item_total = ($item_total)+($mysubtotal);
        //$discvol=0;
		$grandtotal=$grandtotal+$totaldisc3;
		$_SESSION['totalcart']=$grandtotal;

		}
		if (empty($_SESSION['premi']))
		{
			$_SESSION['premi']=0;
		}

		if (empty($_SESSION['potongan']))
		{
			$_SESSION['potongan']=0;
		}

		
		?>

<tr>
<td colspan="9" align="right"><strong>Total:</strong></td><td align="right"><strong> <?php echo "Rp.".number_format($grandtotal); ?></strong></td>
</tr>

<form method="post" action="/sales.php"><td align="right">
<tr>
<td></td><td></td><td></td><td></td><td></td><td align="right"><strong>PREMI:</strong></td>

	<td align="right"><input type="text" style="text-align: right;" name="premi" value="<?php echo $_SESSION["premi"]; ?>" /></td>


<tr>
<td></td><td></td><td></td><td></td><td></td><td align="right"><strong>POTONGAN:</strong></td>

	<td align="right"><input type="text" style="text-align: right;" name="potongan" value="<?php echo $_SESSION["potongan"]; ?>" /></td><td><input type="submit" name="potbtn" value="Potongan" /></td>


</tr>
</form>

<tr>
<td></td><td></td><td></td><td></td><td></td><td align="right"><strong>Grand Total:</strong></td><td align="right"><strong> <?php echo "Rp.".number_format($grandtotal); ?></strong></td>
</tr>
</tbody>
</table>
  <?php
}
?>
</div>
<br/>

<?php


       if (isset($_POST['idsubmit']))
        {

            $i_code=$_POST['itemcode'];
            $mcode=$i_code.'%';

          include ('class/_parkerconnection.php');

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM winventory WHERE i_code LIKE :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
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
            $mname= '%'.$i_name.'%';
            include ('class/_parkerconnection.php');

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `winventory` WHERE i_name LIKE :c_name";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_name', $mname, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
         }
           echo '<html>';
           echo '<ul class="cards">';
             while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $mycode=$row->i_barcode;
               //$//myimg=$row->i_imgfile;
               $mygroup=$row->g_code;
               $mycogs=$row->i_cogs;
               $myqty=$row->i_qty;
               $itemname=$row->i_name;
               //$i_weight=$row->i_weight;
              echo '<form method="post" action="sales.php?action=add">';
              echo '<li class="cards__item">
                      <div class="card">';
               
                echo '<div class="card__title" align="center">';
                echo '<input type="text" name="groupitem" value="'.$row->g_code.'" readonly style="text-align:center; border:0;" readonly>';
                echo '<br/><input type="text" name="code" value="'.$mycode.'" style="text-align:center; border:0;" readonly>';

                echo '</div>';
                echo '<div class="card__text" align="center">';
                echo '<input type="text" name="itemname" value="'.$itemname.'" readonly style="text-align:center; border:0;" readonly >';
                echo '<br/>';
                echo '<input type="text" name="cogs00" value="'.number_format($mycogs).'" readonly style="text-align:center; border:0;">';
                //echo '<br/><input type="text" name="weight" value="'.number_format($i_weight,3).'" readonly style="text-align:center; border:0;">';
                echo '<br/> <input type="text" name="available" value="'.$myqty.'" readonly style="text-align:center; border:0;">';
                echo '<br/><br/><label align="center">QTY</label>';
                echo '<br/><input type="text" name="qty" style="text-align: center" value="1" autofocus/>';
                echo '<br/><br/><label align="center">Selling Price</label>';
                echo '<br/><input type="text" name="cogs" style="text-align: center" placeholder="0"/>';
                if ($myqty <= 0)
                {
                	echo '<br/><br/><input type="submit" name="addtolist" style="text-align: center" value="Add to cart" disabled="disabled" />';
                }else
                {
                	echo '<br/><br/><input type="submit" name="addtolist" style="text-align: center" value="Add to cart"/>';
                }

                echo '</div>';

              echo '</div>
                    </li></form>';


            }
             echo '</ul></html>';


?>






<br/>



</body>
 </head>
</html>
