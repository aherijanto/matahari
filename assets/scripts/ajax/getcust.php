<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();
date_default_timezone_set("Asia/Jakarta");
			
		try 
		{
			$pdo = new PDO('mysql:host=localhost;dbname=kliz7334_cappamed', 'kliz7334_parkerroot','parkerroot@@##');
		}
		catch (PDOException $e) 
		{
    		echo 'Error: ' . $e->getMessage();
    		exit();
		}
		
		try{
			$pdo->setAttribute(PDO::ATTR_ERRMODE,
			PDO::ERRMODE_EXCEPTION);
			$sql = "SELECT * FROM doctors";
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
						<th class="text-center" style="width:30%;">DOCTOR NAME</th>
						<th class="text-center" style="width:30%;">SPECIALITY</th>
						<th class="text-center" style="width:30%;">ADDRESS</th>
						<th class="text-center" style="width:10%;">PHONE</th>
						<th class="text-center" style="width:20%;">CITY</th>
					</tr>
				</thead>';

		while ($row3 = $stmt->fetch()){
			$newarray[] = $row3;
			$table.='<tbody>
						<tr>
                    		<td align="center"><a href="#" hreff="'.$row3["doc_id"].'" class="linkk">'.$row3["doc_id"].'</a>
							<td>'.$row3['doc_name'].'</td>
							<td>'.$row3['doc_spc'].'</td>
							<td>'.$row3['doc_addr'].'</td>
							<td align="center">'.$row3['doc_phone'].'</td>
							<td align="center">'.$row3['doc_city'].'</td></tr>';
				
		}
		$table.='</tbody>
				</table>';

		echo $table;
	
			

?>
