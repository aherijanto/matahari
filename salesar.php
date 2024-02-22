<?php
	session_start();

	error_reporting(E_ALL);
	ini_set("display_errors","On");
	date_default_timezone_set("Asia/Bangkok");

	function setnoinv(){
		$myRandNo=rand(10000,99999);
		$nowM=date('Ymd');
		$mydaternd=strtotime($nowM);
		$xdate='MTHR'.$nowM.$myRandNo;
		$_SESSION['myinvdrm']=$xdate;
		return $xdate;
	}
	$_SESSION["xdate"]=date('Y-m-d');
	$_SESSION['myinvdrm']=setnoinv();
?>	
	
<html>
<link rel="icon" href=".\img\logo\cappa_icon.jpg">
 <head>
     
	 <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	 <?php require_once('./assets/requires/config.php');
    require_once('./assets/requires/header1.php');?>
        
	
</head>
<body bgcolor="#ee9b00" >
	<div>
		
		<div>
			<table width="100%" font="calibri">
				<tr>
					<td align="center" style="width: 180px;font-size: 20px;background-color: #A569BD" id="invno"><?php echo $_SESSION['myinvdrm'];?></td>
					<td align="center" style="font-size: 20px;color: white;background-color: #27AE60;">SALES CUSTOMER</td>
					<td align="center" style="width: 180px;font-size: 20px;background-color: #D35400;"><?php echo $_SESSION['xdate'];?></td>

				</tr>
                <tr>
					<td align="center" style="width: 180px;font-size: 20px;background-color: "></td>
					<td align="center" style="font-size: 20px;color:blue;background-color: ">DUE DATE</td>
					<td align="center" style="width: 180px;font-size: 20px;color:blue;background-color: ">CUSTOMER</td>
				</tr>
                <tr>
					<td align="center" style="width: 180px;font-size: 20px;background-color: "></td>
					<td align="center" style="font-size: 20px;color:blue;background-color: ">
                        <input type="date" id="duedate">
                    </td>
					<td align="center" style="width: 180px;font-size: 20px;color:blue;background-color: ">
                        <?php
                        if(isset($_GET['c_code'])){
                            $custid = $_GET['c_code'];
                        }
                            $conn=mysqli_connect('localhost','mimj5729_myroot','myroot@@##','mimj5729_matahari');
                            $custquery = "select * from wcustomers where c_code='$custid'";
                            $showcustname = mysqli_query($conn,$custquery);
                            $rowcust = mysqli_fetch_array($showcustname);
                            $custname = $rowcust['c_name'];
                        ?>
                        <label id="custid"style="color:brown;" ><?php echo $custid;?></label><br>
                        <label id="custname" style="color:red;font-size:12px;"><?php echo $custname;?></label>
                    </td>
				</tr>
			</table>
		</div>
	</div>
	
		<div id="txtgrandtotal"  align="right" style="font-weight:bold;color:#e76f51;font-size:60px;margin-right:10px;" class="sticky-top"></div>

		<div id="message" class="alert alert-danger"></div>

	<table clas="table" width="100%">
		<thead>
			<th class="text-center">SEARCH BY ID</th>
			<th class="text-center">SEARCH BY NAME</th>
			<th class="text-right" style="padding:10px 10px;">ACTIONS</th>
		</thead>
		<tbody>
			<tr>
				<td align="center">
					<input name="itemcode" type="text"  id="itemcode" autofocus>
					<input type="submit" name="idsubmit" class="btn" style="background-color: #C0392B;" value="Search ID">
				</td>
	            <td align="center">
			    	<input name="itemname" type="text"  id="itemname">
                	<button name="namesubmit" id="btnnamesearch" class="btn btn-primary">Search Name</button>
		    	</td>
				<td align="right" style="padding-left :5px5px;">
                	<button name="namesubmit" id="btnnew" class="btn btn-primary">New</button>
					<button name="namesubmit" id="btnpayment" class="btn btn-success" style="padding-left :5px5px;margin-right:10px;">Continue Payment</button>

		    	</td>
			</tr>
		</tbody>
	</table>

<div id="shopping-cart">
	<div id="TableSales"></div>
</div>
<br/>
<div class="row">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 col-md-6" style="padding:10px;">
           	<div id="TableSearch"></div>
        </div>
    </div>

	<div class="modal fade" id="PriceModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                            	
                <div class="modal-header">
                    <h1 class="modal-title" id="h1-1"></h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="message"></div>
                        </div>
                    </div>
					
						<div class="form-group">
							<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Code :</label>  
                            	<input type="text" id="txtCode" class="form-control" maxlength="100" style="width:200px;margin-left:46px;" disabled>
                    		</div>
							<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Name :</label>  
                            	<input type="text" id="txtName" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:41px;margin-top:5px;" disabled>
                    		</div>
							<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Ware :</label>  
                            	<input type="text" id="txtWare" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:47px;margin-top:5px;" readonly>
                    		</div>
							<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Qty :</label>  
                            	<input type="text" id="txtQty" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:59px;margin-top:5px;">
                    		</div>
							
							<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Disc% 1 :</label>  
                            	<input type="text" id="txtdisc" class="form-control input-sm" maxlength="100" style="width:80px;margin-left:27px;margin-top:5px;">
								<label class="control-label" style="margin-left:10px;margin-top:5px;">Disc Rp. :</label>  
                            	<input type="text" id="txtdiscrp" class="form-control input-sm" maxlength="100" style="width:95px;margin-left:10px;margin-top:5px;margin-bottom:5px;">
							</div>

                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #1 :</label>  
                            	<input type="text" id="txtharga1" class="form-control input-sm" maxlength="50" style="width:200px;margin-top:5px;margin-left:20px;">
								<button type="button" class="btn btn-primary" id="btnHarga1" style="margin-left:10px;">Add</button> 
                        
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #2 :</label>  
                            	<input type="text" id="txtharga2" class="form-control input-sm" maxlength="50" style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga2" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #3 :</label>  
                            	<input type="text" id="txtharga3" class="form-control input-sm" maxlength="50"  style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga3" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #4 :</label>  
                            	<input type="text" id="txtharga4" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga4" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #5 :</label>  
                            	<input type="text" id="txtharga5" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga5" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                   	 		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #6 :</label>  
                            	<input type="text" id="txtharga6" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga6" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #7 :</label>  
                            	<input type="text" id="txtharga7" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga7" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #8 :</label>  
                            	<input type="text" id="txtharga8" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga8" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #9 :</label>  
                            	<input type="text" id="txtharga9" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:20px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga9" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>
                    		<div class="row">
                            	<label class="control-label" style="margin-left:10px;margin-top:5px;">Harga #10 :</label>  
                            	<input type="text" id="txtharga10" class="form-control input-sm" maxlength="100" style="width:200px;margin-left:10px;margin-top:5px;">
								<button type="button" class="btn btn-primary" id="btnHarga10" style="margin-left:10px;margin-top:5px;">Add</button> 
                    		</div>

						</div>
					
                </div>                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>

	<div class="modal fade" id="SummaryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                            	
                <div class="modal-header">
                    <h1 class="modal-title" id="h1-2">Summary</h1>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span>
                        </button>
                </div>

                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                            <div id="messagesummary" class="alert alert-danger"></div>
                        </div>
                    </div>
					
					<div id="TableSummary"></div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div>Pay : <input type="text" class="input input-sm" id="txtpayment"  style="text-align:right;margin-left:27px;width:164px;"></div>
						</div>
					</div>
					<div class="row">
						<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
							<div>Change : <input type="text" class="input input-sm" id="txtchange" style="text-align:right;margin-top:5px;width:164px;" readonly></div>
						</div>
					</div>
                </div>                
                
                <div class="modal-footer">
				<button type="button" class="btn btn-success" id="btnsavedata">Save</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</div>


</body>
<script src="./assets/scripts/js/salesar.js"></script>
</html>

