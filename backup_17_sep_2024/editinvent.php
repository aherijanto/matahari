<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();
if (isset($_SESSION['user'])!="" ){

include 'menuhtml.php';

?>

<html>
<body>
<div>
<p>
<br/><br/><br/><br/>
<form method="post" action="">
<table align="center" style="vertical-align:middle;">
    <tr></tr>
    <tr></tr>
    <tr></tr>
    <tr>
        <td align="center"><font color="blue" ><h2>Search Item Code For Edit</font></td>
    </tr>

    <tr>
        <td align="center"><input type="text" name="myinvno" placeholder="Type here.." style="width: 500px;"/></td>
    </tr>

    
    <tr>
      <td colspan="3" align="center"><input type="submit" value="Search" name="search"/></td>
    </tr>

    
</table>
</form>
</div>
</p>
</body>
</html>

<?php


if (isset($_POST['search'])){

    if(!empty($_POST['myinvno'])){
        $myinvno=$_POST['myinvno'];
        header ("Location:editinvent1.php?codeinvent=$myinvno");

    }
  

  
  }



} else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
 ?>
