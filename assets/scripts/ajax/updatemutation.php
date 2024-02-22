<?php

    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors","On");

    if($_POST){
        $icodesource = $_POST['icodesource'];
        $icodedestination = $_POST['icodedestination'];
        $qtysource = $_POST['qtysource'];
        $qtydestination = $_POST['qtydestination'];

        $sqlupdatesource = "UPDATE winventory SET i_qty=$qtysource WHERE i_code='$icodesource'";
        $sqlupdatedestination = "UPDATE winventory SET i_qty=$qtydestination WHERE i_code='$icodedestination'";
        echo $sqlupdatesource;
    }
   
            $DB_Server = "localhost";   
            $DB_Username = "mimj5729_myroot";   
            $DB_Password = "myroot@@##";               
            $DB_DBName = "mimj5729_matahari";          
            $DB_TBLName = "winventory";  
              
            //create MySQL connection   
            
            $Connect = mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysqli_error($Connect) . "<br>" . mysqli_errno($Connect));

            //select database   
            $Db = mysqli_select_db($Connect, $DB_DBName) or die("Couldn't select database:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));   

            //execute query 
            $resultsource = mysqli_query($Connect,$sqlupdatesource) or die("Couldn't execute query:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));
            
            $resultdestination = mysqli_query($Connect,$sqlupdatedestination) or die("Couldn't execute query:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));
            
?>

