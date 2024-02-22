  
<html>
<style>
  table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;

    padding: 1px;
}

tr:nth-child(even) {
    background-color: white;
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

.tableheader{
  color:black;
 font-family: "Times New Roman", Times, serif;
  margin:2px;
  background-color: white;
}

.details1{
  color:black;
  font-family: "Times New Roman", Times, serif;
  font-size: 14px;
 
  margin-bottom:1px;

}

</style>
<div align="center" style="background-color:#D35400;font-weight: bold;font;font-size: 30px;color:#F9E79F">SALES DETAIL PER DATE PERIOD</div>
<div align="center" style="background-color:#D35400;font-weight: bold;font;font-size: 30px;color:#F9E79F">WITHOUT RETURN</div>
<div><br></div><div><br></div>
<div align="center">SELECT DATE</div>
<form action="" method="post">
    <div align="center"><input type="date" class="me_date" name="mydate" id="mydate"></div>
    <div align="center"><input type="date" class="me_date" name="mydate2" id="mydate2"></div>
    <div align="center"><input type="submit" name="datesubmit" value="Process">
</form>

<?php
session_start();
if (isset($_POST['datesubmit'])){
    $mydate=$_POST['mydate'];
    $mydate1=date('Y-m-d',strtotime($mydate));
    $mydate2=date('Y-m-d',strtotime($_POST['mydate2']));
    $_SESSION['reports']='1';
    include '../class/_parkerconnection.php';
    

       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob="SELECT * FROM wsellhead WHERE s_date BETWEEN '$mydate1' AND '$mydate2'";
                $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtpcsGlob->execute();
                $totalpcsGlob = $stmtpcsGlob->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
    

    
    $grandtotal1=0;
    $grandtotalcogs1=0;
    $grandgross=0;
    $no_seq=0;
    
    //echo '<tr><th>NO FAKTUR</th><th>TGL NOTA</th><th>TOT.SALES</th><th>TOT.COGS</th><th>GROSS</th></tr>';
        while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
              //echo $row->c_code;
            $gcodeHead=$rowpcsGlob->s_code;
            $date1=$rowpcsGlob->s_date;
            $bayar=$rowpcsGlob->s_premi;
            $kembali=$rowpcsGlob->s_deduct;

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectpcsGlob1="SELECT wselltail.s_code,wselltail.i_name,wselltail.i_code,wselltail.i_qty,wselltail.i_sell,wselltail.i_disc1,wselltail.i_disc2,wselltail.i_disc3,winventory.i_cogs,winventory.i_kdsell FROM `wselltail`,`winventory` WHERE (wselltail.s_code='$gcodeHead') AND (wselltail.i_code=winventory.i_barcode)";
                $stmtpcsGlob1 = $pdo->prepare($selectpcsGlob1);
                //$stmt->bindParam
                $stmtpcsGlob1->execute();
                $totalpcsGlob1 = $stmtpcsGlob1->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            $grandtotal=0;
             $grandtotalcogs=0;
             $no_seq++;
            echo '<div><table width="100%">';
            echo '<tr><td class="tableheader">'.$no_seq.'&nbsp&nbsp&nbsp'.$gcodeHead.'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.date('d-m-Y',strtotime($date1)).'</td></tr>';
            echo '</table></div>';
            echo '<div><table width="100%">';
            while ($rowpcsGlob1 = $stmtpcsGlob1->fetchObject()) {
                $i_code=$rowpcsGlob1->i_code;
                $i_name=$rowpcsGlob1->i_name;
                $i_qty=$rowpcsGlob1->i_qty;
                $i_price=$rowpcsGlob1->i_sell;
                $i_cogs=$rowpcsGlob1->i_cogs;
                $disc1=$rowpcsGlob1->i_disc1;
                $disc2=$rowpcsGlob1->i_disc2;
                $disc3=$rowpcsGlob1->i_disc3;
                $mysubtotal=$i_qty*$i_price;
                $mysubtotalcogs=$i_qty*$i_cogs;
                $mykdsell=$rowpcsGlob1->i_kdsell;

                $totaldisc1 = $mysubtotal*(1-($disc1/100));
                $totaldisc2 = $totaldisc1*(1-($disc2/100));
                $totaldisc3 = $totaldisc2-$disc3;
                $grandtotal=$grandtotal+$totaldisc3;
                
                $grandtotalcogs=$grandtotalcogs+$mysubtotalcogs;
                $subgross=$grandtotal-$grandtotalcogs;

                 echo '<tr class="details1" ><td width="100px">'.$i_code.'</td><td width="350px" align="left">'.$i_name.'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$mykdsell.'</td><td width="100px" align="center">'.$i_qty.'</td><td width="100px" align="right">'.number_format($i_price).'</td><td width="100px" align="center">'.$disc1.'</td><td width="100px" align="center">'.$disc2.'</td><td width="100px" align="center">'.number_format($disc3).'</td><td align="right" width="100px">'.number_format($totaldisc3).'</td></tr>';
                   
             }// 
             //
              $grandtotal1=$grandtotal1+$grandtotal;
              $grandtotalcogs1=$grandtotalcogs1+$grandtotalcogs;
              $grandgross=$grandgross+$subgross;
              echo '<tr><td colspan="8" align="right">'.number_format($grandtotal).'</td></tr>';
             // echo '<tr><td colspan="8"><br/></td></tr>';
              

    }//while*/
    echo '<tr><td class="tableheader">TOTAL</td><td colspan="7" align="right" class="tableheader">'.number_format($grandtotal1).'</td></tr>';
    echo '</table></div>';
    
}
  
?>
<footer align="center"><a href="/reginvent.php"><font face="calibri" size="2">&copySBK</font><a></footer>
</html>