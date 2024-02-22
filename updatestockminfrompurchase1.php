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
                $selectInvent="SELECT i_barcode,i_code,i_qty FROM winventory WHERE (i_qty < 0)";
                $stmtInvent = $pdo->prepare($selectInvent);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtInvent->execute();
                $totalInvent = $stmtInvent->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }

        $total

        while ($rowInvent = $stmtInvent->fetchObject()) {
							//echo $row->c_code;
						$gcodeInvent=$rowInvent->i_barcode;
						$icodeInvent=$rowInvent->i_code;
						$qtyInvent=$rowInvent->i_qty;

						echo $gcodeInvent.' - '.$icodeInvent.' - '.$qtyInvent.'<br/>';

				
			
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