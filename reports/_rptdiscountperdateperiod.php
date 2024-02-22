<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    session_start();
    ob_start();
    $upone = dirname(__DIR__, 1);
   
?>

<html>
    <head>
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.css">
        <link rel="stylesheet" href="../bootstrap/css/bootstrap.min.css">
        <!-- <script src="../bootstrap/js/bootstrap.js"></script>
        <script src="../bootstrap/js/bootstrap.min.js"></script> -->
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
    </head>
<div align="center" class="text-white bg-primary mt-3 p-3">DISCOUNT PER DATE PERIOD</div>
<div><br></div>
<div><br></div>
<div align="center" style="padding:15px;">SELECT DATE</div>
<form action="" method="post">
    <div align="center">
        From : &nbsp;&nbsp;<input type="date" class="me_date" name="mydate" id="mydate">&nbsp;&nbsp;
        To : &nbsp;&nbsp;<input type="date" class="me_date" name="mydate2" id="mydate2">
    </div>
    <div align="center"><input type="submit" name="datesubmit" value="Process">
</form>

<?php
if (isset($_POST['datesubmit'])) {
    $mydate = $_POST['mydate'];
    $mydate1 = date('Y-m-d', strtotime($mydate));
    $mydate2 = date('Y-m-d', strtotime($_POST['mydate2']));
    $_SESSION['reports'] = '1';
    
    include $upone . "/class/_parkerconnection.php";

   
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            //$selectpcsGlob="SELECT * FROM `wbuyhead`,`wbuytail` WHERE wbuytail.b_code=wbuyhead.b_code";
            $selectpcsGlob = "SELECT * FROM `wdiscaccountr`,`wsellhead`,`wcustomers` where wdiscaccountr.s_code=wsellhead.s_code and wsellhead.c_code=wcustomers.c_code";
            $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
            //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);

            $stmtpcsGlob->execute();
            $totalpcsGlob = $stmtpcsGlob->rowCount();
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    

    echo '<table width="100%">';
    echo '<th>NO</th><th>NO FAKTUR</th><th>CUSTOMER</th><th>TGL NOTA</th><th>JTH.TEMPO<th>TYPE</th><th>DISCOUNT</th>';
    $grandtotal= 0;
    $subtotal=0;
    $nourut=0;
    while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
        //echo $row->c_code;
        $nourut++;
        $gcodeHead = $rowpcsGlob->s_code;
        $cname = $rowpcsGlob->c_name;
        $date1 = $rowpcsGlob->s_date;
        $duedate = $rowpcsGlob->s_dateinput;
        $bayar = $rowpcsGlob->s_premi;
        $kembali = $rowpcsGlob->s_deduct;
        $type = $rowpcsGlob->type;
        $diskon = $rowpcsGlob->r_amount;
        $subtotal = $kembali + $bayar - $diskon;
        
        echo '<tr>';
        echo '<td>' . $nourut . '</td><td>' . $gcodeHead . '</td><td>' . $cname . '</td><td>' . date('d-m-Y', strtotime($date1)) . '</td><td>' . date('d-m-Y', strtotime($duedate)) . '</td><td>' . $type . '</td><td align="right">' . number_format($diskon).'</td>';
        $grandtotal = $grandtotal + $diskon;
    } //while*/
    echo '</tr>';
    echo '<tr><td align="right" colspan="10"> TOTAL : ' . number_format($grandtotal) . '</td></tr>';

    echo "</table>";
}
$_SESSION['reports'] = '0';
?>
<footer align="center">
    <label id="back" style="color:blue;cursor:pointer;padding:12px 12px;"
        onclick="window.open('/reginvent.php','_self')">
        &copyMatahari</label>
</footer>

</html>