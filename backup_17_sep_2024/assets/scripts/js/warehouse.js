var myflag = $('#txtindex').val();
var test = document.getElementById('TableWarehouse');// js

function viewItems() {
	var path = './assets/scripts/ajax';
	$('#TableWarehouse').html('');
	$.ajax({
		type: "POST",
		url: "/assets/scripts/ajax/getwarehouse.php",
		data: "",
		success: function (response) {
			$('#TableWarehouse').html('');
			$('#TableWarehouse').html(response);//ajax
			$('.linkk').bind('click', function () {
				var idware = $(this).attr('hreff');
				$('#txtindex').val(idware);
				$('#txtwareid').val(idware);
				$('#WarehouseModal').modal('show', { backdrop: 'static' });
			})
		}
	});
}

$(document).ready(function () {
	viewItems();
	var path1 = '/assets/scripts/ajax/';
	
	$('#btnAddNew').click(function () {
		$('#h1-1').html('New Warehouse');
		$('#txtindex').val('new');
		$('#txtwareid').val('');
		$('#txtnama').val('');
		$('#txtloc').val('');
		
		$('#WarehouseModal').modal('show', { backdrop: 'static' });
	})

	$('#btnSave').click(function () {
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
				//var jsonData = JSON.stringify(response);
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
	})

});