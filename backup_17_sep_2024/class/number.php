<?php
//session_start();
//include ("class/_parkerconnection.inc");

function querytable($mytablename)
{
  include ('class/_parkerconnection.php');
    $_custquery = "SELECT COUNT(c_code) as mycount FROM `$mytablename`";
    $res = $pdo->prepare($_custquery);
    $res->execute();
    if(!$res) {
             //die("Database query failed: " . mysql_error());
             }
    $row=$res->fetchColumn();

    $count=$row;
    /*echo 'query:'.$_custquery.'<br/>';
    echo 'tablename: '.$mytablename.'<br/>';
    echo 'count: '.$row.'<br/>';*/

    return $count;
}


function setnumber($tablename)
{
    $rownumber= querytable($tablename);
    //echo 'rownumber: '.$rownumber.'<br/>';

    $_countnumber=strlen(strval($rownumber));



    switch ($_countnumber){
        case 0:
            $_suffix='0000'.strval($rownumber+1);
            break;
        case 1:
            $_suffix='0000'.strval($rownumber+1);
            break;
        case 2:
            $_suffix='000'.strval($rownumber+1);
            break;
        case 3:
            $_suffix='00'.strval($rownumber+1);
            break;
        case 4:
            $_suffix='0'.strval($rownumber+1);
            break;
        case 5:
            $_suffix=strval($rownumber+1);
            break;

            //echo 'default';
    }
    $_prefixdate=date('ymd');
    $mynumber=$_prefixdate.$_suffix;
    return $mynumber;
}
