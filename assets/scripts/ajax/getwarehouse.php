<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");
	error_reporting(E_ALL);
    ini_set("display_errors","On");


		//$index=$_POST["id"];
		$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');

			$result = mysqli_query($conn2,"select ware_id,ware_name,ware_loc from wwarehouse;");
            $jumrec = mysqli_num_rows($result);

			if($jumrec > 0){
                $table='<table class="table table-striped table-hover">';
			    $table.='<thead>
							<tr>
								<th class="text-center" >CODE</th>
								<th class="text-center" >WAREHOUSE NAME</th>
								<th class="text-center" >LOCATION</th>
							</tr>
						 </thead>
                         <tbody>';

                //retrieve record from database
							
                while($record = mysqli_fetch_array($result)){

                    $table.='<tr>
                    <td><a href="#" hreff="'.$record["ware_id"].'" class="linkk">'.$record["ware_id"].'</a>					
                    <td class="text-center">'.$record["ware_name"].'</td>
					<td class="text-center">'.$record["ware_loc"].'</td>';
                }

                $table.='</tbody>
					 	</table>';
             }
			else{

                //echo 'Data Error';
				//$arr = array('barcode' => '0',
				//			 'namabarang' => '',
				//			 'hpp' => '',
				//			 'hrgjual' => '');
			}

			echo $table;


?>
