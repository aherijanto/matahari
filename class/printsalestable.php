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
	font-size:0.8rem;

}

@font-face {
    font-family: 'Baloo Chettan Regular';
    font-style: normal;
    font-weight: normal;
    src: url('/barcode/BalooChettan-Regular.woff') format('woff');
}
}
</style>
</head>

<?php
session_start();
$myinvno1=$_GET['invno'];



$payme=0;
$changeme=0;

$conn3=mysqli_connect('localhost','root','root','utama');
//mysqli_select_db('inventory');

echo '<table width="100%">';
echo '<tr><td colspan="2" class="headerbtm" align="center" >UTAMA</td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm">JL.A. YANI NO 75</td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm">TEGAL </td></tr>';
echo '<tr><td colspan="2" align="center" class="headerbtm">Telp: 0283-4535444</td></tr>';
echo '<tr><td colspan="2" class="headerbtm" align="center">'.$myinvno1.'</td></tr>';
echo '<tr><td class="headerbtm" align="left">'.date('d-m-Y').'</td>';
date_default_timezone_set("Asia/Jakarta");
$mytime=date("h:i:sa");
echo '<td class="headerbtm" align="right">'.$mytime.'</td></tr>';

echo '<tr><td colspan="2"><hr/></td></tr>';
echo '</table>';
$sqlinv="SELECT * FROM wselltail where s_code='$myinvno1'";
$showdetail= mysqli_query($conn3,$sqlinv) or die(mysql_error());
$item_total=0;
$payme=0;
$changeme=0;

$itemcount=0;
echo '<table width="100%">';
while ($row =mysqli_fetch_array($showdetail))
{
	//echo'<br/>';
	$mykdbrg=$row['i_code'];
	$sqlsatuan="SELECT i_unit,i_code from winventory where i_barcode='$mykdbrg'";
	$showsatuan= mysqli_query($conn3,$sqlsatuan) or die(mysql_error());
	if ($row1 =mysqli_fetch_array($showsatuan))
	{ 
	$myitemcode=$row1['i_unit'];
	}	

	
	echo '<tr><td colspan="2" class="auto-style1">'.$row['i_name'].'</td></tr>';
	if ($row['i_name']=='PROMO'){
		echo 'prpm';
		$mysub = 0 - ($row['i_qty']*$row['i_sell']*($row['i_disc1']/100));
	}else{
		

		$mysub=$row['i_qty']*$row['i_sell'];
	}
	echo '<tr><td align="left" class="auto-style1">'.$row['i_qty'].' '.$myitemcode.' x '.number_format($row['i_sell']).'</td><td align="right" class="auto-style1">'.number_format($mysub).'</td></tr>';
	$item_total+=$mysub;
	$itemcount=$itemcount+1;
}
echo '<tr><td colspan="2" class="auto-style1"><hr/></td></tr>';
echo '</table>';
echo '<table width="100%">';
echo '<tr><td align="left" class="auto-style1">TOTAL :</td><td align="right" class="auto-style1">'.number_format($item_total).'</td></tr>';
if (isset($_SESSION['bayar'])){
	$payme=$_SESSION['bayar'];
}

if (isset($_SESSION['kembali'])){
	$changeme=$_SESSION['kembali'];
}

echo '<tr><td class="auto-style1">BAYAR :</td><td align="right" class="auto-style1">'.number_format($payme).'</td></tr>';
echo '<tr><td class="auto-style1">KEMBALI :</td><td align="right" class="auto-style1">'.number_format($changeme).'</td></tr>';
echo '<tr><td class="auto-style1">'.$itemcount.' Item(s)</td></tr>';
echo '<tr><td colspan="2" class="auto-style1"><a href="salesdirect.php?action=new">Terima Kasih</a></td></tr>';
//echo '<br/><p class="auto-style1">Tuhanlah gembalaku, takkan kekurangan aku</p>'; 
echo '</table>';
$_SESSION['cust']='';
$_SESSION['pay']=0;
$_SESSION['change']=0;
?>



</html>

