var myflag = $("#txtindex").val();
var test = document.getElementById("TableWarehouse"); // js
var grandtotal1;
var pay;
var change;

function getGrandTotal() {
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/getgrandtotal.php",
    data: "",
    success: function (response) {
      var jsonData = $.parseJSON(response);
      $(jsonData).each(function (i, val) {
        $.each(val, function (k, v) {
          switch (k) {
            case "grandtotal":
              $("#txtgrandtotal").html(v);
              break;
          } //switch
        }); //each
      }); //jsondata
    }, //response
  }); //ajax
}
function viewItems() {
  var path = "./assets/scripts/ajax";
  $("#TableSales").html("");
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/getitemlist.php",
    data: "",
    success: function (response) {
      $("#TableSales").html("");
      $("#TableSales").html(response);

      $(".link1").bind("click", function () {
        var id = $(this).attr("hreff");
        //$('#message').html(id + ' removed');
        console.log(id);
        $.ajax({
          type: "POST",
          url: "/assets/scripts/ajax/removeperitemsales.php",
          data: "id=" + id,
          success: function (response) {
            if (response == "OK") {
              swal({
                title: "Item Has Been Removed",
                text: "Removed Item",
                timer: 3000,
                type: "success",
                showConfirmButton: false,
              });
            } else {
              $("#message").html(response);
            }
            getGrandTotal();
            viewItems();
          }, //response
        }); //ajax
      });
    },
  });
  getGrandTotal();
}

function newTrans() {
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/newsales.php",
    data: "",
    success: function (response) {
      if (response == "OK") {
        $("#message").html("New Transaction");
        $("#TableSales").html("");
        $("#PriceModal").modal("hide");
        $("#TableSearch").html("");
        $("#message").html("");
        $("#txtgrandtotal").html("0");
        $("#SummaryModal").modal("hide");
        $("#TableSummary").html("");
        $("#txtpayment").val("0");
        $("#txtchange").val("0");

        getGrandTotal();
      }
    },
  });
}
function puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga,disc,discrp) {
  
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/puttoarraysales.php",
    data:
      "id=" +
      itemcode.trim() +
      "&nm=" +
      itemname.trim() +
      "&qty=" +
      itemQTY.trim() +
      "&wareid=" +
      wareid.trim() +
      "&hrg=" +
      txtharga +
      "&disc=" +
      disc.trim() +
      "&discrp=" +
      discrp.trim(),
    success: function (response) {
      if (response) {
        $("#TableSales").html("");
        $("#TableSales").html(response);
        $("#PriceModal").modal("hide");
        $("#TableSearch").html("");
        removeItems();
        //$('.link1').bind('click', function () {
        //	var idware = $(this).attr('hreff');
        //	$('#message').html(idware +' link clicked');

        //$('#txtindex').val(idware);
        //$('#txtwareid').val(idware);
        //$('#priceModal').modal('show', { backdrop: 'static' });
        //});
      } //if
    },
  });
}

function searchname() {
  var itemname = $("#itemname").val();
  console.log(itemname);
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/getsearchname.php",
    data: "name=" + itemname,
    success: function (response) {
      $("#TableSearch").html("");
      $("#TableSearch").html(response);
      $(".linkk").bind("click", function () {
        var id = $(this).attr("hreff");
        $("#txtharga1").val(id);

        $("#PriceModal").modal("show", { backdrop: "static" });
      });

      $(".linkk2").bind("click", function () {
        var id = $(this).attr("hreff");
        $("#h1-1").html("");
        $("#h1-1").html("Choose Price");
        $("#txtQty").val("1");
        $("#txtdisc").val("0");
        $("#txtdiscrp").val("0");

        $.ajax({
          type: "POST",
          url: "/assets/scripts/ajax/getinventdetail.php",
          data: "id=" + id,
          success: function (response) {
            //calculate percent
            $("#txtdiscrp").on("input", function(){
              $("#txtdisc").val('0');
          });
          $("#txtdisc").on("focus", function(){
            $("#txtdiscrp").val('0');
        });
            var jsonData = $.parseJSON(response);
            $(jsonData).each(function (i, val) {
              $.each(val, function (k, v) {
                switch (k) {
                  case "id":
                    $("#txtCode").val(v);
                    break;
                  case "nm":
                    $("#txtName").val(v);
                    break;
                  case "qty":
                    $("#txtQty").val(v);
                    break;
                  case "wareid":
                      $("#txtWare").val(v);
                      break;
                  case "hrg1":
                    $("#txtharga1").val(v);
                    break;
                  case "hrg2":
                    $("#txtharga2").val(v);
                    break;
                  case "hrg3":
                    $("#txtharga3").val(v);
                    break;
                  case "hrg4":
                    $("#txtharga4").val(v);
                    break;
                  case "hrg5":
                    $("#txtharga5").val(v);
                    break;
                  case "hrg6":
                    $("#txtharga6").val(v);
                    break;
                  case "hrg7":
                    $("#txtharga7").val(v);
                    break;
                  case "hrg8":
                    $("#txtharga8").val(v);
                    break;
                  case "hrg9":
                    $("#txtharga9").val(v);
                    break;
                  case "hrg10":
                    $("#txtharga10").val(v);
                    break;
                } //switch
              }); //each
            }); //jsondata
          }, //response
        }); //ajax

        $("#PriceModal").modal("show", { backdrop: "static" }); //modal
      }); //linkk2
    },
  });
}

function removeItems() {
  var path1 = "/assets/scripts/ajax/";
  //var itemname = $('#itemname').val();
  $(".link1").bind("click", function () {
    var id = $(this).attr("hreff");
    //$('#message').html(id + ' removed');
    console.log(id);
    $.ajax({
      type: "POST",
      url: "/assets/scripts/ajax/removeperitemsales.php",
      data: "id=" + id,
      success: function (response) {
        if (response == "OK") {
          swal({
            title: "Item Has Been Removed",
            text: "Removed Item",
            timer: 3000,
            type: "success",
            showConfirmButton: false,
          });
        } else {
          $("#message").html(response);
        }
        viewItems();
      }, //response
    }); //ajax
  }); //linkremove
  getGrandTotal();
}

function searchnameEnterKey() {
  $("#itemname").on("keypress", function (e) {
    if (e.which === 13) {
      searchname();
    }
  });
}

function showSummary(){
  grandtotal1 = '';
  grandtotal1 = $("#txtgrandtotal").html().replace(',','').replace(',','');
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/getsummary.php",
    data: "",
    success: function (response) {
      $("#TableSummary").html("");
      $("#TableSummary").html(response);
      $("#SummaryModal").modal("show", { backdrop: "static" });
      $("#txtpayment").val('0');
    }  
  });
  $("#txtpayment").on("keypress", function (e) {
    if (e.which === 13) {
     pay = $('#txtpayment').val();
     change = parseInt(pay) - parseInt(grandtotal1);
    $("#txtchange").val(change);
    }
  });
  $("#txtpayment").on("input", function (e) {
    
     pay = $('#txtpayment').val();
     change = parseInt(pay) - parseInt(grandtotal1);
    $("#txtchange").val(change);
    
  });
}

function printInvoice(){
}

function salesSave(){
  
  $('#messagesummary').html('');
  if ((pay=='')||(pay=='0')){
    $('#messagesummary').html('');
    $('#messagesummary').html('Please Fill Payment or Payment Less Than..');
  }else{
    var noinv =$("#invno").html();
    
    $.ajax({
      type: "POST",
			crossDomain: true,
      url: "/assets/scripts/ajax/savesales.php",
      data: "pay=" + pay +"&change=" + change,
      success: function (response) {
        if (response == "OKsave") {
          swal({
            title: "Item Has Been Saved",
            text: "Saved Item",
            timer: 3000,
            type: "success",
            showConfirmButton: false,
          });
          newTrans();
          window.open("/assets/scripts/ajax/printsalestable.php?noinv=" + noinv,"_self");
          window.open("/assets/scripts/ajax/printdostore.php?noinv=" + noinv);
        } else {
          swal({
            title: "Save Data Invalid",
            text: "Data cannot be saved.Please try again",
            timer: 3000,
            type: "error",
            showConfirmButton: false,
          });
        }
      }, //response
    }); //ajax
  }
}


//main
$(document).ready(function () {
   
  searchnameEnterKey();
  viewItems();
  $("button").click(function (e) {
    var idClicked = e.target.id;
    var itemcode = $("#txtCode").val();
    var itemname = $("#txtName").val();
    var itemQTY = $("#txtQty").val();
    var wareid = $("#txtWare").val();
    var disc = $("#txtdisc").val();
    var discrp = $("#txtdiscrp").val();
    
    

    var txtharga = "";
    switch (idClicked) {
      case "btnHarga1":
        txtharga = $("#txtharga1").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga2":
        txtharga = $("#txtharga2").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga3":
        txtharga = $("#txtharga3").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga4":
        txtharga = $("#txtharga4").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga5":
        txtharga = $("#txtharga5").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga6":
        txtharga = $("#txtharga6").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga7":
        txtharga = $("#txtharga7").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga8":
        txtharga = $("#txtharga8").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga9":
        txtharga = $("#txtharga9").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga10":
        txtharga = $("#txtharga10").val();
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnnamesearch":
        searchname();
        break;
      case "btnnew":
        newTrans();
        break;
      case "btnpayment":
        showSummary();
        break;
      case "btnsavedata":
        salesSave();
        break;
    }
  });

  /*$('#btnSave').click(function () {
		$('#message').removeClass();
		$('#message').html('');

		var flag = $('#txtindex').val();
		var wareid = $('#txtwareid').val();
		var name = $('#txtnama').val();
		var loc = $('#txtloc').val();
		
		if ((name.trim() == '') || (wareid == '')) {
			$('#message').removeClass();
			$('#message').addClass("alert alert-danger");
			$('#message').html("Please Fill Blank Field");
		}
		else {
			$.ajax({
				type: "POST",
				url: path1 + "savewarehouse.php",
				data: 'flag=' + flag.trim() + '&wareid=' + wareid.trim() + '&nm=' + name.trim() + '&loc=' + loc.trim(),
				success: function (response) {
					if (response == 'OK') {
						swal({
							title: "New Warehouse Has Been Created",
							text: "Warehouse Already Save",
							timer: 3000,
							type: "success",
							showConfirmButton: false
						});
						viewItems();
						$('#WarehouseModal').modal('hide');
					}
					else {
						swal({
							title: "Save Data Invalid",
							text: "Data cannot be saved.Please try again",
							timer: 3000,
							type: "error",
							showConfirmButton: false
						});
					}
				}
			});
		}
	})


	$('#WarehouseModal').on('shown.bs.modal', function () {
		var wareid = $('#txtwareid').val();
		myflag = $('#txtindex').val();
		if (myflag != 'new') {
			$('#h1-1').html('Edit Warehouse');
		}

		$.ajax({
			type: "POST",
			url: "/assets/scripts/ajax/getwarehousedetail.php",
			data: 'id=' + wareid,
			success: function (response) {
				//var json = $.parseJSON(response);
				//var json = JSON.stringify(response);
				var jsonData = $.parseJSON(response);
				$(jsonData).each(function (i, val) {
					$.each(val, function (k, v) {
						switch (k) {
							case 'id': $('#txtwareid').val(v);
								$('#h1-1').val('Edit ');
								$('#txtwareid').val(v);
								break;
							case 'nm': $('#txtnama').val(v);

								break;
							case 'loc': $('#txtloc').val(v); break;
							
						}
					})
				});
			}
		});
	})

	$('#btnDelete').click(function () {
		var indexDelete = $('#txtwareid').val();
		console.log(indexDelete);
		swal({
			title: "Delete Confirmation",
			text: "Do you want to delete this data?",
			type: "warning",
			showCancelButton: true,
			confirmButtonText: "Yes, Delete",
			cancelButtonText: "No, Cancel Delete",
		},
			function () {
				$.ajax({
					type: "POST",
					url: path1 + "deletewarehouse.php",
					data: "id=" + indexDelete,
					success: function (response) {
						if (response == 'OK') {
							swal({
								title: "Delete Successful",
								text: "Data has been deleted",
								timer: 3000,
								type: "success",
								showConfirmButton: true
							});
							viewItems();
							$('#WarehouseModal').modal('hide');		
						}
					}
				})
				viewItems();
			})
	})

	$('#btnSearch').click(function(){
		var searchText= $('#txtSearch').val();
		console.log(searchText);
		$.ajax({
			type:"POST",
			url: path1 + "getcusttable.php",
			data: 'name=' + searchText,
			success: function(response){
				$('#TableCustomer').html('');
				$('#TableCustomer').html(response);
				$('.linkk').bind('click', function () {

					var idcust = $(this).attr('hreff');
					$('#txtindex').val(idcust);
					$('#txtcustid').val(idcust);
					$('#CustomerModal').modal('show', { backdrop: 'static' });
				})
			}
		})
	})*/
});
