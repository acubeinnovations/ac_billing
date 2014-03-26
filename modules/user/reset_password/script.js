

function confirmPassword()
{
	var frm = document.getElementById("frmupdate");
	var password = frm.new_password.value;
	var c_password = frm.confirm_new_password.value;
	if(password==c_password){
		document.getElementById('error_pass').innerHTML="";
	}
	else{
		document.getElementById('error_pass').innerHTML="Mismatch! Re-Enter Password";
		frm.new_password.value = "";
		frm.confirm_new_password.value = "";
		frm.new_password.focus();
	}
}



