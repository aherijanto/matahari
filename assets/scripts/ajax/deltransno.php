<?php
    session_start();
    $_SESSION['report'] = 0;
    error_reporting(E_ALL);
    ini_set("display_errors", "On");

    if($_POST['noinv']){
        $delnote = $_POST['noinv'];
        $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
        $query = "DELETE  FROM wsellhead WHERE s_code='$delnote'";
        $execquery = mysqli_query($conn2,$query);
        //$row = mysqli_num_rows($execquery);
        echo 'OK';        
    }
?>