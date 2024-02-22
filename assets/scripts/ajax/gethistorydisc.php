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
        $selectpcsGlob = "SELECT * FROM wdiscaccountr WHERE s_code='$inputinv'";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
       
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $grandtotal1 = 0;
    if($totalpcsGlob > 0){
      
    
    $mytabledisc='<div class="card shadow-sm mb-5 bg-black rounded" style="background-color:#b9fbc0;">';    
    $mytabledisc.='<div class="card-body">';
        $mytabledisc.='<div class="card-title"><h3 style="color:#d1495b;font-weight:bold;">Discount</h3></div>';
        $mytabledisc.='<p class="card-text">';
        $mytabledisc.='<table width="100%">';
    $grandtotaldisc=0;
    while ($rowpcsGlobdisc = $stmtpcsGlob->fetchObject()) {
        //echo $row->c_code;
        $gcodeHead = $rowpcsGlobdisc->s_code;
        $mydate = $rowpcsGlobdisc->r_date;
        $mytype = $rowpcsGlobdisc->r_desc;
        $myamount = $rowpcsGlobdisc->r_amount;
        $grandtotaldisc= $grandtotaldisc+$myamount;
        $mytabledisc.='<tr style="font-size:12px;"><td width="20%" id="noinv">' . $mydate . '</td><td width="20%">' .  strtoupper($mytype) . '</td></td><td width="20%" align="right">'.number_format($myamount) . '</td></tr>';
        
        
    } //while*///
    $mytabledisc.= '</table>';
    $mytabledisc.='</p>
                <div class="card-footer">
                    <div class="row">
                        <div class="col">GRAND TOTAL</div>
                    
                    <div class="col" align="right"><label id="granddisc" hidden>' .$grandtotaldisc . '</label><medium>'.number_format($grandtotaldisc).'
                    </medium></div>
                    </div>
                    
                </div>
               </div>';
    echo $mytabledisc;
}else{
    echo '0';
}
//$_SESSION['reports'] = '0';
?>
