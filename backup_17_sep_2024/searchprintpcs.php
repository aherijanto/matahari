<?php
if (isset($_POST['isubmit'])){
	$noinv=$_POST['noinv'];
	if ($noinv==''){
		//donothing

	}else
	{
		header("Location:printpurchasebc.php?invno=$noinv");
	}
}
?>

<html>
<form action="" method="post">
<div style="width:100%; margin-top: 100px;" align="center" > Type Purchase Number To Print</div>
<div style="width: 100%;" align="center"><input type="text" name="noinv" /></div>
<div style="width: 100%;margin-top: 20px;"  align="center" ><input type="submit" name="isubmit" style="border:solid;border-radius: 5px;padding: 10px;color: white;background-color: #1e8449;cursor: pointer; "></div>
</form>
</html>