<?php


if (isset($_GET['s_code']))
{
	$s_code=$_GET['s_code'];
	$news_code=$s_code.'-'.'VOID';
	
	echo '<font face="calibri" color="red">WARNING, THIS PROCESS WILL SET YOUR SALES INVOICE INTO VOID';
	echo '<br/> AND SET YOUR INVENTORY </font>'; 

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
                $sql = "UPDATE `wsellhead` SET `s_code`='$news_code' WHERE `s_code`= :i_code";
                $stmt = $pdo->prepare($sql);
                $stmt->bindParam(':i_code', $s_code, PDO::PARAM_STR);
                $stmt->execute();
               
                echo '<br/><br/>UPDATING Head table...done ';

            } catch(PDOException $e) {
                echo $e->getMessage();
            }


           $s_code=$_GET['s_code'];
                $sql = "SELECT * FROM wselltail WHERE s_code = :c_code";
                $stmt1 = $pdo->prepare($sql);
                $stmt1->bindParam(':c_code', $s_code, PDO::PARAM_STR);
                $stmt1->execute();
                $total = $stmt1->rowCount();

                
                while ($row = $stmt1->fetchObject()) {
                  $i_codesell=$row->i_code;
                  $i_namesell=$row->i_name;
                  $i_qtysell=$row->i_qty;
                }
                echo "<br/><br/>Selecting qty from Sales Detail...done";
                echo '<br/>CODE '.$i_codesell;
                echo '<br/>QTY '.$i_qtysell;
            
        
                $sql2 = "SELECT * FROM winventory WHERE i_code = :i_code";
                $stmt2 = $pdo->prepare($sql2);
                $stmt2->bindParam(':i_code', $i_codesell, PDO::PARAM_STR);
                $stmt2->execute();
				$total2 = $stmt2->rowCount();                
                while ($row = $stmt2->fetchObject()) {
                  $i_code=$row->i_code;
                  $i_name=$row->i_name;
                  $i_qty=$row->i_qty;
                }

                echo "<br/><br/>Select inventory to recover...done";
               	echo '<br/>CODE '.$i_code;
                echo '<br/>QTY '.$i_qty;

           

            $recoverqty=$i_qty+$i_qtysell;

           
                $sql3 = "UPDATE `winventory` SET `i_qty`='$recoverqty' WHERE `i_code`= :i_code";
                $stmt3 = $pdo->prepare($sql3);
                $stmt3->bindParam(':i_code', $i_codesell, PDO::PARAM_STR);
                $stmt3->execute();
                
                echo '<br/><br/>Recover inventory quantity...done';
                echo '<br/>Recover QTY: '.$recoverqty;
                echo '</font>';

                echo '<br/><br/><br/><br/><a href="searchengine1.php">Back to Home<a>';


}

?>