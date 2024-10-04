<?php
session_start();
error_reporting(E_ALL);
ini_set("display_errors","On");

if (isset($_SESSION['user'])!="" ){
include 'class/_parkercustomer.php';
include 'class/number.php';
include 'menuhtml.php';



	if (isset($_POST['save'])){

		$c_code=setnumber("wcustomers","0");

		$c_id=$_POST['c_id'];
		$fullname=$_POST['fullname'];
		$c_gender=$_POST['c_gender'];
		$pob=$_POST['pob'];
		$dob=$_POST['dob'];
		$c_addr=$_POST['c_addr'];
		$c_rt=$_POST['c_rt'];
		$c_kel=$_POST['c_kel'];
		$c_kec=$_POST['c_kec'];
        if (empty($_POST['c_phone']))
        {
            echo 'Phone No Must Have Value...';
            exit;
        }
		$c_phone=$_POST['c_phone'];


		$cdate=strtotime($_POST['c_date']);
		$c_join=date('Y-m-d',$cdate);


		//$mycustomer=new Customer;
		$mycustomer=new Customer($c_code,$c_id,$fullname,$pob,$dob,$c_addr,$c_rt,$c_kel,$c_kec,$c_gender,$c_phone,$c_join);
		//$mycustomer->set_c_code($c_code);
		/*$mycustomer->get_c_code().'<br/>';
		$mycustomer->get_c_id().'<br/>';
		$mycustomer->get_c_fullname().'<br/>';
		$mycustomer->get_c_pob().'<br/>';
		$mycustomer->get_c_dob().'<br/>';
		$mycustomer->get_c_addr().'<br/>';
		$mycustomer->get_c_rt().'<br/>';
		$mycustomer->get_c_kel().'<br/>';
		$mycustomer->get_c_kec().'<br/>';
		$mycustomer->get_c_gender();
		$mycustomer->get_c_phone();
		$mycustomer->get_c_join();*/

		$mycustomer->save_customer();

}

?>



<html>
<body>

    <script type="text/javascript">


                    function opencapture(){

                        window.open("cameraid.php", "_blank");
                    }
                </script>

<div>
<table align="center">
    <tr>
        <td align="center"><font color="grey" size="14">Create Your Customer Account</font></td>
    </tr>
</table>
</div>

<p>

<div>
<form method="post" action="">
<font style="font-zise:9px font-face:Arial ">
<table bgcolor="#F5E8C3" align="center" width="200" style="border-radius:10px; padding-left:10px; padding-right:10px; padding-top:5px; padding-bottom=5px;">
    <tr>
        <td colspan="2">Citizen No</td>
    </tr>

    <tr>
        <td colspan="2"><input type="text" name="c_id" style="width: 403px;" /><td>
    </tr>

    <tr>
        <td colspan="2">Fullname</td>

    </tr>

    <tr>
        <td colspan="2"><input type="text" name="fullname" style="width:403px;"/><td>
    </tr>
    <tr>
        <td colspan="2">Gender</td>

    </tr>
    <tr>
        <td colspan="2"><select name="c_gender" style="width:403px;">
		    <option value="M">Male</option>
		    <option value="F">Female</option>
		    </select></td>
    </tr>


    <tr>
        <td>Place Of Birth</td>
        <td>Date Of Birth</td>
    </tr>

    <tr>
        <td><input type="text" name="pob" style="width:250px;"/></td>
        <td><input type="date" name="dob" style="width:150px;"/></td>
    </tr>

    <tr>
        <td>Address</td>
        <td>RT/RW</td>
    </tr>

    <tr>
        <td><input type="text" name="c_addr" style="width:250px;" /></td>
        <td><input type="text" name="c_rt" style="width:150px;"/></td>
    </tr>

    <tr>
        <td>Kelurahan</td>
        <td>Kecamatan</td>
    </tr>

    <tr>
        <td><input type="text" name="c_kel" style="width:250px;"/></td>
        <td><input type="text" name="c_kec" style="width:150px;"/></td>
    </tr>

		<tr>
        <td>Phone</td>
        <td>Join Date</td>
    </tr>

    <tr>
        <td><input type="text" name="c_phone" style="width:250px;"/></td>
				<?php $cdate=date('d-m-Y');?>
				<td><input type="text" name="c_date" style="width:150px;" value="<?php echo $cdate;?>" /></td>
    </tr>

    <?php $regcustcode=setnumber("wcustomers"); $_SESSION['regcustcode']=$regcustcode; ?>
    <tr>
		<td><label><?php echo $regcustcode; ?></label> <img src="img/container/camera.png" alt="capture image" style="width:40px;height:40px;border:0;" onclick="opencapture()">
        </td>

        <td align="right"><br/><br/><input type="submit" name="save" value="Save Data" /></td>
    </tr>

</table>
</font>
</form>
</div>
</p>
</body>
</html>
<?php
} else { echo 'Process cannot continue, please <a href="slogin.php">Login </a>';}

?>
