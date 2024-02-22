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
        $selectpcsGlob = "SELECT * FROM waccountr WHERE s_code='$inputinv'";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
       
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $grandtotal1 = 0;
    if($totalpcsGlob > 0){
      
    
    $mytable='<div class="card shadow-sm mb-5 bg-black rounded" style="background-color:#fde4cf;">';    
    $mytable.='<div class="card-body">';
        $mytable.='<div class="card-title"><h3 style="color:#0a9396;font-weight:bold;">History</h3></div>';
        $mytable.='<p class="card-text">';
        $mytable.='<table width="100%">';
    $grandtotal=0;
    while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
        //echo $row->c_code;
        $gcodeHead = $rowpcsGlob->s_code;
        $mydate = $rowpcsGlob->r_date;
        $mytype = $rowpcsGlob->r_type;
        $mycheque = $rowpcsGlob->r_nocheque;
        $myamount = $rowpcsGlob->r_amount;
        $grandtotal= $grandtotal+$myamount;
        $mytable.='<tr style="font-size:12px;"><td width="20%" id="noinv">' . $mydate . '</td><td width="20%">' .  strtoupper($mytype) . '</td><td width="20%">' . $mycheque . '</td><td width="20%" align="right">'.number_format($myamount) . '</td></tr>';
        
        
    } //while*///
    $mytable.= '</table>';
    $mytable.='</p>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">GRAND TOTAL</div>
                    
                    <div class="col" align="right"><label id="grandhist" hidden>' .$grandtotal . '</label><medium>'.number_format($grandtotal).'
                    </medium></div>
                    </div>
                    <div class="row">
                        <div class="col">REMAINING</div>
                        <div class="col" align="right"><medium id="remainingmedium"></medium></div>
                    </div>
                </div>
               </div>';
    echo $mytable;
}else{
    echo '0';
}
//$_SESSION['reports'] = '0';
?>
