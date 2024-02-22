<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {

		$custid = $_POST["id"];

			$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
			$result = mysqli_query($conn2,"select * from wcompany where code = '$custid';");
			if(!$result){
				die();
				echo 'noresult';
			}else{
				$jumrec=mysqli_num_rows($result);
			}
			

			if($jumrec>0){
				$record = mysqli_fetch_array($result);
				$arr = array('id' => $record["code"],
							 'nm' => $record["name"],
							 'addr1' => $record["address1"],
							 'addr2' => $record["address2"],
							 'city' => $record["city"],
							 'phone' => $record["phone"],
							 'email' => $record["email"]
							 );
			}
			else{
				$arr = array('id' => '0',
							 'nm' => '',
							 'spc'=> '',
							 'addr' => '',
							 'phone' => '',
							 'city' => ''
							 );
			}

			echo json_encode( $arr );


	}
?>
