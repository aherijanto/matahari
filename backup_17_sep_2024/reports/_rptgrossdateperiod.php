<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();
ob_start();
$_SESSION['reports']='1';
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

input[type=submit] {
  background-color: #4CAF50;
  border: none;
  border-radius:5px;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}

.me_date{
    padding:5px 5px;
    background-color: #AED6F1;
    color:black;
    font-size:16px;
}
</style>
<div align="center" style="background-color:#D35400;font-weight: bold;font;font-size: 30px;color:#F9E79F">GROSS MARGIN PER DATE PERIOD</div>
<div><br></div><div><br></div>
<div align="center">SELECT DATE</div>
<form action="" method="post">
    <div align="center"><input type="date" class="me_date" name="mydate" id="mydate"></div>
    <div align="center"><input type="date" class="me_date" name="mydate2" id="mydate2"></div>
    <div align="center"><input type="submit" name="datesubmit" value="Process">
</form>

<?php

if (isset($_POST['datesubmit'])){
    $mydate=$_POST['mydate'];
    $mydate1=date('Y-m-d',strtotime($mydate));
    $mydate2=date('Y-m-d',strtotime($_POST['mydate2']));

  include '../class/_parkerconnection.php';
       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob="SELECT * FROM wsellhead,wselltail WHERE (s_date BETWEEN '$mydate1' AND '$mydate2') AND (wselltail.s_code=wsellhead.s_code)";
                $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtpcsGlob->execute();
                $totalpcsGlob = $stmtpcsGlob->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    

    echo '<table width="100%">';
    echo '<th>NO FAKTUR</th><th>TGL NOTA</th><th>TOT.SALES</th><th>TOT.COGS</th><th>GROSS</th>';
    $grandtotal1=0;
    $grandtotalcogs1=0;
    $grandgross=0;
        while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
              //echo $row->c_code;
            $gcodeHead1=$rowpcsGlob->s_code;
            $date1=$rowpcsGlob->s_date;
            $bayar=$rowpcsGlob->s_premi;
            $kembali=$rowpcsGlob->s_deduct;
            $iCode=$rowpcsGlob->i_code;
            $i_qty=$rowpcsGlob->i_qty;
            $i_price=$rowpcsGlob->i_sell;
                
            $disc1=$rowpcsGlob->i_disc1;
            $disc2=$rowpcsGlob->i_disc2;
            $disc3=$rowpcsGlob->i_disc2;
           
            include '../class/_parkerconnection.php';
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob1="SELECT i_cogs FROM `winventory` WHERE (winventory.i_barcode='$iCode')";
                $stmtpcsGlob1 = $pdo->prepare($selectpcsGlob1);
                //$stmt->bindParam
                $stmtpcsGlob1->execute();
                $totalpcsGlob1 = $stmtpcsGlob1->rowCount();
                while ($rowpcsGlob1 = $stmtpcsGlob1->fetchObject()){
                    $i_cogs=$rowpcsGlob1->i_cogs;
                }
                
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            
            $grandtotal=0;
             $grandtotalcogs=0;
            
                
                $mysubtotal=$i_qty*$i_price;
                $mysubtotalcogs=$i_qty*$i_cogs;

                $totaldisc1 = $mysubtotal*(1-($disc1/100));
                $totaldisc2 = $totaldisc1*(1-($disc2/100));
                $totaldisc3 = $totaldisc2*(1-($disc3/100));
              
                $grandtotal=$grandtotal+$totaldisc3;
                $grandtotalcogs=$grandtotalcogs+$mysubtotalcogs;
                $subgross=$grandtotal-$grandtotalcogs;
            

             //
            echo '<tr>';
            echo '<td>'.$gcodeHead1.'</td><td>'.date('d-m-Y',strtotime($date1)).'</td><td align="right">'.number_format($grandtotal).'</td><td align="right">'.number_format($grandtotalcogs).'</td><td align="right">'.number_format($subgross).'</td>';
            $grandtotal1=$grandtotal1+$grandtotal;
            $grandtotalcogs1=$grandtotalcogs1+$grandtotalcogs;
            $grandgross=$grandgross+$subgross;
      
      
        
                

    }//while*/
    echo '</tr>';
    echo '<tr><td align="right" colspan="3">'.number_format($grandtotal1).'</td><td align="right">'.number_format($grandtotalcogs1).'</td><td align="right">'.number_format($grandgross).'</td></tr>';
echo "</table>";
}

?>
<footer align="center"><a href="/reginvent.php"><font face="calibri" size="2">&copySBK</font><a></footer>
</html>