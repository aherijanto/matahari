<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");
try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }
?>

<html>
<style type="text/css">
	table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
    border: 1px solid #dddddd;

    padding: 8px;
}

tr:nth-child(even) {
    background-color: #dddddd;
}
</style>

<div>
  <form action="" method="post">
		<table height="40px" width="100%">
		<tr><td bgcolor="#D8CEF6" align="center">AVAILABLE INVENTORY EACH GROUP</td></tr>
		<tr></tr>
    <tr><td align="center">Choose Group</td></tr>
    <?php
    $mcode=1;
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wgroups";
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
    echo '<td align="center"><select name="mygroup" id="mygroup">
        <option value="" disabled selected> Select Group...</option>';

        while ($row = $stmt->fetchObject()) {
              //echo $row->c_code;
              $mycode=$row->s_code;
              echo '<option value="'.$row->g_code.'">'. $row->g_name. '</option>';

           }

        echo '</select></td>';
      ?>
      <tr><td align="center"><input type="submit" value="Search" name="grpsubmit"/></td></tr>
    </table>
    
  </form>
</div>



<?php
if (isset($_POST['grpsubmit'])){
  $myGroupQuery=$_POST['mygroup'];
  echo '<label><h1>'.$myGroupQuery.'</h1></label>';
  try {
      $mcode=1;
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT * FROM winventory where g_code='$myGroupQuery'";
      $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }   
}  
 ?>


<table width="100%" font="calibri">
		<th>ITEM CODE</th><th>ITEM NAME</th><th>QTY</th><th>COGS</th><th>WEIGHT</th><th>STATUS</th><th>IMAGE</th>
  
  <?php 
    $totqty=0;
    $totweight=0;         
    while ($row = $stmt->fetchObject()) {
  
               $mycode=$row->i_code;
               $myname=$row->i_name;
               $myqty=$row->i_qty;
               $mycogs=number_format($row->i_cogs);
               $myweight=number_format($row->i_weight,3);
               $mystatus=$row->i_status;
               $myimg=$row->i_imgfile;
               if ($mystatus=='R'){
                echo '<tr style="color:red;"><td>'.$mycode.'</td><td>'.$myname.'</td><td align="center">'.$myqty.'</td><td align="center">'.$mycogs.'</td>
               <td align="center">'.$myweight.'</td><td align="center">'.$mystatus.'</td><td>'.$myimg.'</td></tr>';
               $totweight=$totweight-$myweight;
               }else{
               echo '<tr style="color:blue;"><td>'.$mycode.'</td><td>'.$myname.'</td><td align="center">'.$myqty.'</td><td align="center">'.$mycogs.'</td>
               <td align="center">'.$myweight.'</td><td align="center">'.$mystatus.'</td><td>'.$myimg.'</td></tr>';
               $totweight=$totweight+$myweight;
             }
             	$totqty=$totqty+$myqty;
             	

             }
             echo '<tr><td></td><td></td><td align="center"><h4>'.$totqty.'</h4></td><td></td><td align="center"><h4>'.$totweight.'</h4></td><td></td></tr>';
  
  ?>

</table>
</html>