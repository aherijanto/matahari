function nView(){
    var icode="";
    $.ajax({
        type: "POST",
        url: "/assets/scripts/ajax/getinventory.php",
        data: "icode=" + icode,
        success: function (response) {
            var selectsource = $("#source");
            var selectdestination = $("#destination");
            var jsonObject = $.parseJSON(response);
            $.each(jsonObject, function (index, json) {
                selectsource.append($("<option></option>")
                .attr("value", json.icode).text(json.ibarcode+" - " + json.iname));
                selectdestination.append($("<option></option>")
                .attr("value", json.icode).text(json.ibarcode+" - " + json.iname));
            });
        }
      });
}
function showSuccessSwal() {
    console.log('inside the second swal');
    swal({
        title: "Saved Successfully!",
        text: "Your data has been saved successfully.",
        type: "success",
        showConfirmButton: false,
        timer: 6000
    });
}

function saveData(codesrc, codedst, qtysrc) {
    return new Promise(function(resolve, reject) {
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/saveupdateconversion.php",
            data: "con_from=" + codesrc + "&con_to=" + codedst + "&con_qtyfrom=" + qtysrc + "&con_qtyto=" + qtysrc + "&username=mimo",
            success: function(response) {
                resolve(response);
            },
            error: function(error) {
                reject(error);
            }
        });
    });
}

$(document).ready(function () {
   var codesrc;
   var codedst;
   var qtysrc;
   var qtydst;

   var iqtydest;
    nView();
    $('#source').on('change', function() {
        if(this.value=="0"){
            $('#srcdetail').html('');
        }
        $('#destdetail').html('');
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getinventory.php",
            data: "icode=" + this.value,
            success: function (response) {
                var jsonObject = $.parseJSON(response); //Only if not already an object
                
                $.each(jsonObject, function (i, obj) {
                    codesrc = obj.icode;
                    $("#srcdetail").html("");
                    $("#srcdetail").html("Name : \t"+obj.iname+"<br>"
                                        +"Qty : "+obj.iqty+" " + obj.iunit+" (current)<br>"
                                        +"Volume Per Item : "+obj.ivol+"  (isi setiap "+obj.iunit+")<br>"
                                        +"Satuan Volume: "+ obj.ivolunit + "<br>"
                                        +"Total Volume: " + (obj.ivol * obj.iqty)+ " " + obj.ivolunit+"<br>"
                                        +"Ware Name: "+obj.warename+"<br>"
                                        +"Input Volume : ");

                    $("#srcdetail").append('<input type="text" id="qtysrc" value="0" />');
                    $('#qtysrc').on("input",function(e){
                        qtysrc = $("#qtysrc").val();
                        var total_volume = obj.ivol * obj.iqty;
                        var totalsrc = parseInt(total_volume)-parseInt(qtysrc);

                        $('#qtydest').val(qtysrc);
                        
                        var qqtydest = $('#qtydest').val();
                        var totaldest1 = parseInt(iqtydest)+parseInt(qqtydest);
                      
                        if($("#totalsrc").length===0){
                            $("#srcdetail").append('<br>Estimated : <label id="totalsrc">'+totalsrc+'</label>');
                        }else{
                            $("#totalsrc").html(totalsrc);
                        }
                        if($("#totaldest").length===0){
                            $("#destdetail").append('Estimated : <label id="totaldest">'+totaldest1+'</label>');
                        }else{
                            $("#totaldest").html(totaldest1);
                        }
                    });

                });
            }
      });
    });

    $('#destination').on('change', function() {
        if(this.value=="0"){
            $('#destdetail').html('');
        }
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getinventory.php",
            data: "icode=" + this.value,
            success: function (response) {
                var jsonObject = $.parseJSON(response); //Only if not already an object
                
                $.each(jsonObject, function (i, obj) {
                    codedst= obj.icode;
                    $("#destdetail").html("");
                    $("#destdetail").html("Name : "+obj.iname+"<br>"
                                        +"Qty : "+obj.iqty+" " + obj.iunit+" (current)<br>"
                                        +"Volume Per Item : "+obj.ivol+"<br>"
                                        +"Satuan Volume: "+obj.ivolunit+"<br>"
                                        +"Total Volume: " + (obj.ivol * obj.iqty)+ " " + obj.ivolunit+"<br>"
                                        +"Ware Name: "+obj.warename+"<br>"
                                        +"Transferred Volume : ");
                    $("#destdetail").append('<input type="text" id="qtydest" value="0" readonly/>');
                    var qtydest = $("#qtysrc").val();
                    iqtydest = obj.iqty;
                    var total_volume1 = obj.ivol * obj.iqty;
                    console.log("change dst "+iqtydest);
                    $('#qtydest').val(qtydest);
                    var totaldest = parseInt(total_volume1)+parseInt(qtydest);
                    if($("#totaldest").length===0){
                        $("#destdetail").append('<br>Estimated : <label id="totaldest">'+totaldest+'</label>');
                    }else{
                        $("#totaldest").html(totaldest);
                    }
                });
            }
      });
    });

    $("#process").click(function(){
        var totalsrcqty = $("#totalsrc").html();
        console.log(totalsrcqty)
        swal({
            title: 'Are you sure to save?',
            text: "Please make sure the data is valid before you proceed, You won't be able to revert this!",
            type: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Confirm!'
        },function(isConfirm){
            if (isConfirm) {
                saveData(codesrc, codedst, qtysrc).then(function(response) {
                    if (response == 1) {
                        console.log('second swal');
                        showSuccessSwal(); // Function to display success message with swal
                    } else {
                        // Handle error response
                    }
                });
            } else {
                alert('closed');
            }
                // if (isConfirm){
                //     //console.log(qtysrc);
                //     $.ajax({
                //         type: "POST",
                //         url: "/assets/scripts/ajax/saveupdateconversion.php",
                //         data: "con_from=" + codesrc + "&con_to=" + codedst + "&con_qtyfrom=" + qtysrc + "&con_qtyto=" + qtysrc + "&username=mimo",
                //         success: function (response) {
                //             console.log(response);
                //             // var json_reply = $.parseJSON(response); //Only if not already an object
                //             // $.each(json_reply,function (i, objresp) {
                //             //     reply = objresp.reply;
                //             //     console.log(reply);
                               
                //              if(response == 1){
                //                 showSuccessSwal();
                //              }       
    

                                
                                
                //             // })
                            
                //         }
                //     });// close ajax

                // } else {
                //     alert('closed');
                // }
            }
        );//swal closed bracket
    })

    $("#cancel").click(function(){
        window.open('dashboard.php','_self');
    })
    
//   $("#btnactions").hide();
//   var noinv;
//   $("#btnprocess").click(function (e) {
//     noinv=$("#inputinv").val();
//     $.ajax({
//       type: "POST",
//       url: "/assets/scripts/ajax/getdetailreprint.php",
//       data: "inputinv=" + noinv,
//       success: function (response) {
//         console.log(response);
//         if(response=='0'){
//           $("#reprintdetail").hide();
//         }else{
//           $("#reprintdetail").html("");
//           $("#reprintdetail").html(response);
//           $("#reprintdetail").show();
//           $("#btnactions").show();
//         }
//       }
//     });
//   });
    
//     $("#btnreprintdo").click(function (e) {  
//       window.open("/assets/scripts/ajax/printdostore.php?noinv=" + noinv);
//     });

//     $("#btnreprintinv").click(function (e) {
//       window.open("/assets/scripts/ajax/printsalestable.php?noinv=" + noinv);
//     });
});