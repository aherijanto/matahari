<?php
error_reporting(E_ALL);
ini_set("display_errors","On");
//include 'class/_parkerconnection.php';


class Supplier{

    var $s_code;
    var $s_name;
    var $s_contact;
    var $s_addr;
    var $s_phone;


   function __construct($s_code,$s_name,$s_contact,$s_addr,$s_phone){
        $this->s_code=$s_code;
        $this->s_name=$s_name;
        $this->s_contact=$s_contact;
        $this->s_addr=$s_addr;
        $this->s_phone=$s_phone;
    }



    function set_s_code($args){
        $this->s_code = $args;
     }

    function get_s_code(){
        echo $this->s_code;
     }

    function set_s_name($args){
        $this->s_name = $args;
     }

    function get_s_name(){
        echo $this->s_name;
     }

    function set_s_contact($args){
        $this->s_contact = $args;
     }

    function get_s_contact(){
        echo $this->s_contact;
     }

    function set_s_addr($args){
         $this->s_addr = $args;
      }

    function get_s_addr(){
         echo $this->s_addr;
      }

    function set_s_phone($args){
           $this->s_phone = $args;
        }

    function get_s_phone(){
           echo $this->s_phone;
        }



    function save_supplier(){

      include ('class/_parkerconnection.php');

      $s_code=$this->s_code;
      $s_name=$this->s_name;
      $s_contact=$this->s_contact;
      $s_addr=$this->s_addr;
      $s_phone=$this->s_phone;



        try {
            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = "INSERT INTO wsuppliers (s_code, s_name, s_contact,s_addr,s_phone)
                VALUES('$s_code','$s_name','$s_contact','$s_addr','$s_phone')";
                //echo '<br/>'.$stmt;
                $pdo->exec($stmt);
        } catch(PDOException $e) {
            echo $e->getMessage();
        }
     }

     function fetch_supplier($_search)
     {
      include ('class/_parkerconnection.php');

       switch ($_search){
         case 'cid':
            $c_code=$this->c_code;
            $mcode=$c_code.'%';
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wcustomers WHERE c_code LIKE :c_code";
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
            $c_fullname=$this->c_fullname;
            $mname= '%'.$c_fullname.'%';
            try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM wcustomers WHERE c_name LIKE :c_name";
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
         case 'caddr':
             $c_addr=$this->c_addr;
             $maddr='%'.$c_addr.'%';
             try {
                 $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                 $sql = "SELECT * FROM wcustomers WHERE c_addr LIKE :c_addr";
                 $stmt = $pdo->prepare($sql);
                 $stmt->bindParam(':c_addr', $maddr, PDO::PARAM_STR);
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
               $mycode=$row->c_code;


              echo '<li class="cards__item">
                      <div class="card">
                      <div class="card__image"><img src="img/container/customer.png" ></div>
                        <div class="card__title" align="center">';echo $mycode; echo '</div>
                            <div class="card__text" align="center">';echo $row->c_name;

                                                echo '<br/>';echo $row->c_addr;

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



}
?>
