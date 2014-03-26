$(document).ready(function(){



	$("#delete-fy").click(function(){
		var cnf = confirm("Are You sure?");
		if(cnf == true){
			return true;
		}else{
			return false;
		}
	});




});

function deleteFY(id)
{
	var cnf = confirm("Are You sure?");
	if(cnf == true){
		window.location	= CURRENT_URL+"?dlt="+id;
	}else{
			
	}
}
function closeFY(id)
{
	var cnf = confirm("Are You sure?");
	if(cnf == true){
		window.location	= CURRENT_URL+"?cls="+id;
	}else{
			
	}
}
