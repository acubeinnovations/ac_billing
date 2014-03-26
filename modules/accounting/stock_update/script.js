$(document).ready(function(){

	$("#frmitemadd").submit(function(){
		var item = $("#txtname").val();
		var uom = $("#lstuom").val();
		var qty = $("#txtqty").val();
		var errorMSG = "";
		if(item == ''){
			errorMSG += "Enter Item Name <br>";
		}
		if(uom == -1 || uom == ''){
			errorMSG += "Select Unit of Measure <br>";
		}
		if(qty !=''){
			if(isNaN(qty)){
				errorMSG += "Invalid Quantity <br>";
			}
		}

		if(errorMSG == ""){
			return true;
		}else{
			popup_alert(errorMSG,false);
			return false;
		}
	});

});

function deleteItem(id)
{
	var cnf = confirm("Are You sure?");
	if(cnf == true){
		window.location	= CURRENT_URL+"?dlt="+id;
	}else{
			
	}
}