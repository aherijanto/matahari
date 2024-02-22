$(document).ready(function () {
   var PATH = "http://senang.mimoapps.xyz/apis/down_sync_matahari/";
   var PATHLOCALE = "/assets/scripts/ajax/sync_download/"
   
    $("#syncdownload").click(function(e){
        var dataget;
       var notif;
       console.log("Download...");
        $("#msg").show();
        $("#msg").html("Download data from remote ...");
        $.ajax({
            type: "POST",
            url: PATH+"sync_wsellhead.php",
            data: "",
            success: function (response1) {
              dataget = response1;
             
              $.ajax({
                type: "POST",
                url: PATHLOCALE + "syncwsellhead.php",
                data: response1,
                processData: false,
                //dataType: 'json',
                success: function (response) {
                   
                    console.log('sellhead : '+response);
                   
                }
                });         
            }
            
        });
        
        $.ajax({
            type: "POST",
            url: PATH+"sync_wselltail.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwselltail.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log('selltail : '+response);
                    
                    $("#msg").html('Done .....');

                }
                });         
            }
        });

        $.ajax({
            type: "POST",
            url: PATH+"sync_wcustomers.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwcustomers.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log('customers : '+response);
                    
                }
                });         
            }
        });

        $.ajax({
            type: "POST",
            url: PATH+"sync_wsuppliers.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwsuppliers.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log('suppliers : '+response);
                    
                }
                });         
            }
        });

        $.ajax({
            type: "POST",
            url: PATH+"sync_winventory.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwinventory.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("inventory : " + response);
                    
                }
                });         
            }
        });

        $.ajax({
            type: "POST",
            url: PATH+"sync_wbuyhead.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwbuyhead.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("buyhead : " + response);
                    
                }
                });         
            }
        });

        $.ajax({
            type: "POST",
            url: PATH+"sync_wbuytail.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwbuytail.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("buytail : " + response);
                   
                }
                });         
            }
        });

        $.ajax({
            type: "POST",
            url: PATH+"sync_wwarehouse.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwwarehouse.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("warehouse : " + response);
                    
                }
                });         
            }
        });
       
        $.ajax({
            type: "POST",
            url: PATH+"sync_waccountr.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwaccountr.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("account_r : " + response);
                    
                }
                });         
            }
        });
        
        $.ajax({
            type: "POST",
            url: PATH+"sync_waccountp.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwaccountp.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("account_p : " + response);
                    
                    
                }
                });         
            }
        });

        $.ajax({
            type: "POST",
            url: PATH+"sync_wgroups.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATHLOCALE+"syncwgroups.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("groups : " + response);
                    
                }
                });         
            }
        });
     
    })

});
