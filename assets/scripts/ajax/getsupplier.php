<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	error_reporting(E_ALL);
    ini_set("display_errors","On");


		//$index=$_POST["id"];
		$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');

			$result = mysqli_query($conn2,"select * from wsuppliers;");
            $jumrec = mysqli_num_rows($result);

			if($jumrec > 0){
                $table='<table class="table table-striped table-hover">';
			    $table.='<thead>
							<tr>
								<th class="text-center" >CODE</th>
								<th class="text-center" >NAME</th>
								<th class="text-center" >PERSON</th>
								<th class="text-center" >ADDRESS</th>
								<th class="text-center" >PHONE</th>
							</tr>
						 </thead>
                         <tbody>';

                //retrieve record from database
							
                while($record = mysqli_fetch_array($result)){

                    $table.='<tr>
                    <td><a href="#" hreff="'.$record["s_code"].'" class="linksupp">'.$record["s_code"].'</a>
										
                    <td class="text-center">'.$record["s_name"].'</td>
					<td class="text-center">'.$record["s_contact"].'</td>
					<td class="text-center">'.$record["s_addr"].'</td>
					<td class="text-center">'.$record["s_phone"].'</td>';
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
