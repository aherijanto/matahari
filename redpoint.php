<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

session_start();
if (isset($_SESSION['user'])!="" ){
include 'class/_parkerpoint.php';
include 'class/_parkerconnection.php';
include 'class/number.php';



$_SESSION['c_code']='';
$_SESSION['pcustomername']='';

  
  if (isset($_GET['c_code']))
  {
    $_SESSION['c_code']=$_GET['c_code'];
    

    $c_code=$_SESSION['c_code'];
            $mcode=$c_code;
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wcustomers WHERE c_code LIKE :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

            $row = $stmt->fetchObject();
            $_SESSION['pcustomername']=$row->c_name;
  }
  else
  {
    echo 'Process cannot continue';
    echo '<br/><a href="searchengine1.php">Click Add Point To Process...<a>';
    exit;
  }
  	

  if (isset($_POST['savepoint'])){

    $pred_no=setnumber('wredpoint');
    $c_code=$_POST['custid'];
		//$p_code=$_POST['mypoint'];
		$pred_qty=$_POST['pqty'];
    $p_name='';
		

		

		$mypoint=new Point('blank','blank',$pred_qty);
		//$mycustomer->set_c_code($c_code);

		$mypoint->red_point($pred_no,$c_code);
    $_SESSION['c_code']='';
    $_SESSION['pcustomername']='';
    unset($_GET['c_code']);
    header("Location: searchengine1.php");

}

?>



<html>
<?php include 'menuhtml.php';?>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script type="text/javascript">
function readURL(input) {
      if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function (e) {
              $('#blah')
                  .attr('src', e.target.result)
                  .width(150)
                  .height(200);
          };

          reader.readAsDataURL(input.files[0]);
      }
  }
  </script>
<body>

<div>
<table align="center">
    <tr>
        <td align="center"><font color="#ffb84d" size="14">Redeem Point Customer</font></td>
    </tr>
</table>
</div>

<p>

<div>
<form method="post" action="">
<font style="font-zise:9px font-face:Arial ">
<table bgcolor="#fff5e6" align="center" width="200" style="border-radius:10px; padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom=5px;">
     <tr>
        <td>Customer ID</td>
    </tr>
    <tr>
        <td><input type="text" name="custid"  style="width: 403px; "
              value="<?php echo $_SESSION['c_code'];?>"  readonly/><td>
    </tr>
     <tr>
        <td>Customer Name</td>
    </tr>
    <tr>
        <td><input type="text" name="custname" placeholder="Name shows here..." style="width: 403px;" value="<?php echo $_SESSION['pcustomername'];?>" readonly/><td>
    </tr>

		
    <tr>
        <td>Point QTY</td>
    </tr>

  
    <tr>
        <td ><input type="text" name="pqty" value="1" placeholder="Type number here..." style="width:403px;"/><td>
    </tr>

		
    <tr>
        <td align="right"><br/><br/><input type="submit" name="savepoint" value="Save Data" /></td>
    </tr>

</table>
</font>
</form>
</div>
</p>
</body>
</html>
<?php
 }
  else { 
    echo 'Process cannot continue, please <a href="slogin.php">Login </a>';
}

?>