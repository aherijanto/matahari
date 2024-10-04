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
</style>
<?php


include ('../class/_parkerconnection.php');

       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob="SELECT * FROM wbuyhead";
                $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtpcsGlob->execute();
                $totalpcsGlob = $stmtpcsGlob->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    echo '<div align="center"> PURCHASING GLOBAL</div>';

    echo '<table width="100%">';
    echo '<th>NO FAKTUR</th><th>NO NOTA</th><th>TGL. TERIMA</th><th>JTH.TEMPO</th><th>SUPPLIER</th><th>TOTAL</th>';
        while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
							//echo $row->c_code;
						$gcodeHead=$rowpcsGlob->b_code;
						$icodeHead=$rowpcsGlob->b_refno;
						$date1=$rowpcsGlob->b_date;
            $date2=$rowpcsGlob->b_dateinput;
            $supp=$rowpcsGlob->s_code;

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob1="SELECT * FROM `wbuytail` WHERE b_code='$gcodeHead'";
                $stmtpcsGlob1 = $pdo->prepare($selectpcsGlob1);
                //$stmt->bindParam
                $stmtpcsGlob1->execute();
                $totalpcsGlob1 = $stmtpcsGlob1->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            $grandtotal=0;
            $mysubtotal=0;

            while ($rowpcsGlob1 = $stmtpcsGlob1->fetchObject()) {
                $i_qty=$rowpcsGlob1->i_qty;
                $i_price=$rowpcsGlob1->i_cogs;
                $disc1=$rowpcsGlob1->i_disc1;
                $disc2=$rowpcsGlob1->i_disc2;
                $disc3=$rowpcsGlob1->i_disc2;
                $mysubtotal=$i_qty*$i_price;

                $totaldisc1 = $mysubtotal*(1-($disc1/100));
                $totaldisc2 = $totaldisc1*(1-($disc2/100));
                $totaldisc3 = $totaldisc2*(1-($disc3/100));
						
                $grandtotal=$grandtotal+$mysubtotal;
            } //
            echo '<tr>';
            echo '<td>'.$gcodeHead.'</td><td>'.$icodeHead.'</td><td align="center">'.date('d-m-Y',strtotime($date1)).'</td><td align="center">'.date('d-m-Y',strtotime($date2)).'</td><td>'.$supp.'</td><td align="right">'.number_format($grandtotal).'</td>';
            $grandtotal1=$grandtotal1+$grandtotal;
			
			
				
           			

		}//while*/
    echo '</tr>';
		echo '<tr><td align="right" colspan="6">'.number_format($grandtotal1).'</td></tr>';
echo "</table>";

?>
<footer align="center"><a href="/reginvent.php"><font face="calibri" size="2">&copySBK</font><a></footer>
</html>