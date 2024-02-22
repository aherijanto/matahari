$(document).ready(function () {
  $("#btnactions").hide();
  var noinv;
  $("#btnprocess").click(function (e) {
    noinv=$("#inputinv").val();
    $.ajax({
      type: "POST",
      url: "/assets/scripts/ajax/getdetailreprint.php",
      data: "inputinv=" + noinv,
      success: function (response) {
        console.log(response);
        if(response=='0'){
          $("#reprintdetail").hide();
        }else{
          $("#reprintdetail").html("");
          $("#reprintdetail").html(response);
          $("#reprintdetail").show();
          $("#btnactions").show();
        }
      }
    });
  });
    
    $("#btnreprintdo").click(function (e) {  
      window.open("/assets/scripts/ajax/printdostore.php?noinv=" + noinv);
    });

    $("#btnreprintinv").click(function (e) {
      window.open("/assets/scripts/ajax/printsalestable.php?noinv=" + noinv);
    });
});