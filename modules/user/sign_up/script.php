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
/*

$('select[name=lstcreditplans]').change(function(){
		var plan_id = $(this).val();
		if(plan_id == -1)
		{
			$('#txtcredit').val("");
			$('#txtcredit').attr('readonly',false);
		}
		else
		{
			var post_plan = $.post(current_url,{credit_plan:plan_id });
			post_plan.done(function(data){
				
				$('#txtcredit').val(data);
				$('#txtcredit').attr('readonly',true);
			});
		}
		
	});
*/




	var checking_html = 'Checking...';
	$('#check_availability').click(function(){ 
		var res=validate_username();
		if(res==true)
		{
			$('#username_availability_result').html(checking_html);  
			check_availability();  
		}		 
   }); 
$('#txtusername').blur(function(){
if($('#txtusername').val()!=''){
check_availability_validation();
}
});

 

 $('#submit').click(function () {


	var error = "";


	var post_captcha = $.post(current_url,{captcha:1});
			post_captcha.done(function(data){
			var session_captcha=data;
	
	var captcha = $("#txtcaptcha").val();
	if(captcha!=''){ 
     if(Trim(captcha)!=Trim(session_captcha)){
        error += "The characters didn't match the picture. Please try again.<br/>";
    }
    }else{
	 error += "The characters filed must not be blank.<br/>";
	}


	var username = $('#txtusername').val();  
    if(Trim(username)==""){
        error += "Empty Username.<br/>";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(username);
	    if( result == false) {
	       error += "Username must be an emailid.<br/>";
	    }
	}

	
        if($("#h_validate_username").val()!='false'){
	error=error+'user name is not available.<br/>';
	}
	var password = $('#txtpassword').val();  
    if(Trim(password)==""){
        error += "Empty Password.<br/>";
   	 }

	var confirm_password = $('#txtconfirm').val();  
	if(Trim(confirm_password)==""){
        error += "Empty Confirm Password.<br/>";
	}

	if(Trim(password)!="" && Trim(confirm_password)!=""  && Trim(password) != Trim(confirm_password)){
        error += "Password Mismatch! Re-Enter Password.<br/>";
	}


	var first_name = $('#txtfirst_name').val();  

    if(Trim(first_name)==""){
        error += "Empty First Name.<br/>";
    }

	var last_name = $('#txtlast_name').val();  
    if(Trim(last_name)==""){
        error += "Empty Last Name.<br/>";
    }

	
/*
	var phone = $('#txtphone').val();  
    if(Trim(phone)==""){
        error += "Empty Phone number.<br/>";
    }else{
   var regEx = /^(\+91|\+91|0)?\d{10}$/;
   
	if (phone.match(regEx)) {
 	
     
       }else{
	error += "Invalid Phone number.<br/>"; 
	}
	}
	*/
	
	if( $("#agree_checkbox").is(':checked') ){}else{
	error+="Please check the Terms And Conditions.";
	}
	if ( error != "" ){
	popup_alert(error,"","","close");
			return false;
	}else{
	
	var username = $('#txtusername').val()
	var password = $('#txtpassword').val();
	
	var overlay_panel_content='Your username is '+username+' and password is '+password+' .Please click Ok to proceed to registration or cancel to edit information.';

		popup_alert(overlay_panel_content,"#","","");
	
}
});	
	});


$('#popup_alert_button_ok').click(function () {
	
var username = $("#txtusername").val();  
var first_name = $('#txtfirst_name').val();  
var last_name = $('#txtlast_name').val();  
var password = $('#txtpassword').val();  
var phone = $('#txtphone').val();
var address = $('#txtaddress').val();

$.post('register.php',{
	username:username,
	first_name:first_name,
	last_name:last_name,
	password:password,
	address:address,
	phone:phone
	},function(data){
	if(data!=2){	
	if(data==1){
	
	popup_alert('Registered successfully..Please click here to login your account',"login.php","LOGIN","");
	
	}else if(data==0){
	popup_alert('Error occured in registration please try again..',"sign_up.php","Ok","");
	}
	}
	
	});
	
} );




//function for check email id

function validate_username(){
 var error = "";
var username = $('#txtusername').val();  
    if(username==""){
        error = "<br>Empty Username";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(username);
	    if( result == false) {
	       error = "<br>Username must be an emailid";
	    }
	}
 if ( error != "" ){
       $('#username_availability_result').html(error);
return false;
    }else{
return true;
}

}
function check_availability_validation(){
 var username = $('#txtusername').val();  
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

//function to check username availability  
function check_availability(){  
  
        //get the username  
       var username = $('#txtusername').val();  
        //use ajax to run the check  
        $.post("user_check.php", { username: username },  
            function(result){ 

                //if the result is 1  
                if(result == 1){  
                    //show that the username is available  
                    $('#username_availability_result').html('<font color="green">'+username + ' is Available</font>');  
                }else{  
                    //show that the username is NOT available  
                    $('#username_availability_result').html('<font color="red">'+username + ' is not Available</font>');  
                }  
        });  
}


$('select[name=lstcreditplans]').change(function(){
		var plan_id = $(this).val();
		if(plan_id == -1)
		{
			 $('#txtcredit').val("");
			$('#txtcredit').attr('readonly',true);
		}
		else
		{
			var success_post = $.post('<?php echo $current_url?>',
	        {
	          plan_id:plan_id,
	        });
	        success_post.done(function (data) {
	      		if(data){
					
                    $('#txtcredit').val(data);
					$('#txtcredit').attr('readonly',true);
	      		}
	       });
	    }
    
	});



});

 -->

