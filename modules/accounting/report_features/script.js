$(document).ready(function(){

	$("#button-add").click(function(){

		var ledger = $("#lstmledger").val();
		var ledger_name = $("#lstmledger option:selected").text();
		var position = $("#lstposition").val();
		var position_desc = $("#lstposition option:selected").text();
		var sub_ledger = $("#lstsledger").val();

		var sub_ledger_name = $("#lstsledger option:selected").text();
		

		var ledgertxt = ledger_name+'<input type="hidden" name="hd_ledger[]" value="'+ledger+'">';
		var positiontxt = position_desc+'<input type="hidden" name="hd_position[]" value="'+position+'">';
		var sub_ledgertxt = sub_ledger_name+'<input type="hidden" name="hd_subledger[]" value="'+sub_ledger+'">';

		if(ledger >0){
			$("#insert").before('<tr><td>'+ledgertxt+'</td><td>'+sub_ledgertxt+'</td><td>'+positiontxt+'</td><td></td></tr>');
			clearForm();
		}
    	 return false;
	});

	

	$("#lstmledger").change(function(){
		var master_ledger_id = $(this).val();
		var lstsledger = "";

		$.ajax({
			type:'GET',
			url:CURRENT_URL,
			data:{master:master_ledger_id},
			contentType: "application/json",
			dataType: "json",
			success: function (json) {
				lstsledger += '<select id="lstsledger" name="lstsledger" multiple >';
				if(json['sub']){
					 
					$.each(json['sub'], function(id, name){
	               		lstsledger += '<option value="'+id+'">'+name+'</option>';	
	            	});
	            	
	            }
	            lstsledger += '</select>';
	            
	            $("#sub-ledger").html(lstsledger);
			}

		});

	});
	

});