<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["name"]) {

		$namecust = $_POST["name"];

		try 
		{
			$pdo = new PDO('mysql:host=localhost;dbname=poltek', 'ary', 'ary');
		}
		catch (PDOException $e) 
		{
    		echo 'Error: ' . $e->getMessage();
    		exit();
		}
		
		try{
			$pdo->setAttribute(PDO::ATTR_ERRMODE,
			PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM customers WHERE cust_name like '$namecust%'";
			$stmt = $pdo->prepare($sql);
			$stmt->execute();
			$total = $stmt->rowCount();
		}catch(PDOException $e){
			echo $e->getMessage();
		}
			

			$table='<table class="table table-striped table-hover">';
		$table.='<thead>
					<tr>
						<th class="text-center" style="width:5%;">ID</th>
						<th class="text-center" style="width:30%;">CUSTOMER NAME</th>
						<th class="text-center" style="width:30%;">ADDRESS</th>
						<th class="text-center" style="width:10%;">PHONE</th>
						<th class="text-center" style="width:20%;">CITY</th>
                        <th class="text-center" style="width:20%;">ACTION</th>
					</tr>
				</thead>';

		while ($row3 = $stmt->fetch()){
			$newarray[] = $row3;
			$table.='<tbody>
						<tr>
                    		<td align="center"><a href="#" hreff="'.$row3["cust_id"].'" class="linkk">'.$row3["cust_id"].'</a>
							<td>'.$row3['cust_name'].'</td>
							<td>'.$row3['cust_addr'].'</td>
							<td align="center">'.$row3['cust_phone'].'</td>
							<td align="center">'.$row3['cust_city'].'</td>
                            <td align="center">
                                <button class="btn btn-danger" id="btnDeleteList">Delete</button>
                             </td></tr>';
				
		}
		$table.='</tbody>
				</table>';

		echo $table;

	}
	echo '<script src="./assets/scripts/js/new.js"></script>';
?>
