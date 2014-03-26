<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
	
}
	$activation_token=$_GET['activation_token'];

	 $myuser = new User();
      //$myuser->id = $_SESSION[SESSION_TITLE.'userid'];
	$myuser->connection = $myconnection;
	$chk = $myuser->activate_account($activation_token);
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_token;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: index.php");
        exit(); 
       
        }
        else{

							$mysms = new Sms();
							$phone=trim($myuser->phone);
							$chk_sms=$mysms->user_welcome_sms_unpaid($phone);
							$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_correct_token;
							//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "login.php";
							header( "Location: login.php");
							exit();
								
		}


?>
