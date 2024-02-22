<?php
session_start();
ob_start();
if (isset($_SESSION['user'])!="" )
{
  
    require_once('./assets/requires/config.php');
    require_once('./assets/requires/headerdshbd.php');

?>

<html>
<head>
	<title></title>
	<style type="text/css">
		.center-screen {
  			display: flex;
  			flex-direction: column;
  			justify-content: center;
  			align-items: center;
  			text-align: center;
  			min-height: 100vh;
		}
		
		input[type=text] {
  width: 100%;
  box-sizing: border-box;
  border: 2px solid #ccc;
  border-radius: 4px;
  font-size: 16px;
  background-color: white;
 
  background-position: 1px 10px; 
  background-repeat: no-repeat;
  padding: 12px 20px 12px 40px;
}

input[type=button], input[type=submit], input[type=reset] {
  background-color: #4CAF50;
  border: none;
  color: white;
  padding: 16px 32px;
  text-decoration: none;
  margin: 4px 2px;
  cursor: pointer;
}
	</style>
</head>

<body>
		<div class="center-screen">
      
			  <label for="selectno"><strong><h5>DELETE TRANS</h5></strong></label>
        <div class="form-group">
          
			    <input type="text" class="form-control" name="deleteno" id="deleteno" placeholder="Masukan No Transaksi" style="width: 400px;text-align:center;color:blue;">
          <div class="row text-center">
            
            <div class="col col-md-12">
              <input type="password" class="form-control" name="pin" id="pin" placeholder="Your PIN..." style="width:200;" />
            </div>
          </div>
          <div class="row">
            <div class="col col-sm-6">
              <button class="btn btn-danger mt-2" id="btnquery">Delete</buttion>
            </div>  
            <div class="col col-sm-6">
              <button class="btn btn-primary mt-2" id="btnback">Back</buttion>
            </div>        
          </div>
        </div>
      
    </div>
    <div class="modal fade" id="SummaryModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-lg" role="document">
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
					
                <div class="modal-footer">
				<button type="button" class="btn btn-danger" id="btndeltrans">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
</html>
<?php 
}else { 
  echo 'Process cannot continue, please <a href="slogin.php">Login </a>';
}
?>
<script src="./assets/scripts/js/deltrans1.js"></script>