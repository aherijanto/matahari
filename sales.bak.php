<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");

include "class/_number.php";
include "class/_parkersales.php";
include "class/_parkerinvent.php";
include 'menuhtml.php';

$t_number="";
$icode="";
$itemcode="";
$t_supp="";
$t_ary="";
//if (isset($_SESSION['user'])!="" ){

//$db_handle = new DBController();
$item_total = 0;

if (isset($_POST["discbtn"])){
	if(!empty($_POST["discvol"])){
				$_SESSION["discvol"]=$_POST["discvol"];
			}else {
				$_SESSION["discvol"]=0;
				}
}else { $_SESSION["discvol"]=0; }

function noinv()
{

$noinv="Generated Automatically";//SL".date('Ymd').".".rand(9999,100000);
return $noinv;
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
			$_COOKIE["myrefno"]="";
			$_COOKIE["invdate"]=date('m/d/Y');
			$_SESSION["invdate"]=date('m/d/Y');
			$_COOKIE["invdue"]=date('m/d/Y');
			$_SESSION["invdue"]=date('m/d/Y');
			break;
	
		case "add":
			
			echo 'inADD';
			if(($_POST['itemname']=='')||($_POST['qty']=='')||($_POST['cogs']=='')||($_POST['weight']==''))
			{
				break;
			}

			if(!empty($_POST["qty"])) 
			{
				
				if (isset($_SESSION['code']))
					{
						$itemcode1=$_POST['code'];
					
				
				
				$imgfile=$_POST['imgfile'];

				$itemArray = array($itemcode1=>array('group'=>$_POST['groupitem'],'name'=>$_POST['itemname'],'code'=>$itemcode1, 'qty'=>$_POST["qty"],'cogs'=>$_POST['cogs'],'weight'=>$_POST['weight'],'imgfile'=>$imgfile));



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
			}
			$itemcode1='';
			$imgfile='';
			break;
	
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

				if (isset($_COOKIE["mysupp"]))
					{
						//echo 'cookie id:'.$_COOKIE["myrefno"];
						$_SESSION["mysupp"]=$_COOKIE["mysupp"];
						//echo '<br/>session id:'.$_SESSION["myblur1"];
						$t_supp=$_SESSION["mysupp"];
						
					}
					else{
						$_COOKIE["mysupp"]="";
						$_SESSION["mysupp"]="";
						$t_supp=$_SESSION["mysupp"];
						
					}
					//return $t_number;
			
			$myinvno="SL".date('ymd').".".rand(9999,100000);
			$mydate1=date('Y-m-d');
			//$mydateon=date(strtotime($_SESSION['invdate'],'Y-m-d');

			$mydateon=$_SESSION['invdate'];
			
			//$_SESSION["refno"]=$_COOKIE["refno"];
			$myrefno=$_SESSION['myrefno'];
			
			
			$sales = new Sales($myinvno,$mydateon,$mydate1,$t_supp,'u_code','0','0','0','0','0','0','0'); 
			//
			$sales->save_sell_head();


			foreach($_SESSION["cart_item"] as $myitem) {
				//if($productByCode[0]["itemcode"] == $k)
					
					$mygroup=$myitem['group'];
					$myitemcode= $myitem["code"];//$_SESSION["cart_item"][$k]["code"];//$productByCode[0]["itemcode"];
					$myitemname= $myitem["name"];//$_SESSION["cart_item"][$k]["name"];
					$myprice=$myitem["cogs"];
					$myweight=$myitem["weight"];
					//$productByCode[0]["opprice"];//$_SESSION["cart item"][$k]["price"];
					$myqty= $myitem["qty"];//$_SESSION["cart_item"][$k]["quantity"];
					$myimgfile=$myitem["imgfile"];

					$salesdetail = new Sales($myinvno,$mydateon,$mydate1,$t_supp,'u_code',$mygroup,$myitemcode,$myitemname,$myqty,$myprice,$myweight,$myimgfile); 
				
					$salesdetail->save_sell_tail();
					
					//$myinvent=new Inventory($myitemcode,$mygroup,$myitemname,$myqty,$myprice,$myweight,'A',$myimgfile);
					//$myinvent->save_inventory();
					
					$mysub=$myprice*$myqty;
					//$itemtotal=$itemtotal+$mysub;
					
			}
			header ("Location:printsales.php?invno=$myinvno");


		unset($_SESSION["cart_item"]);
		unset($_SESSION["discvol"]);
		unset($_SESSION["myrefno"]);
		unset($_SESSION["invdate"]);
		unset($_SESSION["mysupp"]);
		//header("Location: /printresepsalesfree.php?myinv=$myinvno&ptncode=$mycodeptn1" );


		}
		
		
		case "empty":
		unset($_SESSION["cart_item"]);
		unset($_SESSION["discvol"]);
		unset($_SESSION["myrefno"]);
		unset($_SESSION["invdate"]);
		unset($_SESSION["mysupp"]);

		break;
	}

}
?>



<html>
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

<body>
	<div>
		<table height="40px" width="100%">
		<tr><td bgcolor="#D8CEF6" align="center">CREATE YOUR SALES</td></tr>
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
			?>

			<?php
				try
					{
						$pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

					}
					catch (PDOException $e)
					{
							echo 'Error: ' . $e->getMessage();
							exit();
					}

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

				echo '<td align="center"><select name="mysupp" id="mysupp" onchange="changesupp();" >
				<option value="" disabled selected> Select Customer...</option>';

				while ($row = $stmt->fetchObject()) {
							//echo $row->c_code;
							$mycode=$row->c_code;
							echo '<option value="'.$row->c_code.'">'. $row->c_name. '</option>';

					 }

				echo '</select></td>';

				
				?>
				<script type="text/javascript">
					function changesupp() {
						var y = document.getElementById("mysupp");
						document.cookie="mysupp=" + y.value;
						alert(y.value);
					}
				</script>
		</tr>
		</table>

		<br/>
		<br/>
		<br/>


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
<div class="txt-heading"><a id="btnNew" href="/sales.php?action=new"><img src="/newbutton.png" alt="New Record" style="width:70px;height:40px;border:0;"></a>     <a id="btnEmpty" href="/sales.php?action=save"><img src="/save.jpg" alt="Save Record" style="width:70px;height:40px;border:0;"></a>     <a id="btnEmpty" href="/sales.php?action=empty"><img src="/clear.jpg" alt="Clear List" style="width:70px;height:40px;border:0;"></a></div>
						
<?php

if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>
<table cellpadding="10" cellspacing="1" width="100%">
<tbody>
<tr>
<th align="center" class="auto-style1"><strong>ITEM CODE</strong></th>
<th class="auto-style1"><strong>ITEM NAME</strong></th>
<th class="auto-style1"><strong>QUANTITY</strong></th>
<th class="auto-style1"><strong>COGS</strong></th>
<th class="auto-style1"><strong>WEIGHT</strong></th>
<th class="auto-style1"><strong>IMAGE</strong></th>

<th class="auto-style1"><strong>SUBTOTAL</strong></th>
<th class="auto-style1"><strong>ACTION</strong></th>
</tr>
<?php
    foreach ($_SESSION["cart_item"] as $item){
		?>
				<tr>
				<td class="auto-style3"><strong><?php echo $item["code"]; ?></strong></td>
				<td align="left" class="auto-style3"><?php echo $item["name"]; ?></td>
				<td align="center" class="auto-style3"><?php echo $item["qty"]; ?></td>
				<td align="right" class="auto-style3"><?php echo "Rp. ".number_format($item["cogs"]); ?></td>
				<td align="right" class="auto-style3"><?php echo number_format($item["weight"],3); ?></td>
				

				<td align=right class="auto-style3"><a href="thumbitem.php"><?php echo $item['imgfile'];?></a></td>

				<?php 
					$mysubtotal=0;
					$mysubtotal=subtotal($item['weight'],$item['cogs']);
				?>
				
				<td align="right" class="auto-style3"> <?php echo number_format($mysubtotal,0); ?> </td>
				
				<td align="center" class="auto-style3"><a href="/sales.php?action=remove&code=<?php echo $item["code"]; ?>" class="auto-style2">Remove Item</a></td>

				</tr>
				<?php
        $item_total = ($item_total)+($mysubtotal);
        //$discvol=0;


		}
		$grandtotal = $item_total-$_SESSION['discvol'];
		?>

<tr>
<td></td><td></td><td></td><td></td><td></td><td align="right"><strong>Total:</strong></td><td align="right"><strong> <?php echo "Rp.".number_format($item_total); ?></strong></td>
</tr>
<tr>
<td></td><td></td><td></td><td></td><td></td><td align="right"><strong>Disc.Volume:</strong></td>
<form method="post" action="/purchase.php"><td align="right">
	<input type="text" align="right" name="discvol" value="<?php echo $_SESSION["discvol"]; ?>" /></td><td><input type="submit" name="discbtn" value="Disc.Vol"/></td>
</form>
</tr>
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
try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }

       if (isset($_POST['idsubmit']))
        {    

            $i_code=$_POST['itemcode'];
            $mcode=$i_code.'%';
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
               $mycode=$row->i_code;
               $myimg=$row->i_imgfile;
               $mygroup=$row->g_code;
               $mycogs=$row->i_cogs;
               $myqty=$row->i_qty;
               $itemname=$row->i_name;
               $i_weight=$row->i_weight;
              echo '<form method="post" action="sales.php?action=add">'; 
              echo '<li class="cards__item">
                      <div class="card">
                      <div class="card__image"><img name="imgfile1" src="img/brands/'.$myimg.'" width="210px" height="100px">
                      <input name="imgfile" type="hidden" value="'.$myimg.'"/>
                      </div>';
                echo '<div class="card__title" align="center">';
                echo '<input type="text" name="groupitem" value="'.$mygroup.'" readonly style="text-align:center; border:0;">';
                echo '<br/><input type="text" name="code" value="'.$mycode.'" style="text-align:center; border:0;">';
               
                echo '</div>';
                echo '<div class="card__text" align="center">';
                echo '<input type="text" name="itemname" value="'.$itemname.'" readonly style="text-align:center; border:0;">';
                echo '<br/>';
                echo '<input type="text" name="cogs00" value="'.number_format($mycogs).'" readonly style="text-align:center; border:0;">';
                echo '<br/><input type="text" name="weight" value="'.number_format($i_weight).'" readonly style="text-align:center; border:0;">';
                echo '<br/><br/><label align="center">QTY</label>';
                echo '<br/><input type="text" name="qty" style="text-align: center" value="'.$myqty.'" autofocus/>';
                echo '<br/><br/><label align="center">Selling Price</label>';
                echo '<br/><input type="text" name="cogs" style="text-align: center" placeholder="0"/>';
                echo '<br/><br/><input type="submit" name="addtolist" style="text-align: center" value="Add to cart"/>';   
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

<?php //} else { echo 'You are not authorized to access this page<br/><br/>';
//echo 'Please <a href="xlogin.php"> Login </a> then you can continue to acces page';
//echo '<br/><br/>Contact your system administrator to get access';
//echo '<br/><br/>Thank You.';
//}?>
