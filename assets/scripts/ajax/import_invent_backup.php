<?php
    error_reporting(E_ALL);
    ini_set('display_errors', TRUE);
    ini_set('display_startup_errors', TRUE);
    date_default_timezone_set('Asia/Jakarta');
    require_once '../../../vendor/autoload.php';
    require_once('../../../assets/requires/config.php');
    require_once('../../../assets/requires/header1.php');
    require_once('../../../PhpSpreadsheet/Spreadsheet.php');
    require_once('../../../PhpSpreadsheet/Reader/Xlsx.php');
    use phpoffice\phpspreadsheet\src\PhpSpreadSheet\Worksheet;
    use phpoffice\phpspreadsheet\src\PhpSpreadSheet\Reader;
    use phpoffice\phpspreadsheet\src\PhpSpreadSheet\Reader\Xlsx;
    //require_once '../../../vendor/phpoffice/phpspreadsheet/src/PhpSpreadSheet/Reader/Xlsx.php';


    if(isset($_FILES['file']['name'])){
        /* Getting file name */
        $filename = $_FILES['file']['tmp_name'];
    }

    $results = [];
    $reader = new Xlsx(); //   PhpOffice\PhpSpreadsheet\Reader\Xlsx
    $reader->setReadDataOnly(true);
    $spreadsheet = $reader->load($filename);
    $sheet = $spreadsheet->getActiveSheet();
    $maxrow = $spreadsheet->getActiveSheet()->getHighestRow();
    $maxcol = $spreadsheet->getActiveSheet()->getHighestColumn();
    
    if (!isset($_SESSION['cart_item'])) {
        $_SESSION['cart_item'] = array();
    }

    //echo MYROOT;
	
    $ColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($maxcol);
    for ($row = 2; $row <= $maxrow; ++ $row) {
        $val = array();
        $col = 1;
        for ($col = 1; $col < $ColumnIndex; ++ $col) {
            $cell = $sheet->getCellByColumnAndRow($col, $row);
            if($cell->getValue()==''){
                $value=0;
            }else{
                $value=$cell->getValue();
            }
            switch($col){
                case 1:
                    $i_code = $value;
                    break;
                case 2:
                    $g_code = $value;
                    break;
                case 3:
                    $i_supp = $value;
                    break;
                case 4:
                    $i_barcode = $value;
                    break;
                case 5:
                    $i_name = $value;
                    break;
                case 6:
                    $i_qty = $value;
                    break;
                case 7:
                    $i_vol = $value;
                    break;
                case 8:
                    $i_volunit = $value;
                    break;
                case 9:
                    $i_qtymin = $value;
                    break;
                case 10:
                    $i_unit= $value;
                    break;
                case 11:
                    $i_size = $value;
                    break;
                case 12:
                    $i_color = $value;
                    break;
                case 13:
                    $i_brands = $value;
                    break;
                case 14:
                    $i_article = $value;
                    break;
                case 15:
                    $i_cogs = $value;
                    break;
                case 16:
                    $i_kdsell = $value;
                    break;
                case 17:
                    $i_sell = $value;
                    break;
                case 18:
                    $i_sell2 = $value;
                    break;
                case 19:
                    $i_sell3 = $value;
                    break;
                case 20:
                    $i_sell4 = $value;
                    break;
                case 21:
                    $i_sell5 = $value;
                    break;
                case 22:
                    $i_sell6 = $value;
                    break;
                case 23:
                    $i_sell7 = $value;
                    break;
                case 24:
                    $i_sell8 = $value;
                    break;

                case 25:
                    $i_sell9 = $value;
                    break;
                case 26:
                    $i_sell10 = $value;
                    break;
                case 27:
                    $i_status = $value;
                    break;
                case 28:
                    $ware_id = $value;
                    break;
            }
            
            // $val[] = $cell->getValue();
            //array_push($_SESSION['cart_item'],$itemArray);
        }
        $itemArray = array('i_code'=>$i_code,
                            'g_code'=>$g_code,
                            'i_supp'=>$i_supp,
                            'i_barcode'=>$i_barcode,
                            'i_name'=>$i_name,
                            'i_qty'=>$i_qty,
                            'i_vol'=>$i_vol,
                            'i_volunit'=>$i_volunit,
                            'i_qtymin'=>$i_qtymin,
                            'i_unit'=>$i_unit,
                            'i_size'=>$i_size,
                            'i_color'=>$i_color,
                            'i_brands'=>$i_brands,
                            'i_article'=>$i_article,
                            'i_cogs'=>$i_cogs,
                            'i_kdsell'=>$i_kdsell,
                            'i_sell'=>$i_sell,
                            'i_sell2'=>$i_sell2,
                            'i_sell3'=>$i_sell3,
                            'i_sell4'=>$i_sell4,
                            'i_sell5'=>$i_sell5,
                            'i_sell6'=>$i_sell6,
                            'i_sell7'=>$i_sell7,
                            'i_sell8'=>$i_sell8,
                            'i_sell9'=>$i_sell9,
                            'i_sell10'=>$i_sell10,
                            'i_status'=>$i_status,
                            'ware_id'=>$ware_id);
        array_push($_SESSION['cart_item'],$itemArray);
    }
        
    $conn2 = mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
    $countupdate=0;
    $countinsert=0;
    foreach($_SESSION['cart_item'] as $item){
        
            $icode_ = $item['i_code'];
            $gcode_ = $item['g_code'];
            $isupp_ = $item['i_supp'];
            $ibarcode_ = $item['i_barcode'];
            $iname_ = $item['i_name'];
            $iqty_ = $item['i_qty'];
            $ivol_ = $item['i_vol'];
            $ivolunit_ = $item['i_volunit'];
            $iqtymin_ = $item['i_qtymin'];
            $iunit_ = $item['i_unit'];
            $isize_ = $item['i_size'];
            $icolor_ = $item['i_color'];
            $ibrands_ = $item['i_brands'];
            $iarticle_ = $item['i_article'];
            $icogs_ = $item['i_cogs'];
            $ikdsell_ = $item['i_kdsell'];
            $isell_ = $item['i_sell'];
            $isell2_ = $item['i_sell2'];
            $isell3_ = $item['i_sell3'];
            $isell4_ = $item['i_sell4'];
            $isell5_ = $item['i_sell5'];
            $isell6_ = $item['i_sell6'];
            $isell7_ = $item['i_sell7'];
            $isell8_ = $item['i_sell8'];
            $isell9_ = $item['i_sell9'];
            $isell10_ = $item['i_sell10'];
            $istatus_ = $item['i_status'];
            $wareid_ = $item['ware_id'];

            $searchquery = "SELECT * FROM winventory WHERE i_code LIKE '$icode_'";
            $resultSearch = mysqli_query($conn2,$searchquery);
            if($resultSearch){
                $totalrows = mysqli_num_rows($resultSearch);
               
                if($totalrows == 1){
                    //echo 'update : '.$gcode_.' '.$isupp_.' '.$iname_.'<br/>';
                    $update_query_ = "UPDATE winventory
                                        SET `g_code`    = '$gcode_',
                                            `i_supp`    = '$isupp_',
                                            `i_barcode` = '$ibarcode_',
                                            `i_name`    = '$iname_',
                                            `i_qty`     = '$iqty_',
                                            `i_vol`     = '$ivol_',
                                            `i_volunit` = '$ivolunit_',
                                            `i_qtymin`  = '$iqtymin_',
                                            `i_unit`    = '$iunit_',
                                            `i_size`    = '$isize_',
                                            `i_color`   = '$icolor_',
                                            `i_brands`  = '$ibrands_',
                                            `i_article` = '$iarticle_',
                                            `i_cogs`    = '$icogs_',
                                            `i_kdsell`  = '$ikdsell_',
                                            `i_sell`    = '$isell_',
                                            `i_sell2`   = '$isell2_',
                                            `i_sell3`   = '$isell3_',
                                            `i_sell4`   = '$isell4_',
                                            `i_sell5`   = '$isell5_',
                                            `i_sell6`   = '$isell6_',
                                            `i_sell7`   = '$isell7_',
                                            `i_sell8`   = '$isell8_',
                                            `i_sell10`  = '$isell10_',
                                            `i_status`  = '$istatus_',
                                            `ware_id`   = '$wareid_'
                                        WHERE `i_code` LIKE '$icode_'";

                    $resultUpdate = mysqli_query($conn2,$update_query_);
                    
                    if($resultUpdate){
                        $countupdate++;
                    }
                }

                if($totalrows == 0){
                    $insert_query_ = "INSERT INTO winventory (
                                            `i_code`,
                                            `g_code`,
                                            `i_supp`,
                                            `i_barcode`,
                                            `i_name`,
                                            `i_qty`,
                                            `i_vol`,
                                            `i_volunit`,
                                            `i_qtymin`,
                                            `i_unit`,
                                            `i_size`,
                                            `i_color`,
                                            `i_brands`,
                                            `i_article`,
                                            `i_cogs`,
                                            `i_kdsell`,
                                            `i_sell`,
                                            `i_sell2`,
                                            `i_sell3`,
                                            `i_sell4`,
                                            `i_sell5`,
                                            `i_sell6`,
                                            `i_sell7`,
                                            `i_sell8`,
                                            `i_sell9`,
                                            `i_sell10`,
                                            `i_status`,
                                            `ware_id`)

                                        VALUES (
                                            '$icode_',
                                            '$gcode_',
                                            '$isupp_',
                                            '$ibarcode_',
                                            '$iname_',
                                            '$iqty_',
                                            '$ivol_',
                                            '$ivolunit_',
                                            '$iqtymin_',
                                            '$iunit_',
                                            '$isize_',
                                            '$icolor_',
                                            '$ibrands_',
                                            '$iarticle_',
                                            '$icogs_',
                                            '$ikdsell_',
                                            '$isell_',
                                            '$isell2_',
                                            '$isell3_',
                                            '$isell4_',
                                            '$isell5_',
                                            '$isell6_',
                                            '$isell7_',
                                            '$isell8_',
                                            '$isell9_',
                                            '$isell10_',
                                            '$istatus_',
                                            '$wareid_')";
                    $resultInsert = mysqli_query($conn2,$insert_query_);
                    if($resultInsert){
                        $countinsert++;
                    }
                }
            }        
    }
    echo 'Total Insert : '.$countinsert.'   Total Update : '.$countupdate ;
?>