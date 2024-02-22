<html>

<style type="text/css">
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
<div>
		<table height="40px" width="100%">
		    <tr>
                <td bgcolor="#D8CEF6" align="center">AVAILABLE INVENTORY</td>
                <td align="right" style="width: 20px;background-color: #FCF3CF;">
                    <label id="back" onclick="window.open('http://matahari.local/reginvent.php','_self');">Back</label>
                </td>
            </tr>
		</table>
	</div>

<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
$_SESSION['reports']='1';
include '../class/_parkerconnection.php';            
            $mcode=1;
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM winventory WHERE :c_code";
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
 ?>
   
<table width="100%" font="calibri">
		<th>ITEM CODE</th><th>ITEM NAME</th><th>QTY</th><th>COGS</th><th>SELL</th><th>TOTAL</th>
  
  <?php 
  $totqty=0;
  $totweight=0;         
  while ($row = $stmt->fetchObject()) {

               $mycode=$row->i_barcode;
               $myname=$row->i_name;
               $myqty=$row->i_qty;
               $mycogs=$row->i_cogs;
               $myweight=$row->i_sell;
               $myimg=$mycogs*$myqty;
               echo '<tr><td>'.$mycode.'</td><td>'.$myname.'</td><td align="center">'.$myqty.'</td><td align="right">'.number_format($mycogs).'</td><td align="right">'.number_format($myweight).'</td><td align="right">'.number_format($myimg).'</td></tr>';
             	$totqty=$totqty+$myqty;
             	$totweight=$totweight+$myimg;

             }
             echo '<tr><td></td><td></td><td align="center"><h4>'.$totqty.'</h4></td><td></td><td></td><td align="right"><h4>'.number_format($totweight).'</h4></td></tr>';
?>

</table>
</html>