<?php
session_start();
$_SESSION['reports']='0';
include 'printbar.php';
if (isset($_SESSION['user'])!="" ){
$mydate='';
$mypremi=0;
$mydeduct=0;



function getPurchaseHead($inv)
{
	try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=mimj5729_utama', 'mimj5729_myroot', 'myroot@@##');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }


            
            $mcode=$inv;
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wbuyhead WHERE b_code = '$inv'";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                $row = $stmt->fetchObject(); 
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      
            
               //echo $row->c_code;
               $_SESSION['pinv']=$row->b_code;
               $_SESSION['pref']=$row->b_refno;
               $_SESSION['pdate']=$row->b_date;
               $_SESSION['pdue']=$row->b_dateinput;
               $_SESSION['psupp']=$row->s_code;

               
             
              return $_SESSION['pinv'];

}


if (!empty($_GET['invno']))
{
	$invno=$_GET['invno'];
	$c_code=getPurchaseHead($invno);
  $psupp=$_SESSION['psupp'];
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
                $sql = "SELECT * FROM wsuppliers WHERE s_code = '$psupp'";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $c_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                $row = $stmt->fetchObject();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      
            
               $mys_name=$row->s_name;
               $mys_addr=$row->s_addr;
               $mys_contact=$row->s_contact;
               $mys_phone=$row->s_phone;
              
}
?>

<html>
<style>
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

<body>
<table height="40px" width="100%">
	<tr>
		<td>TOKO UTAMA BUSANA<br/><br/>JL.A. YANI NO. 75<br/>TELP 0283 453-5444<br/>TEGAL<br/></td>
		<td align="center" ><font face="calibri" color="black"><b><br/> PRINT BARCODE FROM PURCHASING</b></font></td>
		<td></td>
		<td align="right"><?php echo $_SESSION['psupp'];?> <br/> <?php echo $mys_name; ?><br/> <?php echo $mys_addr; ?><br/>
			<?php echo $mys_contact; ?><br/><?php echo $mys_phone; ?><br/><br/></td>
	</tr>

	<?php 
  date_default_timezone_set("asia/jakarta"); 
  $mytime=date("h:i:sa"); $showdate=$_SESSION['pdate'];
  if (isset($_SESSION['user'])){
    $username=$_SESSION['user'];

  }else
  {$username="no user";}

  ?>

	<tr>
		<td align="left"><b>No Faktur : <?php echo $invno ?>/ <?php echo $_SESSION['pref'];?></b></td>
		<td align="center"><b><?php echo $username; ?></font></td>
    <?php date_default_timezone_set("asia/jakarta");?>
		<td align="center"><b><?php echo date('d-M-Y',strtotime($showdate));?></b></td>
		<td align="center"><b><?php echo $mytime;?></b></td>
	</tr>
	<tr>
		<td colspan="4"></td>
	</tr>
</table>

<?php 
	 try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wbuytail WHERE b_code = '$invno' ORDER BY g_code ASC;";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $invno, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
               
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      		$mytotal=0;$mygrand=0;
      		$myqty=0;

          echo '<table width="100%"><th align="left">KODE BARANG</th><th>BARCODE</th><th>NAMA BARANG</th><th>QTY</th><th align="right">HARGA JUAL</th><th align="right">SUBTOTAL</th>';
        
           try
            {
               $pdo1 = new PDO('mysql:host=localhost;dbname=mimj5729_utama', 'mimj5729_myroot', 'myroot@@##');

            } 
             catch (PDOException $e)
            {
             echo 'Error: ' . $e->getMessage();
             exit();
            }
             
            while ($row = $stmt->fetchObject()) {
               //echo $row->i_code;
               $myg_code=$row->g_code;
               $myi_code=$row->i_code;
			   
			      
			     
           try {
                $pdo1->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sqlinvent = "SELECT * FROM winventory WHERE i_barcode='$myi_code'";
                $stmti = $pdo->prepare($sqlinvent);
                //$stmt->bindParam(':c_code', $invno, PDO::PARAM_STR);
                $stmti->execute();
                $total = $stmti->rowCount();
				
				} catch(PDOException $e) {
                echo $e->getMessage();
				}
				
				$rowinvent=$stmti->fetch();
               $myi_name=$row->i_name;
			         $myi_sell=$rowinvent['i_sell'];
               $myi_qty=$row->i_qty;//g_code  i_code  i_name  i_qty i_cogs  i_disc1 i_disc2 i_disc3 tglexp
               $myi_price=$row->i_cogs;
               $myi_disc1=$row->i_disc1;
               $myi_disc2=$row->i_disc2;
               $myi_disc3=$row->i_disc3;
               $mytglexp=$row->tglexp;
                             
              $myqty=$myqty+$myi_qty;
              $mytotal=$myi_price*$myi_qty;
               
               
            
              echo '<tr>';
              echo '<td style="width:100px;">'.$myg_code.'</td>';
              echo '<td>'.$myi_code.'</td>';
              echo '<td>'.$myi_name.'</td>';
              echo '<td align="right">'.$myi_qty.'</td>';
              echo '<td align="right" style="width:auto;">'.number_format($myi_sell).'</td>';
              echo '<td align="right" style="width:auto;">'.number_format($mytotal).'</td>';
              
            
              printBCode($myi_code,$myi_name,$myi_sell,$myi_qty);
             
              
              $mysubtotal=0;
              $mysubtotal=$myi_qty*$myi_price;
              $totaldisc1=0;
              $totaldisc2=0;
              $totaldisc3=0;
              $totaldisc1 = $mysubtotal*(1-($myi_disc1/100));
              $totaldisc2 = $totaldisc1*(1-($myi_disc2/100));
              $totaldisc3 = $totaldisc2*(1-($myi_disc3/100));
              $mygrand= $mygrand + $mysubtotal;//$totaldisc3;
              //echo '<td align="right">'.number_format($totaldisc3).'</td>';
              echo '</tr>';

              }
              /*yfile = fopen("utama.zpl", "a+") or die("Unable to open file!");
              $zplFile="utama.zpl";
              //$foot="^PQ1,1,1,Y\n";
			       $foot="^XZ\n";
              fwrite($myfile, $foot);
              fclose($myfile);*/
              unset($_SESSION['lastcol']);
              
?>

	<tr>
    <td align="right" colspan="4" style="color:blue;font-weight: bold;font-size:16px;"><?php echo number_format($myqty);?></td>
    <td align="right" colspan="2" style="color:black;font-weight: bold;font-size:16px;"><?php echo number_format($mygrand);?> </td>
  </tr>
  
  <tr>
    <td colspan="6" align="right"><a href="http://localhost/medownload.php" style="text-decoration:none;background-color:#2ecc71;color:white;border-radius: 5px;width: 150px;height: 50px;padding: 8px;">Next</a></td>
  </tr>

</table>
<footer align="center"><a href="searchprintpcs.php"><font face="calibri" size="2">&copyUTAMA2019</font><a></footer>
</body>
</html>
<?php } else { echo 'You are not authorized to access this page<br/><br/>'; 
echo 'Please <a href="slogin.php"> Login </a> then you can continue to acces page';
echo '<br/><br/>Contact your system administrator to get access';
echo '<br/><br/>Thank You.';}
?>