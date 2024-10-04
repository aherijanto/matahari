<?php
session_start();
ob_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
$_SESSION['reports']='0';

if (isset($_SESSION['user'])!="" ){
include 'class/_parkergroup.php';




//
	if (isset($_POST['savegroup'])){

		$g_code=$_POST['gid'];
		if ($g_code == '') {
				echo 'Something wrong with input ID, process cannot continue..';
				exit;
		}

		$g_name=$_POST['gname'];

		$mygroup=new Groups($g_code,$g_name);
		//$mycustomer->set_c_code($c_code);
		//$mygroup->get_g_code().'<br/>';
		//$mygroup->get_g_name().'<br/>';

		$mygroup->save_group();

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
        <td align="center"><font color="#C3E9F5" size="14">Create Your Group Account</font></td>
    </tr>
</table>
</div>

<p>

<div>
<form method="post" action="">
<font style="font-zise:9px font-face:Arial ">
<table bgcolor="#C3E9F5" align="center" width="200" style="border-radius:10px; padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom=5px;">
    <tr>
        <td>Group ID</td>
    </tr>

    <tr>
        <td><input type="text" name="gid" placeholder="Type unique ID here..." style="width: 403px;" /><td>
    </tr>

    <tr>
        <td>Group Name</td>

    </tr>

    <tr>
        <td ><input type="text" name="gname" placeholder="Type name here..." style="width:403px;"/><td>
    </tr>


    <tr>

        <td align="right"><br/><br/><input type="submit" name="savegroup" value="Save Data" /></td>
    </tr>

</table>
</font>
</form>
</div>
</p>
</body>
</html>
<?php
}else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
?>
