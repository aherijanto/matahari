<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();
if (isset($_SESSION['user'])!="" ){
include 'class/_parkerexpense.php';
include 'menuhtml.php';



//if (isset($_SESSION['user'])!="" ){
	if (isset($_POST['saveexp'])){

		$s_code=$_POST['sid'];
		$s_name=$_POST['sname'];
		

		if ($s_code == '' || $s_name=='') {
				echo 'Something wrong with input ID, process cannot continue..';
				exit;
		}

		$myexpense=new Expense($s_code,$s_name);
		//$mycustomer->set_c_code($c_code);
		
		$myexpense->save_expense();

}

?>



<html>
<body>

<div>
<table align="center">
    <tr>
        <td align="center"><font color="#85C1E9  " size="14">Create Your Expense Account</font></td>
    </tr>
</table>
</div>

<p>

<div>
<form method="post" action="">
<font style="font-zise:9px font-face:Arial ">
<table bgcolor="#FADBD8" align="center" width="200" style="border-radius:10px; padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom=5px;">
    <tr>
        <td>AccountID</td>
    </tr>

    <tr>
        <td><input type="text" name="sid" placeholder="Type unique ID here..." style="width: 403px;" /><td>
    </tr>

    <tr>
        <td>Expense Name</td>

    </tr>
    <tr>
        <td><input type="text" name="sname" placeholder="Type expense name here..." style="width: 403px;" /><td>
    </tr>
    
    <tr>

        <td align="right"><br/><br/><input type="submit" name="saveexp" value="Save Data" /></td>
    </tr>

</table>
</font>
</form>
</div>
</p>
</body>
</html>
<?php
} else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}

?>