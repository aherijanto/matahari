function nView(){
    var icode="";
    $.ajax({
        type: "POST",
        url: "/assets/scripts/ajax/getinventory.php",
        data: "icode=" + icode,
        success: function (response) {
            console.log(response);
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
            url: "/assets/scripts/ajax/saveupdatemutation.php",
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

function updateInventory(codesrc,codedst,qtysrc,qtydest){
    $.ajax({
        type: "POST",
        url: "/assets/scripts/ajax/updatemutationinvent.php",
        data: "icodesource=" + codesrc + "&icodedestination=" + codedst + "&qtysource=" + qtysrc + "&qtydestination=" + qtydest,
        success: function (response) {
            console.log(response);
        }
    });
}

$(document).ready(function () {
    var codesrc;
    var codedst;
    var qtysrc;
    var qtydest;
    var codedst;
    var codesrc;

    nView();
    $('#source').on('change', function() {
        if(this.value=="0"){
            $('#srcdetail').html('');
        }else{
            codesrc = this.value;
            console.log('codesrc : ' + codesrc);
        }
        $('#destdetail').html('');
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getinventory.php",
            data: "icode=" + this.value,
            success: function (response) {
                var jsonObject = $.parseJSON(response); //Only if not already an object
                
                $.each(jsonObject, function (i, obj) {
                    $("#srcdetail").html("");
                    $("#srcdetail").html("Name : "+obj.iname+"<br>"+"Qty : "+obj.iqty+" (current)<br>"+"Ware Name: "+obj.warename+"<br>"+"Input Qty : ");
                    $("#srcdetail").append('<input type="text" id="qtysrc" value="0" />');
                    $('#qtysrc').on("input",function(e){
                        qtysrc = $("#qtysrc").val();
                        var totalsrc = parseInt(obj.iqty)-parseInt(qtysrc);

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
        }else{
            codedst = this.value;
            console.log('code dest: '+codedst)
        }
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getinventory.php",
            data: "icode=" + this.value,
            success: function (response) {
                var jsonObject = $.parseJSON(response); //Only if not already an object
                
                $.each(jsonObject, function (i, obj) {
                    $("#destdetail").html("");
                    $("#destdetail").html("Name : "+obj.iname+"<br>"+"Qty : "+obj.iqty+" (current)<br>"+"Ware Name: "+obj.warename+"<br>"+"Input Qty : ");
                    $("#destdetail").append('<input type="text" id="qtydest" value="0" readonly/>');
                    qtydest = $("#qtysrc").val();
                    iqtydest = obj.iqty;
                    console.log("change dst "+iqtydest);
                    $('#qtydest').val(qtydest);
                    var totaldest = parseInt(obj.iqty)+parseInt(qtydest);
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
        console.log(totalsrcqty);
        swal({
            title: 'Are you sure to do item mutation?',
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
                        updateInventory(codesrc,codedst,qtysrc,qtydest);
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
        );

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