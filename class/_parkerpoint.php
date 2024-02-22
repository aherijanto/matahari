<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//include 'class/_parkerconnection.php';
//session_start();

class Point{

    var $p_code;
    var $p_name;
    var $p_qty;
    


   function __construct($p_code,$p_name,$p_qty){
        $this->p_code=$p_code;
        $this->p_name=$p_name;
        $this->p_qty=$p_qty;
    }



    function set_p_code($args){
        $this->p_code = $args;
     }

    function get_p_code(){
        echo $this->p_code;
     }

    function set_p_name($args){
         $this->p_name = $args;
      }

     function get_p_name(){
         echo $this->p_name;
      }

    function set_p_qty($args){
        $this->p_qty = $args;
     }

    function get_p_qty(){
        echo $this->p_qty;
     }

    


    function save_point(){

      try
      {
        $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

      }
      catch (PDOException $e)
      {
          echo 'Error: ' . $e->getMessage();
          exit();
      }

      $p_code=$this->p_code;
      $p_name=$this->p_name;
      $p_qty=$this->p_qty;
      



        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wpoint (p_code,p_name, p_qty)
                VALUES('$p_code','$p_name','$p_qty')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
     }

     function add_point($p_addno,$c_code){

      try
      {
        $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

      }
      catch (PDOException $e)
      {
          echo 'Error: ' . $e->getMessage();
          exit();
      }

      $p_code=$this->p_code;
      $p_name=$this->p_name;
      $p_qty=$this->p_qty;
      



        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO waddpoint (p_addno,c_code,p_code, p_qty)
                VALUES('$p_addno','$c_code','$p_code','$p_qty')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
     }

     function red_point($pred_no,$c_code){

      try
      {
        $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

      }
      catch (PDOException $e)
      {
          echo 'Error: ' . $e->getMessage();
          exit();
      }

      $p_code=$this->p_code;
      $p_name=$this->p_name;
      $pred_qty=$this->p_qty;
      



        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wredpoint (pred_no,c_code, pred_qty)
                VALUES('$pred_no','$c_code','$pred_qty')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
     }

    
     



}
?>
