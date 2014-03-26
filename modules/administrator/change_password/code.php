<?php
if (isset($_POST['submit']) && $_POST['submit'] == "submit"){
$passwd_error = "";
if ( $_POST['passwd'] == "" ){
    $passwd_error .= "<br/> Password Empty ";
}
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
      $pass = md5(trim($_POST['passwd']));
      $new_pass = md5(trim($_POST['new_passwd']));
      $myuser = new Administrator();
      $myuser->id = $_SESSION[SESSION_TITLE.'admin_userid'];
      $myuser->connection = $myconnection;
      $chk = $myuser->change_password($new_pass,$pass);
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = "Password seems to be incorrect";
        header( "Location: dashboard.php");
        exit();
        }
        else{
        $_SESSION[SESSION_TITLE.'flash'] = "Password Updated";
        header( "Location: dashboard.php");
        exit();
        }
}else{
 	$_SESSION[SESSION_TITLE.'flash'] = $passwd_error;
}

}
?>
