<!--
var current_url = "<?php echo $current_url; ?>";
function Trim(strInput) {
    while (true) {
        if (strInput.substring(0, 1) != " ")
            break;
        strInput = strInput.substring(1, strInput.length);
    }
    while (true) {
        if (strInput.substring(strInput.length - 1, strInput.length) != " ")
            break;
        strInput = strInput.substring(0, strInput.length - 1);
    }
   return strInput;
}
   

$(document).ready(function(){
 
 $('#captcha_refresh').click(function () {

	
	$('#captcha_id').attr('src',$('#captcha_id').attr('src')+'?'+Math.random());

});

$('#username').blur(function(){
if($('#username').val()!=''){
check_availability_validation();
}
});

 $('#submit').click(function () {

	var error = "";
	
	var username = $('#username').val();  
    if(Trim(username)==""){
        error += "Empty Username<br/>";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(username);
	    if( result == false) {
	       error += "Username must be an emailid<br/>";
	    }
	}
	
	
	if ( error != "" )
        {  popup_alert(error,"","","close");
        return false;
	}
	else{

	if($("#h_validate_username").val()=='false'){
	 popup_alert ("Sorry, you are not registered yet, Would you like to REGISTER now? Click REGISTER to sign up with mydailytest.com","sign_up.php","Register","close");
	
	}else{

	$("#hd_submit").trigger("click");

	}
	}
	

	});  

function check_availability_validation(){
 var username = $('#username').val();  
var error='';
$.post("user_check.php", { username: username },  
            function(result){ 
		
                //if the result is 1  
                if(result == 1){  
                  $("#h_validate_username").attr("value",'false');   
                }else{ 
		
                  $("#h_validate_username").attr("value",username); 
		
                }  
		
		
        });
}
});



-->
