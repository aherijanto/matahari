/*-----------------------------------------
Created by  : Ary H 
Project     : Inventory
Date        : January, 2022
-----------------------------------------*/

//main
$(document).ready(function () {
    
        $("#export").click(function(){
            var mydate1 = $("#mydate1").val();
            var mydate2 = $("#mydate2").val();
           
            if((mydate1=="")||(mydate2=="")){
                swal({
                    title: "Please input date",
                    text: "Some value need to be filled",
                    timer: 3000,
                    type: "warning",
                    showConfirmButton: false,
                  });
            }else{
                window.open('./assets/scripts/ajax/exportxls.php?mydate1='+mydate1+'&mydate2='+mydate2);
                swal({
                    title: "Export to Microsoft Excel",
                    text: "Export succesfully exported",
                    timer: 3000,
                    type: "success",
                    showConfirmButton: false,
                  });
            }
            
          
    //         $.ajax({
    //             type: "POST",
    //             url: "/assets/scripts/ajax/exportxls.php",
    //             data: "mydate1=" + mydate1+"&mydate2="+mydate2,
    //             success:function(params) {
    //                 //$('#detail').html(params);
    //                 var jsonObject = $.parseJSON(params); //Only if not already an object
    //                 var ws = XLSX.utils.json_to_sheet(jsonObject);
    //                 filename='reports.xlsx';
    //                 var wb = XLSX.utils.book_new();
    //                 XLSX.utils.book_append_sheet(wb, ws, "People");
    //                 XLSX.writeFile(wb,filename);
    //                 $.each(jsonObject, function (i, obj) {
    //                     console.log(obj.no+' '+obj.invdate);
                        
    // //    //data=[{Market: "IN", New Arrivals: "6", Upcoming Appointments: "2", Pending - 1st Attempt: "4"},
    // //         {Market: "KS/MO", New Arrivals: "4", Upcoming Appointments: "4", Pending - 1st Attempt: "2"},
    // //         {Market: "KS/MO", New Arrivals: "4", Upcoming Appointments: "4", Pending - 1st Attempt: "2"},
    // //         {Market: "KS/MO", New Arrivals: "4", Upcoming Appointments: "4", Pending - 1st Attempt: "2"}]
        
    //                 });

                    
    //             }
                
    //         });
        })

        $("#cancel").click(function(){
            window.open('dashboard.php','_self');
        })
});
