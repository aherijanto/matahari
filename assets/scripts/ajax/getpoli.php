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
			$sql = "SELECT * FROM poli";
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
						<th class="text-center" style="width:30%;">POLI NAME</th>
					</tr>
				</thead>';

		while ($row3 = $stmt->fetch()){
			$newarray[] = $row3;
			$table.='<tbody>
						<tr>
                    		<td align="center"><a href="#" hreff="'.$row3["poli_id"].'" class="linkk">'.$row3["poli_id"].'</a>
							<td>'.$row3['poli_name'].'</td></tr>';
				
		}
		$table.='</tbody>
				</table>';

		echo $table;
	
			

?>
