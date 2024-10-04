<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();
ob_start();

$_SESSION['reports']='0';
if (isset($_SESSION['user'])!="" ){
include 'class/_parkersupplier.php';

	if (isset($_POST['savesupp'])){

		$s_code=$_POST['sid'];
		$s_name=$_POST['sname'];
		$s_contact=$_POST['scontact'];
		$s_addr=$_POST['saddr'];
		$s_phone=$_POST['sphone'];

		if ($s_code == '') {
				echo 'Something wrong with input ID, process cannot continue..';
				exit;
		}

		$mysupp=new Supplier($s_code,$s_name,$s_contact,$s_addr,$s_phone);
		//$mycustomer->set_c_code($c_code);
		$mysupp->get_s_code().'<br/>';
		$mysupp->get_s_name().'<br/>';
		$mysupp->get_s_contact().'<br/>';
        $mysupp->get_s_addr().'<br/>';
		$mysupp->get_s_phone().'<br/>';
		$mysupp->save_supplier();
}
?>
<html>
    <head>
    <?php
        require_once('./assets/requires/config.php');
        require_once('./assets/requires/header1.php');
    ?> 
    <link rel="icon" href=".\img\logo\cappa_icon.jpg">
</head>
    <body>

<div>
<table align="center">
    <tr>
        <td align="center"><font color="#FFC300" size="14">Create Your Supplier Account</font></td>
    </tr>
</table>
</div>

<p>

<div>
<form method="post" action="">
<font style="font-zise:9px font-face:Arial ">
<table bgcolor="#FFC300" align="center" width="200" style="border-radius:10px; padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom=5px;">
    <tr>
        <td>Supplier ID</td>
    </tr>

    <tr>
        <td><input type="text" name="sid" placeholder="Type unique ID here..." style="width: 403px;" /><td>
    </tr>

    <tr>
        <td>Supplier Name</td>

    </tr>

    <tr>
        <td ><input type="text" name="sname" placeholder="Type name here..." style="width:403px;"/><td>
    </tr>

		<tr>
        <td>Contact Person</td>

    </tr>

    <tr>
        <td ><input type="text" name="scontact" placeholder="Type name here..." style="width:403px;"/><td>
    </tr>

		<tr>
        <td>Address</td>

    </tr>

    <tr>
        <td ><input type="text" name="saddr" placeholder="Type address here..." style="width:403px;"/><td>
    </tr>

		<tr>
        <td>Phone No</td>

    </tr>

    <tr>
        <td ><input type="text" name="sphone" placeholder="Type number here..." style="width:403px;"/><td>
    </tr>


    <tr>

        <td align="right"><br/><br/><input type="submit" name="savesupp" value="Save Data" /></td>
    </tr>

</table>
</font>
</form>
</div>
</p>
 <div id="TableSupplier"></div>

<script src="./assets/scripts/js/supplier.js"></script>
</body>
</html>
<?php
}else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
?>
