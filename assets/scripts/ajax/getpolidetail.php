<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {

		$poliid = $_POST["id"];

			$conn2 = mysqli_connect('localhost','kliz7334_parkerroot','parkerroot@@##','kliz7334_cappamed');
			$result = mysqli_query($conn2,"select * from poli where poli_id = '$poliid';");
			if(!$result){
				die();
				echo 'noresult';
			}else{
				$jumrec=mysqli_num_rows($result);
			}
			

			if($jumrec>0){
				$record = mysqli_fetch_array($result);
				$arr = array('id' => $record["poli_id"],
							 'nm' => $record["poli_name"]
							 );
			}
			else{
				$arr = array('id' => '0',
							 'nm' => ''
							 );
			}

			echo json_encode( $arr );


	}
?>
