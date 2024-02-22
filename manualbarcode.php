
<?php

session_start();
ob_start();
error_reporting(E_ALL);
ini_set("display_errors","On");

include 'menuhtml.php';

include 'printbar.php';
$_SESSION['reports']='0';
if (isset($_SESSION['user'])!="" )
{

$itemcode1="";
$item_total = 0;

if(!empty($_GET["action"])) 
{
	switch($_GET["action"])
	{
		case "new":
			unset($_SESSION["cart_item"]);
			unset($_SESSION["totalcart"]);

			
			break;
	
		case "add":
			if (isset($_POST['addtolist']))
			{
				

				$itemcode1=$_POST['code'];
				
				$itemArray = array($itemcode1=>array('code'=>$_POST["code"],'name'=>$_POST['itemname'], 'artikel'=>$_POST['iartikel'],'warna'=>$_POST['iwarna'],'qty'=>$_POST["qty"],'sell'=>$_POST['isell']));

				
				if(!empty($_SESSION["cart_item"])){
					$itemcheck=$_SESSION['cart_item'];
					if(in_array($itemcode1, array_column($itemcheck, 'code'))) {
    					
					}else{
						$_SESSION['cart_item']=array_merge($_SESSION['cart_item'],$itemArray);
					}
				}else{
					$_SESSION["cart_item"] = $itemArray;
				}
        
			 foreach ($_SESSION["cart_item"] as $item){
          $myi_code=$item['code'];
          $myi_name=$item['name'];
          $myi_sell=$item['sell'];
          $myi_qty=$item['qty'];
          printBCode($myi_code,$myi_name,$myi_sell,$myi_qty);
        }     

      }
      echo '<script> window.open("http://localhost/medownload.php","_self");</script>';
      //header('Location: http://localhost/medownload.php');
			break;
			
		case "remove":
				if(isset($_SESSION["cart_item"]))

				{
				
					foreach($_SESSION["cart_item"] as $k=>$v) 
					{
						
						if($_GET["codetr"] == $_SESSION["cart_item"][$k]["code"]){
							
							unset($_SESSION["cart_item"][$k]);
						}

					if(empty($_SESSION["cart_item"])){
						unset($_SESSION["cart_item"]);
					}

					}//foreach
				}//if


						break;

		
		case "save":

			if(empty($_SESSION["cart_item"]))
			{				
        //include 'printbar.php';
        //$decode=json_decode($myJSON);
         
				foreach ($_SESSION["cart_item"] as $item){
    			
				  
					$myi_code=$item['code'];
					$myi_name=$item['name'];
					$myi_sell=$item['sell'];
					$myi_qty=$item['qty'];
				//	printBCode($myi_code,$myi_name,$myi_sell,$myi_qty);

				}			

				//header('Location: printzebra.php');
	
			}//for each
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
	color:black;

}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    
    color:white;
    font-size: 10px;
    padding: 10px;
}

tr:nth-child(even) {
    background-color: #AED6F1;
}

input[type=text] {
  
  padding: 2px 2px;
  
  box-sizing: border-box;
  border: 1px solid #555;
  outline: none;
}

input[type=text]:focus {
  background-color: #F5B7B1;
  color:black;
 }

input[type=submit] {
  background-color: #4CAF50;
  border-radius: 4px;
  border: none;
  color: white;
  padding: 15px 10px;
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
               background-color: #AED6F1;
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
<body bgcolor="#AED6F1">
	


	<div>

	<form action="" method="post">

		

	<div>
		<table width="100%" font="calibri">
		<tr>
			<td align="center" style="font-size: 20px;color: white;background-color: #27AE60;">PRINT BARCODE BY ITEM</td>
			
		</tr>
		
		</table>
	</div>
		</form>
		

		<br/>
		<div class="txt-heading" align="right">
			<a id="btnNew" href="/manualbarcode.php?action=new" style="color:white;background-color:   #2874a6   ; border-radius: 5px;text-decoration: none;padding: 10px" width="120px">New</a>     
			
			<a id="btnEmpty" href="/manualbarcode.php?action=empty" style="color:white;background-color:  #cb4335  ; border-radius: 5px;text-decoration: none;padding: 10px">Clear</a>
	</div>


	</div>




<div class="product-item">

<table>
	<th class="auto-style3">SEARCH BY ID</th><th class="auto-style3">SEARCH BY NAME</th>
	<tr>		
		
		</td>		
		<form method="post" action="manualbarcode.php?action=search" >
		<td align="center">
			<input name="itemcode" type="text" align="center" id="itemcode" autofocus><input type="submit" name="idsubmit" style="background-color: #C0392B;" value="Search ID">
		</td>
		</form>

		<form method="post" action="manualbarcode.php?action=search" >
		<td align="center">
			<input name="itemname" type="text" align="center" id="itemname"><input type="submit" name="namesubmit" style="background-color: #B9770E;" value="Search Name" />
		</td>
		</form>
			
		
	<tr>
	
</table>

</div>



<?php

if(!empty($_GET["action"])) 
{ 
	if ($_GET["action"]=="search"){

  $total=0;
	$stmt=0;

       if (isset($_POST['idsubmit']))
        {    

        	
            $i_code=$_POST['itemcode'];
            //$mcode=$i_code.'%';
           echo $i_code;

            try
       		{
         		$pdo = new PDO('mysql:host=localhost;dbname=mimj5729_utama', 'mimj5729_myroot', 'myroot@@##');

       		}
       		catch (PDOException $e)
       		{
           		echo 'Error: ' . $e->getMessage();
           		exit();
      		 }

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
            $i_name=(string)$_POST['itemname'];
            
            //$mname= '%'.$i_name.'%';
            	try
       			{
         			$pdo = new PDO('mysql:host=localhost;dbname=mimj5729_utama', 'mimj5729_myroot', 'myroot@@##');

       			}
       				catch (PDOException $e)
       			{
           			echo 'Error: ' . $e->getMessage();
           			exit();
       			}

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
               $isell=$row->i_sell;
              	echo '<tr><form method="post" action="manualbarcode.php?action=add">'; 
                echo '<td width="100px" class="auto-style3" >'.$mycode.'</td><input type="hidden" name="code" value="'.$mycode.'" />';
                echo '<td width="150px" class="auto-style3" >'.$itemname.'</td><input type="hidden" name="itemname" value="'.$itemname.'" />';
                echo '<td width="150px" class="auto-style3" >'.$myarticle.'</td><input type="hidden" name="iartikel" value="'.$myarticle.'" />';
                echo '<td width="80px" class="auto-style3" >'.$iwarna.'</td><input type="hidden" name="iwarna" value="'.$iwarna.'" />';    
                echo '<td width="80px" align="center" ><input type="text" name="qty" style="text-align: center;width:80px;" value="1" autofocus="true"></td>';
              	echo '<td width="80px" class="auto-style3" >'.$isell.'</td><input type="hidden" name="isell" value="'.$isell.'" />';
               	echo '<td ><input type="submit"   name="addtolist" style="text-align: center;background-color:#1F618D;padding:12px 5px;" value="Print Barcode"/></td>';
               	echo '</tr></form>';
                }
                 

              echo '</table>';
             

        }    
       
}       
?>

</body>

 <!--<div id="mybutton" ><img src="/img/logo/doremi.jpg" width="180px" height="86px"></div>!-->
</html>
<?php 
}else { 
	echo 'Process cannot continue, please <a href="slogin.php">Login </a>';
}
//
?>
