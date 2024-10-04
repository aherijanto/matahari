<?php
    session_start();
    error_reporting(E_ALL);
    ini_set("display_errors","On");
    
    // if(isset($_POST['submit'])){
         
            $DB_Server = "localhost";   
            $DB_Username = "mimj5729_myroot";   
            $DB_Password = "myroot@@##";               
            $DB_DBName = "mimj5729_matahari";          
            $DB_TBLName = "winventory";  
            $filename = "inventory";         

            //create MySQL connection   
            $sql = "SELECT * FROM winventory LEFT JOIN price_remark ON winventory.i_code = price_remark.item_code";

            $Connect = mysqli_connect($DB_Server, $DB_Username, $DB_Password) or die("Couldn't connect to MySQL:<br>" . mysqli_error($Connect) . "<br>" . mysqli_errno($Connect));

            //select database   
            $Db = mysqli_select_db($Connect, $DB_DBName) or die("Couldn't select database:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));   

            //execute query 
            $result = mysqli_query($Connect,$sql) or die("Couldn't execute query:<br>" . mysqli_error($Connect). "<br>" . mysqli_errno($Connect));    

            $file_ending = "xls";

            $columns=array('itemcode','group','suppcode','barcode','itemname','qty','volume','volume unit','qty min','unit','remark1','remark2','remark3','remark4','cogs','sell code','price1','price2','price3','price4','price5','price6','price7','price8','price9','price10','status',
            'ware id','comments','id'); //remove title id
            $sep = "\t"; //tabbed character

            //start of printing column names as names of MySQL fields
            $fieldinfo = mysqli_fetch_fields($result);
            
            //end of printing column names  
            $merge=[];
            $_SESSION['inventory']=array();

        //start while loop to get data
            while($row = mysqli_fetch_array($result))
            {

                $itemdata = array(array('itemcode'=>$row['i_code'],'group'=>$row['g_code'],'supp'=>$row['i_supp'],
                    'barcode'=>$row['i_barcode'],'itemname'=>$row['i_name'],'qty'=>$row['i_qty'],'vol'=>$row['i_vol'],
                    'volunit'=>$row['i_volunit'],'qtymin'=>$row['i_qtymin'],'unit'=>$row['i_unit'],'remark1'=>$row['i_size'],
                    'remark2'=>$row['i_color'],'remark3'=>$row['i_brands'],'remark4'=>$row['i_article'],'cogs'=>$row['i_cogs'],
                    'sellcode'=>$row['i_kdsell'],
                    'price1'=>$row['i_sell'],
                    'price2'=>$row['i_sell2'],
                    'price3'=>$row['i_sell3'],
                    'price4'=>$row['i_sell4'],
                    'price5'=>$row['i_sell5'],
                    'price6'=>$row['i_sell6'],
                    'price7'=>$row['i_sell7'],
                    'price8'=>$row['i_sell8'],
                    'price9'=>$row['i_sell9'],
                    'price10'=>$row['i_sell10'],
                    'status'=>$row['i_status'],
                    'wareid'=>$row['ware_id'],
                    'tag'=>$row['tag'],
                    'comments'=>$row['rem01'], // adding 'comments column'
                    'id'=>'Do not modified',
                    //'id'=>$row['id'],
                    ));
                    
                $schema_insert = "";
                if(empty($_SESSION['inventory'])){
                    $_SESSION['inventory'] = $itemdata;
                }else{
                    $_SESSION['inventory'] = array_merge($_SESSION['inventory'],$itemdata);
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
            //var_dump($_SESSION['invent']);
            if(!empty($_SESSION['inventory'])){ 
                foreach($_SESSION["inventory"] as $item){        
                    echo(trim($item['itemcode'])."\t");
                    echo(trim($item['group'])."\t");
                    echo(trim($item['supp'])."\t");
                    echo(trim($item['barcode'])."\t");
                    echo(trim($item['itemname'])."\t");
                    echo(trim($item['qty'])."\t");
                    echo(trim($item['vol'])."\t");
                    echo(trim($item['volunit'])."\t");
                    echo(trim($item['qtymin'])."\t");
                    echo(trim($item['unit'])."\t");
                    echo(trim($item['remark1'])."\t");
                    echo(trim($item['remark2'])."\t");
                    echo(trim($item['remark3'])."\t");
                    echo(trim($item['remark4'])."\t");
                    echo(trim($item['cogs'])."\t");
                    echo(trim($item['sellcode'])."\t");
                    echo(trim($item['price1'])."\t");
                    echo(trim($item['price2'])."\t");
                    echo(trim($item['price3'])."\t");
                    echo(trim($item['price4'])."\t");
                    echo(trim($item['price5'])."\t");
                    echo(trim($item['price6'])."\t");
                    echo(trim($item['price7'])."\t");
                    echo(trim($item['price8'])."\t");
                    echo(trim($item['price9'])."\t");
                    echo(trim($item['price10'])."\t");
                    echo(trim($item['status'])."\t");
                    echo(trim($item['wareid'])."\t");
                    echo(($item['comments'])."\t");
                    echo(trim($item['id'])."\t");
                    // echo($item['tag']);
                    echo "\n";
                }
                return;
            }else{
                echo 'Data Not Found';
            }
           
            return;    
?>

