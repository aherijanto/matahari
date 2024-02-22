<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();
if (isset($_SESSION['user'])!="" ){
include 'class/_parkerpoint.php';





	if (isset($_POST['savepoint'])){

		$p_code=$_POST['pcode'];
		$p_name=$_POST['pname'];
		$p_qty=$_POST['pqty'];
		

		if ($p_code == '') {
				echo 'Something wrong with input ID, process cannot continue..';
				exit;
		}

		$mypoint=new Point($p_code,$p_name,$p_qty);
		//$mycustomer->set_c_code($c_code);

		$mypoint->save_point();

}

?>



<html>
<?php include 'menuhtml.php';?>
<link class="jsbin" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1/themes/base/jquery-ui.css" rel="stylesheet" type="text/css" />
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script class="jsbin" src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.8.0/jquery-ui.min.js"></script>
<script type"text/javascript">
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
        <td align="center"><font color="#ffb84d" size="14">Create Your Point Account</font></td>
    </tr>
</table>
</div>

<p>

<div>
<form method="post" action="">
<font style="font-zise:9px font-face:Arial ">
<table bgcolor="#fff5e6" align="center" width="200" style="border-radius:10px; padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom=5px;">
    <tr>
        <td>Point ID</td>
    </tr>

    <tr>
        <td><input type="text" name="pcode" placeholder="Type unique ID here..." style="width: 403px;" /><td>
    </tr>

		
    <tr>
        <td>Point Name</td>
    </tr>

    <tr>
        <td ><input type="text" name="pname" placeholder="Type name here..." style="width:403px;"/><td>
    </tr>

		<tr>
        <td>Point Get</td>

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
}else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
?>