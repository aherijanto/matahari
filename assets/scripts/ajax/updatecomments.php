<?php
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');//
	require_once('../../requires/fungsi.php');*/

	if($_POST["id"]) {//

		$itemcode = $_POST["id"];
        $comment = $_POST['comment'];
        $poscomment = $_POST['pos'];
        
        $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
        $update = mysqli_query($conn2,"UPDATE price_remark SET $poscomment = '$comment' WHERE item_code LIKE '$itemcode';");
        if($update){
            $arr=array('message'=>"success update");
        }else{
            $arr=array('message'=>"failed update");
        }
        echo json_encode($arr);
	}
?>
