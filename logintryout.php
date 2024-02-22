<?php
//include './class/_parkerconnection.php';

//session_start();
// Open connection

if( isset($_POST['xlogin']) ) {
//try
//{
//	$pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

//}
//catch (PDOException $e)
//{
//    echo 'Error: ' . $e->getMessage();
//    exit();
//}

$username = trim($_POST['username']);
$username = strip_tags($username);
$username = htmlspecialchars($username);
$myusername="tryoutphb";

$pass = trim($_POST['password']);
$pass = strip_tags($pass);
$pass = htmlspecialchars($pass);
// prevent sql injections / clear user invalid inputs
$mypass=hash('sha256','semangatphb');

if(empty($username)){
 $error = true;
 $userError = "Please enter your username.";
 echo $userError;

} //else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
 //$error = true;
 //$emailError = "Please enter valid email address.";
//}

if(empty($pass)){
 $error = true;
 $passError = "Please enter your password.";
echo $passError;

}

if (!$error) {

    $password = hash('sha256', $pass); // password hashing using SHA256
    //$userquery="SELECT * FROM xloginuser WHERE cdtusername='$username'";
    //$res=$pdo->prepare($userquery);
    //$res->execute();
    //if(!$res) {
    //         die("Database query failed: " . mysql_error());
    //         }

    //$row=$res->fetch();

    //$count = $res->rowcount(); // if uname/pass correct it returns must be 1 row

    if( $mypass==$password ) {
     //$_SESSION['user'] = $row['cdtusername'];
     header("Location: tryoutlist.php");
    } else {
     $errMSG = "Incorrect Credentials, Try again...";
    }

   }
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>Login</title>
<style type="text/css">
.auto-style1 {
	border-width: 1px;
	text-align: center;
	font-family: Calibri;
	font-size: medium;
	color: #FCFCFA;
	background-color: #FF9933;
}
.auto-style2 {
	white-space: nowrap;
	text-align: center;
}
.auto-style3 {
	font-family: Calibri;
	font-size: small;
}
.auto-style4 {
	text-align: center;
}
.auto-style5 {
	font-weight: bold;
}
.auto-style6 {
	border-style: solid;
	border-width: 1px;
}
.auto-style7 {
	font-size: x-small;
	color: #7C0EE3;
}
.auto-style8 {
	font-size: x-small;
	color: #D3CED7;
}
</style>
</head>

<body>
<br/>
<br/>

<br />
<br />
<br />
<br />
<br />

<br/>


<form method="post">
<table align="center" style="height: 196px; width: 493px" class="auto-style6">
	<tr>
		<td class="auto-style2" rowspan="4" style="width: 191px">
		<img alt="" height="160" src="/img/forms/securelogin.png" width="216" /></td>
		<td class="auto-style1" colspan="2"><strong>LOGIN</strong></td>
	</tr>


	<tr>
		<td class="auto-style3" style="width: 402px; height: 26px;"><strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Username</strong></td>
		<td class="auto-style3" style="width: 565px; height: 26px;">
		<input name="username" type="text" class="auto-style3" /></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 402px; height: 39px;"><strong>Password&nbsp;&nbsp;
		</strong>&nbsp;&nbsp;&nbsp;
		</td>
		<td class="auto-style3" style="width: 565px; height: 39px;">
				<input name="password" type="password" class="auto-style3" /></td>
	</tr>

	<tr>
		<td class="auto-style4" colspan="2">

			<strong>

			<input name="xlogin" type="submit" value="Log in" class="auto-style5" /></strong>
			<br /><br/>

	</tr>

</table>
</form>
</body>
<br />
<br />
<br />
<br/>
<br/>
<br/>

<footer class="auto-style4"><span class="auto-style7"><strong><br />
	<br />
	<br />
	</strong></span><span class="auto-style8">by:</span><br />
	<img alt="" height="36" src="/img/forms/cappalogo.jpg" width="145" /></footer>
</html>
