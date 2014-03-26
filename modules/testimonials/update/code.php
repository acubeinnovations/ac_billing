<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if (isset($_POST['submit']) && $_POST['submit'] == $CAP_add){
$error = "";

if ( $_POST['testimonials'] ==''){
    $error .= "<br/>".$MSG_testimonials_empty;
}
if ( $error == "" ){
     
      
	$mytestimonials = new User_testimonials();
	$mytestimonials->connection = $myconnection;
	$mytestimonials->user_id = $_SESSION[SESSION_TITLE.'userid'];
	$mytestimonials->testimonial=trim($_POST['testimonials']);
	$mytestimonials->status_id=STATUS_INACTIVE;
      
      $chk = $mytestimonials->update();
        if ($chk == false){
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_testimonials_failed;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location:".$current_url);
        exit();
        //echo $msg_unmatching_que_ans;exit();
        }
        else{
        $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_testimonials_added;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location: dashboard.php");
        exit();
        }
}else{
		$_SESSION[SESSION_TITLE.'flash'] = $error;
        //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "dashboard.php";
        header( "Location:".$current_url);
        exit();
}
}
?>
