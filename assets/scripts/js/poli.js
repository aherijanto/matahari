var myflag = $('#txtindex').val();
var test = document.getElementById('TablePoli');// js

function viewItems() {
	var path = './assets/scripts/ajax';
	$('#TablePoli').html('');
	$.ajax({
		type: "POST",
		url: "/assets/scripts/ajax/getpoli.php",
		data: "",
		success: function (response) {
			$('#TablePoli').html('');
			$('#TablePoli').html(response);//ajax
			$('.linkk').bind('click', function () {
				var idpoli = $(this).attr('hreff');
				$('#txtindex').val(idpoli);
				$('#txtpoliid').val(idpoli);
				$('#PoliModal').modal('show', { backdrop: 'static' });
			})
		}
	});
}//

$(document).ready(function () {
	viewItems();
	var path1 = '/assets/scripts/ajax/';
	$('#btnAddNew').click(function () {
		$('#h1-1').html('New Poli');
		$('#txtindex').val('new');
		$('#txtpoliid').val('');
		$('#txtnamapoli').val('');
		$('#PoliModal').modal('show', { backdrop: 'static' });
	})

	$('#btnSave').click(function () {
		$('#message').removeClass();
		$('#message').html('');

		var flag = $('#txtindex').val();
		var poliid = $('#txtpoliid').val();
		var namapoli = $('#txtnamapoli').val();

		if ((namapoli.trim() == '') || (poliid == '')) {
			$('#message').removeClass();
			$('#message').addClass("alert alert-danger");
			$('#message').html("Please Fill Blank Field");
		}
		else {

			$.ajax({
				type: "POST",
				url: path1 + "savepoli.php",
				data: 'flag=' + flag.trim() + '&poliid=' + poliid.trim() + '&nmpoli=' + namapoli.trim(),
				success: function (response) {
					if (response == 'OK') {
						swal({
							title: "Poli Has Been Created",
							text: "Poli Already Save",
							timer: 3000,
							type: "success",
							showConfirmButton: false
						});
						viewItems();
						$('#PoliModal').modal('hide');
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


	$('#PoliModal').on('shown.bs.modal', function () {
		var poliid = $('#txtpoliid').val();
		myflag = $('#txtindex').val();
		if (myflag != 'new') {
			$('#h1-1').html('Edit Poli');
		}

		$.ajax({
			type: "POST",
			url: "/assets/scripts/ajax/getpolidetail.php",
			data: 'id=' + poliid,
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
								$('#txtpoliid').val(v);
								break;
							case 'nm': $('#txtnamapoli').val(v);

								break;
						}
					})
				})
			}
		})
	});

	$('#btnDelete').click(function () {
		var indexDelete = $('#txtpoliid').val();
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
					url: path1 + "deletepoli.php",
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
			url: path1 + "getpolitable.php",
			data: 'name=' + searchText,
			success: function(response){
				$('#TablePoli').html('');
				$('#TablePoli').html(response);
				$('.linkk').bind('click', function () {

					var idpoli = $(this).attr('hreff');
					$('#txtindex').val(idpoli);
					$('#txtpoliid').val(idpoli);
					$('#PoliModal').modal('show', { backdrop: 'static' });
				})
			}
		})
	})

});