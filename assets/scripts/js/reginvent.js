
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

$(document).ready(function () {
	
	var path1 = '/assets/scripts/ajax/';
	var itemcode = $('#icode').val();
	var comment = $('#txtcomment').val;
	const pos = "rem01";

	$('#saveinvent').click(function (){
		if($('#slctwarehouse').val() == "0"){
			$('#message').html('');
			$('#message').html('Please Fill Blank Field');
			// updatecomment(itemcode,comment,pos);
		}

        if($('#gcode').val() == ""){
			$('#message').html('');
			$('#message').html('Please Fill Blank Field');
			// updatecomment(itemcode,comment,pos);
		}
	})
});