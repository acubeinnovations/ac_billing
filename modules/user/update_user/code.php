<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$myuser = new User();
$myuser->connection = $myconnection;

$user_statuses=$myuser->get_list_array();
$user_types = $myuser->get_list_user_types();

 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_add ) {
 	$strERR = "";
	 if ( trim($_POST['txtusername']) == "" ){
	      $strERR .= $MSG_empty_username;
	 }


	 if ( trim($_POST['txtpassword']) == "" && trim($_POST['txtrepassword']) == "" ){
		      $strERR .= $MSG_empty_password;
	  
	 }
	if ( trim($_POST['txtpassword']) !=trim($_POST['txtrepassword']) ){
		      $strERR .= $MSG_match_password;
	  
	 }
 
	 if ( $_POST['txtuserstatus'] == -1 ){
	      $strERR .= $MSG_empty_userstatus;
	 }

	  if ( $_POST['lstusertype'] == -1 ){
	      $strERR .= $MSG_empty_usertype;
	 }

	$myuser->error_description = $strERR;

	if ( $strERR == "" ){
	    $myuser->username = $_POST['txtusername'];
	    //check user exist or not
	    $chk = $myuser->exist();
	    if ( $chk == true ){
	        $myuser->error_description = "User already exist";
	    }else{
	        $myuser->password = $_POST['txtpassword'];
			$myuser->first_name = $_POST['txtfirstname'];
	        $myuser->last_name = $_POST['txtlastname'];
			$myuser->user_status_id =  $_POST['txtuserstatus'];
			if($myuser->user_status_id== USERSTATUS_WAITING_EMAIL_ACTIVATION){
				$myuser->activation_token=md5(time());
			}else{
				$myuser->activation_token="";
			}
			$myuser->email = $_POST['txtemail'];
			$myuser->phone = $_POST['txtphone'];
			$myuser->user_type_id = $_POST['lstusertype'];
			$chk = $myuser->update();
	        if ( $chk == true ){
				if($myuser->user_status_id==USERSTATUS_WAITING_EMAIL_ACTIVATION){
					$myuser_notification = new User_notifications();
					$myuser_notification->username = $myuser->username;
					$myuser_notification->activation_token=$myuser->activation_token;
					$myuser_notification->password=$myuser->password;
					$myuser_notification->to =$myuser->email;
					$msg=$myuser_notification->user_account_activation();
				}
				
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_added ;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
				header( "Location: users.php");
				exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
				//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
				header( "Location:".$current_url);
				exit();
			}
	    }
	}
}

 if ( isset($_GET['id']) && $_GET['id'] > 0 ){
      $myuser = new User();
      $myuser->id = $_GET['id'];
      $myuser->connection = $myconnection;
      $chk1 = $myuser->get_detail();
	$user_statuses=$myuser->get_list_array();
      if ( $chk == false ){
		  header("Location: index.php");
		  exit();
      }
 }


 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
 	$strERR = "";
	
	 if ( $_POST['txtuserstatus'] == -1 ){
		  $strERR .= $MSG_empty_userstatus;
	 }

	 if ( $_POST['txtusername'] == "" ){
		  $strERR .= $MSG_empty_username;
	 }

	 if ( $_POST['txtemail'] == "" ){
		$strERR .= $MSG_empty_email;
	}

	if($_POST['hiddenusername']!=$_POST['txtusername']){
		$myuser->username=$_POST['txtusername'];
		$chk = $myuser->exist();
	   	 if ( $chk == true ){
		$strERR .= "User already exist";
		$myuser->get_detail();
	    	}
	}
	$myuser->error_description = $strERR;
	if ( $strERR == "" ){
		
		$myuser->id = $_POST['h_id'];
		$chk = $myuser->get_detail();

		$myuser->username = $_POST['txtusername'];
		$myuser->user_status_id = $_POST['txtuserstatus'];
		$myuser->user_type_id = $_POST['lstusertype'];
		$myuser->first_name = $_POST['txtfirstname'];
        $myuser->last_name = $_POST['txtlastname'];
		$myuser->email = $_POST['txtemail'];
		$myuser->phone = $_POST['txtphone'];		
		$chk = $myuser->update();

		if ( $chk == true ){
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_updated;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
			header( "Location: users.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
			header( "Location: ". $current_url);
			exit();
		}
	 }
 }
if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_delete ) {
	$myuser = new User();
	$myuser->connection = $myconnection;
	$myuser->id = $_POST['h_id'];
	$chk = $myuser->delete();
	if ( $chk == true ){
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_deleted;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "users.php";
		header( "Location: users.php");
		exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_attempt_failed;
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
		header( "Location:".$current_url);
		exit();
	}
}
?>
