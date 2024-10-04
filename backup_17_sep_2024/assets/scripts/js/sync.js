$(document).ready(function () {
   
    $("#syncme").click(function(e){
        var dataget;
       var notif;
        $("#msg").show();
        $("#msg").html("Sync in progress ...");
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/sync/sync_wsellhead.php",
            data: "",
            success: function (response1) {
              dataget = response1;
             
              $.ajax({
                type: "POST",
                url: "http://senang.mimoapps.xyz/apis/syncwsellhead.php",
                data: response1,
                processData: false,
                //dataType: 'json',
                success: function (response) {
                    console.log('sellhead : '+response);
                    notif+='sellhead ok \n ';
                    
                   
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
                url: "http://senang.mimoapps.xyz/apis/syncwselltail.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log('selltail : '+response);
                    notif+='selltail ok \n ';
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
                url: "http://senang.mimoapps.xyz/apis/syncwcustomers.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log('customers : '+response);
                    notif+='customers ok \n ';
                    
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
                url: "http://senang.mimoapps.xyz/apis/syncwsuppliers.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log('suppliers : '+response);
                    notif+='suppliers ok \n ';
                   
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
                url: "http://senang.mimoapps.xyz/apis/syncwinventory.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("inventory : " + response);
                    notif+='inventory ok \n ';
                   
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
                url: "http://senang.mimoapps.xyz/apis/syncwbuyhead.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("buyhead : " + response);
                    notif+='buyhead ok \n ';
                    
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
                url: "http://senang.mimoapps.xyz/apis/syncwbuytail.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("buytail : " + response);
                    notif+='buytail ok \n ';
                   
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
                url: "http://senang.mimoapps.xyz/apis/syncwwarehouse.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("warehouse : " + response);
                    notif+='warehouse ok \n ';
                    
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
                url: "http://senang.mimoapps.xyz/apis/syncwaccountr.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("account_r : " + response);
                    notif+='warehouse ok \n ';
                    
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
                url: "http://senang.mimoapps.xyz/apis/syncwaccountp.php",
                data: response1,
                processData: false,
                success: function (response) {
                    console.log("account_p : " + response);
                    notif+='warehouse ok \n ';
                    
                }
                });         
            }
        });
     
    })
    
    

});
