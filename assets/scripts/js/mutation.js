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
$(document).ready(function () {
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
                    $("#srcdetail").html("");
                    $("#srcdetail").html("Name : "+obj.iname+"<br>"+"Qty : "+obj.iqty+" (current)<br>"+"Ware Name: "+obj.warename+"<br>"+"Input Qty : ");
                    $("#srcdetail").append('<input type="text" id="qtysrc" value="0" />');
                    $('#qtysrc').on("input",function(e){
                        var qtysrc = $("#qtysrc").val();
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
                    var qtydest = $("#qtysrc").val();
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
        console.log(totalsrcqty)
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