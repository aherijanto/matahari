<?php

    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors","On");

    // if($_POST){
    //     $icode = $_POST['icode'];
    //     if($icode==""){
    //         $sql = "SELECT * FROM winventory,wwarehouse WHERE winventory.ware_id=wwarehouse.ware_id";
    //     }else{
    //         $sql = "SELECT * FROM winventory,wwarehouse WHERE winventory.i_code='$icode' AND winventory.ware_id=wwarehouse.ware_id";
    //     }
    // }
    //$icode = $_POST['icode'];
    $sql = "SELECT * FROM winventory";
            $DB_Server = "103.247.8.177";   //103.247.8.177
            $DB_Username = "mimj5729_myroot";   
            $DB_Password = "myroot@@##";               
            $DB_DBName = "mimj5729_matahari";          
            $DB_TBLName = "winventory";  
              
            //create MySQL connection   
           

            $Connect = mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysqli_error($Connect) . "<br>" . mysqli_errno($Connect));
            mysqli_set_charset($Connect, "utf8");
            //select database   
            $Db = mysqli_select_db($Connect, $DB_DBName) or die("Couldn't select database:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));   

            //execute query 
            $result = mysqli_query($Connect,$sql) or die("Couldn't execute query:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));
            $merge=[];
            $_SESSION['data'] = '';

        //start while loop to get data
            while($row = mysqli_fetch_assoc($result))
            {
                $icode = $row['i_code'];
                $ibarcode = $row['i_barcode'];
                $iname = $row['i_name'];
                $iqty = $row['i_qty'];
                $unit = $row['i_unit'];
                $ivol = $row['i_vol'];
                $ivolunit = $row['i_volunit'];
                //$warename = $row['ware_name'];
                $itemdata = array($row['i_code']=>array('icode'=>$icode,
                                                        'ibarcode'=>$ibarcode,
                                                        'iname'=>$iname,
                                                        'iqty'=>$iqty,
                                                        'iunit'=>$unit,
                                                        'ivol'=>$ivol,
                                                        'ivolunit'=>$ivolunit
                                                        ));
                if(empty($_SESSION['data'])){
                    $_SESSION['data'] = $itemdata;
                }else{
                    $_SESSION['data'] = array_merge($_SESSION['data'],$itemdata);
                }
                
            }
            $data=json_encode($_SESSION["data"]);
            if ($data === false) {
                echo 'JSON encode error: ' . json_last_error_msg(); // Check error message
            } else {
                echo $data; // Output the JSON
            }
           // unset($_SESSION['data']);
           // return;
    
        
?>

