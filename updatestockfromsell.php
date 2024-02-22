<?php
session_start();
include './class/_parkerinvent.php';

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
                $selectTail="SELECT s_code,i_code,i_qty FROM wselltail";
                $stmtTail = $pdo->prepare($selectTail);
                //$stmt->bindParam(':c_code', $mcode, PDO::PARAM_STR);
                
                $stmtTail->execute();
                $totalTail = $stmtTail->rowCount();
            } catch(PDOException $e) {
                echo $e->getMessage();
            }
        echo '<div>Available data to be update:'.$totalTail.' record(s)</div>';
        $totalInv=0;
        while ($rowTail = $stmtTail->fetchObject()) {
							//echo $row->c_code;
						$gcodeTail=$rowTail->s_code;
						$icodeTail=$rowTail->i_code;
						$qtyTail=$rowTail->i_qty;

						

				    $myinventSales = new Inventory('','','','','','','','','','','','','','','','');
              
            $myinventSales->update_inventory($icodeTail,$qtyTail);
            
            echo '<div>'.$gcodeTail.'&nbsp&nbsp&nbsp'.$icodeTail.'&nbsp&nbsp&nbsp'.$qtyTail.'</div>';
            $totalInv++;
			
				

           		

           			

		}//while*/
		echo $totalInv.'Records Updated';


?>