<?php
ob_start();
session_start();
if (!isset($_SESSION['cart_item'])) {
	$_SESSION['cart_item'] = array();
}

if ($_POST['id']){
	$itemcode1=$_POST['id'];
				
    $disc2=0;
	$artikel='';
	$iwarna='';
				
	$disc=$_POST['disc'];
	$discrp=$_POST['discrp'];

	if ($discrp == '0'){
		$discrp = $disc * $_POST['hrg']/100;
	}

	if ($disc == '0'){
		$disc = $discrp / $_POST['hrg']*100;
	}

	$itemArray = array('code'=>$_POST["id"],'name'=>$_POST['nm'], 'artikel'=>$artikel,'warna'=>$iwarna,'qty'=>$_POST["qty"],'wareid'=>$_POST['wareid'],'cogs'=>$_POST["hrg"],'disc'=>$disc,'disc2'=>$disc2,'discrp'=>$discrp);

	array_push($_SESSION['cart_item'],$itemArray);
					
    $table='<table class="table table-striped table-hover">';
    $item_total = 0;

    $table.=  '<table cellpadding="10" cellspacing="1" width="100%">
                <tbody>
                <tr>
                <th align="center" class="auto-style1"><strong>KODE BARANG</strong></th>
                <th class="text-center"><strong>NAMA BARANG</strong></th>
                <th class="text-center"><strong>QTY</strong></th>
                <th class="text-center"><strong>HARGA</strong></th>
                <th class="text-center"><strong>JUMLAH</strong></th>
                <th class="text-center"><strong>DISC #1</strong></th>
                <th class="text-center"><strong>DISC #2</strong></th>
                <th class="text-center"><strong>DISC #3</strong></th>
                <th class="text-center"><strong>TGL.EXP</strong></th>
                <th class="text-center"><strong>SUBTOTAL</strong></th>
                <th class="text-center"><strong>ACTION</strong></th>
                </tr>';
    
				
	$grandtotal=0;
	$no=0;
	foreach($_SESSION["cart_item"] as $item){
		$no++;
		$subtotal=0;
		$diskpercentperitem=0;
					
		$table.='<tbody>
					<tr>
						<td align="center">'.$no.'</td>
                    		<td align="center">'.$item["code"].'</td>
							<td align="left">'.$item['name'].'</td>
							<td align="left">'.$item['wareid'].'</td>
                            <td align="center">'.$item['qty'].'</td>
                            
							<td align="right">'.number_format($item['cogs']).'</td>
							<td align="right">'.number_format($item['disc'],2).'</td>
							<td align="right">'.number_format($item['discrp']).'</td>';
							
							$discperitem = $item['cogs'] - $item['discrp'];
							$subtotal = $item['qty'] * ($item['cogs']-$item['discrp']);
							$sumtotaldisc = $item['qty'] * $item['discrp'];
							$table.='<td align="right">'.number_format($sumtotaldisc).'</td>
							<td align="right" style="font-weight:bold;font-size:18px;">'.number_format($subtotal).'</td>
							<td class="text-center"><a hreff="'.$item["code"].'" class="link1 btn btn-danger">Remove</a></td></tr>';
    }// end foreach
		$table.='</tbody>
				</table>';
		        echo $table;
}//if
        
?>