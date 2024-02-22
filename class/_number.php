<?php

//include ("./class/_parkerconnection.php");

function querytable($mytablename,$mygroup)
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

  switch ($mytablename){
    case 'wcustomers':
          $_custquery="SELECT COUNT(c_code) FROM '$mytablename'";
          break;

    case 'winventory':
          $_custquery="SELECT COUNT(i_code) as mycount FROM `$mytablename` WHERE g_code='$mygroup' ";
          break;

  }
    
    $res=$pdo->prepare($_custquery);
    $res->execute();

    if(!$res) {
             die("Database query failed: " . mysqli_error());
             }

    $row=$res->fetchColumn();

    $count=$row;
   
    return $count;
}





function setnumber_invent($tablename,$group)
{
    $rownumber= querytable($tablename,$group);

    //echo $_countnumber;
  //  echo $_countnumber.'<br/>';
    //switch ($_countnumber){
        
       
       /*case 1:
            $_suffix=strval($rownumber+1);
            
            break;
        case 2:
            $_suffix=strval($rownumber+1);
            break;
        case 3:
            $_suffix=strval($rownumber+1);
            break;
        case 4:
            $_suffix=strval($rownumber+1);
            break;
        default:
            //echo 'default';
    }//*/
   
    
    //$_mynumber=$_suffix;
    return $rownumber;
}
?>
