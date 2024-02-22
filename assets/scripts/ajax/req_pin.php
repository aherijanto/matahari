<?php
    error_reporting(E_ALL);
    ini_set("display_errors", "On");
    session_start();

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;
    require $_SERVER['DOCUMENT_ROOT'].'/assets/PHPMailer/src/Exception.php';
    require $_SERVER['DOCUMENT_ROOT'].'/assets/PHPMailer/src/PHPMailer.php';
    require $_SERVER['DOCUMENT_ROOT'].'/assets/PHPMailer/src/SMTP.php';
    $pin = mt_rand(10000,99999);
   
    if(!isset($_SESSION['pin'])){
        $_SESSION['pin']=$pin;
    }else{
        $_SESSION['pin']=$pin;
    }
    echo "Pin is : ".$_SESSION['pin'];
    
    
    $mail = new PHPMailer;
    $mail->IsSMTP();
    $mail->Host = 'mail.mimoapps.xyz';
    $mail->Port = 587;
    $mail->SMTPAuth = true;
    $mail->Username = 'notification@mimoapps.xyz';
    $mail->Password = 'mimo241203@@##$$%%^^';
    $mail->SMTPSecure = 'tls';
    
    $mail->From = "notification@mimoapps.xyz";
    $mail->FromName = "Notification-Matahari";
    // $mail->AddAddress("claudiacherry2710@gmail.com", "cherry");
    $mail->AddAddress("cherry@mimoapps.xyz", "cherry");
    $mail->WordWrap = 50;
    $mail->IsHTML(true);
    $mail->Subject = "[NOTIFICATION] Requested PIN Access - Edit";
    $mail->Body = "<html>
                    <body>
                        <p>Halo</p>
                        <p>Terdeksi aktivitas untuk edit Invoice</p>
                        <p>Berikut adalah PIN untuk konfirmasi edit : ".$pin."</p>
                        <p>PIN berlaku selama 1 menit, apabila Anda mengkonfirmasi bahwa aktivitas ini adalah aman,</p>
                        <p>silakan untuk melanjutkan proses, atau abaikan apabila terdapat aktivitas mencurigakan</p>
                        <br/><br/><br/>
                        <p>Salam,</[>
                        <p>Cappa Database Technologies</p>
                    </body>
                   </html>";
    
    $mail->SMTPOptions = array(
                'ssl' => array(
                    'verify_peer' => false,
                    'verify_peer_name' => false,
                    'allow_self_signed' => true
                )
            );

    if(!$mail->Send()){
                echo 'Error : '.$mail->ErrorInfo;;
                
                echo 'ERROR';
    }else{
        echo 'success,.email notification sent...';
    }
?>