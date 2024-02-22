<html>
<head>
<meta content="en-us" http-equiv="Content-Language">
<style type="text/css">
	.auto-style1 {
		font-family: Calibri;
	font-size: small;

}

.title{
	font-family: Baloo Chettan;
	font-size: 2rem;
	font-weight: bold;

}

.headerbtm{
	font-family: Arial;
	font-size:12px;

}


}
</style>
</head>

<?php
session_start();
ob_start();
$_SESSION['reports']='0';
$myinvno1=$_GET['invno'];

$userInv=$_SESSION['user'];

$payme=0;
$changeme=0;

$conn3=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
$sqlcompany="SELECT * FROM wcompany;";
$showcompany= mysqli_query($conn3,$sqlcompany) or die(mysql_error());
$rowcompany = mysqli_fetch_array($showcompany);
$name = $rowcompany['name'];
$addr1 = $rowcompany['address1'];
$addr2 = $rowcompany['address2'];
$city = $rowcompany['city'];
$phone = $rowcompany['phone'];
//mysqli_select_db('inventory');

echo '<table width="100%">';
echo '<tr><td colspan="2" class="headerbtm" align="center" >'.$name.'</td></tr>';
echo '<tr><td colspan="2" class="headerbtm" align="center" >'.$addr1.'</td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm">'.$addr2.'</td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm">'.$city.'</td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm">'.$phone.'</td></tr>';
//echo '<tr><td colspan="2" class="headerbtm" align="center">'.$myinvno1.'</td></tr>';
echo '<tr><td class="headerbtm" align="left">'.date('d-m-Y').'</td>';
date_default_timezone_set("Asia/Jakarta");
$mytime=date("h:i:sa");


echo '<tr><td colspan="2"><hr/></td></tr>';
echo '</table>';
$sqlinv="SELECT * FROM wselltail where s_code='$myinvno1'";
$showdetail= mysqli_query($conn3,$sqlinv) or die(mysql_error());
$item_total=0;
$payme=0;
$changeme=0;

$itemcount=0;
$totaldisc1=0;
$totaldisc2=0;
$totaldisc3=0;

echo '<table width="100%">';
while ($row =mysqli_fetch_array($showdetail))
{
	//echo'<br/>';
	$mykdbrg=$row['i_code'];
	$disc1=$row['i_disc1'];
	$disc2=$row['i_disc2'];
	$disc3=$row['i_disc3'];

	$sqlsatuan="SELECT * from winventory where i_barcode='$mykdbrg'";
	
	$showsatuan= mysqli_query($conn3,$sqlsatuan) or die(mysql_error());
	if ($row1 =mysqli_fetch_array($showsatuan))
	{ 
		$myitemcode=$row1['i_unit'];
		$mywareid=$row1['ware_id'];
	}	

	$mysub=$row['i_qty']*$row['i_sell'];
	echo '<tr><td colspan="2" class="headerbtm">'.$row['i_name'].' - '.$mywareid.'</td></tr>';
	$totaldisc1 = $mysub*(1-($disc1/100));
	$totaldisc2 = $totaldisc1*(1-($disc2/100));
	$totaldisc3 = $totaldisc2-$disc3;

	
	if($disc1<>0 || $disc2<>0 || $disc3<>0){
					$totaldisc1ex=$mysub*$disc1/100;
					$subtotaldisc1=$mysub-$totaldisc1ex;
					$totaldisc2ex=$subtotaldisc1*($disc2/100);
					$subtotaldisc2=$subtotaldisc1-$totaldisc2ex;
					$gtotaldisc=$totaldisc1ex+$totaldisc2ex-$disc3;

		echo '<tr>
			<td align="left" class="headerbtm">'.$row['i_qty'].' '.$myitemcode.' x '.number_format($row['i_sell']).'</td></tr>
			<tr><td class="headerbtm">DISCOUNT  '.number_format($gtotaldisc).'</td>
			<td align="right" class="headerbtm">'.number_format($totaldisc3).'</td></tr>';

	}else{	
		echo '<tr><td align="left" class="headerbtm">'.$row['i_qty'].' '.$myitemcode.' x '.number_format($row['i_sell']).'</td><td align="right" class="headerbtm">'.number_format($totaldisc3).'</td></tr>';
	}
	
	$item_total+=$totaldisc3;
	$itemcount=$itemcount+1;
}
echo '<tr><td colspan="2" class="headerbtm"><hr/></td></tr>';
//echo '</table>';
//echo '<table width="100%">';
echo '<tr><td align="left" class="headerbtm">TOTAL :</td><td align="right" class="headerbtm">'.number_format($item_total).'</td></tr>';
if (isset($_SESSION['bayar'])){
	$payme=$_SESSION['bayar'];
}

if (isset($_SESSION['kembali'])){
	$changeme=$_SESSION['kembali'];
}

echo '<tr><td class="headerbtm">BAYAR :</td><td align="right" class="headerbtm">'.number_format($payme).'</td></tr>';
echo '<tr><td class="headerbtm">KEMBALI :</td><td align="right" class="headerbtm">'.number_format($changeme).'</td></tr>';
echo '<tr><td class="headerbtm">'.$itemcount.' Item(s)</td></tr>';
echo '<td class="headerbtm" align="left">'.$mytime.' / '.$userInv.' / '.$myinvno1.'</td></tr>';
echo '<tr><td colspan="2" class="headerbtm" align="center"><a href="salesdirect.php?action=new" style="text-decoration:none;color:#000000;">TERIMA KASIH ATAS KUNJUNGAN ANDA</a></td></tr>'; 
echo '</table>';
$_SESSION['cust']='';
$_SESSION['pay']=0;
$_SESSION['change']=0;
unset($_SESSION['bayar']);
unset($_SESSION['kembali']);
?>



</html>

