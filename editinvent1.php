<?php
session_start();
ob_start();
$_SESSION['reports']='0';
if (isset($_SESSION['user'])!="" ){
  

$mydate='';
$mypremi=0;
$mydeduct=0;

if (!empty($_GET['codeinvent']))
{
  $codeinvent=$_GET['codeinvent'];

  include ('class/_parkerconnection.php');
            
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM winventory WHERE i_code = :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $codeinvent, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
      
            while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $myi_code    = $row->i_code;
               $myg_code    = $row->g_code;
               $mys_code    = $row->i_supp;
               $myi_barcode = $row->i_barcode;
               $myi_name    = $row->i_name;
               
               $myi_qty     = $row->i_qty;
               $myi_vol     = $row->i_vol;
               $myi_volunit = $row->i_volunit;
               $myi_qtymin  = $row->i_qtymin;
               $myi_unit    = $row->i_unit;
               $myi_size    = $row->i_size;
               
               $myi_color   = $row->i_color;
               $myi_brands  = $row->i_brands;
               $myi_article = $row->i_article;
               $myi_cogs    = $row->i_cogs;

               $mykd_sell   = $row->i_kdsell;
               $myi_sell    = $row->i_sell;
               $myi_sell2   = $row->i_sell2;
               $myi_sell3   = $row->i_sell3;
               $myi_sell4   = $row->i_sell4;
               $myi_sell5   = $row->i_sell5;
               $myi_sell6   = $row->i_sell6;
               $myi_sell7   = $row->i_sell7;
               $myi_sell8   = $row->i_sell8;
               $myi_sell9   = $row->i_sell9;
               $myi_sell10  = $row->i_sell10;
               $myi_status  = $row->i_status;
               $myware      = $row->ware_id;
               
              
              }

/*echo 'Code '.$myi_code.'<br/>';
echo 'Group '.$myg_code.'<br/>';
echo 'Name '.$myi_name.'<br/>';
echo 'Qty '.$myi_qty.'<br/>';
echo 'COGS '.$myi_cogs.'<br/>';
echo 'Weight '.$myi_weight.'<br/>';
echo 'Status '.$myi_status.'<br/>';
echo 'Image '.$myi_imgfile.'<br/>';*/

}
?>

<html>
<head>
  
  <link rel = "stylesheet" type = "text/css" href = "css/raw_css.css" />
  <link rel = "stylesheet" type = "text/css" href = "css/editinvent.css" />
  <?php require_once('./assets/requires/config.php');
    require_once('./assets/requires/header1.php');?>
</head>
<body>
<label> <font color="red">WARNING!!! BEFORE UPDATE PLEASE RECHECK RECORDs </font></label>



  
<form method="post" action="">
  <table>

  <tr>
    <td>Group</td>
    <td><input type='text' name="mygroup" value="<?php echo $myg_code; ?>" readonly></td>
  </tr>

  <tr>
    <td>Supplier</td>
    <td><input type='text' name="mysupp" value="<?php echo $mys_code; ?>" readonly></td>
  </tr>

  <tr>
    <td>Warehouse</td>
    <td><input type='text' name="myware" value="<?php echo $myware; ?>" readonly></td>
  </tr>

  <tr>
    <td>Code</td>
    <td><input type='text' name="mycode" value="<?php echo $myi_code; ?>" readonly></td>
  </tr>

  <tr>
    <td>BarCode</td>
    <td><input type='text' name="mybarcode" value="<?php echo $myi_barcode; ?>" ></td>
  </tr>

  <tr>
    <td>Merk</td>
    <td><input type='text' name="mymerk" value="<?php echo $myi_brands; ?>"></td>
  </tr>
  <tr>
    <td>Warna</td>
    <td><input type='text' name="mywarna" value="<?php echo $myi_color; ?>"></td>
  </tr>
  <tr>
    <td>Ukuran</td>
    <td><input type='text' name="myukuran" value="<?php echo $myi_size; ?>"></td>
  </tr>
  <tr>
    <td>Artikel</td>
    <td><input type='text' name="myartikel" value="<?php echo $myi_article; ?>"></td>
  </tr>
  

  <tr>
    <td>Name</td>
    <td><input type='text' name="myname" value="<?php echo $myi_name; ?>"></td>
  </tr>

  <tr>
    <td>Vol</td>
    <td><input type='text' name="myvol" value="<?php echo $myi_vol; ?>"></td>
  </tr>

  <tr>
    <td>Vol. Unit</td>
    <td><input type='text' name="myvolunit" value="<?php echo $myi_volunit; ?>"></td>
  </tr>

  <tr>
    <td>Qty</td>
    <td><input type='text' name="myqty" value="<?php echo $myi_qty; ?>"></td>
  </tr>

  <tr>
    <td>QTY Min</td>
    <td><input type='text' name="myqtymin" value="<?php echo $myi_qtymin; ?>"></td>
  </tr>
  <tr>
    <td>Satuan</td>
    <td><input type='text' name="myunit" value="<?php echo $myi_unit; ?>"></td>
  </tr>

   <tr>
    <td>HPP</td>
    <td><input type='text' name="mycogs" value="<?php echo $myi_cogs; ?>"></td>
  </tr>

  <tr>
    <td>Harga Jual #1</td>
    <td><input type='text' name="mysell" value="<?php echo $myi_sell; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #2</td>
    <td><input type='text' name="mysell2" value="<?php echo $myi_sell2; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #3</td>
    <td><input type='text' name="mysell3" value="<?php echo $myi_sell3; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #4</td>
    <td><input type='text' name="mysell4" value="<?php echo $myi_sell4; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #5</td>
    <td><input type='text' name="mysell5" value="<?php echo $myi_sell5; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #6</td>
    <td><input type='text' name="mysell6" value="<?php echo $myi_sell6; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #7</td>
    <td><input type='text' name="mysell7" value="<?php echo $myi_sell7; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #8</td>
    <td><input type='text' name="mysell8" value="<?php echo $myi_sell8; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #9</td>
    <td><input type='text' name="mysell9" value="<?php echo $myi_sell9; ?>"></td>
  </tr>
  <tr>
    <td>Harga Jual #10</td>
    <td><input type='text' name="mysell10" value="<?php echo $myi_sell10; ?>"></td>
  </tr>

  <tr>
    <td>Kode Jual</td>
    <td><input type='text' name="mykdsell" value="<?php echo $mykd_sell; ?>"></td>
  </tr>

  <tr>
    <td>Status</td>
    <td><input type='text' name="mystatus" value="<?php echo $myi_status; ?>"></td>
  </tr>

  

   <tr>
    <td><input type='submit' value="Delete" name="delete" style="float:left;border-radius: 5px;width:120px;background-color:  #e74c3c "></td>
    <td><input type='submit' value="Update" name="update" style="float:right;border-radius: 5px;width:120px;"></td>
  </tr>

  <tr>
    <td><a href="reginvent.php">Back</a></td>
  </tr>

</table>
</form>
</body>
</html>

<?php

if (isset($_POST['delete'])){

    $mycode=$_POST['mycode'];
  $mygroup=$_POST['mygroup'];
  $mysupp=$_POST['mysupp'];
  $mybarcode=$_POST['mybarcode'];
    include ('class/_parkerconnection.php');

       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "DELETE FROM winventory WHERE (i_barcode='$mybarcode' AND i_code='$mycode')";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':i_code', $codeinvent, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                $msg="Data".$mybarcode." - ".$mycode."Deleted";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

}


if (isset($_POST['update']))
{

  $mycode       = $_POST['mycode'];
  $mygroup      = $_POST['mygroup'];
  $mysupp       = $_POST['mysupp'];
  $mybarcode    = $_POST['mybarcode'];
  $myname       = $_POST['myname'];
  $myqty        = $_POST['myqty'];
  $myvol        = $_POST['myvol'];
  $myvolunit    = $_POST['myvolunit'];
  $myqtymin     = $_POST['myqtymin'];
  $myunit       = $_POST['myunit'];
  $myukuran     = $_POST['myukuran'];
  $mywarna      = $_POST['mywarna'];
  $mymerk       = $_POST['mymerk'];
  $myartikel    = $_POST['myartikel'];
  $mycogs       = $_POST['mycogs'];
  $mykdsell     = $_POST['mykdsell'];
  $mysell       = $_POST['mysell'];
  $mysell2      = $_POST['mysell2'];
  $mysell3      = $_POST['mysell3'];
  $mysell4      = $_POST['mysell4'];
  $mysell5      = $_POST['mysell5'];
  $mysell6      = $_POST['mysell6'];
  $mysell7      = $_POST['mysell7'];
  $mysell8      = $_POST['mysell8'];
  $mysell9      = $_POST['mysell9'];
  $mysell10     = $_POST['mysell10'];
  $mystatus     = $_POST['mystatus'];
  $mywareid     = $_POST['myware'];
  //$myimage=$_POST['myimage'];

  include ('class/_parkerconnection.php');

       try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `winventory` SET `i_code`='$mycode',`g_code`='$mygroup',`i_supp`='$mysupp',`i_barcode`='$mybarcode',`i_name`='$myname',`i_qty`='$myqty',`i_vol`='$myvol',`i_volunit`='$myvolunit',
                `i_qtymin`='$myqtymin',`i_unit`='$myunit',`i_size`='$myukuran',`i_color`='$mywarna',`i_brands`='$mymerk',`i_article`='$myartikel',`i_cogs`='$mycogs',`i_kdsell`='$mykdsell',`i_sell`='$mysell',`i_sell2`='$mysell2',`i_sell3`='$mysell3',`i_sell4`='$mysell4',`i_sell5`='$mysell5',`i_sell6`='$mysell6',`i_sell7`='$mysell7',`i_sell8`='$mysell8',`i_sell9`='$mysell9',`i_sell10`='$mysell10',`i_status`='$mystatus',`ware_id`='$mywareid' WHERE `i_code`= '$mycode'";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':i_code', $codeinvent, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                $msg="Data Updated";
                echo "<script type='text/javascript'>alert('$msg');</script>";
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
}

} else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
?>



