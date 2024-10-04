/*-----------------------------------------
Created by  : Ary H 
Project     : Inventory
Date        : July, 2022
-----------------------------------------*/

//main
$(document).ready(function () {
    $("#deleteno").val('');
    $("#pin").val('');

        $("#btnquery").click(function(){
            var delno = $('#deleteno').val();
            var mypin = $('#pin').val();
            
            if ((delno == '')||(mypin=='')){
                alert("Empty Text...");
                return 0;
            }else{
                var dt = new Date();
                
                var time = dt.getHours().toString() + dt.getMinutes().toString();
                month = (dt.getMonth() + 1).toString().padStart(2, "0");
                day   = dt.getDate().toString().padStart(2, "0"); 
                var delno1 = $('#deleteno').val();
                var pinpin = $('#pin').val();
                
                if(pinpin!=(time+day+month)){
                    alert("Invalid Pin!");
                    return 0;
                }else{
                    $.ajax({
                        type: "POST",
                        url: "/assets/scripts/ajax/getdetailtrans.php",
                        data: "noinv=" + delno1.trim(),
                        success: function (response) {
                        
                            if(response=="Failed"){
                                swal({
                                    title: "Data Not Found",
                                    text: "Canceled",
                                    timer: 3000,
                                    icon: "success",
                                    buttons: false
                                });
                            }else{
                                $("#TableSummary").html("");
                                $("#TableSummary").html(response);
                                $("#SummaryModal").modal("show", { backdrop: "static" });
                            }
                            
                        }//end response
                    });//ajax
                }
            }
        });

        $("#btndeltrans").click(function(){
            var delno1 = $('#deleteno').val();
            $("#TableSummary").html("");
            $("#TableSummary").hide();
            $("#SummaryModal").modal("hide");
            //start swal
            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this invoice!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                closeOnConfirm: false,
            }, function (isConfirm) {
                    if (!isConfirm) return;
                    var delno1 = $('#deleteno').val();
                    
                    $.ajax({
                        type: "POST",
                        url: "/assets/scripts/ajax/deltransno.php",
                        data: "noinv=" + delno1.trim(),
                        success: function (response1) {
                            if(response1 == 'OK'){
                                swal({
                                    title: "Data Removed",
                                    text: "Item has been deleted",
                                    timer: 3000,
                                    icon: "success",
                                    buttons: false
                                });
                                $('#deleteno').val('');
                            }
                        }
                    });
            }); 
                        // //end swal 
        });
               
    
        $("#btnback").click(function(){
            window.open('dashboard.php','_self');
        });

       
});
