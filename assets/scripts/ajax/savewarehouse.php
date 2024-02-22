<?php
     error_reporting(E_ALL);
     ini_set("display_errors","On");
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/
   
   
	if($_POST) {
        $flag=($_POST["flag"]);
       
		$wareid = htmlspecialchars($_POST["wareid"]);
        $nama =htmlspecialchars($_POST["nm"]);
        $loc = htmlspecialchars($_POST['loc']);
        
       if ($flag=='new'){
			$conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
			$result = mysqli_query($conn2,"insert into wwarehouse (ware_id, ware_name, ware_loc) values ('$wareid', '$nama','$loc');");
            
			if($result){
                echo 'OK';
            }
            else{
                echo 'ERROR';
            }   
        }
    
        else{
            $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
            $result=mysqli_query($conn2,"update warehouse set ware_id='$wareid',ware_name='$nama',ware_loc = '$loc' where ware_id='$wareid';");
            
            if($result){
                echo 'OK';
            }
            else{
                echo 'ERROR';
            }
        
        }

	}
?>