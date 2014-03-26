<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
	
}
$password_token=$_GET['password_token'];
if(!isset($password_token)){

 //header( "Location: index.php");
// exit();
}

if (isset($_POST['submit']) && $_POST['submit'] == $CAP_reset){

      
      $myuser = new User();
      //$myuser->id = $_SESSION[SESSION_TITLE.'userid'];
	$myuser->connection = $myconnection;
	$password_token = $_POST['password_token'];
	$new_pass = md5(trim($_POST['new_password']));
	$chk = $myuser->reset_password($new_pass,$password_token);
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_incorrect_token;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "index.php";
        header( "Location: index.php");
        exit(); 
        //echo $msg_unmatching_que_ans;exit();
        }
        else{

		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_correct_token;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "login.php";
		header( "Location: login.php");
		exit();
		}
}
?>
