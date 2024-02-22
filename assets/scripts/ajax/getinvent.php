<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	error_reporting(E_ALL);
    ini_set("display_errors","On");


		//$index=$_POST["id"];
		$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');

			$result = mysqli_query($conn2,"select code,name,address1,address2,city,phone,email from wcompany;");
            $jumrec = mysqli_num_rows($result);

			if($jumrec > 0){
                $table='<table class="table table-striped table-hover">';
			    $table.='<thead>
							<tr>
								<th class="text-center" style="width:5%;">CODE</th>
								<th class="text-center" style="width:30%;">COMPANY</th>
								<th class="text-right" style="width:35%;">ADDRESS 1</th>
								<th class="text-right" style="width:35%;">ADDRESS 2</th>
								<th class="text-right" style="width:35%;">CITY</th>
								<th class="text-right" style="width:15%;">PHONE</th>
								<th class="text-right" style="width:35%;">EMAIL</th>
							</tr>
						 </thead>
                         <tbody>';

                //retrieve record from database
							
                while($record = mysqli_fetch_array($result)){

                    $table.='<tr>
                    <td><a href="#" hreff="'.$record["code"].'" class="linkk">'.$record["code"].'</a>
										
                    <td>'.$record["name"].'</td>
					<td>'.$record["address1"].'</td>
					<td>'.$record["address2"].'</td>
					<td>'.$record["city"].'</td>
					<td>'.$record["phone"].'</td>
					<td>'.$record["email"].'</td>';
                }

                $table.='</tbody>
					 	</table>';
             }
			else{
				//$arr = array('barcode' => '0',
				//			 'namabarang' => '',
				//			 'hpp' => '',
				//			 'hrgjual' => '');
			}

			echo $table;


?>
