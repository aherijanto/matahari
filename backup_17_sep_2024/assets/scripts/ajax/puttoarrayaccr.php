<?php
ob_start();
session_start();
if (!isset($_SESSION['accr'])) {
	$_SESSION['accr'] = array();
}

if ($_POST['mytype']){
	$itemArray = array('mydate'=>$_POST["mydate"],'mytype'=>$_POST["mytype"],'mynocheque'=>$_POST["mynocheque"],'myamount'=>$_POST["myamount"]);
	
	array_push($_SESSION['accr'],$itemArray);
					
    $table='<table class="table table-striped table-hover">';
				
	$grandtotal=0;
	$no=0;
	foreach($_SESSION["accr"] as $item){
		$no++;
		$subtotal=0;
		$diskpercentperitem=0;
					
		$table.='<tbody>
					<tr>
						<td align="center">'.$no.'</td>
                    		<td align="center">'.$item["mydate"].'</td>
							<td align="center">'.strtoupper($item['mytype']).'</td>
							<td align="center">'.$item["mynocheque"].'</td>
							<td align="right">'.number_format($item['myamount']).'</td></tr>';
							
    }// end foreach
		$table.='</tbody></table>';
		echo $table;
		
}//if
        
?>