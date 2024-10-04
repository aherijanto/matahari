  <?php
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
<div align="center" style="background-color: #0f517d ;font-weight: bold;font;font-size: 30px;color:#F9E79F">SALES DETAIL PER BRAND</div>
<div><br></div><div><br></div>

<form action="" method="post">
    <div align="center">
      SELECT BRANDS
      <?php
       include ('../class/_parkerconnection.php');

          $mygroup=1;
          try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT DISTINCT(i_brands) FROM winventory ORDER BY i_brands ASC";
                $stmt = $pdo->prepare($sql);
                
                $stmt->execute();
                $total = $stmt->rowCount();
               
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            echo '<form method="POST"><select name="brands" id="brands" >
                  <option value="" disabled selected>Select Brands Here</option>';
            while ($row = $stmt->fetchObject()) {
              //echo $row->c_code;
              
              echo '<option value="'.$row->i_brands.'">'. $row->i_brands. '</option>';

           }
           echo '</select>';
      ?>



    </div>

    <div align="center">
      SELECT SUPPLIER
      <?php
       include ('../class/_parkerconnection.php');

         
          try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sqlsup = "SELECT * FROM wsuppliers ORDER BY s_code ASC";
                $stmtsup = $pdo->prepare($sqlsup);
                
                $stmtsup->execute();
                $totalsup = $stmtsup->rowCount();
               
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            echo '<form method="POST"><select name="supplier" id="supplier" >
                  <option value="" disabled selected>Select Supplier Here</option>';
            while ($rowsup = $stmtsup->fetchObject()) {
              //echo $row->c_code;
              
              echo '<option value="'.$rowsup->s_code.'">'. $rowsup->s_code.' - '.$rowsup->s_name. '</option>';

           }
           echo '</select>';
      ?>



    </div>
    <div align="center">FROM DATE &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="date" class="me_date" name="mydate" id="mydate"></div>
    <div align="center">TO DATE &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<input type="date" class="me_date" name="mydate2" id="mydate2"></div><br/>
    <div align="center"><input type="submit" name="datesubmit" value="Process"><br/><br/>
</form>

<?php
//

if (isset($_POST['datesubmit'])){
    $mybrands=$_POST['brands'];
    $mysupp=$_POST['supplier'];
    $mydate=$_POST['mydate'];
    $mydate1=date('Y-m-d',strtotime($mydate));
    $mydate2=date('Y-m-d',strtotime($_POST['mydate2']));

  

    
    $grandtotal1=0;
    $grandtotalcogs1=0;
    $grandgross=0;
    $no_seq=0;
    
    //echo '<tr><th>NO FAKTUR</th><th>TGL NOTA</th><th>TOT.SALES</th><th>TOT.COGS</th><th>GROSS</th></tr>';
        

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                $selectpcsGlob1="SELECT wsellhead.*, wselltail.s_code,wselltail.i_name,wselltail.i_code,wselltail.i_qty,wselltail.i_sell,wselltail.i_disc1,wselltail.i_disc2,wselltail.i_disc3,winventory.i_cogs,winventory.i_kdsell,winventory.i_supp FROM `wselltail`,`winventory`,`wsellhead` WHERE (wselltail.s_code=wsellhead.s_code) AND (wselltail.i_code=winventory.i_barcode) AND (winventory.i_brands='$mybrands') AND (winventory.i_supp='$mysupp') AND (wsellhead.s_date BETWEEN '$mydate1' AND '$mydate2') ORDER BY wsellhead.s_date ASC";
                $stmtpcsGlob1 = $pdo->prepare($selectpcsGlob1);
                //$stmt->bindParam
                $stmtpcsGlob1->execute();
                $totalpcsGlob1 = $stmtpcsGlob1->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            $grandtotal=0;
             $grandtotalcogs=0;
             
            //echo '<div><table width="100%">';
            //echo '<tr><td class="tableheader">'.$no_seq.'&nbsp&nbsp&nbsp'.$gcodeHead.'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.date('d-m-Y',strtotime($date1)).'</td></tr>';
            //echo '</table></div>';
            echo '<div align="center">BRAND '.$mybrands.'<br/><br/>';
            echo '<div align="center">FROM '.date('d-m-Y',strtotime($mydate)).' TO '.date('d-m-Y',strtotime($_POST['mydate2'])).'<br/><br/>';
            echo '<div><table width="100%">';
            echo '<th>NO</th><th>KODE BARANG</th><th>SUPP</th><th>TANGGAL</th><th>NO INVOICE</th><th>NAMA ITEM</th><th>QTY</th><th>HARGA</th><th>DISC%1</th><th>DISC%2</th><th>DISCRP</th><th>TOTAL</th>';
            while ($rowpcsGlob1 = $stmtpcsGlob1->fetchObject()) {
              $no_seq++;
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
                $gcodeHead=$rowpcsGlob1->s_code;
                $totaldisc1 = $mysubtotal*(1-($disc1/100));
                $totaldisc2 = $totaldisc1*(1-($disc2/100));
                $totaldisc3 = $totaldisc2-$disc3;
              
                
                $grandtotalcogs=$grandtotalcogs+$mysubtotalcogs;
                $subgross=$grandtotal-$grandtotalcogs;

                 echo '<tr class="details1" ><td width="50px" align="center">'.$no_seq.'</td><td width="150px">'.$i_code.'</td><td width="80px" align="center">'.$rowpcsGlob1->i_supp.'</td><td width="100px" align="center">'.date('d-m-Y',strtotime($rowpcsGlob1->s_date)).'</td><td width="200px" align="center">'.$rowpcsGlob1->s_code.'</td><td width="350px" align="left">'.$i_name.'&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp'.$mykdsell.'</td><td width="80px" align="center">'.$i_qty.'</td><td width="100px" align="right">'.number_format($i_price).'</td><td width="100px" align="center">'.$disc1.'</td><td width="100px" align="center">'.$disc2.'</td><td width="100px" align="center">'.number_format($disc3).'</td><td align="right" width="100px">'.number_format($totaldisc3).'</td></tr>';
                   
                
#--------------------------RETURN SALES--------------------------------------------------------------------------------
                $sqlRet="SELECT * FROM wretsalesdetail where s_code='$gcodeHead' and i_barcode='$i_code'";
                try {
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                  $stmtRet = $pdo->prepare($sqlRet);
                //$stmt->bindParam
                  $stmtRet->execute();
                  $totalRet = $stmtRet->rowCount();
                } catch(PDOException $e) {
                  echo $e->getMessage();
                }
                
                $negNumber=0;
                $totalNeg=0;

                while ($rowret =$stmtRet->fetch())
                {
                  $mysubret=$rowret['i_qty']*$i_price;
                  $totaldisc1Ret = $mysubret*(1-($disc1/100));
                  $totaldisc2Ret = $totaldisc1Ret*(1-($disc2/100));
                  $totaldisc3Ret = $totaldisc2Ret-$disc3;
    
                  echo '<tr><td class="details1" colspan="7" style="font-style:italic;">*****'.$rowret['i_name'].' x '.$rowret['i_qty'].'**RET</td>';
                  $negNumber=0-$totaldisc3Ret;
                  echo '<td align="right" class="details1" style="font-style:italic;">'.number_format($negNumber).'</td></tr>';
                  $totalNeg=$totalNeg+$negNumber;
                }



                $grandtotal=$grandtotal+$totaldisc3+$totalNeg;

            } // 
             //
              $grandtotal1=$grandtotal1+$grandtotal;
              $grandtotalcogs1=$grandtotalcogs1+$grandtotalcogs;
              $grandgross=$grandgross+$subgross;
              echo '<tr><td colspan="8" align="right">'.number_format($grandtotal).'</td></tr>';
             // echo '<tr><td colspan="8"><br/></td></tr>';
              

    
    echo '<tr><td class="tableheader">TOTAL</td><td colspan="7" align="right" class="tableheader">'.number_format($grandtotal1).'</td></tr>';
    echo '</table></div>';
    
}
  
?>
<footer align="center"><a href="/reginvent.php"><font face="calibri" size="2">&copySBK</font><a></footer>
</html>