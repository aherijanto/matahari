<?php
ob_start();
session_start();
$_SESSION['reports']='0';

			if(isset($_SESSION['cart_retpcs'])){
				unset($_SESSION['cart_retpcs']);
			}
			
	if(isset($_SESSION['cart_pcsreturn'])){
				unset($_SESSION['cart_pcsreturn']);
			}


if (isset($_POST['next'])){
	$myinv=$_POST['invtext'];
	
	header("Location:retpcsdetail.php?invtext=$myinv");
}
?>
<?php
 include 'menuhtml.php';
?>
<html>
<head>
  <link rel = "stylesheet" type = "text/css" href = "css/raw_css.css" />
 </head>

 <div align="center" style="transform: translate(-50%, -50%);margin: 0;position: absolute;top: 30%;
  left: 50%;">
 	<label style="font-size: 24px;color:#1565C0;text-shadow: 2px 2px #AEB6BF">Type Purchasing No</label>
 
 <br/>
 <br/>
 <form method="post" action="">
 	<div align="center">
 	<input type="text" name="invtext" placeholder="Type Invoice No" style="width: 100%; padding: 12px 20px;margin: 8px 0;
  			box-sizing: border-box;font-size: 20px;,">
 	</div>

 <div align="center">
 	<input type="submit" name="next" value="Next" style="border-style: none; background-color: #27AE60;color:white;width: 80px;height: 30px;font-size: 22px; text-align: center;border-radius: 3px;cursor: pointer;">
 </div> 

</form>
</div>

 </div>
</html>