<?php
error_reporting(E_ALL);
ini_set("display_errors","On");


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
      
        <td align="center">PURCHASING PER REFERENCE NO REPORTS</td>
    </tr>

    <tr>

        <td align="center"><input type="text" name="searchtext" placeholder="Type RefNo here.." style="width: 500px;"/><input type="submit" value="Search" name="search"/></td>
    </tr>

    
   
</table>
</form>
</div>
</p>
</body>
</html>

<?php


if (isset($_POST['search'])){
$myrefno=$_POST['searchtext'];
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
                  $sql = "SELECT * FROM wbuytail,wbuyhead where wbuyhead.b_refno='$myrefno' and wbuyhead.b_code=wbuytail.b_code ";

                  $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                  $stmt->execute();
                  $total = $stmt->rowCount();

        echo '<table width="100%" font="calibri">
         <th>ITEM CODE </th><th>ITEM NAME</th><th>QTY</th><th>COGS</th><th>WEIGHT</th><th>IMAGE</th>';
                  while ($row = $stmt->fetchObject()) 
                  {
                    $icode=$row->i_code;
                    $iname=$row->i_name;
                    $iqty=$row->i_qty;
                    $icogs=$row->i_cogs;
                    $iweight=$row->i_weight;
                    $i_img=$row->i_imgfile;

                    
            echo '<tr><td><font color="blue">'.$icode.'</font></td><td>'.$iname.'</td><td align="center">'.$iqty.'</td><td align="center">'.$icogs.'</td><td align="center">'.$iweight.'</td><td align="center">'.$i_img.'</td>';
                
                  }
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        
            echo '</table>';

  }







 ?>
