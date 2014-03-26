<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

if(isset($_SESSION[SESSION_TITLE.'admin_userid']) && $_SESSION[SESSION_TITLE.'admin_userid'] > 0 && isset($_SESSION[SESSION_TITLE.'administrator_type']) && $_SESSION[SESSION_TITLE.'administrator_type'] == ADMINISTRATOR){
	header ("Location: dashboard.php");
	exit();
}

$login_error = "";
if (isset($_POST['submit']) && $_POST['submit'] == "Sign In"){
if ( $_POST['loginname'] == "" ){
    $login_error .= "Empty Login name";
}
if ( $_POST['passwd'] == "" ){
    $login_error .= "<br/> Empty Password";
}
if ( $login_error == "" ){
      $username = trim($_POST['loginname']);
      $password = md5(trim($_POST['passwd']));
      $myuser = new AdministratorSession($username,$password,$myconnection);
      $chk = $myuser->login();
      if ( $chk == true ){
		$chk = $myuser->register_login();
		header ("Location: dashboard.php");
		exit();
      }else{
		$login_error .= "Invalid Login name/Password.";
		$_SESSION[SESSION_TITLE.'flash'] = $login_error;
	}
	
}else{
 	$_SESSION[SESSION_TITLE.'flash'] = $login_error;

}



}
?>
