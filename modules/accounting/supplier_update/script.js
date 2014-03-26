$(document).ready(function(){

});

function deleteSupplier(id)
{
	var cnf = confirm("Are You sure?");
	if(cnf == true){
		window.location	= CURRENT_URL+"?dlt="+id;
	}else{
			
	}
}