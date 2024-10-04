<?php


echo '<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/_menu.css">

</head>
<body>

<ul>
  <li><a href="searchengine1.php">Home</a></li>

  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Maintenance</a>
    <div class="dropdown-content">
      
      <a href="reginvent.php">Inventory</a>
      <a href="reggroup.php">Groups</a>
      <a href="regsupp.php">Supplier</a>
      <a href="regpromitem.php?action=new">Promosi</a>
    </div>
  </li>
  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Transaction</a>
    <div class="dropdown-content">
      
      <a href="salesdirect.php?action=new">Sales</a>
      <a href="retsales.php">Sales Return</a>
      <a href="purchase.php?action=new">Purchase</a>
      <a href="retpcs.php">Purchase Return</a>
      
    </div>
  </li>


  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Tools</a>
    <div class="dropdown-content">
    <a href="searchprintpcs.php">Print Barcode From Purchasing</a>
    <a href="manualbarcode.php?action=new">Manual Barcode</a>
    </div>
  </li>

  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Search</a>
    <div class="dropdown-content">
      


    </div>
  </li>

  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Reports</a>
    <div class="dropdown-content">
      <a href="./reports/_rptpcsglobal.php">Purchasing Global</a>
      <a href="./reports/_rptinvent.php">Inventory All </a>
      <a href="./reports/_rptsalesperdate.php">Sales Per Date </a>
      <a href="./reports/_rptsalesall.php">Sales All </a>
      <a href="./reports/_rptgrossdateperiod.php">Gross Per Date Period </a>
      <a href="./reports/_rptsalessumdetail.php">Net Sales Detail Per Date Period A</a>
      <a href="./reports/_rptsalessumdetailperbrands.php">Sales Per Brand Per Period </a>
      <a href="./reports/_rptsalessumdetailnoret.php">Gross Sales Detail Per Date Period </a>
    </div>
  </li>

  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Backups</a>
    <div class="dropdown-content">
      <a href="backupdb.php">Database</a>
      <a href="#">Shrinking DB</a>
      <a href="updatestockfrompurchase.php">Update Stock Zero From Purchasing</a>

    </div>
  </li>


  <li class="dropdown">
    <a href="javascript:void(0)" class="dropbtn">Settings</a>
    <div class="dropdown-content">
      <a href="company.php">Company Header</a>
      <a href="#">Company Footer</a>
    </div>
  </li>

   <li class="dropdown">
    <a href="xlogout.php" class="dropbtn">Sign Out</a>
  </li>
</ul>



</body>
</html>';
?>
