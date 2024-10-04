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
        
       
    ?> 
</head>
<body>
    
    <div class=row style="background-color:#ffffff;">
        <div class="col-sm-2" style="margin-left:10px;padding-top:10px;">
            <div id="title" style="font-size:58px;color:#168aad">Warehouse</div>
        </div>
        
        <div class="col-sm-2" style="margin-left:250px;floating:right;padding-top:10px;align:right;">
           	    <div class="form-group">
                    <label class="control-label">&nbsp;</label>
                    <button class="btn btn-primary form-control" id="btnAddNew" >Add Warehouse</button>
                </div>            
            </div>
        </div>      
    </div>
                    
    <div class=row style="background-color:#ffffff;">
        <div class="col-md-12 col-xs-12 col-lg-12 col-sm-12 col-md-6" style="padding:10px;">
           	<div id="TableWarehouse"></div>
        </div>
    </div>

    <div class="modal fade" id="WarehouseModal" tabindex="-1" role="dialog">
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
                                <input type="text" id="txtwareid" class="form-control" maxlength="100">
                            </div> 
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Warehouse Name :</label>
                                <input type="text" id="txtnama" class="form-control" maxlength="100">
                            </div> 
                        </div>

                        <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">
                                <label class="control-label">Location :</label>
                                <input type="text" id="txtloc" class="form-control" maxlength="100">
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
<script src="./assets/scripts/js/warehouse.js"></script>
</html>
