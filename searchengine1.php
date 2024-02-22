<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
if (isset($_SESSION['user'])!="" ){
include 'class/_parkercustomer.php';

?>

<html>
  <head>
  <?php
        require_once('./assets/requires/config.php');
        require_once('./assets/requires/header1.php');
    ?> 
</head>
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
        <td align="center"><font color="blue" ></font></td>
    </tr>

    <tr>
        <td align="center">
          <input type="text" name="searchtext" placeholder="Type here.." style="width: 500px;"/>
        </td>
    </tr>

    <tr>
        <td align="center">
          <font face="Arial" size="2">Search by:<input type="radio" name="searchradio" value="c_id" checked>Customer ID
            <input type="radio" name="searchradio" value="c_name">Customer Name
            <input type="radio" name="searchradio" value="c_addr">Customer Address
          </font>
        </td>
    </tr>

    <tr>
      <td colspan="3" align="center"><input type="submit" value="Search" name="search"/></td>
    </tr>

    <tr>
      <td colspan="3" align="center">Don't have account ?</td>
    </tr>

    <tr>
      <td colspan="3" align="center"><a href="regcust.php">Sign Up</a></td>
    </tr>
</table>
</form>
</div>
</p>
</body>
</html>

<?php


if (isset($_POST['search'])){
  $myradio=$_POST['searchradio'];
  $mytext=$_POST['searchtext'];

  switch ($myradio){
    case 'c_id':
        //echo 'cid <br/>';
        $myid=new Customer($mytext,'','','','','','','','','','','');
        $myid->fetch_customer('cid');

        break;
    case 'c_name':
        $myid=new Customer('','',$mytext,'','','','','','','','','');
        $myid->fetch_customer('cname');
        break;
    case 'c_addr':
        $myid=new Customer('','','','','',$mytext,'','','','','','');
        $myid->fetch_customer('caddr');
        break;
  }
}

} else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
 ?>
