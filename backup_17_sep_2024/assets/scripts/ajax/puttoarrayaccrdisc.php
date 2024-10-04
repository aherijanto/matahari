<?php
ob_start();
session_start();
if (!isset($_SESSION['discaccr'])) {
	$_SESSION['discaccr'] = array();
}

if ($_POST['datedisc']){
	$itemArrayDisc = array('datedisc'=>$_POST["datedisc"],'descdisc'=>$_POST["descdisc"],'amountdisc'=>$_POST["amountdisc"]);
	
	array_push($_SESSION['discaccr'],$itemArrayDisc);
					
    $tabledisc='<table class="table table-striped table-hover">';
				
	$grandtotaldisc=0;
	$nodisc=0;
	foreach($_SESSION["discaccr"] as $itemdisc){
		$nodisc++;
		$subtotaldisc=0;
		$diskpercentperitem=0;
					
		$tabledisc.='<tbody>
					<tr>
						<td align="center">'.$nodisc.'</td>
                    		<td align="center">'.$itemdisc["datedisc"].'</td>
							<td align="center">'.strtoupper($itemdisc['descdisc']).'</td>
							<td align="right">'.number_format($itemdisc['amountdisc']).'</td></tr>';
							
    }// end foreach
		$tabledisc.='</tbody></table>';
		echo $tabledisc;
		//
}//if
        
?>