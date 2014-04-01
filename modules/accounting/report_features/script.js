$(document).ready(function(){

	$("#lstsledger").attr('disabled',true);

	

	$("#button-add").click(function(){

		var ledger = $("#lstmledger").val();
		var ledger_name = $("#lstmledger option:selected").text();
		var position = $("#lstposition").val();
		var position_desc = $("#lstposition option:selected").text();
		var sub_ledger = $("#lstsledger").val();

		var sub_ledger_name = $("#lstsledger option:selected").text();
		if(sub_ledger_name == ''){
			sub_ledger = '';
			sub_ledger_name = $("#lstsledger option").text();
		}
		

		var ledgertxt = ledger_name+'<input type="hidden" name="hd_ledger[]" value="'+ledger+'">';
		var positiontxt = position_desc+'<input type="hidden" name="hd_position[]" value="'+position+'">';
		var sub_ledgertxt = sub_ledger_name+'<input type="hidden" name="hd_subledger[]" value="'+sub_ledger+'">';

		if(ledger >0 && sub_ledger_name != ""){
			$("#insert").before('<tr><td>'+ledgertxt+'</td><td>'+sub_ledgertxt+'</td><td>'+positiontxt+'</td><td></td></tr>');

			$("#lstmledger option[value='"+ledger+"']").remove();
			clearForm();
		}
    	 return false;
	});

	

	$("#lstmledger").change(function(){
		var master_ledger_id = $(this).val();
		var lstsledger = '<select id="lstsledger" name="lstsledger" multiple ></select>';

		$.ajax({
			type:'GET',
			url:CURRENT_URL,
			data:{master:master_ledger_id},
			contentType: "application/json",
			dataType: "json",
			success: function (json) {
				lstsledger = '<select id="lstsledger" name="lstsledger" multiple >';
				if(json['sub']){
					 
					$.each(json['sub'], function(id, name){
	               		lstsledger += '<option value="'+id+'">'+name+'</option>';	
	            	});
	            	
	            }
	            lstsledger += '</select>';
	            	$("#sub-ledger").html(lstsledger);
			},
			fail:function(){
				lstsledger += '<select id="lstsledger" name="lstsledger" multiple ></select>';
				$("#sub-ledger").html(lstsledger);
			}

		});
		
		$("#sub-ledger").html(lstsledger); 

	});



	//remove feature
	$(".button-remove").click(function(){
		var cnf = confirm("Do you really want to remove this feature?");
		if(cnf){
			var feature_id = $(this).attr('feature');
			$.ajax({
				type:'POST',
				url:CURRENT_URL,
				data:{remove_feature:feature_id},
				success: function (data) {
					if(data == '1'){
						popup_alert("Feature Removed",false);
					}else{
						popup_alert("Failed to remove feature",false);
					}
				}
			});
		}

			
	});


	$("#popup_alert_button_cancel").click(function(){
		location.reload();
	});




});

function clearForm()
{
	$("#lstmledger").val(-1);
	$("#lstsledger").children().remove();
	$("#lstsledger").attr('disabled',true);
}