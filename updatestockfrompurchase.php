<?php
session_start();


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
                $selectTail="SELECT g_code,i_code,i_qty FROM wbuytail";
                $stmtTail = $pdo->prepare($selectTail);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtTail->execute();
                $totalTail = $stmtTail->rowCount();
                echo $selectTail;
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        while ($rowTail = $stmtTail->fetchObject()) {
							//echo $row->c_code;
						$gcodeTail=$rowTail->g_code;
						$icodeTail=$rowTail->i_code;
						$qtyTail=$rowTail->i_qty;

						echo $gcodeTail.' - '.$icodeTail.' - '.$qtyTail.'<br/>';

				
			
				try {
                	$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                	$updateInv="UPDATE `winventory` SET i_qty=$qtyTail WHERE ((i_code='$gcodeTail') AND (i_barcode='$icodeTail'))";
                	$stmtInv = $pdo->prepare($updateInv);

                	//$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                	$stmtInv->execute();
                	$totalInv = $stmtInv->rowCount();
            	} catch(PDOException $e) {
                	echo $e->getMessage();
           		}

           		

           			

		}//while*/
		echo $totalInv.'Records Updated';


?>