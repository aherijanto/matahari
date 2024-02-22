<?php
     error_reporting(E_ALL);
     ini_set("display_errors","On");
	session_start();
	date_default_timezone_set("Asia/Jakarta");

	/*require_once('../../requires/config.php');
	require_once('../../requires/fungsi.php');*/
   
    
	if($_POST) {
        $flag=($_POST["flag"]);
       
		$custid = htmlspecialchars($_POST["custid"]);
        $nama =htmlspecialchars($_POST["nm"]);
        $spc = htmlspecialchars($_POST['spc']);
        $addr = htmlspecialchars($_POST["addr"]);
        $phone = htmlspecialchars($_POST["ph"]);
        $city = htmlspecialchars($_POST["city"]);

        
        /*echo $custid;
        echo $nama;
        echo $addr;
        echo $phone;
        echo $city;*/

       if ($flag=='new'){
			$conn2 = mysqli_connect('localhost','kliz7334_parkerroot','parkerroot@@##','kliz7334_cappamed');
			$result = mysqli_query($conn2,"insert into doctors (doc_id, doc_name,doc_spc, doc_addr, doc_phone, doc_city) values ('$custid', '$nama','$spc', '$addr','$phone', '$city');");
            
			if($result){
               
                echo 'OK';
            }
            else{
                echo 'ERROR';
            }
           
        }
    
        else{
            $conn2 = mysqli_connect('localhost','kliz7334_parkerroot','parkerroot@@##','kliz7334_cappamed');
            $result=mysqli_query($conn2,"update doctors set doc_id='$custid',doc_name='$nama',doc_spc = '$spc', doc_addr='$addr', doc_phone='$phone', doc_city='$city' where doc_id='$custid';");
            
            if($result){
                echo 'OK';
            }
            else{
                echo 'ERROR';
            }
        
        }

	}
?>
