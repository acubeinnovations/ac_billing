<!--

var CURRENT_URL = '<?php echo $current_url ?>';

function deleteTax(id)
{
	var cnf = confirm("Are You sure?");
	if(cnf == true){
		window.location	= CURRENT_URL+"?dlt="+id;
	}else{
			
	}
}


$(document).ready(function(){
	$("#txtrate").click(function(){
		$(this).select();
	});
});
-->