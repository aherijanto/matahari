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
error_reporting(E_ALL);
$_SESSION['reports']='0';
ini_set("display_errors", "On");
$_SESSION['reports']='0';
$myinvno1=$_GET['invno'];

$userInv=$_SESSION['user'];

$payme=0;
$changeme=0;

$conn3=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
//mysqli_select_db('inventory');

echo '<table width="100%">';
echo '<tr><td colspan="2" class="headerbtm" align="center">TB.MATAHARI</td></tr>';
echo '<tr><td colspan="2" class="headerbtm" align="center">TEGAL</td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm"></td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm" style="font-weight:bold;font-size:14px;">INVOICE</td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm" style="font-weight:bold;font-size:14px;">SALES RETURN</td></tr>';
//echo '<tr><td colspan="2" class="headerbtm" align="center">'.$myinvno1.'</td></tr>';
echo '<tr><td class="headerbtm" align="left">'.date('d-m-Y').'</td>';
date_default_timezone_set("Asia/Jakarta");
$mytime=date("h:i:sa");


echo '<tr><td colspan="2"><hr/></td></tr>';
echo '</table>';
$sqlinv="SELECT wselltail.*, winventory.i_unit,winventory.i_code,winventory.i_barcode,wselltail.i_qty as sellqty FROM wselltail,winventory where s_code='$myinvno1' AND wselltail.i_code=winventory.i_code";
$showdetail= mysqli_query($conn3,$sqlinv) or die(mysqli_error());
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
	
	$mykdbrg=$row['i_code'];
	$disc1=$row['i_disc1'];
	$disc2=$row['i_disc2'];
	$disc3=$row['i_disc3'];

	// $sqlsatuan="SELECT * from winventory where i_barcode='$mykdbrg'";
	
	// $showsatuan= mysqli_query($conn3,$sqlsatuan) or die(mysqli_error());
	// if ($row1 =mysqli_fetch_array($showsatuan))
	// { 
	$myitemcode=$row['i_unit'];
	//}	

	$mysub=$row['sellqty']*$row['i_sell'];
	echo '<div>';
	echo '<tr><td colspan="2" class="headerbtm">'.$row['i_name'].'</td></tr>';
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
	
#---------------------------CheckIfReturn--------------------------------------------------------------------------------
	$sqlret="SELECT * FROM wretsalesdetail where s_code='$myinvno1' and i_barcode='$mykdbrg'";
	$showdetailret= mysqli_query($conn3,$sqlret) or die(mysqli_error());
	$negNumber=0;
	$totalNeg=0;

	while ($rowret =mysqli_fetch_array($showdetailret))
	{
		$mysubret=$rowret['i_qty']*$row['i_sell'];
		$totaldisc1Ret = $mysubret*(1-($disc1/100));
		$totaldisc2Ret = $totaldisc1Ret*(1-($disc2/100));
		$totaldisc3Ret = $totaldisc2Ret-(($disc3/$row['i_qty'])*$rowret['i_qty']);
		
		echo '<tr><td class="headerbtm" style="font-style:italic;">*****'.$rowret['i_name'].' x '.$rowret['i_qty'].'**RETURN</td>';
		$negNumber=0-$totaldisc3Ret;
		echo '<td align="right" class="headerbtm" style="font-style:italic;">'.number_format($negNumber).'</td></tr>';
		$totalNeg=$totalNeg+$negNumber;
	}

	$item_total+=$totaldisc3+$totalNeg;
	$itemcount=$itemcount+1;
	echo '</div>';
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
echo '<tr><td class="headerbtm">KEMBALI :</td><td align="right" class="headerbtm">'.number_format($totalNeg).'</td></tr>';
echo '<tr><td class="headerbtm">'.$itemcount.' Item(s)</td></tr>';
echo '<td class="headerbtm" align="left">'.$mytime.' / '.$userInv.' / '.$myinvno1.'</td></tr>';
echo '<tr><td colspan="2" class="headerbtm" align="center"><a href="retsales.php" style="text-decoration:none;color:#000000;">TERIMA KASIH ATAS KUNJUNGAN ANDA</a></td></tr>'; 
echo '</table>';
$_SESSION['cust']='';
$_SESSION['pay']=0;
$_SESSION['change']=0;
unset($_SESSION['bayar']);
unset($_SESSION['kembali']);
$_SESSION['reports']='0';
?>



</html>

