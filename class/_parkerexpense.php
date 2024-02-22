<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//include 'class/_parkerconnection.php';
//session_start();

class Expense{

    var $e_code;
    var $e_name;
    
    


   function __construct($e_code,$e_name){
        $this->e_code=$e_code;
        $this->e_name=$e_name;
        
    }



    function set_e_code($args){
        $this->e_code = $args;
     }

    function get_e_code(){
        echo $this->e_code;
     }

    function set_e_name($args){
         $this->e_name = $args;
      }

     function get_e_name(){
         echo $this->e_name;
      }

    
    


    function save_expense(){

      try
      {
        $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

      }
      catch (PDOException $e)
      {
          echo 'Error: ' . $e->getMessage();
          exit();
      }

      $e_code=$this->e_code;
      $e_name=$this->e_name;
      
      



        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wexpense (e_code,e_name)
                VALUES('$e_code','$e_name')";               //echo '<br/>'.$stmt;
                $pdo->exec($stmt);

        } catch(PDOException $e) {
            echo $e->getMessage();
        }
     }

    



}
?>
