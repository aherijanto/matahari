<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//include 'class/_parkerconnection.php';


class Purchase
{

    var $b_code;
    var $b_refno;
    var $b_date;
    var $b_dateinput;
    var $s_code;
    var $u_code;
    var $g_code;
    var $i_code;
    var $i_name;
    var $i_qty;
    var $i_cogs;
    var $i_disc1;
    var $i_disc2;
    var $i_disc3;
    




function __construct($b_code,$b_refno,$b_date,$b_dateinput,$s_code,$u_code,$g_code,$i_code,$i_name,$i_qty,$i_cogs,$i_disc1,$i_disc2,$i_disc3)
   {
        $this->b_code=$b_code;
        $this->b_refno=$b_refno;
        $this->b_date=$b_date;
        $this->b_dateinput=$b_dateinput;
        $this->s_code=$s_code;
        $this->u_code=$u_code;
        $this->g_code=$g_code;
        $this->i_code=$i_code;
        $this->i_name=$i_name;
        $this->i_qty=$i_qty;
        $this->i_cogs=$i_cogs;
        $this->i_disc1=$i_disc1;
        $this->i_disc2=$i_disc2;
        $this->i_disc3=$i_disc3;
        

    }


//1
    function set_b_code($args){
        $this->b_code = $args;
     }

    function get_b_code(){
        echo $this->b_code;
     }

    //2
    function set_b_refno($args){
         $this->b_refno = $args;
      }

     function get_b_refno(){
         echo $this->b_refno;
      }

      //3

    function set_b_date($args){
        $this->b_date = $args;
     }

    function get_b_date(){
        echo $this->b_date;
     }

     //4

    function set_b_dateinput($args){
        $this->b_dateinput = $args;
     }

    function get_b_dateinput(){
        echo $this->b_dateinput;
     }

     //5
    function set_s_code($args){
         $this->s_code = $args;
      }

    function get_s_code(){
         echo $this->s_code;
      }

      //6

    function set_u_code($args){
           $this->u_code = $args;
        }

    function get_u_code(){
           echo $this->u_code;
        }

        //7
    function set_g_code($args){
           $this->g_code = $args;
        }

    function get_g_code(){
           echo $this->g_code;
        }

        //8
    function set_i_code($args){
           $this->i_code = $args;
        }

    function get_i_code(){
           echo $this->i_code;
        }

        //9

    function set_i_name($args){
           $this->i_name = $args;
        }

    function get_i_name(){
           echo $this->i_name;
        }

        //10

    function set_i_qty($args){
           $this->i_qty = $args;
        }

    function get_i_qty(){
           echo $this->i_qty;
        }

        //11
    function set_i_cogs($args){
           $this->i_cogs = $args;
        }

    function get_i_cogs(){
           echo $this->i_cogs;
        }

        //12

    function set_i_disc1($args){
           $this->i_disc1 = $args;
        }

    function get_i_disc1(){
           echo $this->i_disc1;
        }

        //13
    function set_i_disc2($args){
            $this->i_disc2 = $args;
       }

    function get_i_disc2(){
            echo $this->i_disc2;
         }

//14
    function set_i_disc3($args){
            $this->i_disc3 = $args;
       }

    function get_i_disc3(){
            echo $this->i_disc3;
         }



    function save_purchase_head()
    {

      include ('class/_parkerconnection.php');

      /*------------------DEFINE HEAD-----------------*/

      $b_code=$this->b_code;
      $b_refno=$this->b_refno;
      $b_date=$this->b_date;
      $b_dateinput=$this->b_dateinput;
      $s_code=$this->s_code;
      $u_code=$this->u_code;

      

/*--------------INSERT INTO WBUYHEAD---------------------------------------------------------------------------*/
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wbuyhead (b_code,b_refno,b_date,b_dateinput,s_code,u_code)
                VALUES('$b_code','$b_refno','$b_date','$b_dateinput','$s_code','$u_code')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
    }


function save_purchase_tail($expdate)
    {

      include ('class/_parkerconnection.php');


        /*----------------DEFINE TAIL-----------------*/
      $b_code=$this->b_code;
      $g_code=$this->g_code;
      $i_code=$this->i_code;
      $i_name=$this->i_name;
      $i_qty=$this->i_qty;
      $i_cogs=$this->i_cogs;
      $i_disc1=$this->i_disc1;
      $i_disc2=$this->i_disc2;
      $i_disc3=$this->i_disc3;
      



/*-------------INSERT INTO WBUYTAIL----------------------------------------------------------------------------*/

        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wbuytail (b_code,g_code,i_code,i_name,i_qty,i_cogs,i_disc1,i_disc2,i_disc3,tglexp)
                VALUES('$b_code','$g_code','$i_code','$i_name','$i_qty','$i_cogs','$i_disc1','$i_disc2','$i_disc3','$expdate')";
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }




    


  }

  function save_return_pcs($rs_code,$rs_date,$rss_code,$rsi_code,$rsi_name,$rsi_qty)
    {

      include ('class/_parkerconnection.php');

      /*------------------DEFINE HEAD-----------------*/

      
      

/*--------------INSERT INTO WRETSALESDETAIL---------------------------------------------------------------------------*/
        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wretpcsdetail (rs_code,rs_date,s_code,i_barcode,i_name,i_qty)
                VALUES('$rs_code','$rs_date','$rss_code','$rsi_code','$rsi_name','$rsi_qty')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
  }
}
?>