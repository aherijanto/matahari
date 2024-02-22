<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    session_start();
    $upone = dirname(__DIR__);

    $iname = $_POST['iname'];
    $db='mimj5729_matahari';$user='mimj5729_myroot';$pwd='myroot@@##';
    try 
    {
	    $pdo = new PDO('mysql:host=localhost;dbname='.$db, $user, $pwd);
    }
        catch (PDOException $e) 
    {
        echo 'Error: ' . $e->getMessage();
        exit();
    }

    try {
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $selectpcsGlob = "SELECT * FROM winventory WHERE i_name LIKE '%$iname%'";
        $stmtpcsGlob = $pdo->prepare($selectpcsGlob);
        $stmtpcsGlob->execute();
        $totalpcsGlob = $stmtpcsGlob->rowCount();
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
    $grandtotal1 = 0;
    if($totalpcsGlob==0){
        echo 'NotFound';
    }else{
        $nourut=0;
        $mytable='<table width="100%" style="font-size:14px;">
                    <thead>
                        <th>NO</th>
                        <th>BARCODE</th>
                        <th>EDIT</th>
                        <th>PLU NAME</th>
                        <th align="center">QTY</th>
                        <th style="text-align:right;">COGS</th>
                        <th style="text-align:right;">SELL 1</th>
                        <th style="text-align:right;">SELL 2</th>
                        <th style="text-align:right;">SELL 3</th>
                        <th style="text-align:right;">SELL 4</th>
                        <th style="text-align:right;">SELL 5</th>
                        <th style="text-align:right;">SELL 6</th>
                        <th style="text-align:right;">SELL 7</th>
                        <th style="text-align:right;">SELL 8</th>
                        <th style="text-align:right;">SELL 9</th>
                        <th style="text-align:right;">SELL 10</th>
                    </thead>';
        
    while ($rowpcsGlob = $stmtpcsGlob->fetchObject()) {
        //echo $row->c_code;
        $nourut++;
        $barcode = $rowpcsGlob->i_barcode;
        $iname = $rowpcsGlob->i_name;
        $iqty = $rowpcsGlob->i_qty;
        $icogs = $rowpcsGlob->i_cogs;
        $isell1 = $rowpcsGlob->i_sell;
        $isell2 = $rowpcsGlob->i_sell2;
        $isell3 = $rowpcsGlob->i_sell3;
        $isell4 = $rowpcsGlob->i_sell4;
        $isell5 = $rowpcsGlob->i_sell5;
        $isell6 = $rowpcsGlob->i_sell6;
        $isell7 = $rowpcsGlob->i_sell7;
        $isell8 = $rowpcsGlob->i_sell8;
        $isell9 = $rowpcsGlob->i_sell9;
        $isell10 = $rowpcsGlob->i_sell10;
        $mytable.= '<tr style="color:#023047;">';
        $mytable.= '<td>'.$nourut.'</td><td style="width:2%">'.$barcode.'</td><td><input type="text" name="barcode" id="'.$barcode.'" style="width:80px;" value="'.$barcode.'"></td><td>' . $iname . '</td><td align="center"><input type="text" style="width:50px;text-align:right;" name="iqty[]" id="iqty" value="'.$iqty.'"></td><td align="right"><input type="text" style="width:60px;text-align:right;" name="icogs[]" id="icogs" value="'.$icogs.'"></td>
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell1[]" id="isell1" value="'.$isell1.'">
        </td>
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell2[]" id="isell2" value="'.$isell2.'">
        </td>
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell3[]" id="isell3" value="'.$isell3.'">
        </td>
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell4[]" id="isell4" value="'.$isell4.'">
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell5[]" id="isell5" value="'.$isell5.'">
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell6[]" id="isell6" value="'.$isell6.'">
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell7[]" id="isell7" value="'.$isell7.'">
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell8[]" id="isell8" value="'.$isell8.'">
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell9[]" id="isell9" value="'.$isell9.'">
        <td align="right"><input type="text" style="width:60px;text-align:right;" name="isell10[]" id="isell10" value="'.$isell10.'">
        </td>';
        $mytable.= '</tr>';       
       
    } //while*/
    $mytable.= '</table>';
    echo $mytable;
}
//$_SESSION['reports'] = '0';
?>
