<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {

		$wareid = $_POST["id"];

			$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
			$result = mysqli_query($conn2,"delete from wwarehouse where ware_id = '$wareid';");
			if($result){
				
				echo 'OK';
			}else{ echo 'failed';}			
	}
?>
