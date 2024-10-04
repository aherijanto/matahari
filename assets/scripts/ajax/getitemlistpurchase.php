<?php
    session_start();


    function subtotal($qty,$price)
	{
		$subtotal1=0;
		$subtotal1 = $qty * $price;
		return $subtotal1;
	}

    if(isset($_SESSION["cart_item"])){
        $item_total = 0;

        $tablepurchase =  '<table cellpadding="10" cellspacing="1" width="100%">
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
        foreach ($_SESSION["cart_item"] as $item){
            $tablepurchase.= '<tr>
                <td class="auto-style3"><strong>'.$item["barcode"].'</strong></td>
                <td align="left" class="auto-style3">'.$item["name"].'</td>
                <td align="center" class="auto-style3">'.$item["qty"].'</td>
                <td align="right" class="auto-style3">Rp.'.number_format($item["cogs"]).'</td>';
        
                $mysubtotal=0;
                $mysubtotal=subtotal($item['qty'],$item['cogs']);
                $totaldisc3 = $mysubtotal - ($item['qty']*$item['disc3']);
        

            $tablepurchase.='<td align="right" class="auto-style3"> Rp.'.number_format($mysubtotal,0).'</td>
                <td align="right" class="auto-style3">'.number_format($item["disc1"],2).'</td>
                <td align="right" class="auto-style3">'.number_format($item["disc2"],2).'</td>
                <td align="right" class="auto-style3">'.number_format($item["disc3"],2).'</td>
                <td align="right" class="auto-style3">'.$item["tglexp"].'</td>
                <td align="right" class="auto-style3">'.number_format($totaldisc3).'</td>
                <td align="center" class="auto-style3"><a hreff="'.$item["barcode"].'" class="linkkmf btn btn-danger mt-1" >Remove Item</a></td>
                </tr>';
            $grandtotal=$grandtotal+$totaldisc3;

        }
                
            $tablepurchase.= '<tr>
                            <td colspan="11" align="right" class="auto-style3"><font size="18" >'.number_format($grandtotal).'</font></td>
                        </tr>
        </tbody>
        </table>';
        
    }
    echo $tablepurchase;
?>