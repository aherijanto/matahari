var myflag = $('#txtindex').val();
var test = document.getElementById('TableCustomer');// js

function viewItems() {
	var path = './assets/scripts/ajax';
	$('#TableCustomer').html('');
	$.ajax({
		type: "POST",
		url: "/assets/scripts/ajax/getcompany.php",
		data: "",
		success: function (response) {
			$('#TableCustomer').html('');
			$('#TableCustomer').html(response);//ajax
			$('.linkk').bind('click', function () {
				var idcust = $(this).attr('hreff');
				$('#txtindex').val(idcust);
				$('#txtcustid').val(idcust);
				$('#CustomerModal').modal('show', { backdrop: 'static' });
			})
		}
	});
}//

$(document).ready(function () {
	viewItems();
	var path1 = '/assets/scripts/ajax/';
	$('#btnAddNew').hide();
	$('#btnDelete').hide();

	$('#saveinvent').click(function (){
		if($('#slctwarehouse').val() == "0"){
			$('#message').html('');
			$('#message').html('Please Fill Blank Field');
		}

	})

	$('#btnAddNew').click(function () {
		$('#h1-1').html('My Profile');
		$('#txtindex').val('new');
		$('#txtcustid').val('');
		$('#txtnama').val('');
		$('#txtaddr').val('');
		$('#txtphone').val('');
		$('#txtcity').val('');
		$('#CustomerModal').modal('show', { backdrop: 'static' });
	})

	$('#btnSave').click(function () {
		$('#message').removeClass();
		$('#message').html('');

		var flag = $('#txtindex').val();
		var custid = $('#txtcustid').val();
		var name = $('#txtnama').val();
		var spc = $('#txtspc').val();
		var addr = $('#txtaddr').val();
		var phone = $('#txtphone').val();
		var city = $('#txtcity').val();

		if ((name.trim() == '') || (custid == '')) {
			$('#message').removeClass();
			$('#message').addClass("alert alert-danger");
			$('#message').html("Please Fill Blank Field");
		}
		else {

			$.ajax({
				type: "POST",
				url: path1 + "savecust.php",
				data: 'flag=' + flag.trim() + '&custid=' + custid.trim() + '&nm=' + name.trim() + '&spc=' + spc.trim() + '&addr=' + addr.trim() + '&ph=' + phone.trim() + '&city=' + city.trim(),
				success: function (response) {
					if (response == 'OK') {
						swal({
							title: "Doctor Has Been Created",
							text: "Doctor Already Save",
							timer: 3000,
							type: "success",
							showConfirmButton: false
						});
						viewItems();
						$('#CustomerModal').modal('hide');
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


	$('#CustomerModal').on('shown.bs.modal', function () {
		var custid = $('#txtcustid').val();
		myflag = $('#txtindex').val();
		if (myflag != 'new') {
			$('#h1-1').html('Edit Profile');
		}

		$.ajax({
			type: "POST",
			url: "/assets/scripts/ajax/getcompanydetail.php",
			data: 'id=' + custid,
			success: function (response) {
				//var json = $.parseJSON(response);
				//var json = JSON.stringify(response);
				var jsonData = $.parseJSON(response);
				//var jsonData = JSON.stringify(response);
				$(jsonData).each(function (i, val) {
					$.each(val, function (k, v) {
						switch (k) {
							case 'id': $('#txtindex').val(v);
								$('#h1-1').val('Edit ');
								$('#txtcustid').val(v);
								break;
							case 'nm': $('#txtnama').val(v);

								break;
							case 'addr1': $('#txtaddr1').val(v); break;
							case 'addr2': $('#txtaddr2').val(v); break;
							case 'city': $('#txtcity').val(v); break;
							case 'phone': $('#txtphone').val(v); break;
							case 'email': $('#txtemail').val(v); break;
						}
					})
				})
			}
		})
	});

	$('#btnDelete').click(function () {
		var indexDelete = $('#txtcustid').val();
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
					url: path1 + "deletecust.php",
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
							$('#CustomerModal').modal('hide');		
						}
					}
				});
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
	})

});