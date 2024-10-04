<html>
    <head>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <script>
            window.onload = function(){
                var buttonupload = document.getElementById('syncupload');
                //var buttondownload = document.getElementById('syncdownload');
                setInterval(function(){
                    console.log('Sync data to remote...');
                    buttonupload.click();
                   // console.log('Sync data to local...');
                    // buttondownload.click();
                },15*60*1000);  // this will make it click again every 1000 milisecondsd
            };
</script>
    </head>
    <?php
        require_once('./assets/requires/config.php');
        require_once('./assets/requires/header1.php');
    ?>
    <body>
        <div align="center" class="mt-5">
            <p> Every 15 minutes, data will be automatically uploaded to the remote,</p>
            <p>or you can do it manually by pressing the button</p>
        </div>
        <div align="center" id="msg" class="mt-5"></div>
        <div class="row">
            <div class="col"></div>
            <div class="col-sm">
                <div align="center" class="mt-5">
                    <button id="syncupload" class="btn btn-success"><i class="fa fa-arrow-up"></i> Sync to Remote <i class="fa fa-arrow-up"></i></button>
                </div>
            </div>
            <div class="col-sm">
                <!-- <div align="center" class="mt-5">
                    <button id="syncdownload" class="btn btn-danger"><i class="fa fa-arrow-down"></i> Sync to Local <i class="fa fa-arrow-down"></i></button>
                </div> -->
            </div>
            <div class="col"></div>
        </div>
    </body>
</html>
<script src="./assets/scripts/js/sync_upload.js"></script>
<script src="./assets/scripts/js/sync_download.js"></script>