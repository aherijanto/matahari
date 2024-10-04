/*-----------------------------------------
Created by  : Ary H 
Project     : Inventory
Date        : January, 2022
-----------------------------------------*/
var myflag = $("#txtindex").val();
var test = document.getElementById("TableWarehouse"); // js
var grandtotal1;
var pay;
var change;
var mstatus;


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
    url: "/assets/scripts/ajax/newaccr.php",
    data: "",
    success: function (response) {
      console.log(response);
      if (response == "OK") {
        $("#accrdetail").html("");
      }
    },
  });
}
function puttoarrayaccr(mydate,mytype,mynocheque,myamount) {
  
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/puttoarrayaccr.php",
    data:
      "mydate=" +
      mydate.trim() +
      "&mytype=" +
      mytype.trim() +
      "&mynocheque=" +
      mynocheque.trim()+
      "&myamount=" +
      myamount.trim(),
    success: function (response) {
      if (response) {
        $("#accrdetail").html("");
        $("#accrdetail").html(response);
        checkdetailaccr();
        //removeItems();
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

// 

function accrSave(noinv){
  
    var noinv =$("#noinv").html();
   
      $.ajax({
        type: "POST",
			  crossDomain: true,
        url: "/assets/scripts/ajax/saveaccr.php",
        data: "myinvno="+noinv.trim(),
        success: function (response) {
          console.log(response);
          if (response == "OKsave") {

            swal({
              title: "Item Has Been Saved",
              text: "Saved Item",
              timer: 3000,
              type: "success",
              showConfirmButton: false,
            });
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

function getHistory(myinv){
  $.ajax({
    type: "POST",
    url: "/assets/scripts/ajax/gethistoryaccr.php",
    data: "inputinv=" + myinv,
    success: function (response) {
      console.log(response);
      if(response=='0'){
        $("#historyaccr").hide();
      }else{
        $("#historyaccr").html("");
        $("#historyaccr").html(response);
        $("#historyaccr").show();
        var grandhist = Math.round($("#grandhist").html());
        var grandtotal1 = Math.round($("#grandtotal1").html());
        var remaining = (grandhist - grandtotal1).toLocaleString();

        // console.log(grandhist);
        // console.log(grandtotal1);
        // console.log(remaining);
        if(remaining=='0'){
          $("#remainingmedium").css({
            'color':'#008000',
            'font-size':'24px',
            'font-weight':'bold'
          });  
          $("#accr").hide();
        }else{
          $("#remainingmedium").css({
            'color':'red',
            'font-size':'24px',
            'font-weight':'bold'
          });
          $("#accr").show();
        }

        $("#remainingmedium").html(remaining);
        
      }
    }
  });
}

function checkdetailaccr(){
  if($("#accrdetail").html()==''){
    $("#btnaction").hide();
  }else{
    $("#btnaction").show();
  }
}
//main
$(document).ready(function () {
  var grandtotalarray=0;
  var grandmf;
  var grandtotal1;
  newTrans();
  var mf_array=[];
    $("#accr").hide();
    $("#historyaccr").hide();
    checkdetailaccr();
    $("#btnsearch").click(function(e){
        noinv = $("#srchInv").val();
        $.ajax({
            type: "POST",
            url: "/assets/scripts/ajax/getinvaccr.php",
            data: "inputinv=" + noinv,
            success: function (response) {
             
              if(response=='NotFound'){
                $("#accr").hide();
              }else{
                $("#infoinvaccr").html("");
                $("#infoinvaccr").html(response);
                grandtotal1 = Math.round($("#grandtotal1").html());
                console.log("grandtotal1-search = " + grandtotal1);
                $("#accr").show();
                $("#nocheque").val();
                $("#amount").val('0');
                getHistory(noinv);
              }
            }
        });        
    })
    
    $('#typepay').on('change', function() {
      var mytype =$("#typepay").val();
      if(mytype=="cash"){
        $("#nocheque").val(mytype);
      }else{
        $("#nocheque").val('');
      }
      
    });
    
    $("#addtolist").click(function(e){
      //
      mydate = $("#dateaccr").val();
      mytype = $("#typepay").val();
      mynocheque = $("#nocheque").val();
      myamount = $("#amount").val();
      grandtotal1 = Math.round($("#grandtotal1").html());
      console.log('grandtotal1 = '+grandtotal1);
      if($("#remainingmedium").length){
        
        var remaining = Math.round($("#remainingmedium").html().replace(",","").replace(",",""));
        var absremaining = Math.abs(remaining);//Math.abs(parseInt(remaining));
        if(absremaining==0){
          absremaining=grandtotal1;
        }
        console.log("absreamingng-length= "+absremaining);
        var exist=true;
      }else{
        var absremaining=grandtotal1;
        console.log("absreamingng-else= "+absremaining);
        var exist=false;
      }
      //console.log("absreamining-after = "+absremaining);
      
      // console.log("myamount= "+ myamount);
      
      if(mydate!=''&&mytype!=''&&mynocheque!=''&&myamount!=0){ 
        grandmf=0;
        grandmf = grandtotalarray + parseInt(myamount);
        console.log("GranMF = " +grandmf);
        if((myamount==absremaining)&&(grandmf==absremaining)){
          mf_array.push(myamount);
          
          for(var loop=0;loop < mf_array.length; loop++){
            grandtotalarray=grandtotalarray + parseInt(mf_array[loop]);
          }
          //console.log("isi array " + mf_array);
          puttoarrayaccr(mydate,mytype,mynocheque,myamount);
          $("#nocheque").val('');
          $("#amount").val('0'); 
          return false;
        }

        if(myamount>absremaining) {
          alert("Please input less than Remaining...");
          $("#nocheque").val('');
          $("#amount").val('0'); 
          return false;
        }
        
        if((grandmf>absremaining)){
          alert("Reach maximum payment");
          //console.log("inside if = "+mf_array);
          $("#nocheque").val('');
          $("#amount").val('0'); 
          console.log("grandmf>absremaining =" + mf_array);
          grandmf=0;
          return false;
        }else{
          
          if(grandmf<absremaining){
            grandtotalarray=0;
            mf_array.push(myamount);
            for(var loop=0;loop < mf_array.length; loop++){
              grandtotalarray=grandtotalarray + parseInt(mf_array[loop]);
            }
            puttoarrayaccr(mydate,mytype,mynocheque,myamount);
            console.log("grandmf<absremaining =" + mf_array);
            grandmf=0;
          }
          if(grandmf==absremaining){
            grandtotalarray=0;
            mf_array.push(myamount);
            for(var loop=0;loop < mf_array.length; loop++){
              grandtotalarray=grandtotalarray + parseInt(mf_array[loop]);
            }
            puttoarrayaccr(mydate,mytype,mynocheque,myamount);
            console.log("grandmf==absremaining =" + mf_array);
            grandmf=0;
          }
        }
       
        
        
        $("#nocheque").val('');
        $("#amount").val('0');        
      }else{
        alert('Please input value ');
      }
    })

    $("#btnsave").click(function(e){
      myinvno = $("#noinv").html();
      accrSave(myinvno);
      getHistory(myinvno);
      newTrans();
      grandmf = 0;
      mf_array=[];
      grandtotalarray=0;
     $("#btnaction").hide();
    })

    $("#btnclear").click(function(e){
      newTrans();
      $("#btnaction").hide();
      mf_array=[];
      grand_mf=0;
      grandtotalarray=0;
      absremaining=0;
    })
});
