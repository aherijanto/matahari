<?php
session_start();
//if (isset($_SESSION['user'])!="" ){
$mydate='';
$mypremi=0;
$mydeduct=0;


function getCustomer()
{
	try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }



            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wcustomers WHERE c_code = :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      
            while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $myc_name=$row->c_name;
               $myc_addr=$row->c_addr;
               $myc_phone=$row->c_phone;
              }

             
}

function getSalesHead($inv)
{
	try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }


            
            $mcode=$inv;
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wsellhead WHERE s_code = :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      
            while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $myinv=$row->s_code;
               $mydate=$row->s_date;
               $_SESSION['mydatedb']=$mydate;
               $myc_code=$row->c_code;
               $mypremi=$row->s_premi;
               $mydeduct=$row->s_deduct;
              }
              $_SESSION['premi']=$mypremi;
              $_SESSION['potongan']=$mydeduct;
              return $myc_code;

}


if (!empty($_GET['invno']))
{
	$invno=$_GET['invno'];
	$c_code=getSalesHead($invno);
	try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }

            
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wcustomers WHERE c_code = :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $c_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      
            while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $myc_name=$row->c_name;
               $myc_addr=$row->c_addr;
               $myc_kel=$row->c_kel;
               $myc_kec=$row->c_kec;
               $myc_phone=$row->c_phone;
               $myc_rt=$row->c_rt;
              
              }




}
?>

<html>
<style>
	 @font-face {
                                  font-family: code39;
                                  src: url(barcode/Code39Azalea.ttf);
</style>

<body>
<table height="40px" width="100%">
	<tr>
		<td><font face="calibri" size="2">TOKO EMAS WALET<br/>RUKO PERDAGANGAN BLOK D NO 5<br/>SLAWI<br/>TELP (0283) 6198416</font></td>
		<td align="center" ><font face="calibri" color="black"><b>SURAT<br/> PEMBELIAN</b></font></td>
		<td></td>
		<td align="right"><font face="calibri" size="2"><b><?php echo $c_code;?> <br/> <?php echo $myc_name; ?><br/> <?php echo $myc_addr; ?><br/>
			RT/RW <?php echo $myc_rt; ?><br/><?php echo $myc_kel; ?><br/><?php echo $myc_kec; ?><br/><?php echo $myc_phone; ?><br/></b></font></td>
	</tr>

	<?php $mytime=date("h:i:sa"); $showdate=$_SESSION['mydatedb'];?>

	<tr>
		<td align="left"><font face="calibri" size="2"><b>No Faktur : <?php echo $invno ?></b></font></td>
		<td align="center"><font face="calibri" size="2"><b>Username</b></font></td>
		<td align="center"><font face="calibri" size="2"><b><?php echo date('d-M-Y',strtotime($showdate));?></b></font></td>
		<td align="center"><font face="calibri" size="2"><b><?php echo $mytime;?></b></font></td>
	</tr>
	<tr>
		<td colspan="4"><hr/></td>
	</tr>

<?php 
	 try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wselltail WHERE s_code = :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $invno, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
               
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      		$mytotal=0;$mygrand=0;
      		$mypremi1=$_SESSION['premi'];
            $mydeduct=$_SESSION['potongan'];
            
            while ($row = $stmt->fetchObject()) {
               //echo $row->i_code;
               $myg_code=$row->g_code;
               $myi_code=$row->i_code;
               $myi_name=$row->i_name;
               $myi_qty=$row->i_qty;
               $myi_price=$row->i_cogs;
               $myi_weight=$row->i_weight;
               $myimgfile=$row->i_imgfile;
              
              $mytotal=$mytotal+((number_format($myi_weight,3)*$myi_price)*$myi_qty);
               
               $mygrand= $mygrand + $mytotal;
              }
              $_SESSION['mygrand']= $mygrand;
              
?>

	
	<tr>
		<td align="left"><font face="calibri" size="2"><b><?php echo $myg_code;?>--<?php echo $myi_code;?><br/><?php echo $myi_name;?><br/><br/><br/>Mulus/Tidak Mulus</b></font></td>
		<td align="center"><font face="calibri" size="2"><b><?php echo number_format($myi_weight,3);?> GRAM</b></font></td>
		<td align="right"><font face="calibri" size="2"><b><?php echo number_format(number_format($myi_weight,3)*$myi_price*$myi_qty);?></b></font></td>
		<td align="center"><img src="img/brands/<?php echo $myimgfile; ?>" width="100px" heght="80px" /></td>
	</tr>
	<tr>
		<td colspan="4"><hr/></td>
	</tr>
	<tr>

		<?php $mbarcode='*'.$myi_code.'*';$mygrand1=$_SESSION['mygrand'];?>
		<td align="left"> <font face="code39" size="6em"><?php echo '*'.$invno.'*';?></font></div></td>
		<td align="left"><font face="calibri" size="2"><b> Jumlah Rp</b></font></td>
		<td align="right"><font face="calibri" size="2"><b><?php echo (number_format($mytotal));?></b></font></td>
		<td align="right"><font face="calibri" size="2"><b>Rugi 10%</b></font></td>
	</tr>
	<tr>
		<td></td>
		<td align="left"><font face="calibri" size="2"><b> Premi Rp</b></font></td>
		<td align="right"><font face="calibri" size="2"><b><?php echo number_format($mypremi1); ?></b></font></td>
		<td align="right"><font face="calibri" size="2"><b>Rusak 20%</b></font></td>
	</tr>
	<tr>
		<td></td>
		<td align="left"><b><font face="calibri" size="2"><b> Potongan Rp</b></font></td>
		<td align="right"><font face="calibri" size="2"><b><?php echo number_format($mydeduct);?></b></font></td>
		<td align="right"></td>
	</tr>
	<tr>
		<td></td><?php $mytotf=$mypremi1-$mydeduct; $mygrandtot=$mytotal+$mytotf; ?>
		<td align="left"><font face="calibri" size="2"><b> Total Rp</td>
		<td align="right"><font face="calibri" size="2"><b><?php echo (number_format($mygrandtot)); ?></b></font></td>
		<td align="right"></td>
	</tr>
	<tr>
		<td></td>
		<td align="left"> </td>
		<td align="right"></td>
		<td align="center"><font face="calibri" size="2"><b>Terima Kasih</b></font></td>
	</tr>

	<tr>
		<td colspan="4"><font face="calibri" size="2"><b>Perhatian:</b></font></td>
	<tr/>
	<tr>
		<td colspan="4"><font face="calibri" size="2">1. Kondisi dan berat barang telah diperiksa dan diterima dengan baik oleh pembeli</font></td>
	<tr/>
	<tr>
		<td colspan="4"><font face="calibri" size="2">2. Pembelian barang tanpa premi batu apabila rusak batu permata tidak diterima kembali</font></td>
	<tr/>
	<tr>
		<td colspan="4"><font face="calibri" size="2">3. Barang diterima kembali sesuai harga pasar dan besar potongan disesuaikan dengan kondisi barang pada saat dijual</font></td>
	<tr/>
	<tr>
		<td colspan="4"><font face="calibri" size="2">4. Kadar hancur/lebur emas turun 10% s/d 15 % dari kadar awal</font></td>
	<tr/>
	<tr>
		<td colspan="4"><font face="calibri" size="2">5. Selisih berat timbangan 0.05 gram dianggap wajar (berat angin)</font></td>
	<tr/>
</table>

<footer align="center"><a href="searchengine1.php"><font face="calibri" size="2">&copyWaletmas 2017</font><a>
  <form method="post" action="">
  <br/><br/><input type="text" placeholder="Type your void confirmation" name="voidtext"><input type="submit" value="VOID Invoice" name="btnvoid"/>
</form>
</footer>
</body>
</html>
<?php 
if (isset($_POST['btnvoid']))
{
  $voidtext=$_POST['voidtext'];

  if ($voidtext='' || $voidtext != 'void'){
    echo 'VOID process cannot continue...';
    exit();
  }else{
    header("Location: voidsales.php?s_code=$invno");
  }
}



/*} else { echo 'You are not authorized to access this page<br/><br/>'; 
echo 'Please <a href="slogin.php"> Login </a> then you can continue to acces page';
echo '<br/><br/>Contact your system administrator to get access';
echo '<br/><br/>Thank You.';
}*/?>