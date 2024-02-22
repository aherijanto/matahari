<?php
    error_reporting(E_ALL);
    ini_set("display_errors","On");
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    $noinv=$_POST['noinv'];
    $conn=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
    

    $companyquery = "select * from wcompany";
    $showcompany = mysqli_query($conn,$companyquery);
    $rowcompany = mysqli_fetch_array($showcompany);
    $coname = $rowcompany['name'];

    $duequery = "select * from wsellhead,wcustomers where s_code='$noinv' and wsellhead.c_code=wcustomers.c_code";
    $showdue = mysqli_query($conn,$duequery);
    $rowdue = mysqli_fetch_array($showdue);
    
    $myrowhead = mysqli_num_rows($showdue);
    if($myrowhead>0){
        $duedate = $rowdue['s_dateinput'];
        $mydateinv = $rowdue['s_date'];
        $mytable= '<table  style="width:100%;">
                <tr><td>'.$coname.'</td>
                    <td align="right">Kepada Yth.</td>
                </tr>
                <tr>
                    <td style="font-size:16px;font-weight:normal;">Invoice No: '.$noinv.'</td>
                    <td align="right" style="font-size:16px;">'.$rowdue['c_name'].'</td>
                </tr>
                <tr>
                    <td style="font-size:16px;font-weight:normal;">Inv Date:   '.date('d-m-Y',strtotime($mydateinv)).'</td>
                    <td align="right" style="font-size:16px;">'.substr($rowdue['c_addr'],0,20).'</td>
                </tr>
                <tr>
                    <td style="font-size:16px;font-weight:normal;">Due Date:   '.date('d-m-Y',strtotime($duedate)).'</td>   
                </tr>
                <tr>
                    <td style="font-size:12px;font-weight:normal;padding-top:15px;font-style:italic;">Print Date: '.date('d-m-Y').'&nbsp&nbsp&nbsp&nbspPrint Time: '.date('H:i:s').'</td></tr>
                </table>';

        $sqlinv="select wsellhead.s_code,wsellhead.s_date,wsellhead.c_code,wsellhead.u_code,wselltail.i_code,wselltail.i_name,wselltail.i_qty, wselltail.i_sell,wselltail.i_disc1,wselltail.i_disc3,winventory.i_unit,winventory.ware_id from wsellhead,wselltail,winventory where wselltail.s_code=wsellhead.s_code and wselltail.i_code=winventory.i_code and wselltail.s_code = '$noinv'";
        $showdetail= mysqli_query($conn,$sqlinv) or die(mysqli_error($conn));
    
        $item_total=0;
        $payme=0;
        $changeme=0;
        $no=0;
        $nodata=true;
        $mytable.='<table style="width:100%;border-collapse:collapse;">
                    <thead style="border:solid;"> 
                        <th class="text-center" style="width:5%;">NO</th>
                        <th class="text-left" style="width:40%;">ITEM</th>
                        <th class="text-right" style="width:10%;">QTY</th>
                        <th class="text-center" style="width:10%;">UNIT</th>
                        <th  align="right" class="text-right" style="width:10%;">HARGA</th>
                        <th align="right" class="text-right" style="width:10%;">DISC</th>
                        <th align="right" class="text-center" style="width:20%;padding-right:10px;">TOTAL</th>
                    </thead>
                
                    <tbody>';
                
            
            $grandtotal=0;
            while($row =mysqli_fetch_array($showdetail)){
                $no++;
                $subtotal = 0;
                $subtotal = $row['i_qty']*($row['i_sell']-$row['i_disc3']);
                $mykdbrg = $row['i_code'];
                $sqlsatuan="SELECT * from winventory,wwarehouse where i_code='$mykdbrg' and winventory.ware_id=wwarehouse.ware_id;";
        
                $showsatuan= mysqli_query($conn,$sqlsatuan) or die(mysql_error());
                if ($row1 =mysqli_fetch_array($showsatuan))
                { 
                    $myitemcode=$row1['i_unit'];
                    $mywareid=$row1['ware_id'];
                    $mywarename=$row1['ware_name'];
                    
                }	
                $mytable.= '<tr>
                    <td style="text-align:center;font-size:14px">'.$no.'</td>
                    <td style="text-align:left;padding-left:40px;padding-top:3px;font-size:14px">'.$row['i_name'].' - '.$mywarename.'</td>
                    <td style="text-align:center;font-size:14px">'.$row['i_qty'].'</td>
                    <td style="text-align:center;font-size:14px">'.$row['i_unit'].'</td>
                    <td style="text-align:right;font-size:14px">'.number_format($row['i_sell']).'</td>
                    <td style="text-align:right;font-size:14px">'.$row['i_disc3'].'</td>
                    <td style="text-align:right;padding-right:10px;font-size:14px">'.number_format($subtotal).'</td>
                    </tr>';
                $grandtotal=$grandtotal+$subtotal;
                $nodata=false;
            }
            $mytable.='<tbody></table>
                        <div style="margin-top:200px;"><hr></div>
                        <div align="right" style="padding-top:10px;padding-right:10px;font-size:18px;font-weight:bold;">T O T A L :&nbsp&nbsp&nbsp&nbsp '.number_format($grandtotal).'</div>  
                        <div style="font-size:12px;font-style:italic;"><a href="/searchengine1.php" style="text-decoration:none;color:black;">***Document dianggap sah apabila terdapat tandatangan dan stempel***</a></div>
                        <div><table style="width:100%;">
                        <tr>
                            <td style="text-align:center;">Hormat Kami,</td>
                            <td style="text-align:center;"></td>
                            <td style="text-align:center;">Pembeli,</td>
                        </tr>
                        </table></div>';
                        echo $mytable;
    }else{
        echo 'Failed';
    }
        
                
    

?>