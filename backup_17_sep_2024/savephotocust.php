<?php
session_start();
if (isset($_SESSION['filec_code']))
{
	$filec_code=$_SESSION['filec_code'];	
} else {echo 'Process cannot continue, Customer ID Not Found..'; exit();}

$upload_dir = "img/customers/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . $filec_code . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';
?>