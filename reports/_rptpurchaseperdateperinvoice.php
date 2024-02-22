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
<div align="center" style="background-color:#370617;font-weight: bold;font;font-size: 30px;color:#F9E79F">PURCHASE PER INVOICE </div>
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
        $selectpcsGlob = "SELECT * FROM wbuyhead,wsuppliers WHERE b_code='$inputinv'AND wbuyhead.s_code = wsuppliers.s_code";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);

        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    echo '<table width="100%">';
    echo '<th>NO FAKTUR</th><th>REF. NO</th><th>SUPLIER</th><th>TGL NOTA</th><th>JTH.TEMPO</th>';
    echo '</table>';
    $grandtotal1 = 0;
    while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
        //echo $row->c_code;
        $bcode = $rowpcsGlob->b_code;
        $refno = $rowpcsGlob->b_refno;
        $sname = $rowpcsGlob->s_name;
        $date1 = $rowpcsGlob->b_date;
        $duedate = $rowpcsGlob->b_dateinput;

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
            $selectpcsGlob1 = "SELECT * FROM `wbuytail` WHERE b_code='$bcode'";
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
        echo '<td width="20%">' . $bcode . '</td><td width="20%">' . $refno . '</td><td width="20%">' .  $sname . '</td><td width="20%">' . date('d-m-Y', strtotime($date1)) . '</td><td width="20%">' . date('d-m-Y', strtotime($duedate)) . '</td>';
        echo '</tr></table>';

        echo '<table width="100%" class="mf">';
        while ($rowpcsGlob1 = $stmtpcsGlob1->fetchObject()) {
            $myi_code = $rowpcsGlob1->i_code;
            $i_qty = $rowpcsGlob1->i_qty;
            $i_cogs = $rowpcsGlob1->i_cogs;
            $disc1 = $rowpcsGlob1->i_disc1;
            $disc2 = $rowpcsGlob1->i_disc2;
            $disc3 = $rowpcsGlob1->i_disc3;
            $mysubtotal = $i_qty * $i_cogs;

            $mysubtotal=0;
			$mysubtotal=$rowpcsGlob1->i_qty * $rowpcsGlob1->i_cogs;
			$subtotalafter = $mysubtotal - ($rowpcsGlob1->i_qty * $rowpcsGlob1->i_disc3);
            $grandtotal = $grandtotal + $subtotalafter;

            $conn=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
            $sqlsatuan="SELECT * from winventory where i_barcode='$myi_code'";
              $showsatuan= mysqli_query($conn,$sqlsatuan) or die(mysqli_error($conn));
              if ($row1 =mysqli_fetch_array($showsatuan))
              { 
                $myitemcode=$row1['i_unit'];
                $mywareid=$row1['ware_id'];
              }	
            echo '<tr style="font-size:12px;color:#023047;">';
            echo '<td style="padding-left:20px;" width="15%">' . $rowpcsGlob1->i_name .' - '.$mywareid. '</td><td width="15%" align="center">' . $i_qty . '</td><td width="15%" align="right">' . number_format($i_cogs) . '</td><td width="15%" align="right">' . number_format($disc1, 3) . '</td><td width="15%" align="right">' . number_format($rowpcsGlob1->i_disc3) . '</td><td width="15%" align="right">' . number_format($grandtotal) . '</td>';
            echo '</tr>';
            $grandtotal1 = $grandtotal1 + $grandtotal;
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