var myflag = $("#txtindex").val();
var test = document.getElementById("TableWarehouse"); // js
var grandtotal1;
var pay;
var change;
var mstatus;
var tag;
var all_date;
var all_invno;
var pin = '';

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

function clear_comments(){
  $('#commentharga1').val('');
  $('#commentharga2').val('');
  $('#commentharga3').val('');
  $('#commentharga4').val('');
  $('#commentharga5').val('');
  $('#commentharga6').val('');
  $('#commentharga7').val('');
  $('#commentharga8').val('');
  $('#commentharga9').val('');
  $('#commentharga10').val('');

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

        //get item-comments
        $.ajax({
          type: "POST",
          url: "/assets/scripts/ajax/loadcomments.php",
          data: "id=" + id,
          success: function (resp_comments) {
            //clearing comment price
            clear_comments();
            //load comment price
            var jsonComments = $.parseJSON(resp_comments);
            $(jsonComments).each(function (i, val) {
              $.each(val, function (k, comments) {
                switch (k) {
                  case "message" : 
                    console.log(comments);
                    break;
                  case "c1":
                    $("#commentharga1").val(comments);
                    break;
                  case "c2":
                    $("#commentharga2").val(comments);
                    break;
                  case "c3":
                    $("#commentharga3").val(comments);
                    break;
                  case "c4":
                    $("#commentharga4").val(comments);
                    break;
                  case "c5":
                    $("#commentharga5").val(comments);
                    break;
                  case "c6":
                    $("#commentharga6").val(comments);
                    break;
                  case "c7":
                    $("#commentharga7").val(comments);
                    break;
                  case "c8":
                    $("#commentharga8").val(comments);
                    break;
                  case "c9":
                    $("#commentharga9").val(comments);
                    break;
                  case "c10":
                    $("#commentharga10").val(comments);
                    break;
                } //switch
              }); //each
            }); //jsondata
          }, //response
        });

        // get item price
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

function daysPressed(){
  $("#txtdays").on("keypress", function (e) {
    if (e.which === 13) {
      
      var _days = ($("#txtdays").val());
      if(_days == ''){
        _days=0;
      }
      changeDate(_days);
    }
  });
}

function changeDate(days){

  var nowDate = new Date();
  var chooseDate=new Date();
  chooseDate.setDate(nowDate.getDate() + parseInt(days));
   // var futureDate = chooseDate.getFullYear()+'-'+('0'+(chooseDate.getMonth()+1)).slice(-2)+'-'+('0'+(chooseDate.getDate())).slice(-2);
    console.log(chooseDate);
    $("#txtdate").val(chooseDate.toISOString().split('T')[0]);
}

function showSummary(){
  grandtotal1 = '';
  grandtotal1 = $("#txtgrandtotal").html().replace(',','').replace(',','');
  mstatus = $("#statussales").attr('mystat');
  
  console.log(mstatus);
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
  if (mstatus=="Cash"){
    $("#divdate").hide();
    $("#divdate1").hide();
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

  if(mstatus=="A/R"){
    $("#payme").hide();
    $("#mychange").hide();
    var today = new Date().toISOString().split('T')[0];
    //
    //var mm = today.getMonth() + 1;
    //daysPressed();
    $("#txtdays").val('0');
    if(tag=='edit'){
      console.log($('#invdate').html());
      $("#txtdate").val($('#invdate').html());  
    }else{
      $("#txtdate").val(today);
    }
   
  }

}

function salesSave(){
  var error;
  var duedate;
  mstatus = $("#statussales").attr('mystat');
  var _client;
  _client = $("#custid").attr('mycode');
  console.log(_client);
  console.log(mstatus);
  pay = $('#txtpayment').val();
  $('#messagesummary').html('');
  if(mstatus=="Cash"){
    if ((pay=='')||(pay=='0')){
      $('#messagesummary').html('');
      $('#messagesummary').html('Please Fill Payment or Payment Less Than..');
      error='yes';duedate='MF';
      return false;
    }else{ error='no'}
  }
  if(mstatus=="A/R"){
    var _mydate = new Date().toISOString().split('T')[0];

    if($("#txtdate").val() == _mydate){
      $('#messagesummary').html('');
      $('#messagesummary').html('Date cannot be the same..');
      return false;
    }
    if($("#txtdate").val()==''){
      $('#messagesummary').html('');
      $('#messagesummary').html('Please Fill Date..');
      error='yes';
      
      return false;
    }else{ pay='0';
    change='0';error='no';duedate=$("#txtdate").val();}
  }

  if(error="no"){  
    var noinv =$("#invno").html();
    // console.log('date is : ' + duedate);
    // console.log('client is ' +_client);
    var linkdata;
    if(tag=='new'){
      linkdata = "pay=" + pay +"&change=" + change + "&status=" + mstatus + "&duedate=" + duedate + "&client=" + _client + '&tag='+tag;
    }

    if(tag=='edit'){
      linkdata = "pay=" + pay +"&change=" + change + "&status=" + mstatus + "&duedate=" + duedate + "&client=" + _client + '&tag='+ tag + "&dateedit=" + all_date;
    }
      $.ajax({
        type: "POST",
			  crossDomain: true,
        url: "/assets/scripts/ajax/savesales.php",
        data: linkdata,
        success: function (response) {
          console.log(response);
          console.log('linkdata: ' + linkdata);
          if (response == "OKsave") {
            swal({
              title: "Item Has Been Saved",
              text: "Saved Item",
              timer: 3000,
              type: "success",
              showConfirmButton: false,
            });
            newTrans();
            if(mstatus=="Cash"){
              window.open("/assets/scripts/ajax/printsalestable.php?noinv=" + noinv,"_self");
            }

            if(mstatus=="A/R"){
              window.open("/assets/scripts/ajax/printsalesar.php?noinv=" + noinv,"_self");
            }
            
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
        } //response
      }); //ajax
  }
}
function disableF5(e) { 
  if ((e.which || e.keyCode) == 116) e.preventDefault(); };

function checkPIN(){
  var mypin=$("#yourpin").val();
  $.ajax({
    type: "POST",
    crossDomain: true,
    url: "/assets/scripts/ajax/checkpin.php",
    data: "pin=" + mypin,
    success: function (response) {
      
      if(response=='ok'){
        $("#vrifpin").modal("hide");
      }
      if(response=='failed'){
        swal({
          title: "PIN does not match",
           text: "Please contact your supervisor to access...",
           timer: 6000,
           type: "error",
           showConfirmButton: false,
         });
         window.open('searchengine1.php','_self');
      }
    } //response
  }); //ajax
}

function updatecomment(x,y,z){
  $.ajax({
    type: "POST",
    crossDomain: true,
    url: "/assets/scripts/ajax/updatecomments.php",
    data: "id=" + x + "&comment=" + y + "&pos=" + z,
    success: function (resp_update) {
      console.log(resp_update);
    } //response
  })
}
//main
$(document).ready(function () {
  $(document).on("keydown", disableF5);
 
    const getParameter = (key) => {
      // Address of the current window
      address = window.location.search
      // Returns a URLSearchParams object instance
      parameterList = new URLSearchParams(address)
      // Returning the respected value associated
      // with the provided key
      return parameterList.get(key)
    }
  
// Gets the value associated with the key "ie"
    console.log(getParameter("tag"))
  if(getParameter("tag")=='edit'){
    $("#vrifpin").modal("show", { backdrop: "static" });
    $.ajax({
      type: "POST",
      crossDomain: true,
      url: "/assets/scripts/ajax/req_pin.php",
      data: "",
      success: function (response) {
        
      } //response
    }); //ajax
    $("#btnCancelPin").click(function(){
      window.open('searchengine1.php','_self');
    })
          
    $("#btnSubmitPin").click(function(){
      checkPIN();
    })
        
    pin=0;
  }

  tag='new';
  searchnameEnterKey();
  daysPressed();
  viewItems();
  //console.log(tag);
  var tagheader;
  tagheader = $('#header-form').attr('tagme');
  //console.log('tagheader: ' +  tagheader);
  if(tagheader=='new'){
    $('#searchedit').hide();
  }
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
        txtcomment = $("#commentharga1").val();
        pos = "rem01";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga2":
        txtharga = $("#txtharga2").val();
        txtcomment = $("#commentharga2").val();
        pos = "rem02";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga3":
        txtharga = $("#txtharga3").val();
        txtcomment = $("#commentharga3").val();
        pos = "rem03";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga4":
        txtharga = $("#txtharga4").val();
        txtcomment = $("#commentharga4").val();
        pos = "rem04";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga5":
        txtharga = $("#txtharga5").val();
        txtcomment = $("#commentharga5").val();
        pos = "rem05";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga6":
        txtharga = $("#txtharga6").val();
        txtcomment = $("#commentharga6").val();
        pos = "rem06";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga7":
        txtharga = $("#txtharga7").val();
        txtcomment = $("#commentharga7").val();
        pos = "rem07";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga8":
        txtharga = $("#txtharga8").val();
        txtcomment = $("#commentharga8").val();
        pos = "rem08";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga9":
        
        txtharga = $("#txtharga9").val();
        txtcomment = $("#commentharga9").val();
        pos = "rem09";
        updatecomment(itemcode,txtcomment,pos);
        puttoarrayphp(itemcode, itemname, itemQTY,wareid, txtharga, disc, discrp);
        getGrandTotal();
        break;
      case "btnHarga10":
        txtharga = $("#txtharga10").val();
        txtcomment = $("#commentharga10").val();
        pos = "rem10";
        updatecomment(itemcode,txtcomment,pos);
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

  $('#btncancel').click(function(){
    window.open("searchengine1.php","_self");
  });

  $('#btnsearchno').click(function(){
    var searchinv = $("#invnosearch").val();
    var _custid = $("#custid").html();
    console.log('custid : '+_custid);
    tag='edit';
    //console.log(tag);
    //console.log('clicked ' + searchinv);
    $.ajax({
      type: "POST",
      url: "/assets/scripts/ajax/puttoarrayeditsales.php",
      data:
        "noinv=" + searchinv.trim() + "&custid=" + _custid,
      success: function (response) {
        //console.log(response);
        if(response=='failed'){
          swal({
            title: "Data Not Found",
             text: searchinv + " for " + _custid + " Not Found..",
             timer: 3000,
             type: "error",
             showConfirmButton: false,
           });
        }else{
            var jsonData = $.parseJSON(response);
                $(jsonData).each(function (i, val) {
                  $.each(val, function (k, v) {
                    switch (k) {
                      case "noinv":
                        $("#invno").html(v);
                        all_invno = v;
                        break;
                      case "tanggal":
                        $("#invdate").html(v);
                        // if(mstatus=='A/R'){
                          $('#txtdate').val(v);
                          all_date = v;
                          //console.log(all_date);
                        // }
                        break;
                      case "status":
                        $("#statussales").html(v);
                        $('#statussales').attr('mystat',v);
                        break;
                      case "custid":
                        $("#custid").html(v);
                        $("#custid").attr("mycode",v);
                        break;
                      case "custname":
                        $('#custname').html(v);
                        break;
                    }
                  });
                });
          
             viewItems();
          }
      }
    });
  })


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
				data: 'flag=' + flag.trim() + '&wareid=' + wareid.trim() + '&nm=' + name.trim() +if(tag=='edit'){
    $('#invdate').html(all_date);
    $('#invno').html(all_invno);

  } '&loc=' + loc.trim(),
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
