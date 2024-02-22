/*-----------------------------------------
Created by  : Ary H 
Project     : Inventory
Date        : January, 2022
-----------------------------------------*/

//main
$(document).ready(function () {
  
    $("#accrnotif").hide();
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getnotifaccr.php",
            data: "_date=all",
            success: function (response) {
             
              if(response=='NotFound'){
                $("#accrnotif").hide();
              }else{
                $("#accrnotif").html("");
                $("#accrnotif").html(response);
                
                $("#accrnotif").show();
              }
            }
        });
    
        $("#todaybtn").click(function(){
      
          $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getnotifaccr.php",
            data: "_date=today",
            success: function (response) {
             
              if(response=='NotFound'){
                $("#accrnotif").hide();
              }else{
                $("#accrnotif").html("");
                $("#accrnotif").html(response);
                
                $("#accrnotif").show();
              }
            }
        });
        })

        $("#allbtn").click(function(){
      
          $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getnotifaccr.php",
            data: "_date=all",
            success: function (response) {
             
              if(response=='NotFound'){
                $("#accrnotif").hide();
              }else{
                $("#accrnotif").html("");
                $("#accrnotif").html(response);
                
                $("#accrnotif").show();
              }
            }
        });
        })

    $("#refreshbtn").click(function(){
      
      var _date = $('#_date').val();
      console.log(_date);
      $.ajax({
        type: "POST",
        url: "/assets/scripts/ajax/getnotifaccr.php",
        data: "_date="+_date,
        success: function (response) {
         
          if(response=='NotFound'){
            $("#accrnotif").hide();
          }else{
            $("#accrnotif").html("");
            $("#accrnotif").html(response);
            
            $("#accrnotif").show();
          }
        }
    });
    })
});
