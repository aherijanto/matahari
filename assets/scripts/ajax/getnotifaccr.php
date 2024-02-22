<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    session_start();
    $upone = dirname(__DIR__);
    date_default_timezone_set("Asia/Jakarta");
    $today = date('Y-m-d');
    $mfdate = $_POST['_date'];
    
    if ($mfdate == ''){
        $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE  wsellhead.c_code = wcustomers.c_code AND type='A/R' ORDER BY s_dateinput DESC;"; 
    }

    if ($mfdate == 'today'){
        echo 'TODAY : ';
        $mfdate1 = date('Y-m-d',strtotime($mfdate));
        $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE  wsellhead.c_code = wcustomers.c_code AND type='A/R' AND wsellhead.s_dateinput='$today' ORDER BY s_dateinput DESC;";
    }else{
        if ($mfdate == 'all'){
            echo 'ALL :';
            $mfdate1 = date('Y-m-d',strtotime($mfdate));
            $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE  wsellhead.c_code = wcustomers.c_code AND type='A/R' ORDER BY s_dateinput DESC;";
        }else{
            //if ($mfdate == ''){
                echo 'BY DATE : '.date('d-m-Y',strtotime($mfdate));
                $mfdate1 = date('Y-m-d',strtotime($mfdate));
                $selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE  wsellhead.c_code = wcustomers.c_code AND type='A/R' AND wsellhead.s_dateinput='$mfdate' ORDER BY s_dateinput DESC;";
            //}else{
            }
    }
    
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
        //$selectpcsGlob = "SELECT * FROM wsellhead,wcustomers WHERE  wsellhead.c_code = wcustomers.c_code AND type='A/R' ORDER BY s_dateinput DESC;";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $grandtotal1 = 0;
    $nourut=0;
    if($totalpcsGlob==0){
        echo 'NotFound';
    }else{
        $mytable='<table width="100%">';
    while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
        //echo $row->c_code;
        $gcodeHead = $rowpcsGlob->s_code;
        $cname = $rowpcsGlob->c_name;
        $date1 = $rowpcsGlob->s_date;
        $duedate = $rowpcsGlob->s_dateinput;
        $bayar = $rowpcsGlob->s_premi;
        $kembali = $rowpcsGlob->s_deduct;
        $type = $rowpcsGlob->type;
        $nourut++;

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        
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
        }
        $grandaccr=0;
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $selectpcsGlob2 = "SELECT SUM(r_amount) as amountMF FROM `waccountr` WHERE s_code='$gcodeHead'";
            $stmtpcsGlob2 = $pdo->prepare($selectpcsGlob2);
            $stmtpcsGlob2->execute();
            $totalpcsGlob2 = $stmtpcsGlob2->rowCount();
            $rowpcsGlob2 = $stmtpcsGlob2->fetchObject();
            $grandaccr = $rowpcsGlob2->amountMF;   
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       $remain = 0;
       $remain = $grandaccr - $grandtotal;
       if ($remain == 0){
        $statusaccr = '<label style="color:white;background-color:green;">PAID</label>';
       }else{
        $statusaccr = '<label style="color:red;">'.number_format($remain).'</label>';
       }

       if($duedate == $today){
        $duedatecolor= 'Due Date: <label style="color:white;background-color:blue;padding:5px 5px;">'.date('d-m-Y',strtotime($duedate)).'</label>';
       }else{
        $duedatecolor= 'Due Date: <label style="padding:5px 5px;">'.date('d-m-Y',strtotime($duedate)).'</label>';
       }

        $mytable.='<tr style="font-size:12px;"><td width="5%" align="center">'.$nourut.'</td>
                            <td width="15%" id="noinv">' . $gcodeHead . '</td><td width="20%">Customer : ' .  $cname . '</td><td width="15%">Date : ' . date('d-m-Y', strtotime($date1)) . '</td><td width="15%">'.$duedatecolor . '</td><td width="10%" align="right">' . number_format($grandtotal) . '</td><td width="10%" align="right" style="padding-left:10px;">' . number_format($grandaccr) . '</td><td width="20%" align="right" style="padding-left:10px;">' . $statusaccr . '</td>
                            </tr>';
        
    } //while*/
    //
    $mytable.= '</table>';
    echo $mytable;
}
//$_SESSION['reports'] = '0';
?>
