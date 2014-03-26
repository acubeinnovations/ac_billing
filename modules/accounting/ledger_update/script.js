$(document).ready(function(){

	//$("#sub-ledger").hide();

	$("#lstmledger").change(function(){
		var master_ledger_id = $(this).val();
		$("#sub-ledger").html('');

		$.ajax({
			type:'GET',
			url:CURRENT_URL,
			data:{master:master_ledger_id},
			contentType: "application/json",
			dataType: "json",
			success: function (json) {

				if(json){
					var lstsledger = '<select id="lstsledger" name="lstsledger"><option value="-1">Choose from list..</option>';
					$.each(json, function(id, name){
	               		lstsledger += '<option value="'+id+'">'+name+'</option>';	
	            	});
	            	lstsledger += '</select>';
	            	$("#sub-ledger").html('<label for="ledger">Sub Ledger</label>'+lstsledger);
	            }
			}
		});

	});

});