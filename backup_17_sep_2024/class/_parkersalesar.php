<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//include 'class/_parkerconnection.php';


class Sales{

    var $s_code;
    var $s_date;
    var $s_dateinput;
    var $c_code;
    var $u_code;
    var $i_code;
    var $i_name;
    var $i_qty;
    var $i_sell;
    var $i_disc1;
    var $i_disc2;
    var $i_disc3;
    var $s_premi;
    var $s_deduct;



   function __construct($s_code,$s_date,$s_dateinput,$c_code,$u_code,$s_premi,$s_deduct,$i_code,$i_name,$i_qty,$i_sell,$i_disc1,$i_disc2,$i_disc3)
   {
        $this->s_code=$s_code;
        $this->s_date=$s_date;
        $this->s_dateinput=$s_dateinput;
        $this->c_code=$c_code;
        $this->u_code=$u_code;

        $this->i_code=$i_code;
        $this->i_name=$i_name;
        $this->i_qty=$i_qty;
        $this->i_sell=$i_sell;
        $this->i_disc1=$i_disc1;
        $this->i_disc2=$i_disc2;
        $this->i_disc3=$i_disc3;
        $this->s_premi=$s_premi;
        $this->s_deduct=$s_deduct;
    }



    function set_s_code($args){
        $this->b_code = $args;
     }

    function get_s_code(){
        echo $this->b_code;
     }

    

    function set_s_date($args){
        $this->b_date = $args;
     }

    function get_s_date(){
        echo $this->b_date;
     }

    function set_s_dateinput($args){
        $this->b_dateinput = $args;
     }

    function get_s_dateinput(){
        echo $this->b_dateinput;
     }

    function set_c_code($args){
         $this->s_code = $args;
      }

    function get_c_code(){
         echo $this->s_code;
      }

    function set_u_code($args){
           $this->u_code = $args;
        }

    function get_u_code(){
           echo $this->u_code;
        }

  

    function set_i_code($args){
           $this->i_code = $args;
        }

    function get_i_code(){
           echo $this->i_code;
        }

    function set_i_name($args){
           $this->i_name = $args;
        }

    function get_i_name(){
           echo $this->i_name;
        }

    function set_i_qty($args){
           $this->i_qty = $args;
        }

    function get_i_qty(){
           echo $this->i_qty;
        }

    function set_i_sell($args){
           $this->i_sell = $args;
        }

    function get_i_sell(){
           echo $this->i_sell;
        }

    function set_i_disc1($args){
           $this->i_disc1 = $args;
        }

    function get_i_disc1(){
           echo $this->i_disc1;
        }

    function set_i_disc2($args){
            $this->i_disc2 = $args;
       }

    function get_i_disc2(){
            echo $this->i_disc2;
         }

    function set_i_disc3($args){
            $this->i_disc3 = $args;
       }

    function get_i_disc3(){
            echo $this->i_disc3;
         }


    function set_s_premi($args){
            $this->s_premi = $args;
       }

    function get_s_premi(){
            echo $this->s_premi;
         }


    function set_s_deduct($args){
            $this->s_deduct = $args;
       }

    function get_s_deduct(){
            echo $this->s_deduct;
         }

    function save_sell_head()
    {

      include ('class/_parkerconnection.php');

      /*------------------DEFINE HEAD-----------------*/

      $s_code=$this->s_code;
      
      $s_date=$this->s_date;
      $s_dateinput=$this->s_dateinput;
      $c_code=$this->c_code;
      $u_code=$this->u_code;
      $s_premi=$this->s_premi;
      $s_deduct=$this->s_deduct;

      

/*--------------INSERT INTO WBUYHEAD---------------------------------------------------------------------------*/
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wsellarhead (s_code,s_date,s_dateinput,c_code,u_code,s_premi,s_deduct)
                VALUES('$s_code','$s_date','$s_dateinput','$c_code','$u_code','$s_premi','$s_deduct')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
}


function save_sell_tail()
    {

      include ('class/_parkerconnection.php');


        /*----------------DEFINE TAIL-----------------*/
      $s_code=$this->s_code;
      $i_code=$this->i_code;
      $i_name=$this->i_name;
      $i_qty=$this->i_qty;
      $i_sell=$this->i_sell;
      $i_disc1=$this->i_disc1;
      $i_disc2=$this->i_disc2;
      $i_disc3=$this->i_disc3;

/*-------------INSERT INTO WBUYTAIL----------------------------------------------------------------------------*/

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wsellartail (s_code,i_code,i_name,i_qty,i_sell,i_disc1,i_disc2,i_disc3)
                VALUES('$s_code','$i_code','$i_name','$i_qty','$i_sell','$i_disc1','$i_disc2','$i_disc3')";
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

    function save_promo_head()
    {

      include ('class/_parkerconnection.php');

      /*------------------DEFINE HEAD-----------------*/

      $s_code=$this->s_code;
      
      $s_date=$this->s_date;
      $s_dateinput=$this->s_dateinput;
      $c_code=$this->c_code;
      $u_code=$this->u_code;
      $s_premi=$this->s_premi;
      $s_deduct=$this->s_deduct;

      

/*--------------INSERT INTO WBUYHEAD---------------------------------------------------------------------------*/
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wpromoitemhead (s_code,s_date,s_dateinput,c_code,u_code,s_premi,s_deduct)
                VALUES('$s_code','$s_date','$s_dateinput','$c_code','$u_code','$s_premi','$s_deduct')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
}




function save_promo_tail($codepromo,$barcode,$itemname,$artikel,$warna,$disc01)
    {

      include ('class/_parkerconnection.php');


        /*----------------DEFINE TAIL-----------------*/
      $s_code=$this->s_code;
      $i_code=$this->i_code;
      $i_name=$this->i_name;
      $i_qty=$this->i_qty;
      $i_sell=$this->i_sell;
      $i_disc1=$this->i_disc1;
      $i_disc2=$this->i_disc2;
      $i_disc3=$this->i_disc3;

/*-------------INSERT INTO WBUYTAIL----------------------------------------------------------------------------*/

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wpromoitemtail (s_code,i_code,i_name,i_article,i_color,i_disc)
                VALUES('$codepromo','$barcode','$itemname','$artikel','$warna','$disc01')";
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }

function save_return_sales($rs_code,$rs_date,$rss_code,$rsi_code,$rsi_name,$rsi_qty)
    {

      include ('class/_parkerconnection.php');

      /*------------------DEFINE HEAD-----------------*/

      
      

/*--------------INSERT INTO WRETSALESDETAIL---------------------------------------------------------------------------*/
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wretsalesdetail (rs_code,rs_date,s_code,i_barcode,i_name,i_qty)
                VALUES('$rs_code','$rs_date','$rss_code','$rsi_code','$rsi_name','$rsi_qty')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
}     



}
?>
