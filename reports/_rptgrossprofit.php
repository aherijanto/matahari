

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
		<tr><td bgcolor="#D8CEF6" align="center">GROSS PROFIT</td></tr>
		<form method="post" action="">
		<tr><td align="center">Date From <input type="date" name="datequery"/></td></tr>
		<tr><td align="center">Date To <input type="date" name="datequery1"/></td></tr>
    <tr><td align="center"><input type="submit" name="submitdate"/></td></tr>
    </form>
		</table>
	</div>


<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");

if (isset($_POST['submitdate']))
{

$mydate=$_POST['datequery'];
$mydate1=$_POST['datequery1'];
$datequery=date('Y-m-d',strtotime($mydate));
$datequery1=date('Y-m-d',strtotime($mydate1));
try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }

       
            
            
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT wsellhead.s_code,wsellhead.c_code,wsellhead.s_date,wselltail.s_code,wselltail.i_code,wselltail.i_name,wselltail.i_qty,wselltail.i_cogs,wselltail.i_weight,wcustomers.c_code,wcustomers.c_name,winventory.i_code,winventory.i_cogs as inventcogs FROM `wsellhead`,`wselltail`,`wcustomers`,`winventory` WHERE (wsellhead.s_code=wselltail.s_code) AND (wsellhead.s_date BETWEEN '$datequery' AND '$datequery1') AND (wsellhead.c_code=wcustomers.c_code) AND (wselltail.i_code=winventory.i_code)";

                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                //while ($row = $stmt->fetchObject()) {
                 // echo $row->c_code;
                //}
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
 
   
echo '<table width="100%" font="calibri">
		<th>INVOICE NO </th><th>CUSTOMER CODE </th><th>CUSTOMER NAME</th><th>ITEM CODE</th><th>ITEM NAME</th><th>QTY</th><th>
		PRICE SELL</th><th>COGS</th><th>RANGE</th><th>WEIGHT</th><th>GROSS</th>';
  
  		$totqty=0;
  		$totweight=0;
  		$grand=0;
        
 		while ($row = $stmt->fetchObject()) {
  			   $myinvno=$row->s_code;
  			   $mycustcode=$row->c_code;
  			   $mycustname=$row->c_name;
               $mycode=$row->i_code;
               $myname=$row->i_name;
               $myqty=$row->i_qty;
               $mycogs=number_format($row->i_cogs);
               $myweight=number_format($row->i_weight,3);
               $myinventcogs=number_format($row->inventcogs,3);
               $mysubtotal=$row->i_qty * (($row->i_cogs - $row->inventcogs) * $row->i_weight);
               $myrange=number_format($row->i_cogs - $row->inventcogs);
               echo '<tr><td><font color="blue">'.$myinvno.'</font></td><td>'.$mycustcode.'</td><td>'.$mycustname.'</td><td>'.$mycode.'</td><td>'.$myname.'</td><td align="center">'.$myqty.'</td><td align="right">'.$mycogs.'</td><td align="right">'.$myinventcogs.'</td><td align="right">'.$myrange.'</td><td align="center">'.$myweight.'</td><td align="right">'.number_format($mysubtotal).'</td></tr>';
             	$totqty=$totqty+$myqty;
             	$totweight=$totweight+$myweight;
             	$grand=$grand+$mysubtotal;

             }
             echo '<tr><td></td><td></td><td></td><td></td><td></td><td align="center"><h4>'.$totqty.'</h4></td><td></td><td></td><td></td><td align="center"><h4>'.$totweight.'</h4></td><td align="right"><h4>'.number_format($grand).'</h4</td></tr>';
}
?>

</table>
</html>