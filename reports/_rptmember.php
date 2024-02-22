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
		<table height="40px" width="100%">
		<tr><td bgcolor="#D8CEF6" align="center">MEMBER CUSTOMER</td></tr>
		<!--<form method="post" action="">
		<tr><td align="center">Pick a Date <input type="date" name="datequery"/><input type="submit" name="submitdate"/></td></tr>
		</form>-->
		</table>
	</div>

<?php
try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }

       
            $addpoint=0;
            $redpoint=0;
            
            try {
                	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                	$sql = "SELECT * FROM wcustomers";

                	$stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                	$stmt->execute();
                	$total = $stmt->rowCount();

        echo '<table width="100%" font="calibri">
		<th>CUSTOMER CODE </th><th>CUSTOMER NAME</th><th>ADDRESS</th><th>PHONE</th><th>ADD POINT</th><th>REDEEM POINT</th><th>BALANCE</th>';
                	while ($row = $stmt->fetchObject()) 
                	{
                		$custcodeinvent=$row->c_code;
                		$custname=$row->c_name;
                		$caddr=$row->c_addr;
                		$cphone=$row->c_phone;

                  		$sql2 = "SELECT sum(p_qty) as addpoint FROM waddpoint WHERE c_code='$custcodeinvent'";
                  		$stmt2 = $pdo->prepare($sql2);
                	//$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                		$stmt2->execute();
                		$total2 = $stmt2->rowCount();
                		$row2 = $stmt2->fetchObject();
						$addpoint=$row2->addpoint;

						$sql3 = "SELECT sum(pred_qty) as redpoint FROM wredpoint WHERE c_code='$custcodeinvent'";
                  		$stmt3 = $pdo->prepare($sql3);
                		//$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                		$stmt3->execute();
                		$total3 = $stmt3->rowCount();
                		$row3 = $stmt3->fetchObject();
						$redpoint=$row3->redpoint;

						$balance=$addpoint-$redpoint;
						echo '<tr><td><font color="blue">'.$custcodeinvent.'</font></td><td>'.$custname.'</td><td align="center">'.$caddr.'</td><td align="center">'.$cphone.'</td><td align="center">'.$addpoint.'</td><td align="center">'.$redpoint.'</td><td align="center">'.$balance.'</td>';
                
                	}
            } catch(PDOException $e) {
                echo $e->getMessage();
            }


?>
</table>
</html>


