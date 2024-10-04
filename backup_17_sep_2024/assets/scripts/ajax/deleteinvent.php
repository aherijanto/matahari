<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {

		$kdbrg = $_POST["id"];

			$conn2 = mysqli_connect('103.247.8.177','mimj5729_myroot','myroot@@##','mimj5729_senang');
			$result = mysqli_query($conn2,"delete from mstbrg where KD_BRG = $kdbrg;");
			if($result){
				
				echo 'OK';
			}
			

			


	}
?>
