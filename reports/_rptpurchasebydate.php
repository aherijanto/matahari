<?php
error_reporting(E_ALL);
ini_set("display_errors","On");


?>

<html>

<style type="text/css">
  table {
    font-family: arial, sans-serif;
    font-size: 12;
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
<body>
<div>
<p>

<div>
    <table height="40px" width="100%">
    <tr><td bgcolor="#D8CEF6" align="center">PURCHASE PER DATE</td></tr>
    <form method="post" action="">
    <tr><td align="center">Date From <input type="date" name="datequery"/></td></tr>
    <tr><td align="center">Date To <input type="date" name="datequery1"/></td></tr>
    <tr><td align="center"><input type="submit" name="submitdate"/></td></tr>
    </form>
    </table>
  </div>
</div>
</p>
</body>
</html>

<?php


if (isset($_POST['submitdate'])){
$mydate=date('Y-m-d',strtotime($_POST['datequery']));
$mydate1=date('Y-m-d',strtotime($_POST['datequery1']));
  try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }

       
            
            
            try {
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sql = "SELECT * FROM wbuytail,wbuyhead where (wbuyhead.b_date BETWEEN '$mydate' AND '$mydate1') AND (wbuyhead.b_code=wbuytail.b_code) ORDER BY wbuyhead.b_date ASC";

                  $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                  $stmt->execute();
                  $total = $stmt->rowCount();

        echo '<table width="100%" font="calibri">
         <th>DATE </th><th>INVOICE NO </th><th>REFERENCE NO </th><th>ITEM CODE </th><th>ITEM NAME</th><th>QTY</th><th>COGS</th><th>WEIGHT</th><th>IMAGE</th>';
                  while ($row = $stmt->fetchObject()) 
                  {
                    $bdate=$row->b_date;
                    $bcode=$row->b_code;
                    $brefno=$row->b_refno;
                    $icode=$row->i_code;
                    $iname=$row->i_name;
                    $iqty=$row->i_qty;
                    $icogs=$row->i_cogs;
                    $iweight=$row->i_weight;
                    $i_img=$row->i_imgfile;

                    
            echo '<tr><td><font color="blue">'.date('d-M-Y',strtotime($bdate)).'</font></td><td><font color="purple">'.$bcode.'</font></td><td><font color="green">'.$brefno.'</font></td><td><font color="red">'.$icode.'</font></td><td>'.$iname.'</td><td align="center">'.$iqty.'</td><td align="center">'.number_format($icogs).'</td><td align="center">'.number_format($iweight,3).'</td><td align="center">'.$i_img.'</td>';
                
                  }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        
            echo '</table>';

  }







 ?>
