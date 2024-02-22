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
								<th class="text-center" >CODE</th>
								<th class="text-center" >COMPANY</th>
								<th class="text-center" >ADDRESS 1</th>
								<th class="text-center" >ADDRESS 2</th>
								<th class="text-center" >CITY</th>
								<th class="text-center" >PHONE</th>
								<th class="text-center" >EMAIL</th>
							</tr>
						 </thead>
                         <tbody>';

                //retrieve record from database
							
                while($record = mysqli_fetch_array($result)){

                    $table.='<tr>
                    <td><a href="#" hreff="'.$record["code"].'" class="linkk">'.$record["code"].'</a>
										
                    <td class="text-center">'.$record["name"].'</td>
					<td class="text-center">'.$record["address1"].'</td>
					<td class="text-center">'.$record["address2"].'</td>
					<td class="text-center">'.$record["city"].'</td>
					<td class="text-center">'.$record["phone"].'</td>
					<td class="text-center">'.$record["email"].'</td>';
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
