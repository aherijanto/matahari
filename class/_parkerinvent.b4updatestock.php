<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//include 'class/_parkerconnection.php';
//session_start();

class Inventory{

    var $i_code;
    var $g_code;
    var $i_supp;
    var $i_barcode;
    var $i_name;
    var $i_qty;
    var $i_qtymin;
    var $i_unit;
    var $i_ukuran;
    var $i_warna;
    var $i_merk;
    var $i_artikel;
    var $i_cogs;
    var $i_kdsell;
    var $i_sell;
    var $i_status;


   function __construct($i_code,$g_code,$i_supp,$i_barcode,$i_name,$i_qty,$i_qtymin,$i_unit,$i_ukuran,$i_warna,$i_merk,$i_artikel,$i_cogs,$i_kdsell,$i_sell,$i_status){
        $this->i_code=$i_code;
        $this->g_code=$g_code;
        $this->i_supp=$i_supp;
        $this->i_barcode=$i_barcode;

        $this->i_name=$i_name;
        $this->i_qty=$i_qty;
        $this->i_qtymin=$i_qtymin;
        $this->i_unit=$i_unit;
        $this->i_ukuran=$i_ukuran;
        $this->i_warna=$i_warna;
        $this->i_merk=$i_merk;
        $this->i_artikel=$i_artikel;
        $this->i_cogs=$i_cogs;
        $this->i_kdsell=$i_kdsell;
        $this->i_sell=$i_sell;
        $this->i_status=$i_status;
    }



    function set_i_code($args){
        $this->i_code = $args;
     }

    function get_i_code(){
        echo $this->i_code;
     }

    function set_g_code($args){
         $this->g_code = $args;
      }

     function get_g_code(){
         echo $this->g_code;
      }


    function set_i_supp($args){
         $this->i_supp = $args;
      }

     function get_i_supp(){
         echo $this->i_supp;
      }

    function set_i_barcode($args){
         $this->i_barcode = $args;
      }

     function get_i_barcode(){
         echo $this->i_barcode;
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

    function set_i_qtymin($args){
        $this->i_qtymin = $args;
     }

    function get_i_qtymin(){
        echo $this->i_qtymin;
     }

    function set_i_unit($args){
        $this->i_unit = $args;
     }

    function get_i_unit(){
        echo $this->i_unit;
     }

     function set_i_ukuran($args){
        $this->i_ukuran= $args;
     }

    function get_i_ukuran(){
        echo $this->i_ukuran;
     }

     function set_i_warna($args){
        $this->i_warna = $args;
     }

    function get_i_warna(){
        echo $this->i_warna;
     }

    function set_i_merk($args){
        $this->i_merk = $args;
     }

    function get_i_merk(){
        echo $this->i_merk;
     }

    function set_i_artikel($args){
        $this->i_artikel = $args;
     }

    function get_i_artikel(){
        echo $this->i_artikel;
     }

    function set_i_cogs($args){
         $this->i_cogs = $args;
      }

    function get_i_cogs(){
         echo $this->i_cogs;
      }

    function set_i_kdsell($args){
         $this->i_kdsell = $args;
      }

    function get_i_kdsell(){
         echo $this->i_kdsell;
      }

    function set_i_sell($args){
        $this->i_sell = $args;
     }

    function get_i_sell(){
        echo $this->i_sell;
     }


    function set_i_status($args){
           $this->i_status = $args;
        }

    function get_i_status(){
           echo $this->i_status;
        }




    function save_inventory(){

      try
      {
        $pdo = new PDO('mysql:host=localhost;dbname=utama', 'root', 'root');

      }
      catch (PDOException $e)
      {
          echo 'Error: ' . $e->getMessage();
          exit();
      }

      $i_code=$this->i_code;
      $g_code=$this->g_code;
      $i_supp=$this->i_supp;
      $i_barcode=$this->i_barcode;
      $i_name=$this->i_name;
      $i_qty=$this->i_qty;
      $i_qtymin=$this->i_qtymin;
      $i_unit=$this->i_unit;
      $i_ukuran=$this->i_ukuran;
      $i_warna=$this->i_warna;
      $i_merk=$this->i_merk;
      $i_artikel=$this->i_artikel;
      $i_cogs=$this->i_cogs;
      $i_kdsell=$this->i_kdsell;
      $i_sell=$this->i_sell;
      $i_status=$this->i_status;



        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO winventory (i_code,g_code,i_supp,i_barcode,i_name, i_qty,i_qtymin,i_unit,i_size,i_color,i_brands,i_article,i_cogs,i_kdsell,i_sell,i_status)
                VALUES('$i_code','$g_code','$i_supp','$i_barcode','$i_name','$i_qty','$i_qtymin','$i_unit','$i_ukuran','$i_warna','$i_merk','$i_artikel','$i_cogs','$i_kdsell','$i_sell','$i_status')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
     }

     function update_inventory($myitemcode,$deductqty)
     {

      $i_code=$this->i_code;
      try
      {
        $pdo = new PDO('mysql:host=localhost;dbname=utama', 'root', 'root');

      }
      catch (PDOException $e)
      {
          echo 'Error: ' . $e->getMessage();
          exit();
      }

      try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `winventory` WHERE i_code ='$myitemcode'";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $i_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                $row = $stmt->fetchObject();
                $beforeqty=$row->i_qty;
                }
            catch(PDOException $e) {
                echo $e->getMessage();
            }

      $i_code=$this->i_code;
      
      $balanceqty=$beforeqty+$deductqty;

      try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `winventory` SET `i_qty`='$balanceqty' WHERE i_code = '$myitemcode' ";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':i_code', $i_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
     }



     function fetch_inventory($_search)
     {
       try
       {
         $pdo = new PDO('mysql:host=localhost;dbname=utama', 'root', 'root');

       }
       catch (PDOException $e)
       {
           echo 'Error: ' . $e->getMessage();
           exit();
       }

       switch ($_search){
         case 'cid':
            $i_code=$this->i_code;
            $mcode=$i_code.'%';
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM winventory WHERE i_code LIKE :c_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            break;

         case 'cname':
            $i_name=$this->i_name;
            $mname= '%'.$c_fullname.'%';
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM winventory WHERE i_name LIKE :c_name";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':c_name', $mname, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
            break;
         
       }

       echo '<html>
             <head>
             <style>
             html {
               background-color: white;
             }

             .card__image {
               background-position: center center;
               background-repeat: no-repeat;
               background-size: cover;
               border-top-left-radius: 0.25rem;
               border-top-right-radius: 0.25rem;
               filter: contrast(70%);
               //filter: saturate(180%);
               overflow: hidden;
               position: relative;
               transition: filter 0.5s cubic-bezier(.43,.41,.22,.91);;
               &::before {
                 content: "";
                display: block;
                 padding-top: 56.25%; // 16:9 aspect ratio
               }
               @media(min-width: 40rem) {
                 &::before {
                   padding-top: 66.6%; // 3:2 aspect ratio
                 }
               }
             }

             .card__image--customer {
               background-image: url("customer.png");
             }
             .card {
               background-color: white;
               border-radius: 0.25rem;
               box-shadow: 0 30px 60px -14px rgba(0,0,0,0.25);

             }

               .cards {
                 display:flex;
                 flex-wrap: wrap;
                 list-style: none;
                 margin: 0;
                 padding: 0;
               }
               .cards__item {
                 display: flex;
                 padding: 1rem;
                 @media(min-width: 40rem) {
                   width: 50%;
                 }

             .card:hover {
               box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
             }

             img {
               border-radius: 5px 5px 0 0;
             }

             .container {
               padding: 2px 16px;

               .card__title {
                 color: @gray-dark;
                 font-size: 1.25rem;
                 font-weight: 300;
                 letter-spacing: 2px;
                 text-transform: uppercase;
               }

               .card__text {
                 flex: 1 1 auto;
                 font-size: 0.875rem;
                 line-height: 1.5;
                 margin-bottom: 1.25rem;
               }
             </style>
             </head>
             <body>
             <ul class="cards">';
             while ($row = $stmt->fetchObject()) {
               //echo $row->c_code;
               $mycode=$row->i_code;
               $myimg=$row->i_imgfile;


              echo '<li class="cards__item">
                      <div class="card">
                      <div class="card__image"><img src="img/brands/"'.$myimg.' ></div>';
                        echo '<div class="card__title" align="center">';echo $mycode; echo '</div>
                            <div class="card__text" align="center">';echo $row->i_name;

                                                

                                                echo '<br/><br/><a href="printmember.php?c_code='.$mycode.'">Print Member Card</a>';
                                                echo '<br/><a href="membersales.php">Sales</a>';
                                                echo '<br/><a href="printmember.php">Redeem Point</a>';
                                                echo '</div>';

              echo '</div>
                    </li>';


            }
             echo '</ul>
                  </body>
                   </html>';

     }

     function fetch_group()
     {

         try
         {
           $pdo = new PDO('mysql:host=localhost;dbname=utama', 'root', 'root');

         }
         catch (PDOException $e)
         {
             echo 'Error: ' . $e->getMessage();
             exit();
         }
         $group_param=1;

         try
         {
             $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $sql = "SELECT * FROM wgroupsWHERE LIKE :c_addr";
             $stmt = $pdo->prepare($sql);
             $stmt->bindParam(':c_addr', $group_param, PDO::PARAM_STR);
             $stmt->execute();
             $total = $stmt->rowCount();
         } catch(PDOException $e) {
               echo $e->getMessage();
           }
           echo '<select name=gcode>';
           while ($row = $stmt->fetchObject()) {
             //echo $row->c_code;
             $mycode=$row->c_code;
             echo '<option value="'.$row->g_code.'">'. $row->g_name. '</option>';

          }
          echo '</select>';

        }



}
?>
