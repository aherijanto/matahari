<?php
if(isset($_POST['delsubmit'])){
        $delnote = $_POST['deleteno'];
            include 'class/_parkerconnection.php';
            
            try {
                   $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sqlcomplaint = "DELETE  FROM wsellhead WHERE s_code='$delnote'";
                  $stmt = $pdo->prepare($sqlcomplaint);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                  $stmt->execute();
                  
                } catch(PDOException $e) {
                  echo $e->getMessage();
              }
            
            try {
                  $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                  $sqldeltail = "DELETE  FROM wselltail WHERE s_code='$delnote'";
                  $stmt = $pdo->prepare($sqldeltail);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                  $stmt->execute();
                  
                } catch(PDOException $e) {
                  echo $e->getMessage();
              }
    }

    if(isset($_POST['back'])){
      header('Location:searchengine1.php');
    }
?>