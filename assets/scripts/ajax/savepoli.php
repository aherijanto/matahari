<?php
     error_reporting(E_ALL);
     ini_set("display_errors","On");
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/
   
    
	if($_POST) {
        $flag=($_POST["flag"]);
       
		$poliid = htmlspecialchars($_POST["poliid"]);
        $namapoli =htmlspecialchars($_POST["nmpoli"]);

       if ($flag=='new'){
			$conn2 = mysqli_connect('localhost','kliz7334_parkerroot','parkerroot@@##','kliz7334_cappamed');
			$result = mysqli_query($conn2,"insert into poli (poli_id, poli_name) values ('$poliid', '$namapoli');");
            
			if($result){
               
                echo 'OK';
            }
            else{
                echo 'ERROR';
            }
           
        }
    
        else{
            $conn2 = mysqli_connect('localhost','kliz7334_parkerroot','parkerroot@@##','kliz7334_cappamed');
            $result=mysqli_query($conn2,"update poli set poli_id='$poliid',poli_name='$namapoli' where poli_id='$poliid';");
            
            if($result){
                echo 'OK';
            }
            else{
                echo 'ERROR';
            }
        
        }

	}
?>
