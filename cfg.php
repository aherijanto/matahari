 <?php
$myfile = fopen("cn.cfg", "w") or die("Unable to open file!");
$txt = "localhost\n";
fwrite($myfile, $txt);
$txt = "doremi\n";
fwrite($myfile, $txt);
$txt = "root\n";
fwrite($myfile, $txt);
$txt = "root\n";
fwrite($myfile, $txt);

fclose($myfile);

?> 