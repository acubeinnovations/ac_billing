
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


function validate_member_update(frm){
    error = "";

    frm = document.getElementById("frmupdate");

    if(frm.txtusername.value==""){
        error = "<?php echo $MSG_empty_username ?>\n";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtusername.value));
	    if( result == false) {
	       error = "<?php echo $MSG_invalid_username?>\n";
	    }
	}
 if ( error != "" ){
       alert(error);
return false;
    }


    if(frm.txtemail.value!=""){
            //pattern = /\w+@\w+\.\w+/;
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtemail.value));
	    if( result == false) {
	       error = "<?php echo $MSG_invalid_email?>\n";
	    }
	}
if ( error != "" ){
       alert(error);
return false;
    }


		if (Trim(frm.txtpassword.value) == "" && Trim(frm.txtrepassword.value) == "" ) {
		    error += "<?php echo $MSG_empty_password ?>\n";
		}
		else if( Trim(frm.txtpassword.value) != Trim(frm.txtrepassword.value) ){
		        error += "<?php echo $MSG_unmatching_passwords ?>\n";
		}
		else{
		         pattern = /[a-zA-Z0-9_-]{5,}/;
		         result = pattern.test(Trim(frm.txtrepassword.value));
		         if(result == false)
		         error += "<?php echo $MSG_length_password ?>\n" ;
		}
  if ( error != "" ){
       alert(error);
return false;
    }
 

/*
 if(frm.txtphone.value==""){
            error += "<?php echo $MSG_empty_phone ?>\n";
        }
*/


    if ( Trim(frm.txtuserstatus.value) == -1 ) {
        error+= "<?php echo $MSG_empty_userstatus?>\n";
    }
    if ( error == "" )
        return true;
    else
    alert(error);
        return false; 
}


function delete_member(){
    var ans = confirm("This will delete User Permanently");
    if ( ans == true ){
    	return true;
    }else{
        return false;
    }

}


$(document).ready(function(){


    $("#frmuser").submit(function(){
        var username = $('#txtusername').val(); 
        var userstatus = $('#txtuserstatus').val(); 
        var usertype = $('#lstusertype').val(); 
        var password = $('#txtpassword').val(); 
        var repassword = $('#txtrepassword').val(); 
        var fname = $('#txtfirstname').val(); 
        var lname = $('#txtlastname').val(); 
        var email = $('#txtemail').val(); 
        var phone = $('#txtphone').val(); 
        var error = "";
       
        if(userstatus == -1){
            error += "Select User Status<br>";
        }
        if(usertype == -1){
            error += "Select User Type<br>";
        }
               
        if(!validate_email()){
            error += "Invalid Email Id<br>";
        }
        if(phone != ""){
            if(isNaN(phone)){
                error += "Invalid Phone Number<br>";
            }
        }

        if(error != ""){
            popup_alert(error,false);
            return false;
        }else{
            return true;
        }

    });



	var checking_html = 'Checking...';
	$('#check_availability').click(function(){ 
	   var res=validate_username();
        if(res==true)
        {
            $('#username_availability_result').html(checking_html);  
            check_availability();  
        }
             
    }); 

function validate_username(){
    var error = "";
    var username = $('#txtusername').val(); 
    if(username == ""){
        error = "Empty Username\n";
    }

    if ( error != "" ){
        str_result = '<div data-alert class="alert-box info radius">'+error + '</div>'
        $('#username_availability_result').html(str_result);
        return false;
    }else{
        return true;
    }
}


//function for check email id

function validate_email(){
    var email = $('#txtemail').val(); 
    if(email != ""){	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(email);
	    if( result == false) {
	       return false;
	    }else{
            return true;
        }
	}else{
        return true;
    }
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
                    str_result = '<div data-alert class="alert-box info radius">'+ username + ' is available.</div>'
                    $('#username_availability_result').html(str_result);  
                }else{  
                    //show that the username is NOT available
                    str_result = '<div data-alert class="alert-box info radius">'+ username + ' is not available. </div>'  
                    $('#username_availability_result').html(str_result);  
                }  
        });  
    }



});




