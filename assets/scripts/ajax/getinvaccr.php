<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    session_start();
    $upone = dirname(__DIR__);

    $inputinv = $_POST['inputinv'];
    $db='mimj5729_matahari';$user='mimj5729_myroot';$pwd='myroot@@##';
    try 
    {
	    $pdo = new PDO('mysql:host=localhost;dbname='.$db, $user, $pwd);
    }
        catch (PDOException $e) 
    {
        echo 'Error: ' . $e->getMessage();
        exit();
    }

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE s_code='$inputinv' AND wsellhead.c_code = wcustomers.c_code";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $grandtotal1 = 0;
    if($totalpcsGlob==0){
        echo 'NotFound';
    }else{
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
        $mytable='<div class="card shadow-sm mb-5 bg-black rounded" style="background-color:#caf0f8;">';
        
            $mytable.='<div class="card-body">';
                $mytable.='<div class="card-title" style="background-color:#e9c46a;">';
                $mytable.='<table width="100%"><tr><td width="20%" id="noinv">' . $gcodeHead . '</td><td width="20%">Customer : ' .  $cname . '</td><td width="20%">Date : ' . date('d-m-Y', strtotime($date1)) . '</td><td width="20%">Due Date: ' . date('d-m-Y', strtotime($duedate)) . '</td><td width="20%" align="center">Payment : ' . $type . '</td></tr></table></div>';

                $mytable.='<p class="card-text">';
        
        $mytable.='<table width="100%" class="mf">';
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
            $mytable.= '<tr style="font-size:12px;color:#023047;">';
            $mytable.= '<td style="padding-left:20px;" width="15%">' . $rowpcsGlob1->i_name . '</td><td width="15%" align="center">' . $i_qty . '</td><td width="15%" align="right">' . number_format($i_price) . '</td><td width="15%" align="right">' . number_format($disc1, 3) . '</td><td width="15%" align="right">' . number_format($rowpcsGlob1->i_disc3) . '</td><td width="15%" align="right">' . number_format($grandtotal) . '</td>';
            $mytable.= '</tr>';

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
                
		        $mytable.= '<tr><td class="headerbtm" style="font-style:italic;color:red;font-size:12px;">*****'.$rowret->i_name.' x '.$rowret->i_qty.'**RETURN</td>';
		        $negNumber=0-$mysubret;
		        $mytable.= '<td align="right" class="headerbtm" style="font-style:italic;color:red;font-size:12px;" colspan="5">'.number_format($negNumber).'</td></tr>';
		        $totalNeg=$totalNeg+$negNumber;
	        }

            
            $grandtotal1 = $grandtotal1 + $grandtotal+$totalNeg;
            $grandtotal = 0;
        } //
        $mytable.= '</table>';
    } //while*/
    //
    $mytable.='<table width="100%">';
    $mytable.='<tr><td align="right" colspan="6"><label id="grandtotal1" hidden>' .$grandtotal1 . '</label>' . number_format($grandtotal1) . '</td></tr>';
    $mytable.= "</table>";
    $mytable.='</p>
                <div class="card-footer">INFO</div>
               </div>';
    echo $mytable;
}
//$_SESSION['reports'] = '0';
?>
