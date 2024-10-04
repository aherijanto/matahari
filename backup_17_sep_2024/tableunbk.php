<html>
<h3 align="center">
HASIL TRYOUT USBN SD/MI TP 2017/2018<br/>
PELITA HARAPAN BANGSA SCHOOL<br/>
MINGGU, 11 MARET 2018
</h3>
<form action="" method="post">
<center>
  Masukan Nomor Peserta<br/>
<input type="text" name="nops" placeholder="Ketik nomor peserta...">
<br/>
<input type="submit" name="nopssubmit" value="Cari" />
</center>

</form>

<?php
if ($_POST['nopssubmit']){
  $myno=$_POST['nops'];
  if ($myno==""){
    exit();
  }else{
echo '
<link rel="stylesheet" type="text/css" href="cappa.css">
<hr>
<table class="bluetable" align="center">
  <thead>
  <tr>
    <th rowspan="3">RANK </th>
    <th rowspan="3">NAMA SISWA </th>
    <th rowspan="3">ASAL SEKOLAH </th>
    <th rowspan="3">RUANG </th>
    <th rowspan="3">NO PESERTA </th>
    <th colspan="9">MATA PELAJARAN</th>
    <th rowspan="3">TOTAL NILAI</th>
    <th rowspan="3">RATA-RATA</th>

  </tr>

  <tr>
    <th colspan="3">MATEMATIKA</th>
    <th colspan="3">IPA</th>
    <th colspan="3">B.INDONESIA</th>
  </tr>

  <tr>
    <th width="45px">B</th>
    <th width="45px">S</th>
    <th width="45px">N</th>

    <th width="45px">B</th>
    <th width="45px">S</th>
    <th width="45px">N</th>

    <th width="45px">B</th>
    <th width="45px">S</th>
    <th width="45px">N</th>

  </tr>
</thead>
</table>';
}
}
?>

</html>
