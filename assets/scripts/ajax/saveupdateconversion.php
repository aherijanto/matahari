<?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors","On");

    if($_POST){
        $DB_Server = "localhost";   
        $DB_Username = "mimj5729_myroot";   
        $DB_Password = "myroot@@##";               
        $DB_DBName = "mimj5729_matahari";          
        

        $condate = date('Y-m-d');
        $contime = date('H:m:s');
        $conno = date('Ymd').date('Hms');
        
        
        $icodesource = $_POST['con_from'];
        $icodedestination = $_POST['con_to'];
        $qtysource = $_POST['con_qtyfrom'];
        $qtydestination = $_POST['con_qtyto'];
        $conuser = $_POST['username'];
        
        // saving to wconversion
        $sql_save_conversion = "INSERT INTO wconversion (`con_no`,`con_date`,`con_time`,`con_from`,`con_qtyfrom`,`con_to`,`con_qtyto`,`con_user`) 
                                VALUES ('$conno','$condate','$contime','$icodesource','$qtysource','$icodedestination','$qtydestination','$conuser')";

        
        $Connect = mysqli_connect($DB_Server, $DB_Username, $DB_Password,$DB_DBName);
        
        $resultsave = mysqli_query($Connect,$sql_save_conversion);
        echo $resultsave;
        
        // var_dump($resultsave);
        // if($resultsave==1){
        //     //$m = json_encode(array('message'=>array('reply'=>'OK')));
        //     echo 'ok';
        // }else{
        //     echo 'failed';
        // } 

        // if($success == 'ok'){
        //     echo 'ok';
        // }else{
        //     echo 'failed';
        // }
        // $sqlupdatesource = "UPDATE winventory SET i_qty=$qtysource WHERE i_code='$icodesource'";
        // $sqlupdatedestination = "UPDATE winventory SET i_qty=$qtydestination WHERE i_code='$icodedestination'";
        // echo $sqlupdatesource;
   }
    //          
              
    //         //create MySQL connection   
            
    //         $Connect = mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysqli_error($Connect) . "<br>" . mysqli_errno($Connect));

    //         //select database   
    //         $Db = mysqli_select_db($Connect, $DB_DBName) or die("Couldn't select database:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));   

    //         //execute query 
    //         $resultsource = mysqli_query($Connect,$sqlupdatesource) or die("Couldn't execute query:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));
            
    //         $resultdestination = mysqli_query($Connect,$sqlupdatedestination) or die("Couldn't execute query:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));
            
?>

