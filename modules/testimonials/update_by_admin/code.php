<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
	$mytestimonials = new User_testimonials();
    	$mytestimonials->connection = $myconnection;
	$statuses=$mytestimonials->get_array_statuses();
 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
 $strERR = "";
	 if ( isset($_POST['chkverify'])){
	      $mytestimonials->status_id=STATUS_ACTIVE;
	}else{
	$mytestimonials->status_id=STATUS_INACTIVE;
	}
	 $mytestimonials->id=$_POST['h_id'];
	  $chk = $mytestimonials->update();
          if ( $chk == true ){
			
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_testimonials_status_updated;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
				header( "Location: testimonials.php");
				exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] =$RD_MSG_testimonials_status_updated_failed;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
				header( "Location:".$current_url);
				exit();
			}
    	
	
}

 if ( isset($_GET['id']) && $_GET['id'] > 0 ){
      $mytestimonials = new User_testimonials();
      $mytestimonials->id = $_GET['id'];
      $mytestimonials->connection = $myconnection;
      $chk1 = $mytestimonials->get_detail();
	$statuses=$mytestimonials->get_array_statuses();
      if ( $chk1 == false ){
		  header("Location: index.php");
		  exit();
      }
 }


if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_delete ) {
	$mytestimonials = new User_testimonials();
	$mytestimonials->connection = $myconnection;
	$mytestimonials->id = $_POST['h_id'];
	$chk = $mytestimonials->delete();
	if ( $chk == true ){
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_deleted;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
		header( "Location: testimonials.php");
		exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
		header( "Location:".$current_url);
		exit();
	}
}
?>
