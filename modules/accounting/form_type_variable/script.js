$(document).ready(function(){
	$("#button-add").click(function(){

		var nameval = $("#lstvariable").val();
		var nametxt = $("#lstvariable option:selected").text();
		var order = $("#txtorder").val();

		var variable = nametxt+'<input type="hidden" name="hd_vble[]" value="'+nameval+'">';
		var ordertxt = order+'<input type="hidden" name="hd_order[]" value="'+order+'">';

		if(nameval >0 && parseInt(order) > 0 ){
			$("#insert").before('<tr><td>'+variable+'</td><td>'+ordertxt+'</td><td></td></tr>');
			$("#lstvariable").val(-1);
			$("#txtorder").val('');
		}
    	return false;
	});
});