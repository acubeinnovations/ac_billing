<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$u_id=$_GET['id'];
if (isset($_POST['submit']) && $_POST['submit'] == "submit"){
$passwd_error = "";
if ( $_POST['new_passwd'] == "" ){
    $passwd_error .= "<br/> New Password Empty ";
}
if ( $_POST['retype_passwd'] == "" ){
    $passwd_error .= "<br/> Retype Password Empty";
}
if ( $_POST['new_passwd'] != $_POST['retype_passwd'] ){
    $passwd_error .= "<br/> Unmatching Passwords";
}

if ( $passwd_error == "" ){

	$myuser = new User();
	$myuser->connection = $myconnection;
	$myuser->id = $_POST['u_id'];
	$pass=$_POST['new_passwd'];
	$myuser->password= md5(trim($_POST['new_passwd']));
	$chk = $myuser->change_user_password();
        if ($chk == false){
		    $_SESSION[SESSION_TITLE.'flash'] = "Problem occured during updation. <br> Updating password may same as old password! <br> Try with another one.";
		    header( "Location: users.php");
		    exit();
        }else{
			$myuser_notification = new User_notifications();
			$myuser_notification->connection = $myconnection;
			$myuser_notification->password=$myuser->password;
			$myuser_notification->id=$myuser->id;
			$msg=$myuser_notification->user_password_reset_by_admin($pass);
			if($msg==true){
				$_SESSION[SESSION_TITLE.'flash'] ="Password Updated, Email Notification send to users email id.";
				header( "Location: users.php");
				exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] ="Problem occured during updation. please try after some time";
				header( "Location: users.php");
				exit();
			}
        }
}else{
 	$_SESSION[SESSION_TITLE.'flash'] = $passwd_error;
}

}
?>
