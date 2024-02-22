<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {

		$custid = $_POST["id"];

		//user sesuaikan dengan permission masing-masing
			$conn2 = mysqli_connect('localhost','kliz7334_parkerroot','parkerroot@@##','kliz7334_cappamed');
			$result = mysqli_query($conn2,"delete from poli where poli_id = '$custid';");
			if($result){
				
				echo 'OK';
			}
			
	}
?>
