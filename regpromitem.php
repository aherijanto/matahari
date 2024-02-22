 

<?php
session_start();
ob_start();

error_reporting(E_ALL);
ini_set("display_errors","On");
$_SESSION['reports']='0';
if (isset($_SESSION['user'])!="" )
{

include "class/_parkersales.php";
include "class/_parkerinvent.php";
include 'menuhtml.php';
include 'class/number.php';

//$t_number="";
//$icode="";
$itemcode1="";
//$t_cust="";



//$db_handle = new DBController();
$item_total = 0;




function subtotal($qty,$price)
{
$subtotal1=0;
 $subtotal1 = $qty * $price;
return $subtotal1;
}


function setnoinv(){
	$myRandNo=rand(10000,99999);
	$nowM=date('Ymd');
	$mydaternd=strtotime($nowM);
	
	$xdate='PROM'.$nowM.$myRandNo;
	
	$_SESSION['myinvdrm']=$xdate;
	return $xdate;
}


if(!empty($_GET["action"])) 
{
	switch($_GET["action"])
	{
		case "new":
			unset($_SESSION["cart_item"]);
				
				
				unset($_SESSION["xdate"]);
				unset($_SESSION["scode"]);
				unset($_SESSION["myinvdrm"]);
			
			
			$_SESSION["xdate"]=date('Y-m-d');
			
			$_SESSION['myinvdrm']=setnoinv();
			
			break;
	
		case "add":
			if (isset($_POST['addtolist']))
			{
				

								
				$itemcode1=$_POST['code'];
				
				
				

				
				$itemArray = array($itemcode1=>array('code'=>$_POST["code"],'name'=>$_POST['itemname'], 'artikel'=>$_POST['iartikel'],'warna'=>$_POST['iwarna'],'disc'=>$_POST['disc']));


					if(!empty($_SESSION["cart_item"]))
					{
						if(in_array($itemcode1,$_SESSION["cart_item"])) 
						{
							foreach($_SESSION["cart_item"] as $k => $v)
							{
								if($itemcode == $k)
								{
									$_SESSION["cart_item"][$k]["artikel"] = $_POST["iartikel"];
									$_SESSION["cart_item"][$k]["warna"] = $_POST["iwarna"];
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
					
					if($_GET["codetr"] == $_SESSION["cart_item"][$k]["code"]){
						
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
				$myinvno=$_SESSION['myinvdrm'];
				$myrefno=$myinvno;
				$mydate1=date('Y-m-d');
				$mydateon=date('Y-m-d');
				$myuser=$_SESSION['user'];
				$mysupp='cash';
			
			
				$drmSales = new Sales($myinvno,$mydate1,$mydateon,$mysupp,$myuser,'0','0','0','0','0','0','0','0','0'); 
				$drmSales->save_promo_head();


				foreach($_SESSION["cart_item"] as $myItem) 
				{
						$myInvNo=$myinvno;
						$myItemCode= $myItem["code"];//		
						$myItemName= $myItem["name"];
						$myArticle=$myItem["artikel"];
						$myColor=$myItem["warna"];
						$myDisc=$myItem['disc'];
						
						

						$salesDetail = new Sales($myinvno,$mydate1,$mydateon,$mysupp,$myuser,'0','0','0','0','0','0','0','0','0');
						$salesDetail->save_promo_tail($myInvNo,$myItemCode,$myItemName,$myArticle,$myColor,$myDisc);
											
				}


				unset($_SESSION["cart_item"]);
				
				unset($_SESSION["xdate"]);
				
				unset($_SESSION["myinvdrm"]);

				$_SESSION["xdate"]=date('Y-m-d');
			
				$_SESSION["myinvdrm"]=setnoinv();
		
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
	color:blue;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    
    color:white;
    font-size: 12px;
    padding: 8px;
}

tr:nth-child(even) {
    background-color: white;
}

input[type=text] {
  
  padding: 10px 5px;
  margin: 2px 0;
  box-sizing: border-box;
  border: 1px solid #555;
  outline: none;
}

input[type=text]:focus {
  background-color: #F5B7B1;
 }

input[type=submit] {
  background-color: #4CAF50;
  border-radius: 4px;
  border: none;
  color: white;
  padding: 5px 5px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}

#footer {
	color:white;
  position: absolute;
  bottom: 0;
  width: 100%;
  height: 2.5rem;            /* Footer height */
}


img.sticky {
  position: -webkit-sticky;
  position: sticky;
  bottom:1rem;
}
 #mybutton {
  position: fixed;
  bottom: -4px;
  right: 10px;
}
  
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
</head>
<body bgcolor="white">
	


	<div>

	<form action="" method="post">

		

	<div>
		<table width="100%" font="calibri">
		<tr>
			<td align="center" style="width: 180px;font-size: 20px;background-color: #A569BD"><?php echo $_SESSION['myinvdrm'];?></td>
			<td align="center" style="font-size: 20px;color: white;background-color: #27AE60;">PROMOTIONs ITEM</td>
			<td align="center" style="width: 180px;font-size: 20px;background-color: #D35400;"><?php echo $_SESSION['xdate'];?></td>
			
		</tr>
		
		</table>
	</div>
		</form>
		

		<br/>
		<div class="txt-heading" align="right"><a id="btnNew" href="/regpromitem.php?action=new" style="color:white;background-color:   #2874a6   ; border-radius: 5px;text-decoration: none;padding: 10px" width="120px">New</a>     <a id="btnEmpty" href="/regpromitem.php?action=save" style="color:white;background-color: #229954; border-radius: 5px;text-decoration: none;padding: 10px">Save</a> <a id="btnEmpty" href="/regpromitem.php?action=empty" style="color:white;background-color:  #cb4335  ; border-radius: 5px;text-decoration: none;padding: 10px">Clear</a>
	</div>


	</div>




<div class="product-item">
<form method="post" action="/regpromitem.php?action=search" >
<table>
	<th>SEARCH BY ID</th><th>SEARCH BY NAME</th>
	<tr>		
				
		<td align="center">
			<input name="itemcode" type="text" align="center" id="itemcode" autofocus><input type="submit" name="idsubmit" style="background-color: #C0392B;" value="Search ID">
		</td>
		<td align="center">
			<input name="itemname" type="text" align="center" id="itemname"><input type="submit" name="namesubmit" style="background-color: #B9770E;" value="Search Name" />
		</td>
			
		
	<tr>
	
</table>
</form>
</div>


<div id="shopping-cart">

						
<?php

if(isset($_SESSION["cart_item"])){
    $item_total = 0;
?>
<table cellpadding="10" cellspacing="1" width="100%">
<tbody>
<tr bgcolor="#228FF5">
<th align="left" class="auto-style1"><strong>KODE BARANG</strong></th>
<th class="auto-style1" align="left"><strong>NAMA BARANG</strong></th>
<th class="auto-style1" align="center"><strong>ARTIKEL</strong></th>
<th class="auto-style1" align="center"><strong>WARNA</strong></th>
<th class="auto-style1" align="center"><strong>DISC</strong></th>
<th class="auto-style1" align="center"><strong>ACTION</strong></th>
</tr>
<?php
$grandtotal=0;
$totItem=0;
    foreach ($_SESSION["cart_item"] as $item){
		?>
				
				<tr>
				<td class="auto-style3"><strong><?php echo $item["code"]; ?></strong></td>
				<td align="left" class="auto-style3"><?php echo $item["name"]; ?></td>
				<td align="center" class="auto-style3"><?php echo $item["artikel"]; ?></td>
				<td align="center" class="auto-style3"><?php echo $item["warna"]; ?></td>
				<td align="center" class="auto-style3"><?php echo $item["disc"]; ?></td>
				<td align="center" class="auto-style3"><a href="/regpromitem.php?action=remove&codetr= <?php echo $item["code"]; ?>" class="auto-style2" style="color:white;background-color:  #8e44ad; border-radius: 5px;text-decoration: none;padding: 10px">Remove Item</a></td>
					

				
				</tr>
		<?php	
		$totItem++;
		}
		?>

				<tr><td colspan="12"><hr/></td></tr>
				<tr>
					<td align="left" style="color: #85c1e9  ;"><?php echo 'Item : '.$totItem.' record(s)';?></td>
				</tr>





</tbody>
</table>
  <?php
}
?>
</div>
<br/>

<?php


if($_GET["action"]=='search'){ 

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
            
            //$mname= '%'.$i_name.'%';
			include ('class/_parkerconnection.php');
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql1 = "SELECT * FROM `winventory` WHERE i_name LIKE '%$i_name%'";
                $stmt = $pdo->prepare($sql1);
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
          
           echo '<table width="100%;">';
           echo '<tr><td colspan="10" style="background-color:#873600  ;">RESULT::  '.$total.' record(s)</td></tr>';
             while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $mycode=$row->i_barcode;
               //$mygroup=$row->g_code;
               $mysell=$row->i_sell;
               $myqty=$row->i_qty;
               $myarticle=$row->i_article;
               $itemname=$row->i_name;
               $iwarna=$row->i_color;
              	echo '<tr><form method="post" action="regpromitem.php?action=add">'; 
                echo '<td width="100px" class="auto-style3" >'.$mycode.'</td><input type="hidden" name="code" value="'.$mycode.'" />';
                echo '<td width="150px" class="auto-style3" >'.$itemname.'</td><input type="hidden" name="itemname" value="'.$itemname.'" />';
                echo '<td width="150px" class="auto-style3">'.$myarticle.'</td><input type="hidden" name="iartikel" value="'.$myarticle.'" />';
                echo '<td width="80px" class="auto-style3">'.$iwarna.'</td><input type="hidden" name="iwarna" value="'.$iwarna.'" />';
                echo '<td width="20px" class="auto-style3"><input type="text" name="disc" value="0" style="width:50px;"/>';

               	echo '<td ><input type="submit"   name="addtolist" style="text-align: center;background-color:#1F618D;" value="Add to cart"/></td>';
               	echo '</tr></form>';
                }
                 

              echo '</table>';


            
       
}       
?>

</body>

</html>
<?php 
}else { 
	echo 'Process cannot continue, please <a href="slogin.php">Login </a>';
}
?>
