<?php

error_reporting(E_ALL);
ini_set("display_errors","On");
session_start();

if (isset($_SESSION['user'])!="")
 {
    include 'class/_number.php';


if (isset($_GET['c_code']))
                {
                $code=$_GET['c_code'];
                $_SESSION['regcustcode']=$code;
                echo $code;
                }
                

                     /*if (isset($_COOKIE["groupitem1"]))
                        {
                        //echo 'cookie id:'.$_COOKIE["myrefno"];
                            $_SESSION["group"]=$_COOKIE["groupitem1"];
                        //echo '<br/>session id:'.$_SESSION["myblur1"];
                            $prefix=$_SESSION["group"];
                            
                        }
                        else{
                            $_COOKIE["groupitem1"]="";
                            $_SESSION["group"]="";

                        }

                        //echo $_SESSION['cart_item']['code'];
                        $rownumber=setnumber_invent('winventory',$prefix);
                        

                        //$itemcode1=$prefix.strval(setnumber_invent('winventory',$prefix));
                        
                        if (empty($_SESSION['cart_item']))
                        {
                            $itemcode1=$prefix.strval($rownumber+1);
                        }


                        if(!empty($_SESSION['cart_item']))
                        {
                            
                            $itemcode1=$prefix.strval($rownumber+1);

                            while(array_key_exists($itemcode1,$_SESSION['cart_item']))
                                {
                                    $rownumber=$rownumber+1;
                                    $itemcode1=$prefix.strval($rownumber);
                                }             
                           
                        
                        }*/

                        
?>

<html>
<style>
		video { border: 1px solid #ccc; display: block; margin: 0 0 20px 0; }
		#canvas { margin-top: 20px; border: 1px solid #ccc; display: block; }
</style>

<body>


	
	<video id="video" width="200" height="150" autoplay></video>
	<button id="snap" class="sexyButton">Snap Photo</button>
	<canvas id="canvas" width="640" height="480"></canvas>


	<script>

		// Put event listeners into place
		window.addEventListener("DOMContentLoaded", function() {
			// Grab elements, create settings, etc.
            var canvas = document.getElementById('canvas');
            var context = canvas.getContext('2d');
            var video = document.getElementById('video');
            var mediaConfig =  { video: true };
            var errBack = function(e) {
            	console.log('An error has occurred!', e)
            };

			// Put video listeners into place
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia(mediaConfig).then(function(stream) {
                    video.src = window.URL.createObjectURL(stream);
                    video.play();
                });
            }

            /* Legacy code below! */
            else if(navigator.getUserMedia) { // Standard
				navigator.getUserMedia(mediaConfig, function(stream) {
					video.src = stream;
					video.play();
				}, errBack);
			} else if(navigator.webkitGetUserMedia) { // WebKit-prefixed
				navigator.webkitGetUserMedia(mediaConfig, function(stream){
					video.src = window.webkitURL.createObjectURL(stream);
					video.play();
				}, errBack);
			} else if(navigator.mozGetUserMedia) { // Mozilla-prefixed
				navigator.mozGetUserMedia(mediaConfig, function(stream){
					video.src = window.URL.createObjectURL(stream);
					video.play();
				}, errBack);
			}

			// Trigger photo take
			document.getElementById('snap').addEventListener('click', function() {
				context.drawImage(video, 0, 0, 640, 480);
			});
		}, false);

		
	</script>

	<div>
            
            <input type="button" onclick="uploadEx()" value="Upload" />
           <!-- <a href="http://localhost/purchase.php">Back</a>-->
        </div>
 
        <form method="post" accept-charset="utf-8" name="form1">
            <input name="hidden_data" id='hidden_data' type="hidden"/>
            
        </form>
 
        <script>
            function uploadEx() {
                var canvas = document.getElementById("canvas");
                var dataURL = canvas.toDataURL("image/png");
                document.getElementById('hidden_data').value = dataURL;
                var fd = new FormData(document.forms["form1"]);
 
                var xhr = new XMLHttpRequest();
                xhr.open('POST', 'savephotoid.php', true);
 
                xhr.upload.onprogress = function(e) {
                    if (e.lengthComputable) {
                        var percentComplete = (e.loaded / e.total) * 100;
                        console.log(percentComplete + '% uploaded');
                        alert('Succesfully uploaded');
                    }
                };
 
                xhr.onload = function() {
 
                };
                xhr.send(fd);
            };
        </script>

</div>
</body>
</html>
<?php
 }
  else { 
    echo 'Process cannot continue, please <a href="slogin.php">Login </a>';
}

?>
