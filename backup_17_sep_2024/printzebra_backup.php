<?php
if (isset($_POST['printbc'])){
	
 
	$zplFile="utama.zpl";
    copy($zplFile, "//192.168.1.9/ZDesigner GK420t");
    unlink($zplFile);
    
}

if (isset($_POST['cancelprint'])){
	$zplFile="utama.zpl";
     unlink($zplFile);
     header('Location: searchprintpcs.php');
}
?>

<html>
<body>

<div align="center">Please make sure</div>
 <div align="center">Your label Printer is READY</div>
 <div align="center" style="margin-top: 30px;margin-bottom: 20px;">
 	<img src="./img/container/zebraloaded.png">
 </div>
<div align="center">
	<form action="printzebra.php" method="post">
		<input type="submit" name="printbc" value="Print ZPL" style="border-style: solid;padding: 12px;border-radius: 5px;color:white;background-color:  #2980b9;margin-top: 20px;">
		<input type="submit" name="cancelprint" value="Cancel"  style="border-style: solid;padding: 12px;border-radius: 5px;color:white;background-color:#e74c3c;margin-top: 20px;">

	</form>
</div>
</body>
</html>