<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

 $myuser = new User($myconnection);
 $myuser->connection = $myconnection;
$myuser->error_description = "";
 

 $strERR = "";

 if ( trim($_POST['username']) == "" ){
      $strERR .= "".$MSG_empty_username;
 }elseif (!filter_var($_POST['username'], FILTER_VALIDATE_EMAIL)){
		$strERR .= "".$MSG_invalid_email;
 }


 if ( trim($_POST['first_name']) == "" ){
      $strERR .= "<br/>".$MSG_empty_first_name;
 }

 if ( trim($_POST['last_name']) == "" ){
      $strERR .= "<br/>".$MSG_empty_last_name;
 }



$myuser->error_description = $strERR;

if ( $strERR == "" ){
    $myuser = new User();
    $myuser->connection = $myconnection;
    $myuser->username =trim($_POST['username']);
    //check user exist or not
    $chk = $myuser->exist();
    if ( $chk == true ){
    
	print "2";
	exit();
    }else{
		  $myuser->phone = trim($_POST['phone']);
		  $myuser->first_name = trim($_POST['first_name']);
		  $myuser->last_name = trim($_POST['last_name']);
		  $myuser->password = trim($_POST['password']);
		  $myuser->address = trim($_POST['address']);
			
	 	  $myuser->user_status_id = USERSTATUS_ACTIVE;	
	      $chk = $myuser->update();
	  
		if($chk == true)
		{
			print "1";
			echo "";
			exit();	
		}else{
			print "0";
			exit();	
		}
	}
	}else{
			print $strERR;
			exit();	
	}
	
?>
