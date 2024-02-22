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
<div align="center" style="background-color:#D35400;font-weight: bold;font;font-size: 30px;color:#F9E79F">SALES PER INVOICE </div>
<div><br></div>
<div><br></div>
<div align="center" style="padding:15px;">INVOICE NO</div>
<form action="" method="post">
    <div id="invno" align="center"><input type="text" id="inputinv" width="250px" name="inputinv"></div>
    <div align="center"><input type="submit" name="datesubmit" value="Process">
</form>

<?php

if (isset($_POST['datesubmit'])) {

    $_SESSION['reports'] = '1';
    $inputinv = $_POST['inputinv'];
    include $upone . "/class/_parkerconnection.php";

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
        $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE s_code='$inputinv'AND wsellhead.c_code = wcustomers.c_code";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);

        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }


    echo '<table width="100%">';
    echo '<th>NO FAKTUR</th><th>CUSTOMER</th><th>TGL NOTA</th><th>JTH.TEMPO</th><th>TYPE</th>';
    echo '</table>';
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
            //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
            $selectpcsGlob1 = "SELECT * FROM `wselltail` WHERE s_code='$gcodeHead'";
            $stmtpcsGlob1 = $pdo->prepare($selectpcsGlob1);
            //$stmt->bindParam
            $stmtpcsGlob1->execute();
            $totalpcsGlob1 = $stmtpcsGlob1->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }

        $grandtotal = 0;
        $mysubtotal = 0;

        echo '<table width="100%"> <tr>';
        echo '<td width="20%">' . $gcodeHead . '</td><td width="20%">' .  $cname . '</td><td width="20%">' . date('d-m-Y', strtotime($date1)) . '</td><td width="20%">' . date('d-m-Y', strtotime($duedate)) . '</td><td width="20%">' . $type . '</td>';
        echo '</tr></table>';

        echo '<table width="100%" class="mf">';
        while ($rowpcsGlob1 = $stmtpcsGlob1->fetchObject()) {
            $i_qty = $rowpcsGlob1->i_qty;
            $i_price = $rowpcsGlob1->i_sell;
            $disc1 = $rowpcsGlob1->i_disc1;
            $disc2 = $rowpcsGlob1->i_disc2;
            $disc3 = $rowpcsGlob1->i_disc2;
            $mysubtotal = $i_qty * $i_price;
            $mykdbrg = $rowpcsGlob1->i_code;
            $totaldisc1 = $mysubtotal * (1 - ($disc1 / 100));
            $totaldisc2 = $totaldisc1 * (1 - ($disc2 / 100));
            $totaldisc3 = $totaldisc2 * (1 - ($disc3 / 100));

            $grandtotal = $grandtotal + $totaldisc3;
            echo '<tr style="font-size:12px;color:#023047;">';
            echo '<td style="padding-left:20px;" width="15%">' . $rowpcsGlob1->i_name . '</td><td width="15%" align="center">' . $i_qty . '</td><td width="15%" align="right">' . number_format($i_price) . '</td><td width="15%" align="right">' . number_format($disc1, 3) . '</td><td width="15%" align="right">' . number_format($rowpcsGlob1->i_disc3) . '</td><td width="15%" align="right">' . number_format($grandtotal) . '</td>';
            echo '</tr>';

            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
                $selectret = "SELECT * FROM wretsalesdetail where s_code='$gcodeHead' and i_barcode='$mykdbrg'";
                $stmtret = $pdo->prepare($selectret);
                //$stmt->bindParam
                $stmtret->execute();
                $totalret = $stmtret->rowCount();
            } catch (PDOException $e) {
                echo $e->getMessage();
            }
            // $sqlret="SELECT * FROM wretsalesdetail where s_code='$myinvno1' and i_barcode='$mykdbrg'";
	        // $showdetailret= mysqli_query($conn3,$sqlret) or die(mysqli_error());
	        $negNumber=0;
            $totalNeg=0;

	        while ($rowret =$stmtret->fetchObject())
	        {
                $prcdisc = $rowpcsGlob1->i_sell - $rowpcsGlob1->i_disc3;
                $mysubret = $rowret->i_qty * $prcdisc;
		        // $mysubret=$rowret['i_qty']*$row['i_sell'];
		        // $totaldisc1Ret = $mysubret*(1-($disc1/100));
		        // $totaldisc2Ret = $totaldisc1Ret*(1-($disc2/100));
		        // $totaldisc3Ret = $totaldisc2Ret-(($disc3/$row['i_qty'])*$rowret['i_qty']);
                
		        echo '<tr><td class="headerbtm" style="font-style:italic;color:red;font-size:12px;">*****'.$rowret->i_name.' x '.$rowret->i_qty.'**RETURN</td>';
		        $negNumber=0-$mysubret;
		        echo '<td align="right" class="headerbtm" style="font-style:italic;color:red;font-size:12px;" colspan="5">'.number_format($negNumber).'</td></tr>';
		        $totalNeg=$totalNeg+$negNumber;
	        }




            $grandtotal1 = $grandtotal1 + $grandtotal + $totalNeg;
            $grandtotal = 0;
        } //
        echo '</table>';
    } //while*/
    echo '<table width="100%">';
    echo '<tr><td align="right" colspan="6">' . number_format($grandtotal1) . '</td></tr>';
    echo "</table>";
}
$_SESSION['reports'] = '0';
?>
<footer align="center">
    <label id="back" style="color:blue;cursor:pointer;padding:12px 12px;" onclick="window.open('/reginvent.php','_self')">
        &copyMatahari</label>
</footer>

</html>