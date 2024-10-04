<?php
session_start();
if (isset($_SESSION['user'])!="" ){
if (isset($_SESSION['filepng']))
{
	$filename=$_SESSION['filepng'];	
}

$upload_dir = "img/brands/";
$img = $_POST['hidden_data'];
$img = str_replace('data:image/png;base64,', '', $img);
$img = str_replace(' ', '+', $img);
$data = base64_decode($img);
$file = $upload_dir . $filename . ".png";
$success = file_put_contents($file, $data);
print $success ? $file : 'Unable to save the file.';

}else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}
?>