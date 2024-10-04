<?php
    error_reporting(E_ALL);
    ini_set("display_errors","On");
	session_start();
	date_default_timezone_set("Asia/Jakarta");
    $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
    //get tables
    $tables = array();
    $resulttables = mysqli_query($conn2, 'SHOW TABLES');
    while($rowtables = mysqli_fetch_row($resulttables))
    {
        $tables[] = $rowtables[0];
    }
    mysqli_close($conn2);
    foreach($tables as $table){
        $conn3 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
        
        
        $resultMe = mysqli_query($conn3,"select * from ".$table);
        while($row = mysqli_fetch_array($resultMe,MYSQLI_ASSOC)){
            $row[]=$row;
        }
        
        $data=json_encode($rowdata);
        echo $data;
 
    }
    
    //unset($_SESSION['syncsellhead']);
			
?>
