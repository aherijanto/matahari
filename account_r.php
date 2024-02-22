<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">  
    </head>
    <?php
        require_once('./assets/requires/config.php');
        require_once('./assets/requires/header1.php');
    ?>

    <div class="container">
        <div id="jdlaccr" style="font-size:36px;color:brown;">Account Receivable</div>
        <div class="card shadow-sm mb-5 bg-black rounded">
            <!-- <img class="card-img-top" src="..." alt="Card image cap">!-->
            <div class="card-body" >
                <h5 class="card-title">Invoice No.</h5>
                <p class="card-text"><input type="text" class="input input-lg" style="width:100%;" id="srchInv"></p>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="btnsearch">Search</button>
            </div>
        </div>
        <div id="infoinvaccr"></div>
        <div id="historyaccr"></div>
        <div id="historydisc"></div>
        
        <div id="accr" >
            <div class="card shadow-sm mb-5 bg-black rounded" style="background-color:#ffe6a7;"> 
                <div class="card-body" >
                    <div class="card-title"><h3 style="color:#003d5b;font-weight:bold;">Input Payment</h3></div>
                        <div class="form-group row">
                            <label for="dateaccr" class="col-form-label" style="margin-left:10px;">Date</label>
                            <div style="margin-left:10px;">
                                <input type="date" id="dateaccr" class="form-control" >
                            </div> 
                            
                            <label for="typepay" class="col-form-label" style="margin-left:10px;">Type</label>
                                <div style="margin-left:10px;">
                                    <select id="typepay" class="form-control">
                                        <option value="0" selected>Select Payment</option>
                                        <option value="cash">Cash</option>
                                        <option value="cheque">Cheque</option>
                                        <option value="bilyet">Bilyet</option>
                                    </select>
                                </div>

                            <label for="nocheque" class="col-form-label" style="margin-left:10px;">No</label>
                            <div style="margin-left:10px;">
                                <input type="text" class="input input-md form-control" id="nocheque">
                            </div>

                            <label for="amount" class="col-form-label" style="margin-left:10px;">Amount</label>
                            <div style="margin-left:10px;">
                                <input type="number" class="input input-md form-control" id="amount">
                            </div>
                            <div style="margin-left:15px;">
                                <button id="addtolist" class="btn btn-primary form-control">Add</button>
                            </div>
                        </div>                        
                    
                    <p class="card-text" id="accrdetail"></p>
                </div>
                <div class="card-footer" id="btnaction">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success" id="btnsave">Save</button>
                        </div>
                        <div class="col col-sm-2">
                            <button class="btn btn-danger" id="btnclear">Clear List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="discaccr" style="padding-bottom:140px;">
            <div class="card shadow-sm mb-5 bg-black rounded" style="background-color:#f2e8cf;"> 
                <div class="card-body" >
                    <div class="card-title"><h3 style="color:#720026;font-weight:bold;">Input Discount</h3></div>
                        <div class="form-group row">
                            <label for="datedisc" class="col-form-label" style="margin-left:10px;">Date</label>
                            <div style="margin-left:10px;">
                                <input type="date" id="datedisc"  name="datedisc" class="form-control" >
                            </div> 
                            
                            <label for="descdisc" class="col-form-label" style="margin-left:10px;">Description</label>
                                <div style="margin-left:10px;">
                                    <input type="text" id="descdisc"  name="descdisc" class="form-control" >
                                </div>

                            <label for="amountdisc" class="col-form-label" style="margin-left:10px;">Amount</label>
                            <div style="margin-left:10px;">
                                <input type="number" class="input input-md form-control" id="amountdisc" name="amountdisc">
                            </div>
                            <div style="margin-left:15px;">
                                <button id="adddisc" class="btn btn-primary form-control">Add Disc</button>
                            </div>
                        </div>                        
                    
                    <p class="card-text" id="discdetail"></p>
                </div>
                <div class="card-footer" id="btnactiondisc">
                    <div class="row">
                        <div class="col">
                            <button class="btn btn-success" id="btnsavedisc">Save</button>
                        </div>
                        <div class="col col-sm-2">
                            <button class="btn btn-danger" id="btncleardisc">Clear List</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</div>

</html>
<script src="./assets/scripts/js/accr.js"></script>

