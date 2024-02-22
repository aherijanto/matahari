$(document).ready(function () {
   var PATH = "http://senang.mimoapps.xyz/apis/up_sync_matahari/";
   
    $("#syncupload").click(function(e){
        var dataget;
       var notif;
        $("#msg").show();
        $("#msg").html("Upload in progress ...");
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/sync/sync_wsellhead.php",
            data: "",
            success: function (response1) {
              dataget = response1;
             
              $.ajax({
                type: "POST",
                url: PATH + "syncwsellhead.php",
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
            url: "/assets/scripts/ajax/sync/sync_wselltail.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwselltail.php",
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
            url: "/assets/scripts/ajax/sync/sync_wcustomers.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwcustomers.php",
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
            url: "/assets/scripts/ajax/sync/sync_wsuppliers.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwsuppliers.php",
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
            url: "/assets/scripts/ajax/sync/sync_winventory.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwinventory.php",
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
            url: "/assets/scripts/ajax/sync/sync_wbuyhead.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwbuyhead.php",
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
            url: "/assets/scripts/ajax/sync/sync_wbuytail.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwbuytail.php",
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
            url: "/assets/scripts/ajax/sync/sync_wwarehouse.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwwarehouse.php",
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
            url: "/assets/scripts/ajax/sync/sync_waccountr.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwaccountr.php",
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
            url: "/assets/scripts/ajax/sync/sync_waccountp.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwaccountp.php",
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
            url: "/assets/scripts/ajax/sync/sync_wgroups.php",
            data: "",
            success: function (response1) {
              dataget = response1;
              $.ajax({
                type: "POST",
                url: PATH+"syncwgroups.php",
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
