<?php
session_start();
ob_start();
error_reporting(E_ALL);
date_default_timezone_set('Asia/Jakarta');
ini_set("display_errors","On");
$_SESSION['reports']='0';
if (isset($_SESSION['user'])!="" ){
$mydate='';
$mypremi=0;
$mydeduct=0;



function getPurchaseHead($inv)
{
	try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=mimj5729_matahari', 'mimj5729_myroot', 'myroot@@##');

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
         $pdo = new PDO('mysql:host=localhost;dbname=mimj5729_matahari', 'mimj5729_myroot', 'myroot@@##');

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

.myfont{
  font-size: 8px;
  font-family: arial, sans-serif;
}
</style>

<body>
<table height="40px" width="100%">
	<tr>
		<td>TB.MATAHARI<br/><br/>TEGAL<br/><br/><br/></td>
		<td align="center" ><font face="calibri" color="black"><b><br/> PURCHASING</b></font></td>
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
  $conn=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
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
          echo '<table width="100%"><th align="left" style="font-size:12px;">KODE BARANG</th><th style="font-size:12px;">BARCODE</th><th style="font-size:12px;">NAMA BARANG</th><th style="font-size:12px;">QTY</th><th align="right" style="font-size:12px;">HARGA BELI</th><th align="right" style="font-size:12px;">SUBTOTAL</th><th align="right" style="font-size:12px;">DISC%</th><th align="right" style="font-size:12px;">DISC Rp.</th><th align="right" style="font-size:12px;">TGL.EXP</th><th align="right" style="font-size:12px;">TOTAL</th>';
            
            while ($row = $stmt->fetchObject()) {
               //echo $row->i_code;
               $myg_code=$row->g_code;
               $myi_code=$row->i_code;
               $myi_name=$row->i_name;
               $myi_qty=$row->i_qty;//g_code  i_code  i_name  i_qty i_cogs  i_disc1 i_disc2 i_disc3 tglexp
               $myi_price=$row->i_cogs;
               $myi_disc1=$row->i_disc1;
               $myi_disc2=$row->i_disc2;
               $myi_disc3=$row->i_disc3;
               $mytglexp=$row->tglexp;
                             
              $myqty=$myqty+$myi_qty;
              $mytotal=$myi_price*$myi_qty;

              $sqlsatuan="SELECT * from winventory where i_barcode='$myi_code'";
              $showsatuan= mysqli_query($conn,$sqlsatuan) or die(mysqli_error($conn));
              if ($row1 =mysqli_fetch_array($showsatuan))
              { 
                $myitemcode=$row1['i_unit'];
                $mywareid=$row1['ware_id'];
              }	
              $mysubtotal=0;
					    $mysubtotal=$row->i_qty * $row->i_cogs;
					    $subtotalafter = $mysubtotal - ($row->i_qty * $row->i_disc3);
              echo '<tr>';
              echo '<td style="width:100px;font-size:12px;">'.$myg_code.'</td>';
              echo '<td style="font-size:12px;font-size:12px;">'.$myi_code.'</td>';
              echo '<td style="font-size:12px;">'.$myi_name.' - '.$mywareid.'</td>';
              echo '<td align="right" style="font-size:12px;">'.$myi_qty.'</td>';
              echo '<td align="right" style="width:auto;font-size:12px;">'.number_format($myi_price).'</td>';
              echo '<td align="right" style="width:auto;font-size:12px;">'.number_format($mytotal).'</td>';
              echo '<td align="right" style="width:50px;font-size:12px;">'.$myi_disc1.'</td>';
              //echo '<td align="right">'.$myi_disc2.'</td>';
              echo '<td align="right" style="font-size:12px;">'.$myi_disc3.'</td>';
              echo '<td align="center" style="font-size:12px;">'.$mytglexp.'</td>';
              echo '<td align="right" style="font-size:12px;">'.number_format($subtotalafter).'</td>';
             
              $mygrand= $mygrand + $subtotalafter;//$totaldisc3;
             
              echo '</tr>';

              }
?>

	<tr>
    <td align="right" colspan="4" style="color:blue;font-weight: ;font-size:16px;"><?php echo number_format($myqty);?></td>
    <td align="right" colspan="6" style="color:black;font-weight: bold;font-size:16px;"><?php echo number_format($mygrand);?> </td>
  </tr>
</table>
<div align="center">
<footer align="center"><a href="purchase.php?action=new"><font face="calibri" size="2">&copyMatahari</font><a></footer>
            </div>
</body>
</html>
<?php } else { echo 'You are not authorized to access this page<br/><br/>'; 
echo 'Please <a href="slogin.php"> Login </a> then you can continue to acces page';
echo '<br/><br/>Contact your system administrator to get access';
echo '<br/><br/>Thank You.';}
?>