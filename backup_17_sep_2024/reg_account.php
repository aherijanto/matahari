<?php
 error_reporting(E_ALL);
ini_set("display_errors","On");
 session_start();
 include './class/_parkerconnection.php';
 //if( isset($_SESSION['user'])!="" ){
  //header("Location: home.php");
// }
 

 $error = false;

 if ( isset($_POST['save']) ) {
  
  // clean user inputs to prevent sql injections
  $fname = trim($_POST['fname']);
  $fname = strip_tags($fname);
  $fname = htmlspecialchars($fname);
  
  $lname = trim($_POST['lname']);
  $lname = strip_tags($lname);
  $lname = htmlspecialchars($lname);
  
  $uname = trim($_POST['uname']);
  $uname = strip_tags($uname);
  $uname = htmlspecialchars($uname);
  
  $email = trim($_POST['email']);
  $email = strip_tags($email);
  $email = htmlspecialchars($email);
  
  $pass1 = trim($_POST['pwd1']);
  $pass1 = strip_tags($pass1);
  $pass1 = htmlspecialchars($pass1);
  
  $pass2 = trim($_POST['pwd2']);
  $pass2 = strip_tags($pass2);
  $pass2 = htmlspecialchars($pass2);
  
  $mphone=trim($_POST['mphone']);
  // basic name validation
  if (empty($fname) || empty($lname)) {
   $error = true;
   $nameError = "Please enter your first name and lastname.";
   echo $nameError;
   exit;
  } 
  
  if (strlen($uname) < 8) {
   $error = true;
   $nameError = "Username must have atleat 8 characters.";
   echo $nameError;
  } else if (!preg_match("/^[a-zA-Z ]+$/",$uname)) {
   $error = true;
   $nameError = "Username must contain alphabets and space.";
   echo $nameError;
  }
  
  //basic email validation
  if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
   $error = true;
   $emailError = "Please enter valid email address.";
   echo $emailError;
  } else {
   // check email exist or not

    $userquery = "SELECT cdtemail FROM xloginuser WHERE cdtemail='$email'";
    $res=$pdo->prepare($userquery);
    $res->execute();
    if(!$res) {
             die("Database query failed: " . mysql_error());
             }
    
    $row=$res->fetch();
    
    $count = $res->rowcount();

   
   if($count!=0){
    $error = true;
    $emailError = "Provided Email is already in use.";
   }
  }
  // password validation
  if (empty($pass1)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass1) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  if (empty($pass2)){
   $error = true;
   $passError = "Please enter password.";
  } else if(strlen($pass2) < 6) {
   $error = true;
   $passError = "Password must have atleast 6 characters.";
  }
  
  if ($pass2!=$pass1) {
	exit;
  }	  
  // password encrypt using SHA256();
  $password = hash('sha256', $pass1);
  
  // if there's no error, continue to signup
  if( !$error ) {
   $fullname=$fname.' '.$lname;
   $cdtusercode=rand(9999,100000);
   
   try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO xloginuser (cdtusercode,cdtusername,cdtuserpwd,cdtfullname,cdtemail,cdtmphone,cdtpic) VALUES ('$cdtusercode','$uname','$password','$fullname','$email','$mphone','0')";
                //echo '<br/>'.$stmt;
            $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }

   /*$query = "INSERT INTO xloginuser (cdtusercode,cdtusername,cdtuserpwd,cdtfullname,cdtemail,cdtmphone,cdtpic) VALUES ('$cdtusercode','$uname','$password','$fullname','$email','$mphone','0')";
   $res = mysqli_query($query,$conn);*/
  
   if ($res) {
    $errTyp = "success";
    $errMSG = "Successfully registered, you may login now";
    unset($name);
    unset($email);
    unset($pass);
   } else {
	    die("Database query failed: " . mysql_error());
    $errTyp = "danger";
    $errMSG = "Something went wrong, try again later..."; 
   } 
    
  }
  
  
 }
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<meta content="en-us" http-equiv="Content-Language" />
<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
<title>ACCOUNT</title>

<style type="text/css">
.auto-style1 {
	background-color: #0066FF;
}
.auto-style2 {
	font-family: "Trebuchet MS";
	font-size: xx-large;
	color: #FBFAFC;
	background-color: #3399FF;
}
.auto-style3 {
	font-family: Arial, Helvetica, sans-serif;
	font-size: small;
}
.auto-style4 {
	text-align: left;
}
.auto-style5 {
	border: 0 solid #3399FF;
}
.auto-style6 {
	border-style: solid;
	border-width: 0;
}
.auto-style7 {
	font-family: Calibri;
	font-size: small;
	font-weight: normal;
}
</style>

</head>

<body>
<form method="post">
<table class="auto-style1" style="width: 100%">
	<tr>
		<td class="auto-style2">Account</td>
	</tr>
</table>
<table style="width: 57%" align="left">
	<tr>
		<td class="auto-style3" style="width: 138px">First Name</td>
		<td style="width: 157px"><input name="fname" type="text" /></td>
		
		
	</tr>
	<tr>
		<td class="auto-style3" style="width: 138px">Last Name</td>
		<td style="width: 157px">
		
			<input name="lname" type="text" /></form></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 138px">Username</td>
		<td style="width: 157px"><input name="uname" type="text" /></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 138px">Email</td>
		<td style="width: 157px">
		<input name="email" type="text" style="width: 143px" /></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 138px">Mobile Phone</td>
		<td style="width: 157px"><input name="mphone" type="text" /></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 138px">Password</td>
		<td style="width: 157px"><input name="pwd1" type="password" /></td>
	</tr>
	<tr>
		<td class="auto-style3" style="width: 138px">Confirm Password</td>
		<td style="width: 157px"><input name="pwd2" type="password" /></td>
	</tr>
	
	
	<tr>
		<td class="auto-style4" colspan="3">
		<hr />
		<br />
		<br />
		<input name="save" type="submit" value="Save" /></td>
	</tr>
</table>
</form>
</body>

</html>
