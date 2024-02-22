
<?php



?>

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
    <tr><td bgcolor="#D8CEF6" align="center">INVENTORY FROM PURCHASE GROUP BY SUPPLIER AND ITEM GROUP</td></tr>
    <form method="post" action="">
    <tr>
    <?php 
    		$group_param='g_code';

    				try
					{
						$pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

					}
					catch (PDOException $e)
					{
							echo 'Error: ' . $e->getMessage();
							exit();
					}
					try
					{
							$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
							$sql = "SELECT * FROM wsuppliers ORDER BY :c_order";
							$stmt = $pdo->prepare($sql);
							$stmt->bindParam(':c_order', $group_param, PDO::PARAM_STR);
							$stmt->execute();
							$total = $stmt->rowCount();
					} catch(PDOException $e) {
								echo $e->getMessage();
						}
						?>
				
				
				<td align="center">Select Supplier<select name="groupitem" id="groupitem"  placeholder="Select Supplier..." >
					<option value="" disabled selected>Select Group</option>
				<?php
				while ($row = $stmt->fetchObject()) {
							//echo $row->c_code;
							$mycode=$row->s_code;
							echo '<option value="'.$row->s_code.'">'. $row->s_name. '</option>';

					 }

				echo '</select></td>';	
    ?>
 	</tr>
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


if (isset($_POST['submitdate']) && isset($_POST['groupitem'])){
$mydate=date('Y-m-d',strtotime($_POST['datequery']));
$mydate1=date('Y-m-d',strtotime($_POST['datequery1']));
$mysupp=$_POST['groupitem'];

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
                  $sqlgroups = "SELECT * FROM wgroups";

                  $stmt = $pdo->prepare($sqlgroups);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                  $stmt->execute();
                  $total = $stmt->rowCount();

        		
         				
                  			while ($row = $stmt->fetchObject()) 
                  			{
                  				$mygroupcode=$row->g_code;
                  				$mygroupname=$row->g_name;
                    			echo '<table bgcolor="black" width="100%" font="calibri"><br/><br/><tr><td><font color="white"><h2>'.$mygroupname.'<h2></tr></td></table>';

                    			echo '<table width="100%" font="calibri">';
            					try {
                 					
                  					$trackquery="SELECT * FROM `wbuyhead`,`wbuytail` where (wbuytail.b_code=wbuyhead.b_code)  AND (wbuytail.g_code='$mygroupcode')  AND (wbuyhead.b_date BETWEEN '$mydate' AND '$mydate1') and (wbuyhead.s_code='$mysupp')";
                  					$stmt1 = $pdo->prepare($trackquery);
                					//$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                  					$stmt1->execute();
                  					$total1 = $stmt1->rowCount();

                  					

                  					echo '<th>ITEM CODE </th><th>ITEM NAME </th><th>INV.NO PURCHASE </th><th>QTY</th><th>INV.NO SALES </th><th>QTY</th><th>COGS</th><th>WEIGHT</th><th>IMAGE</th>';
         				
                  					while ($row1 = $stmt1->fetchObject()) 
                  					{
                  						$myicode=$row1->i_code;
                  						try {
                 							 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  							$tracksell="SELECT * FROM `wselltail` where (wselltail.i_code='$myicode')";
                  							$stmt2 = $pdo->prepare($tracksell);
                					//$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                  							$stmt2->execute();
                  							$total2 = $stmt2->rowCount();
                  							$row2 = $stmt2->fetchObject();
                  							if ($total2==0){
                  								$mysalesinv="";
                  								$myqtysell=0;
                  							}else{
                  							$mysalesinv=$row2->s_code;
                  							$myqtysell=$row2->i_qty;
                  							}

            							} catch(PDOException $e) {
                							echo $e->getMessage();
            							}
                    		
            						echo '<tr><td><font color="blue">'.$row1->i_code.'</font></td><td><font color="purple">'.$row1->i_name.'</font></td><td>'.$row1->b_refno.'</td><td align="center">'.$row1->i_qty.'</td><td align="center"><font color="red">'.$mysalesinv.'</font></td><td align="center"><font color="red">'.$myqtysell.'</font></td><td align="right">'.number_format($row1->i_cogs).'</td><td align="right">'.number_format($row1->i_weight,2).'</td><td>'.$row1->i_imgfile.'</td></tr>';
                
                  				
                  					}

            					} catch(PDOException $e) {
                					echo $e->getMessage();
            					}
                
                  				 echo '</table>';
                  			}

            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        
           

  }







 ?>
