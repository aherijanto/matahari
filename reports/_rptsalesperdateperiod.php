<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");
session_start();
ob_start();
$upone = dirname(__DIR__, 1);
?>

<html>
<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;

        padding: 8px;
    }

    tr:nth-child(even) {
        background-color: #dddddd;
    }

    input[type=submit] {
        background-color: #0a9396;
        border: none;
        border-radius: 5px;
        color: white;
        padding: 10px 20px;
        text-decoration: none;
        margin: 4px 2px;
        cursor: pointer;
    }

    .me_date {
        padding: 5px 5px;

        color: black;
        font-size: 16px;
    }
</style>
<div align="center" style="background-color:#D35400;font-weight: bold;font;font-size: 30px;color:#F9E79F">SALES PER DATE PERIOD</div>
<div><br></div>
<div><br></div>
<div align="center" style="padding:15px;">SELECT DATE</div>
<form action="" method="post">
    <div align="center">
        From : &nbsp;&nbsp;<input type="date" class="me_date" name="mydate" id="mydate">&nbsp;&nbsp;
        To : &nbsp;&nbsp;<input type="date" class="me_date" name="mydate2" id="mydate2">
    </div>
    <div align="center" style="padding:20px;">
        <select id="slcttype" name="slcttype" style="font-size:14px;width:200px;">
            <option value="0" selected>Select Type</option>
            <option value="All">All Account</option>
            <option value="Cash">Cash</option>
            <option value="A/R">A/R</option>
            
        </select>
    </div>
    <div align="center"><input type="submit" name="datesubmit" value="Process">
</form>

<?php

if (isset($_POST['datesubmit'])) {
    $mydate = $_POST['mydate'];
    $mydate1 = date('Y-m-d', strtotime($mydate));
    $mydate2 = date('Y-m-d', strtotime($_POST['mydate2']));
    $_SESSION['reports'] = '1';
    $mytype = $_POST['slcttype'];
    include $upone . "/class/_parkerconnection.php";

    if ($mytype=="All"){
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
            $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE s_date BETWEEN '$mydate1' AND '$mydate2' AND wsellhead.c_code = wcustomers.c_code";
            $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
            //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
    
            $stmtpcsGlob->execute();
            $totalpcsGlob = $stmtpcsGlob->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }else{
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
            $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE s_date BETWEEN '$mydate1' AND '$mydate2' AND type='$mytype' AND wsellhead.c_code = wcustomers.c_code";
            $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
            //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
    
            $stmtpcsGlob->execute();
            $totalpcsGlob = $stmtpcsGlob->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

    }

    


    echo '<table width="100%">';
    echo '<th>NO FAKTUR</th><th>CUSTOMER</th><th>TGL NOTA</th><th>JTH.TEMPO<th>TYPE</th><th>BAYAR</th><th>KEMBALI</th><th>TOTAL</th><th>RETURN</th><th>SUBTOTAL</th>';
    $grandtotal1 = 0;
    while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
        //echo $row->c_code;
        $gcodeHead = $rowpcsGlob->s_code;
        $cname = $rowpcsGlob->c_name;
        $date1 = $rowpcsGlob->s_date;
        $duedate = $rowpcsGlob->s_dateinput;
        $bayar = $rowpcsGlob->s_premi;
        $kembali = $rowpcsGlob->s_deduct;
        $type = $rowpcsGlob->type;
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           
            $selectpcsGlob1 = "SELECT * FROM `wselltail` WHERE s_code='$gcodeHead'";
            $stmtpcsGlob1 = $pdo->prepare($selectpcsGlob1);
           
            $stmtpcsGlob1->execute();
            $totalpcsGlob1 = $stmtpcsGlob1->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $grandtotal = 0;
        $mysubtotal = 0;
        $ifReturnTotal = 0;
        
        while ($rowpcsGlob1 = $stmtpcsGlob1->fetchObject()) {
            $i_qty = $rowpcsGlob1->i_qty;
            $i_price = $rowpcsGlob1->i_sell;
            $disc1 = $rowpcsGlob1->i_disc1;
            $disc2 = $rowpcsGlob1->i_disc2;
            $disc3 = $rowpcsGlob1->i_disc2;
            $mysubtotal = $i_qty * $i_price;

            $totaldisc1 = $mysubtotal * (1 - ($disc1 / 100));
            $totaldisc2 = $totaldisc1 * (1 - ($disc2 / 100));
            $totaldisc3 = $totaldisc2 * (1 - ($disc3 / 100));

            $grandtotal = $grandtotal + $totaldisc3;
            
        } //

            $negNumber=0;
	        $totalNeg=0;
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
               
                $selectReturnSales = "SELECT * , wretsalesdetail.i_qty AS retqty, wselltail.i_qty as sellqty FROM `wretsalesdetail`,`wselltail` WHERE wretsalesdetail.s_code='$gcodeHead' and wretsalesdetail.s_code=wselltail.s_code and wretsalesdetail.i_barcode = wselltail.i_code";
                $stmtReturnSales = $pdo->prepare($selectReturnSales);
               
                $stmtReturnSales->execute();
                $totalReturnSales = $stmtReturnSales->rowCount();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
    
           
            while ($rowret =$stmtReturnSales->fetchObject())
            {
                $prcdisc = $rowret->i_sell - $rowret->i_disc3;
                $mysubret = $rowret->retqty * $prcdisc;
                // $totaldisc1Ret = $mysubret*(1-($disc1/100));
                // $totaldisc2Ret = $totaldisc1Ret*(1-($disc2/100));
                // $totaldisc3Ret = $totaldisc2Ret-(($disc3/$rowret->retqty) * $rowret->retqty);
                
                // echo '<tr><td class="headerbtm" style="font-style:italic;">*****'.$rowret['i_name'].' x '.$rowret['i_qty'].'**RETURN</td>';
                $negNumber=0-$mysubret;
                // echo '<td align="right" class="headerbtm" style="font-style:italic;">'.number_format($negNumber).'</td></tr>';
                $totalNeg=$totalNeg+$negNumber;
            }
        
            $ifReturnTotal = $grandtotal + $totalNeg;
        
        echo '<tr>';
        echo '<td>' . $gcodeHead . '</td><td>' . $cname . '</td><td>' . date('d-m-Y', strtotime($date1)) . '</td><td>' . date('d-m-Y', strtotime($duedate)) . '</td><td>' . $type . '</td><td align="center">' . number_format($bayar) . '</td><td align="center">' . number_format($kembali) . '</td><td align="right">' . number_format($grandtotal) . '</td><td align="right">' . number_format($totalNeg) . '</td><td align="right">' . number_format($ifReturnTotal) . '</td>';
        $grandtotal1 = $grandtotal1 + $ifReturnTotal;

        
	    

    } //while*/
    echo '</tr>';
    echo '<tr><td align="right" colspan="10"> TOTAL : ' . number_format($grandtotal1) . '</td></tr>';
    
    echo "</table>";
}
$_SESSION['reports'] = '0';
?>
<footer align="center">
    <label id="back" style="color:blue;cursor:pointer;padding:12px 12px;" onclick="window.open('/reginvent.php','_self')">
        &copyMatahari</label>
</footer>

</html>