<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}




$login_error = "";
if(isset($_POST['submit']) and $_POST['submit'] == $capSIGNIN)
{
	if ( $_POST['loginname'] == ""  || $_POST['passwd'] == ""){
		$login_error = "Invalid Username or password!";
	}
	
	
	if ( $login_error == "" )
	{
		$username = trim($_POST['loginname']);
		$password = md5(trim($_POST['passwd']));
		$usersession = new UserSession($username,$password,$myconnection);
		$chk = $usersession->login();
		if ( $chk == true ){
			if($_SESSION[SESSION_TITLE.'user_type']==COUNTER){
				header('Location:/counter/dashboard.php');
				exit();
			}elseif($_SESSION[SESSION_TITLE.'user_type']==FINANCE){
				header('Location:/finance/dashboard.php');
				exit();
			}
			elseif($_SESSION[SESSION_TITLE.'user_type']==ADMINISTRATOR){
				header('Location:/admin/dashboard.php');
				exit();
			}
		}

	} else{
		$login_error = "Invalid Username or password!";
	}
	
}



?>
