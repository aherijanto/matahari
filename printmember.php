<?php
error_reporting(E_ALL);
ini_set("display_errors","On");

session_start();

if (isset($_SESSION['user'])!="" ){

function fetch_customer($_search)
{
  try
  {
    $pdo = new PDO('mysql:host=localhost;dbname=waletmas', 'root', 'root');

  }
  catch (PDOException $e)
  {
      echo 'Error: ' . $e->getMessage();
      exit();
  }

       try {
           $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
           $sql = "SELECT * FROM wcustomers WHERE c_code = :c_code";
           $stmt = $pdo->prepare($sql);
           $stmt->bindParam(':c_code', $_search, PDO::PARAM_STR);
           $stmt->execute();
           $total = $stmt->rowCount();
           /*while ($row = $stmt->fetchObject()) {
             echo $row->c_code;
           }*/
       } catch(PDOException $e) {
           echo $e->getMessage();
       }

       while ($row = $stmt->fetchObject()) {
         //echo $row->c_code;
         $mycode1=$row->c_code;
         $c_name=$row->c_name;
         $c_addr=$row->c_addr;
         $c_join=$row->c_join;
         $datestr=date('d-m-Y',strtotime($c_join));

       }

       echo '<html<body><style>
       .table { background: url(/img/forms/logocardfront51.jpg) no-repeat; }
                              .table1 { background: url(/img/forms/logocardback1.jpg) no-repeat; }
                              @font-face {
                                  font-family: code39;
                                  src: url(barcode/Code39Azalea.ttf);
                              }</style>';

          echo '<table class="table" style="width:327px;height:200px;">
          <tr>
            <td align="right" style="padding-right:10px;"><br/><br/><br/><font color="white">';
            echo substr($mycode1,-5).'<br/>';
            echo $c_name.'<br/>';
            $mybarcodeprint='*'.$mycode1.'*';
            echo $datestr; echo '</font>';
            echo '<div><br/><font face="code39" color="black" size="6em">';echo $mybarcodeprint;echo '</font></div>';

            echo '</font></td>
          </tr>


          </table>
          <table class="table1" style="width:327px;height:200px;" >
          <tr>

          </tr>


          </table>

      </body></html>';



}



if (isset($_GET['c_code']))
{
  $mycode=$_GET['c_code'];
  fetch_customer($mycode);

}

}else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
?>
