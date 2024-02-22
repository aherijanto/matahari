<?php

    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors","On");

    // if(isset($_POST['submit'])){
            $date1=$_GET['mydate1'];
            $date2=$_GET['mydate2'];
         
            $DB_Server = "localhost";   
            $DB_Username = "mimj5729_myroot";   
            $DB_Password = "myroot@@##";               
            $DB_DBName = "mimj5729_matahari";          
            $DB_TBLName = "winventory";  
            $filename = "pajak";         

            //create MySQL connection   
            $sql = "SELECT wsellhead.s_code,wsellhead.s_date,wcustomers.c_code,wcustomers.c_id,wcustomers.c_name,wcustomers.c_addr,wselltail.* FROM wselltail,wsellhead,wcustomers where wsellhead.s_date BETWEEN '$date1' AND '$date2' AND wsellhead.c_code = wcustomers.c_code and wsellhead.s_code = wselltail.s_code";

            $Connect = mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysqli_error($Connect) . "<br>" . mysqli_errno($Connect));

            //select database   
            $Db = mysqli_select_db($Connect, $DB_DBName) or die("Couldn't select database:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));   

            //execute query 
            $result = mysqli_query($Connect,$sql) or die("Couldn't execute query:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));    

            $file_ending = "xls";

            $columns=array('no_faktur','tgl_faktur','npwp','nama','NIK','alamat','jumlah_dpp','jumlah_ppn','jumlah_ppnbm','ide_keterangan_tambahan','fg_uang_muka','uang_muka_dpp','uang_muka_ppn','uang_muka_ppnbm','referensi','kode_objek','nama_product','harga_satuan','jumlah_barang','harga_total','diskon','dpp','ppn','tarif_ppnbm','ppnbm','dok_pendukung');
            $sep = "\t"; //tabbed character

            //start of printing column names as names of MySQL fields
            $fieldinfo = mysqli_fetch_fields($result);
            
            //end of printing column names  
            $merge=[];
            unset($_SESSION['data']);
            $_SESSION['data'] = '';

        //start while loop to get data
            while($row = mysqli_fetch_array($result))
            {
                $subtotal = $row['i_qty'] * ($row['i_sell']-$row['i_disc3']);
                
                $subtotaltax = $subtotal * 1.11; // tax 11%
                $dpp = $subtotal / 1.11;
                $ppn = $dpp * 0.11;
                $itemdata = array(array('no'=>$row['s_code'],'invdate'=>$row['s_date'],'npwp'=>'0000000',
                    'name'=>$row['c_name'],'nik'=>$row['c_id'],'addr'=>$row['c_addr'],'jumdpp'=>$dpp,
                    'jumppn'=>$ppn,'jumppnbm'=>'0','ide'=>'','fguangmuka'=>'0',
                    'uangmukadpp'=>'0','uangmukappn'=>'0','uangmukappnbm'=>'0','referensi'=>'',
                    'kodeobjek'=>'A01','namaproduk'=>$row['i_name'],'hargasatuan'=>$row['i_sell'],
                    'jumlahbarang'=>$row['i_qty'],'hargatotal'=>$subtotal,'diskon'=>'0','dpp'=>$dpp,'ppn'=>$ppn,'tarifppnbm'=>'0','ppnbm'=>'0','dokpendukung'=>'0'));
                $schema_insert = "";
                if(empty($_SESSION['data'])){
                    $_SESSION['data'] = $itemdata;
                }else{
                    $_SESSION['data'] = array_merge($_SESSION['data'],$itemdata);
                }
            }
        //    $data=json_encode($_SESSION["data"]);
        //     echo $data;
            header("Content-Type: application/xls");    
            header("Content-Disposition: attachment; filename=$filename.xls");  
            header("Pragma: no-cache"); 
            header("Expires: 0");
            foreach ($columns as $val) {
                print $val."\t";
            }
            print("\n");
            if(!empty($_SESSION['data'])){ 
                foreach($_SESSION["data"] as $item){        
                    echo(trim($item['no'])."\t");
                    echo(trim($item['invdate'])."\t");
                    echo(trim(strval($item['npwp']))."\t");
                    echo(trim($item['name'])."\t");
                    echo(trim($item['nik'])."\t");
                    echo(trim($item['addr'])."\t");
                    echo(trim($item['jumdpp'])."\t");
                    echo(trim($item['jumppn'])."\t");
                    echo(trim($item['jumppnbm'])."\t");
                    echo(trim($item['ide'])."\t");
                    echo(trim($item['fguangmuka'])."\t");
                    echo(trim($item['uangmukadpp'])."\t");
                    echo(trim($item['uangmukappn'])."\t");
                    echo(trim($item['uangmukappnbm'])."\t");
                    echo(trim($item['referensi'])."\t");
                    echo(trim($item['kodeobjek'])."\t");
                    echo(trim($item['namaproduk'])."\t");
                    echo(trim($item['hargasatuan'])."\t");
                    echo(trim($item['jumlahbarang'])."\t");
                    echo(trim($item['hargatotal'])."\t");
                    echo(trim($item['diskon'])."\t");
                    echo(trim($item['dpp'])."\t");
                    echo(trim($item['ppn'])."\t");
                    echo(trim($item['tarifppnbm'])."\t");
                    echo(trim($item['ppnbm'])."\t");
                    echo(trim($item['dokpendukung'])."\t");
                    echo "\n";
                }
                return;
            }else{
                echo 'Data Not Found';
            }
            unset($_SESSION['data']);
            return;    
?>

