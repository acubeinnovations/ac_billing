<!--
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
if(frm.txtusername.value==""  ){
        error = "Empty Username\n";
    }else{
	if($.isNumeric($('#txtusername').val())){
	if (/^\d{10}$/.test(frm.txtusername.value)) {
 	
     return true;  
       }  
      else  
        {  
        alert("Number is not valid");  
        return false;  
        }  

	}else{

	    pattern = /\w+@\w+\.\w+/;
	     //pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtusername.value));
	    if( result == false) {
	       error = "Username must be an emailid\n";
	    }
	}
	
	}


/*
if(frm.txtusername.value==""){
        error = "Empty Username\n";
    }else{
	    pattern = /\w+@\w+\.\w+/;
	     //pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtusername.value));
	    if( result == false) {
	       error = "Username must be an emailid\n";
	    }
	}

   */

    if ( error != "" ){
       alert(error);
return false;
    }


 if(frm.txtemail.value==""){
        /*error1 = "Empty Email\n";*/
    }else{
	    pattern = /\w+@\w+\.\w+/;
	     //pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(Trim(frm.txtemail.value));
	    if( result == false) {
	       error1 = "Invalid Email\n";
	    }
	}


if (error != "" || error1!="" ){
       alert(error1);
return false;
    }else{
return true;
}
}
/*

$(document).ready(function(){

var checking_html = 'Checking...';
	$('#check_availability').click(function(){ 
		var res=validate_username();
		if(res==true)
		{
			$('#username_availability_result').html(checking_html);  
			check_availability();  
		}		 
   });

//function for check email id

function validate_username(){
 var error = "";
var username = $('#txtusername').val();  
    if(username==""){
        error = "<br>Empty Username\n";
    }else{
	    
	    pattern = /^[a-zA-Z0-9]\w+(\.)?\w+@\w+\.\w{2,5}(\.\w{2,5})?$/;
	    result = pattern.test(username);
	    if( result == false) {
	       error = "<br>Username must be an emailid\n";
	    }
	}
 if ( error != "" ){
       $('#username_availability_result').html(error);
return false;
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
                    $('#username_availability_result').html(username + ' is Available');  
                }else{  
                    //show that the username is NOT available  
                    $('#username_availability_result').html(username + ' is not Available');  
                }  
        });  
}

});
*/

 -->
