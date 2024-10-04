
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
session_start();


include ('class/_parkerconnection.php');

       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob="SELECT * FROM wsellhead";
                $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtpcsGlob->execute();
                $totalpcsGlob = $stmtpcsGlob->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    echo '<div align="center"> SALES ALL</div>';

    echo '<table width="100%">';
    echo '<th>NO FAKTUR</th><th>TGL NOTA</th><th>BAYAR</th><th>KEMBALI</th><th>TOTAL</th>';
    $grandtotal1=0;
        while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
              //echo $row->c_code;
            $gcodeHead=$rowpcsGlob->s_code;
            $date1=$rowpcsGlob->s_date;
            $bayar=$rowpcsGlob->s_premi;
            $kembali=$rowpcsGlob->s_deduct;

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob1="SELECT * FROM `wselltail` WHERE s_code='$gcodeHead'";
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
                $i_price=$rowpcsGlob1->i_sell;
                $disc1=$rowpcsGlob1->i_disc1;
                $disc2=$rowpcsGlob1->i_disc2;
                $disc3=$rowpcsGlob1->i_disc2;
                $mysubtotal=$i_qty*$i_price;

                $totaldisc1 = $mysubtotal*(1-($disc1/100));
                $totaldisc2 = $totaldisc1*(1-($disc2/100));
                $totaldisc3 = $totaldisc2*(1-($disc3/100));
            
                $grandtotal=$grandtotal+$totaldisc3;
            } //
            echo '<tr>';
            echo '<td>'.$gcodeHead.'</td><td>'.date('d-m-Y',strtotime($date1)).'</td><td align="center">'.number_format($bayar).'</td><td align="center">'.number_format($kembali).'</td><td align="right">'.number_format($grandtotal).'</td>';
            $grandtotal1=$grandtotal1+$grandtotal;
      
      
        
                

    }//while*/
    echo '</tr>';
    echo '<tr><td align="right" colspan="6">'.number_format($grandtotal1).'</td></tr>';
echo "</table>";

?>
<footer align="center"><a href="/reginvent.php"><font face="calibri" size="2">&copySBK</font><a></footer>
</html>