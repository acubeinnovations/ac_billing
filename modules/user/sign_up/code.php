<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

 $myuser = new User($myconnection);
 $myuser->connection = $myconnection;
$myuser->error_description = "";




if (isset($_POST['captcha'])) {

		print $_SESSION[SESSION_TITLE.'security_code'];exit();

}
if (isset($_POST['captcha_image'])) {

		print '<img src="/captcha.php"/>';exit();

}

?>
