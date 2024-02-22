<?php
    session_start();
    date_default_timezone_set('Asia/Jakarta');
    $wareid=$_GET['wareid'];
    $noinv=$_GET['noinv'];
    $conn=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
    $warehousequery = "select * from wwarehouse where ware_id='$wareid'";
    $showwarehouse = mysqli_query($conn,$warehousequery);
    $rowware = mysqli_fetch_array($showwarehouse);

    $companyquery = "select * from wcompany";
    $showcompany = mysqli_query($conn,$companyquery);
    $rowcompany = mysqli_fetch_array($showcompany);
    $coname = $rowcompany['name'];

    $custquery = "select * from wsellhead,wcustomers where s_code='$noinv' and wsellhead.c_code=wcustomers.c_code";
    $showcust = mysqli_query($conn,$custquery);
    $rowcust = mysqli_fetch_array($showcust);

    $warename=$rowware['ware_name'];
    echo '<head><title>'.$wareid.'@'.$noinv.'</title></head>';
    echo '<div style="font-size:22px;font-weight:bold;">'.$warename.'</div>';
    echo '<table  style="width:100%;">';
    echo '<tr><td style="font-size:14px;>'.$coname.'</td>
                
        </tr>';
    
    echo '<tr>
            <td style="font-size:16px;font-weight:normal;">Invoice No: '.$noinv.'</td>
            <td style="font-size:16px;font-weight:normal;" align="right">'.$rowcust['c_name'].'</td>
            </tr>';
    echo '<tr>
            <td style="font-size:14px;font-weight:normal;">Print Date: '.date('d-m-Y').'  '.' Print Time: '.date('H:i:s').'</td>
            </tr>';
    echo '</table>';

    if (isset($_SESSION[$wareid])){
        $no=0;
        echo '<table style="width:100%;border-collapse:collapse;">
                <thead style="border:solid;"> 
                    <th class="text-center" style="width:5%;font-size:14px;">NO</th>
                    <th class="text-left" style="width:5%;font-size:14px;">CODE</th>
                    <th class="text-left" style="width:40%;font-size:14px;">ITEM NAME</th>
                    <th class="text-right" style="width:20%;font-size:14px;">QTY</th>
                    <th class="text-center" style="width:10%;font-size:14px;">UNIT</th>
                    
                </thead>
               
                <tbody>';
        foreach($_SESSION[$wareid] as $item){
            $no++;
            echo '<tr styles="padding:5px 5px;">
                    <td style="text-align:center;font-size:14px;">'.$no.'</td>
                    <td style="text-align:left;font-size:14px;">'.$item['code'].'</td>
                    <td style="text-align:left;font-size:14px;">'.$item['name'].'</td>
                    <td style="text-align:center;font-size:14px;">'.$item['qty'].'</td>
                    <td style="text-align:center;font-size:14px;">'.$item['unit'].'</td>
                  </tr>';
        }
        echo '<tbody></table>';
        echo '<div style="margin-top:150px;"><hr></div>';  
        echo '<div style="font-size:12px;font-style:italic;">***Document dianggap sah apabila terdapat tandatangan dan stempel***</div>';
        echo '<div><table style="width:100%;">
                <tr>
                    <td style="text-align:center;font-size:14px;">Pengirim</td>
                    <td style="text-align:center;font-size:14px;">Diterima Oleh:</td>
                    <td style="text-align:center;font-size:14px;">Diperiksa Oleh:</td>
                </tr>
                </table></div>';  
    }

?>