<?php
    error_reporting(E_ALL);
    ini_set("display_errors","On");
	session_start();
	date_default_timezone_set("Asia/Jakarta");
    $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
    $result = mysqli_query($conn2,"SELECT * FROM wbuytail ORDER BY id ASC;");
    $rowdata=array();
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
    {
        $rowdata[] = $row;
    }
    
    $data=json_encode($rowdata);
    echo $data;
   
			
?>
