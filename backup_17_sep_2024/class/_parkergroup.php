<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//include 'class/_parkerconnection.php';
//session_start();

class Groups{

    var $g_code;
    var $g_name;



   function __construct($g_code,$g_name){
        $this->g_code=$g_code;
        $this->g_name=$g_name;

    }



    function set_g_code($args){
        $this->g_code = $args;
     }

    function get_g_code(){
        echo $this->g_code;
     }

    function set_g_name($args){
        $this->g_name = $args;
     }

    function get_g_name(){
        echo $this->g_name;
     }





    function save_group(){

      include ('class/_parkerconnection.php');

      $g_code=$this->g_code;
      $g_name=$this->g_name;



      try {

          $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wgroups (g_code, g_name)
              VALUES('$g_code','$g_name')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e)
          {
            echo $e->getMessage();
          }

     }

     function fetch_group($_search)
     {
       include ('class/_parkerconnection.php');


       }





}
?>
