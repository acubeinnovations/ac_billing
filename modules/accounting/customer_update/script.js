$(document).ready(function(){

});

function deleteCustomer(id)
{
	var cnf = confirm("Are You sure?");
	if(cnf == true){
		window.location	= CURRENT_URL+"?dlt="+id;
	}else{
			
	}
}