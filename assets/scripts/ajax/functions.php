<?php
$db = 'mimj5729_matahari';
$user = 'mimj5729_myroot';
$pwd = 'myroot@@##';

try 
{
	$pdo = new PDO('mysql:host=localhost;dbname='.$db, $user, $pwd);
    
}
catch (PDOException $e) 
{
    echo 'Error: ' . $e->getMessage();
    exit();
}

function update_inventory($myitemcode,$deductqty)
     {
      $i_code=$this->i_code;
      try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `winventory` WHERE i_barcode ='$myitemcode'";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $i_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                $row = $stmt->fetchObject();
                $beforeqty=$row->i_qty;
                }
            catch(PDOException $e) {
                echo $e->getMessage();
            }

      $i_code=$this->i_code;
      
      $balanceqty=$beforeqty-$deductqty;

      try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `winventory` SET `i_qty`='$balanceqty' WHERE i_barcode = '$myitemcode' ";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':i_code', $i_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
     }

     function update_inventory_purchase($myitemcode,$deductqty)
     {
     
      try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "SELECT * FROM `winventory` WHERE i_code ='$myitemcode'";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':c_code', $i_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                $row = $stmt->fetchObject();
                $beforeqty=$row->i_qty;
                }
            catch(PDOException $e) {
                echo $e->getMessage();
            } 
      $balanceqty=$beforeqty+$deductqty;

      try {
                $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $sql = "UPDATE `winventory` SET `i_qty`='$balanceqty' WHERE i_code = '$myitemcode' ";
                $stmt = $pdo->prepare($sql);
                //$stmt->bindParam(':i_code', $i_code, PDO::PARAM_STR);
                $stmt->execute();
                $total = $stmt->rowCount();
                /*while ($row = $stmt->fetchObject()) {
                  echo $row->c_code;
                }*/
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
     }
?>