<?

include ("_parkerconnection.php");





function querytable($mytablename)
{

    $_custquery="SELECT COUNT(c_code) FROM $mytablename";
    $res=$pdo->prepare($_custquery);
    $res->execute();
    if(!$res) {
             die("Database query failed: " . mysql_error());
             }

    $row=$res->fetch();
    $count = $res->rowcount();
    echo $count;
    return $count;
}


function setnumber($tablename)
{
    $rownumber= querytable($tablename);
    $_countnumber=strlen(strval($rownumber));
  //  echo $_countnumber.'<br/>';
    switch ($_countnumber){

        case 1:
            //$_suffix='0000'.$_countnumber+1;
            $mynumber=1;
            break;
        case 2:
            //$_suffix='000'.$_countnumber+1;
            break;
        case 3:
            //$_suffix='00'.$_countnumber+1;
            break;
        case 4:
            //$_suffix='0'.$_countnumber+1;
            break;
        case 5:
            //$_suffix=$_countnumber+1;
            break;
        default:
            //echo 'default';
    }
    //$_prefixdate=date('Ymd');
    //$_mynumber=$_prefixdate.'.'.$_suffix;
    return $_mynumber;
}

//$number= _setnumber("wcustomers"
?>

<html>
<body>
    <? echo $mynumber; ?>
</body>
</html>
