<?php
session_start();
ob_start();
date_default_timezone_set('Asia/Jakarta');
require_once('./assets/requires/config.php');
require_once('./assets/requires/header1.php');
if (isset($_SESSION['user'])!="" )
{
    $c_code = $_GET['c_code'];
    if(isset($_POST['delsubmit'])){
        $delnote = $_POST['deleteno'];
        $prefix1=date('Ymd');
        $prefix2='admin';
        $pin=$prefix1.$prefix2;
        $pininput = $_POST['pin'];
        if($pin==$pininput){
            include 'class/_parkerconnection.php';
            try {
                   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sqlcomplaint = "DELETE  FROM wcustomers WHERE c_code='$delnote'";
                  $stmt = $pdo->prepare($sqlcomplaint);
                  $stmt->execute();                  
                } catch(PDOException $e) {
                  echo $e->getMessage();
              }
              header('Location:searchengine1.php');
        }else{
            echo '<script>
                        
                        alert("Wrong PIN..");
                    </script>';
        }
    }

    if(isset($_POST['back'])){
      header('Location:searchengine1.php');
    }
?>

<html>
<head>
	<title></title>
	<style type="text/css">
		.center-screen {
  			display: flex;
  			flex-direction: column;
  			justify-content: center;
  			align-items: center;
  			text-align: center;
  			/* min-height: 100vh; */
            margin-top:px;
		}
		
		
	</style>
    
</head>
<body>
    <div id="message" style="background:#e76f51;color:white;"></div>
    <div class="row">
        <div class="col" align="center">
            <img src="custdelete.png" width="200px;"/>
        </div>
    </div>
	<form action="" method="post">
		<div class="center-screen">
			<label for="deletetno" style="padding:10px 10px;font-size:16px;color:blue;">DELETE CUSTOMER</label>
            <div class="row" >
                <input type="text" name="deleteno" placeholder="Customer ID" style="width: 400px;text-align:center;color:blue;" value="<?php echo $c_code;?>">
            </div>
            <label for="pin" style="margin-top:5px;font-size:16px;color:red;">PIN</label>
            <div class="row" >
                <input type="password" name="pin" placeholder="PIN" style="width: 150px;text-align:center;color:red;margin-top:2px;" >
            </div>
            <div class="row" style="margin-top:5px;">
			    <div class="col">
                    <input type="submit" class="btn btn-danger" value="Delete" name="delsubmit">
                </div>
                <div class="col">
                    <input type="submit" class="btn btn-success" value="Back" name="back" >
                </div>
            </div>
		</div>
    </form>
</body>
</html>
<?php 
}else { 
  echo 'Process cannot continue, please <a href="slogin.php">Login </a>';
}
?>