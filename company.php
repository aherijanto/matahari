<?php
    error_reporting(E_ALL);
    ini_set("display_errors","On");
?>
<!DOCTYPE HTML>
<html>

<head>
   <?php
        require_once('./assets/requires/config.php');
        require_once('./assets/requires/header1.php');
        
        //require_once './menuside.html';
    ?> 
</head>
<body>
    <div class=row style="background-color:#ffffff;">
        <div  style="margin-left:20px;padding-top:10px;">
            <div id="title" style="font-size:58px;color:#e0aaff">Your Company</div>
        </div>
        <!--<div class="col-sm-2" style="margin-left:250px;padding-top:10px;floating:right;align:right;">
           	<div class="form-group">
                <label class="control-label">&nbsp;</label>
                <button class="btn btn-primary form-control" id="btnAddNew" >My Profile</button>
            </div>            
        </div> !-->     
    </div>
                    
    <div class=row style="background-color:#ffffff;">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 col-md-6" style="padding:10px;">
           	<div id="TableCustomer"></div>
        </div>
    </div>

    <div class="modal fade" id="CustomerModal" tabindex="-1" role="dialog">
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
                
                    <div class="row">
                        <div class="col-lg-8 col-md-8 col-sm-12 col-xs-12">
                  	        <div class="form-group">
                                <label class="control-label">Code :</label>
                                <input type="hidden" id="txtindex" value="new" class="form-control">
                                <input type="text" id="txtcustid" class="form-control" maxlength="100">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Company Name :</label>
                                <input type="text" id="txtnama" class="form-control" maxlength="100">
                            </div> 
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Address 1 :</label>
                                <input type="text" id="txtaddr1" class="form-control" maxlength="100">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Address 2 :</label>
                                <input type="text" id="txtaddr2" class="form-control" maxlength="255">
                            </div>
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">City :</label>
                                <input type="text" id="txtcity" class="form-control" maxlength="100">
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Phone :</label>
                                <input type="text" id="txtphone" class="form-control" maxlength="255">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Email :</label>
                                <input type="text" id="txtemail" class="form-control" maxlength="255">
                            </div>
                        </div>
                    </div>

                </div>                
                
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" id="btnSave">Save</button>
                    <button type="button" class="btn btn-danger" id="btnDelete">Delete</button>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
                
           

</body>
<script src="./assets/scripts/js/inventory.js"></script>
</html>
