<?php

//$sqlzero  = 'SELECT `winventory`.`i_code`,`winventory`.`i_name`,`winventory`.`i_qty`,`wbuytail`.`b_code`,`wselltail`.`s_code`FROM `winventory` \n'
//    . "INNER JOIN `wbuytail` ON `wbuytail`.`i_code`=`winventory`.`i_code` \n";
//    . "INNER JOIN `wselltail` ON `wselltail`.`i_code`=`winventory`.`i_code`\n";
//    . "WHERE (`winventory`.`i_qty`=0) AND (`winventory`.`g_code`=\'K\')\n";
//    . "ORDER BY myid";

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
            <tr><td bgcolor="#D8CEF6" align="center">INVENTORY ONE</td></tr>
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
        							$sqlgroup = "SELECT * FROM wgroups ORDER BY :c_order";
        							$stmt = $pdo->prepare($sqlgroup);
        							$stmt->bindParam(':c_order', $group_param, PDO::PARAM_STR);
        							$stmt->execute();
        							$total = $stmt->rowCount();
        					} catch(PDOException $e) {
        								echo $e->getMessage();
        						}
?>


        				<td align="center">Select Group<select name="groupitem" id="groupitem"  placeholder="Select Group..." >
        					<option value="" disabled selected>Select Group</option>
<?php
        				while ($row = $stmt->fetchObject()) {
        							//echo $row->c_code;
        							$mycode=$row->s_code;
        							echo '<option value="'.$row->g_code.'">'. $row->g_name. '</option>';

        					 }

        				echo '</select></td>';
?>

         	</tr>

            <tr><td align="center"><input type="submit" name="submitdate"/></td></tr>
            </form>
            </table>
          </div>
        </div>
        </p>
        </body>
        </html>

<?php


        if (isset($_POST['submitdate']) && isset($_POST['groupitem']))
        {


        $mysupp=$_POST['groupitem'];

          try
               {
                 $pdo1 = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

               }
               catch (PDOException $e)
               {
                   echo 'Error: ' . $e->getMessage();
                   exit();
               }





                try
                {


//$trackquery="SELECT * FROM `wbuyhead`,`wbuytail` where (wbuytail.b_code=wbuyhead.b_code)  AND (wbuytail.g_code='$mygroupcode')  AND (wbuyhead.b_date BETWEEN '$mydate' AND '$mydate1') and (wbuyhead.s_code='$mysupp')";
$sql  = "SELECT winventory.i_code AS wicode,winventory.i_name AS winame,winventory.i_qty AS wiqty,winventory.i_weight AS weight,winventory.i_cogs AS cogs,winventory.i_imgfile AS imgfile,wbuytail.b_code AS bcode,wselltail.s_code as scode FROM winventory LEFT OUTER JOIN wbuytail ON wbuytail.i_code=winventory.i_code LEFT OUTER JOIN wselltail on wselltail.i_code=winventory.i_code WHERE (winventory.i_qty= 1) AND (winventory.g_code='$mysupp') order by id";

                $stmt1 = $pdo1->prepare($sql);
                 $stmt1->execute();
                 $total1 = $stmt1->rowCount();
                 echo '<table width="100%" font="calibri">';
                 echo '<th>ITEM CODE </th><th>ITEM NAME </th><th>INV.NO PURCHASE </th><th>QTY</th><th>INV.NO SALES </th><th>QTY</th><th>COGS</th><th>WEIGHT</th><th>IMAGE</th>';
                 while ($row1 = $stmt1->fetchObject())
                 {
		                echo '<tr><td><font color="blue">'.$row1->wicode.'</font></td><td><font color="purple">'.$row1->winame.'</font></td><td>'.$row1->bcode.'</td><td align="center">'.$row1->wiqty.'</td><td align="center"><font color="red">'.$row1->scode.'</font></td><td align="center"><font color="red">-</font></td><td align="right">'.$row1->cogs.'</td><td align="right">'.$row1->weight.'</td><td>'.$row1->imgfile.'</td></tr>';
      					 }

                } catch(PDOException $e)
                 {
                	echo $e->getMessage();
                 }

          echo '</table>';
        }
?>
