<?php

session_start();
ob_start();
$_SESSION['reports'] = '0';
include 'class/_parkerconnection.php';
require_once('./assets/requires/config.php');
require_once('./assets/requires/headerdshbd.php');
if (isset($_POST['xlogin'])) {
	$username = trim($_POST['username']);
	$username = strip_tags($username);
	$username = htmlspecialchars($username);

	$pass = trim($_POST['password']);
	$pass = strip_tags($pass);
	$pass = htmlspecialchars($pass);
	// prevent sql injections / clear user invalid inputs
	$error = false;
	if (empty($username)) {
		$error = true;
		$userError = "Please enter your username.";
	}

	if (empty($pass)) {
		$error = true;
		$passError = "Please enter your password.";
	}

	if (!$error) {
		$password = hash('sha256', $pass); // password hashing using SHA256
		$userquery = "SELECT * FROM xloginuser WHERE cdtusername='$username'";
		$res = $pdo->prepare($userquery);
		$res->execute();
		if (!$res) {
			die("Database query failed: " . mysqli_error($PDO));
		}

		$row = $res->fetch();

		$count = $res->rowcount(); // if uname/pass correct it returns must be 1 row

		if ($count == 1 && $row['cdtuserpwd'] == $password) {
			$_SESSION['user'] = $row['cdtusername'];
			header("Location: dashboard.php");
		} else {

			$errMSG = "Incorrect Credentials, Try again...";
			echo $errMSG . '<br/>';
			echo 'Back to <a href="./slogin.php">Login</a> page';
			exit();
		}
	}
}

?>



<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<link rel="icon" href=".\img\logo\cappa_icon.png">

<head>
	<meta content="en-us" http-equiv="Content-Language" />
	<meta content="text/html; charset=utf-8" http-equiv="Content-Type" />
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<title>Login</title>
	<script>
		window.onload = function(){
			var loc;
			var defLocation = "mthr.mimoapps.xyz";
			var onLocation = window.location.host;
			if(defLocation==onLocation){
				loc='<h3 class="text-primary">Internet <i class="material-icons">signal_wifi_on</i></h3>';
			}else{
				loc='<h3 class="text-danger">Local <i class="material-icons">signal_wifi_off</i></h3>';
			}
			document.getElementById('location').innerHTML = loc;
			
		};
	</script>
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
<section class="vh-100" style="background-color: #508bfc;">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-12 col-md-8 col-lg-6 col-xl-5">
        <div class="card shadow-2-strong" style="border-radius: 1rem;">
          <div class="card-body p-5 text-center">

            <h3 class="mb-2">Sign in</h3>
			<div id="location" align="center" class="mt-2"></div>
            <form action="" method="post">
            <div class="form-outline mb-4 mt-4">
              <input type="text" id="typeEmailX-2" name="username" class="form-control form-control-lg" />
              <label class="form-label" for="typeEmailX-2">Username</label>
            </div>

            <div class="form-outline mb-4">
              <input type="password" id="typePasswordX-2" name="password" class="form-control form-control-lg" />
              <label class="form-label" for="typePasswordX-2">Password</label>
            </div>
            <button class="btn btn-primary btn-lg btn-block" name="xlogin" type="submit">Login</button>
            </form>
            <!-- Checkbox -->
           
            <hr class="my-4">
          </div>
        </div>
      </div>
    </div>
  </div>
  
</section>
</body>

</html>
