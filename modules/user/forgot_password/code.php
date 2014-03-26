<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if (isset($_POST['hd_submit'])){

      
      $myuser = new User();
      
	$myuser->connection = $myconnection;
	$myuser->username = $_POST['username'];
	if($_SESSION[SESSION_TITLE.'security_code']!=$_POST['txtcaptcha']){
	$_SESSION[SESSION_TITLE.'flash'] = "The characters didn't match the picture. Please try again.";
	header( "Location:".$current_url);
	exit(); 
	}

        $chk = $myuser->check_email();
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_username;
	header( "Location: index.php");
	exit(); 
        }
        else{
	
	$myuser_notification = new User_notifications();
	$myuser_notification->connection = $myconnection;
	$myuser_notification->username = $myuser->username;
	$myuser_notification->password_token=$chk;
	$chk_email=$myuser_notification->user_password_reset();
		if($chk_email==true){
		$_SESSION[SESSION_TITLE.'flash'] ="An email with password reset link has been sent to ".$myuser->username.". Please check your email.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
		header( "Location: index.php");
		exit();
		}else{
		$_SESSION[SESSION_TITLE.'flash'] =$RD_MSG_email_send_failed;
		header( "Location: index.php");
		exit();
		}	
	}
	
}

if (isset($_POST['captcha'])) {
	
		print $_SESSION[SESSION_TITLE.'security_code'];exit();
	
}
if (isset($_POST['captcha_image'])) {
	
		print '<img src="/captcha.php"/>';exit();
	
}
?>
