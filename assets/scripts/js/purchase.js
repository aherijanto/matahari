$(document).ready(function () {
    $("#btnsearchpcs").click(function() {
       
        let noinvmf = $("#txtpcssearch").val();
        if (noinvmf == ''){
            alert('Please type proper invoice no...');
        }else{
            $.ajax({
                type: "POST",
                url: "/assets/scripts/ajax/puttoarrayeditpurchase.php",
                data:"noinv=" + noinvmf.trim(),
                success: function (response) {
                  console.log(response);
                  if(response=='failed'){
                    swal({
                      title: "Data Not Found",
                       text: "Invoice No : "+ noinvmf +" Not Found..",
                       timer: 3000,
                       type: "error",
                       showConfirmButton: false,
                     });
                  }else{
                    var path = "./assets/scripts/ajax";
                    $("#TablePurchasing").html("");
                    $.ajax({
                      type: "POST",
                      url: "/assets/scripts/ajax/getitemlistpurchase.php",
                      data: "",
                      crossDomain: true,
                      success: function (response) {
                        console.log(response);
                        $("#TablePurchasing").html("");
                        $("#TablePurchasing").html(response);
                      }
                    });
                    }
                }
            });
        
        }
    });
});