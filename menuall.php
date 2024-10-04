<?php
echo '<nav class="navbar navbar-expand-lg navbar-dark " style="background-color:#14213d;color:#f1faee;">
    <a class="navbar-brand" href="dashboard.php">Dashboard</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active">
          <a class="nav-link" href="searchengine1.php">Home <span class="sr-only">(current)</span></a>
        </li>
        
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Maintenance
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="reginvent.php">Inventory</a>
            <a class="dropdown-item" href="reggroup.php">Groups</a>
            <a class="dropdown-item" href="regsupp.php">Suppliers</a>            
          </div>
        </li>

        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Transactions
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="purchase.php?action=new">Purchase</a>
            <a class="dropdown-item" href="retpcs.php">Purchase Return</a>    
            <a class="dropdown-item" href="account_r.php">Account Receivable</a> 
            <a class="dropdown-item" href="account_p.php">Account Payable</a>
            <a class="dropdown-item" href="retsales.php">Sales Return</a>           
          </div>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Tools
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="adjustinvent..php">Inventory Adjust</a>
            <a class="dropdown-item" href="deltrans.php">Cancel Transaction</a>
            <a class="dropdown-item" href="backupdb.php">Backup Data</a>
            <a class="dropdown-item" href="reprint.php">Reprint Invoice</a>
            <a class="dropdown-item" href="exportexcel.php">Export-Tax</a>
            <a class="dropdown-item" href="mutation.php">Item Mutation</a>
            <a class="dropdown-item" href="syncme.php">Sync To Remote</a>
            <a class="dropdown-item" href="exportinvent.php">Export Inventory</a>
            <a class="dropdown-item" href="importinvent.php">Import Inventory</a>
            <a class="dropdown-item" href="conversion_tools.php">Item Conversion</a>

          </div>
        </li>
        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Reports
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="/reports/_rptsalesperdateperiod.php">Sales Per Period</a>
            <a class="dropdown-item" href="/reports/_rptsalesperdateperioddetail.php">Sales Per Period Detail</a>
            <a class="dropdown-item" href="/reports/_rptsalesperdateperinvoice.php">Sales Per Invoice</a>
            <a class="dropdown-item" href="/reports/_rptpurchaseperdateperiod.php">Purchasing Per Period</a>
            <a class="dropdown-item" href="/reports/_rptpurchaseperdateperioddetail.php">Purchasing Per Period Detail</a>
            <a class="dropdown-item" href="/reports/_rptpurchaseperdateperinvoice.php">Purchasing Per Invoice</a>
            <a class="dropdown-item" href="/reports/_rptdiscountperdateperiod.php">Discount Per Date Period</a>
            <a class="dropdown-item" href="./reports/_rptmutasiperperiod.php">Mutasi Per Date Period </a>
        </li>

        <li class="nav-item dropdown active">
          <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            Settings
          </a>
          <div class="dropdown-menu" aria-labelledby="navbarDropdown">
            <a class="dropdown-item" href="company.php">Company Header</a>
            <a class="dropdown-item" href="#">Company Footer</a>
            <a class="dropdown-item" href="warehouse.php">Warehouse</a>
          </div>
        </li>
        <li class="nav-item  active">
            <a href="xlogout.php" class="nav-link nav-right"><span class="sr-only"></span> Logout</a>
        </li>
      </ul>
    </div>
  </nav>';
