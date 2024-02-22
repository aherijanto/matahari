<?php
session_start();
?>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<?php
require_once('./assets/requires/config.php');
require_once('./assets/requires/headerdshbd.php');
?>

<body class="container">
    <div style="padding-top:40px;color:#7209b7;font-size:32px;">DASHBOARD</div>
    <div style="padding-top:10px;color:#1e6091;font-size:20px;"><?php echo 'WELCOME, ' . $_SESSION['user']; ?> </div>
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" style="border-style:none;border-color:blue;border-radius:15px 15px;">
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
           
        </ol>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img class="d-block w-100" src="/img/image1.gif" alt="First slide">
            </div>
            <div class="carousel-item">
                <img class="d-block w-100" src="/img/image2.gif" alt="Second slide">
            </div>
            
   
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="card-deck" style="padding-top:20px;">
        <div class="card">
            <!-- <img class="card-img-top" src="..." alt="Card image cap">!-->
            <div class="card-body" style="background-color:#8eecf5">
                <h5 class="card-title">Home</h5>
                <p class="card-text">Go to Home to start your Maintenance, Transactions, Reports, etc</p>
            </div>
            <div class="card-footer">
                <small class="text-muted"><a href="searchengine1.php">Go Home</a></small>
            </div>
        </div>

        <div class="card">
            <div class="card-body" style="background-color:#e9c46a">
                <h5 class="card-title">Sales</h5>
                <div>
                    <img src="/img/sales.png" width="160px" height="100px">
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted"><a href="searchengine1.php">Sales - Transaction</a></small>
            </div>
        </div>

        <div class="card">
            <div class="card-body" style="background-color:#cdb4db">
                <h5 class="card-title">Account Receivable</h5>
                <div>
                    <img src="/img/ar.png" width="160px" height="100px">
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted"><a href="account_r.php">Account Receivable</a></small>
            </div>
        </div>

        <div class="card">
            <div class="card-body" style="background-color:#ffafcc">
                <h5 class="card-title">Purchasing</h5>
                <div>
                    <img src="/img/purchase.png" width="160px" height="100px">
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted"><a href="purchase.php?action=new">Purchasing - Transaction</a></small>
            </div>
        </div>

        <div class="card">
            <div class="card-body" style="background-color:#fdffb6">
                <h5 class="card-title">Account Payable</h5>
                <div>
                    <img src="/img/ap.png" width="160px" height="100px">
                </div>
            </div>
            <div class="card-footer">
                <small class="text-muted"><a href="account_p.php">Account Payable</a></small>
            </div>
        </div>
    </div>
    <div class="card-deck" style="padding-top:20px;">
    <div class="card">
            <div class="card-body" style="background-color:#e7c6ff">
                <div class="row">
                    <div class="col">
                        <h5 class="card-title">Account Receivable - Notification</h5>
                    </div>
                    <div class="col">
                        <button class="btn btn-primary" id="todaybtn">Today</button>
                        <input type="date" id="_date" />
                        <button class="btn btn-primary" id="refreshbtn">Refresh</button>
                        <button class="btn btn-primary" id="allbtn">All</button>
                    </div>
                </div>
                <p class="card-text">
                    <div id="accrnotif" ></div>
                </p>
               
            </div>
            <div class="card-footer">
                <small class="text-muted">Notification</small>
            </div>
        </div>
    </div>
</body>

</html>
<script src="./assets/scripts/js/notif.js"></script>