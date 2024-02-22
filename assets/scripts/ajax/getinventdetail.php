<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {

		$kdbrg = $_POST["id"];

			$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
			$result = mysqli_query($conn2,"select * from winventory where i_code = '$kdbrg';");
			if(!$result){
				die();
				echo 'noresult';
			}else{
				$jumrec=mysqli_num_rows($result);
			}
			
			if($jumrec>0){
				$record = mysqli_fetch_array($result);
				$arr = array('id' => $record["i_code"],
							 'nm' => $record["i_name"],
							 'qty' => "1",
							 'wareid'=> $record["ware_id"],
							 'hrg1' => $record["i_sell"],
							 'hrg2' => $record["i_sell2"],
							 'hrg3' => $record["i_sell3"],
							 'hrg4' => $record["i_sell4"],
							 'hrg5' => $record["i_sell5"],
							 'hrg6' => $record["i_sell6"],
							 'hrg7' => $record["i_sell7"],
							 'hrg8' => $record["i_sell8"],
							 'hrg9' => $record["i_sell9"],
							 'hrg10' => $record["i_sell10"],
							 );
			}
			else{
				$arr = array('id' => '0',
							 'nm' => '',
							 'hpp' => '',
							 'hrgjual' => ''
							 );
			}

			echo json_encode( $arr );


	}
?>
