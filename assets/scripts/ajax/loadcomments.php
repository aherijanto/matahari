<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {

		$itemcode = $_POST["id"];

			$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
			$result = mysqli_query($conn2,"SELECT * FROM price_remark where item_code = '$itemcode';");
			if(!$result){
				die();
				echo 'noresult';
			}else{
				$jumrec=mysqli_num_rows($result);
			}
			

			if($jumrec>0){
				$record = mysqli_fetch_array($result);
				$arr = array('itemcode' => $record["item_code"],
							 'c1' => $record["rem01"],
							 'c2' => $record["rem02"],
							 'c3' => $record["rem03"],
							 'c4' => $record["rem04"],
							 'c5' => $record["rem05"],
							 'c6' => $record["rem06"],
							 'c7' => $record["rem07"],
							 'c8' => $record["rem08"],
							 'c9' => $record["rem09"],
							 'c10' => $record["rem10"],
							 );
						}
			else{
				$insert = mysqli_query($conn2,"INSERT INTO price_remark (item_code) VALUES ('$itemcode')");
				if ($insert) {
					// Insertion was successful
					$arr=array('message'=>"success insert");
				} else {
					// Insertion failed
					$arr=array('message'=>"failed insert");
				}
				// $arr = array('id' => '0',
				// 			 'nm' => '',
				// 			 'spc'=> '',
				// 			 'addr' => '',
				// 			 'phone' => '',
				// 			 'city' => ''
				// 			 );
			}

			echo json_encode($arr);
			


	}
?>
