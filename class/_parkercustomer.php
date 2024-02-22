<?php
error_reporting(E_ALL);
ini_set("display_errors", "On");

//session_start();
//include 'class/_parkerbalancepoint.php';

class Customer
{

  var $c_code;
  var $c_id;
  var $c_fullname;
  var $c_gender;
  var $c_pob;
  var $c_dob;
  var $c_addr;
  var $c_rt;
  var $c_kel;
  var $c_kec;
  var $c_phone;
  var $c_join;

  function __construct($c_code, $c_id, $c_fullname, $c_pob, $c_dob, $c_addr, $c_rt, $c_kel, $c_kec, $c_gender, $c_phone, $c_join)
  {
    $this->c_code = $c_code;
    $this->c_id = $c_id;
    $this->c_fullname = $c_fullname;
    $this->c_gender = $c_gender;
    $this->c_pob = $c_pob;
    $this->c_dob = $c_dob;
    $this->c_addr = $c_addr;
    $this->c_rt = $c_rt;
    $this->c_kel = $c_kel;
    $this->c_kec = $c_kec;
    $this->c_phone = $c_phone;
    $this->c_join = $c_join;
  }



  function set_c_code($args)
  {
    $this->c_code = $args;
  }

  function get_c_code()
  {
    echo $this->c_code;
  }

  function set_c_id($args)
  {
    $this->c_id = $args;
  }

  function get_c_id()
  {
    echo $this->c_id;
  }

  function set_c_fullname($args)
  {
    $this->c_fullname = $args;
  }

  function get_c_fullname()
  {
    echo $this->c_fullname;
  }

  function set_c_pob($args)
  {
    $this->c_pob = $args;
  }

  function get_c_pob()
  {
    echo $this->c_pob;
  }

  function set_c_dob($args)
  {
    $this->c_dob = $args;
  }

  function get_c_dob()
  {
    echo $this->c_dob;
  }



  function set_c_gender($args)
  {
    $this->c_gender = $args;
  }

  function get_c_gender()
  {
    echo $this->c_gender;
  }


  function set_c_addr($args)
  {
    $this->c_addr = $args;
  }

  function get_c_addr()
  {
    echo $this->c_addr;
  }


  function set_c_rt($args)
  {
    $this->c_rt = $args;
  }

  function get_c_rt()
  {
    echo $this->c_rt;
  }


  function set_c_kel($args)
  {
    $this->c_kel = $args;
  }

  function get_c_kel()
  {
    echo $this->c_kel;
  }

  function set_c_kec($args)
  {
    $this->c_kec = $args;
  }

  function get_c_kec()
  {
    echo $this->c_kec;
  }

  function set_c_phone($args)
  {
    $this->c_phone = $args;
  }

  function get_c_phone()
  {
    echo $this->c_phone;
  }

  function set_c_join($args)
  {
    $this->c_join = $args;
  }

  function get_c_join()
  {
    echo $this->c_join;
  }

  function save_customer()
  {

    include('class/_parkerconnection.php');

    $c_code = $this->c_code;
    $c_id = $this->c_id;
    $c_fullname = $this->c_fullname;
    $c_pob = $this->c_pob;
    $c_dob = $this->c_dob;
    $c_addr = $this->c_addr;
    $c_rt = $this->c_rt;
    $c_kel = $this->c_kel;
    $c_kec = $this->c_kec;
    $c_gender = $this->c_gender;
    $c_phone = $this->c_phone;
    $c_join = $this->c_join;


    try {
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $stmt = "INSERT INTO wcustomers (c_code, c_id, c_name,c_pob,c_dob,c_addr,c_rt,c_kel,c_kec,c_gender,c_phone,c_join)
                VALUES('$c_code','$c_id','$c_fullname','$c_pob','$c_dob','$c_addr','$c_rt','$c_kel','$c_kec','$c_gender','$c_phone','$c_join')";

      $pdo->exec($stmt);
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }

  function calculate_balance_point($c_code)
  {
    include('class/_parkerconnection.php');

    /* SELECT SUM FROM ADDPOINT PER CUSTOMER*/


    $mcode = $c_code;
    try {
      $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $sql = "SELECT SUM(p_qty) as avpoint FROM waddpoint WHERE c_code =:c_code";
      $stmt = $pdo->prepare($sql);
      $stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
      $stmt->execute();
      $total = $stmt->rowCount();
      /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
    } catch (PDOException $e) {
      echo $e->getMessage();
    }

    $myavpoint = $row->avpoint;
    return $myavpoint;
  }



  function fetch_customer($_search)

  {

    include('class/_parkerconnection.php');

    switch ($_search) {
      case 'cid':
        $c_code = $this->c_code;
        $mcode = $c_code . '%';
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
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
        break;

      case 'cname':
        $c_fullname = $this->c_fullname;
        $mname = '%' . $c_fullname . '%';
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
        } catch (PDOException $e) {
          echo $e->getMessage();
        }
        break;
      case 'caddr':
        $c_addr = $this->c_addr;
        $maddr = '%' . $c_addr . '%';
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
        } catch (PDOException $e) {
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
      $mycode = $row->c_code;

      //$myavpoint=countAddPoint($mycode)-countRedPoint($mycode);
      //
      echo '<li class="cards__item">
                      <div class="card">
                      <div class="card__image"><img src="images/icons/customer.png" width="210px" height="100px" "alt="Not Available" ></div>
                        <div class="card__title" align="center">';
      echo $mycode;
      echo '</div>
                            <div class="card__text" align="center">';
      echo $row->c_name;
      echo '</div>
                            <div class="card__text" align="center">';
      echo '<br/>';
      echo $row->c_addr;

      echo '<br/><a href="salesdirect.php?c_code=' . $mycode . '&status=Cash&tag=new">Sales Cash</a>';
      echo '<br/><a href="salesdirect.php?c_code=' . $mycode . '&status=A/R&tag=new">Sales A/R</a>';
      echo '<br/><a href="salesdirect.php?c_code=' . $mycode . '&status=A/R&tag=edit">Edit Sales</a>';
      echo '<br/><a href="delcust.php?c_code=' . $mycode . '" class="btn btn-danger">Delete</a>';
      echo '<br/><a href="editprofile.php?c_code=' . $mycode . '" class="btn btn-success" style="margin-top;10px;">Edit Profile</a>';
      

      echo '</div>';

      echo '</div>
                    </li>';
    }
    echo '</ul>
                  </body>
                   </html>';
  }
}
