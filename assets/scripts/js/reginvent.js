$(document).ready(function () {
	
	var path1 = '/assets/scripts/ajax/';
	
	$('#saveinvent').click(function (){
		if($('#slctwarehouse').val() == "0"){
			$('#message').html('');
			$('#message').html('Please Fill Blank Field');
		}

        if($('#gcode').val() == ""){
			$('#message').html('');
			$('#message').html('Please Fill Blank Field');
		}
	})
});