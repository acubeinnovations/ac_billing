<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class User_notifications{
    var $connection;
    var $to 			= "";
    var $subject		= "";
    var $message		= "";
    var $username		= "";
    var $password		= "";
    var $first_name ="";
	var $last_name="";
    var $root_path="";

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";
	var $from 	= "my_daily_test@acube.co";





function user_password_reset(){
	$headers="";
    $strMailbody="";
    $strTo="";
    $strSubject="";
    $strSQL = "SELECT first_name,last_name FROM users WHERE username = '".$this->username."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        	
		$this->first_name = mysql_result($rsRES,0,'first_name');
		$this->last_name = mysql_result($rsRES,0,'last_name');
		
	if($this->first_name!='' && $this->last_name!=''){
	$name=$this->first_name." ".$this->last_name;
	}else
	{
	$name=$this->username;	
		
	}
    $strFrom=EMAIL_NO_REPLY;
    $strTo=$this->username;
    $headers  .= 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= "From: Mydailytest.com <".$strFrom.">"."\r\n";
  

	$strSubject = "Password Reset email";
	 $strMailbody .= "Dear ".$name.",<br /><br />";
	$strMailbody .= "You have requested for a password reset link.";
	$strMailbody .= "<a href='".WEB_URL."/reset_password.php?password_token=";
        $strMailbody .= $this->password_token;
	$strMailbody .= "'>Click Here To Reset Your Password</a><br />Thanks,<br />
    	".WEB_NAME."<br /><br />";
	$strMailbody .="If clicking the link does not work, just copy and paste the entire link into your browser. If you are still having problems, simply forward this email to support@mydailytest.com and we will do our best to help you.";
$strMailbody=$this->get_email_template($strMailbody);

mail($strTo,$strSubject,$strMailbody,$headers);	
return true;
	}

}



function user_account_activation(){
	$headers="";
    $strMailbody="";
    $strTo="";
    $strSubject="";		
	if($this->first_name!='' && $this->last_name!=''){
	$name=$this->first_name." ".$this->last_name;
	}else
	{
	$name=$this->username;	
		
	}
    $strFrom=EMAIL_NO_REPLY;
    $strTo = $this->username;

    $strSubject="Activate your mydailytest.com account";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= "From: Mydailytest.com <".$strFrom.">"."\r\n";

    
    $strMailbody.= "Dear ".$name.",<br /><br />";
    $strMailbody .="Thank you  for registering with us at My Daily Test .com. We look forward to seeing you around in the site.<br />";
$strMailbody.="To complete your registration, you need to confirm that you received this email.<br/>";
    $strMailbody .="<a href='".WEB_URL."/account_activation.php?activation_token=".$this->activation_token."'\">Please click here to activate your account</a>";
    $strMailbody .="<br />Here are your login details for http://mydailytest.com site .<br/>You can change your password after you log into the site.<br /><br />";
   
    
    $strMailbody .="Your Username :". $this->username ."<br />";
    $strMailbody .="Your Password :". $this->password . "<br /><br /><br /><br /><br />
    Thanks,<br />My Daily Test .com Team<br/>";
    $strMailbody .="If clicking the link does not work, just copy and paste the entire link into your browser. If you are still having problems, simply forward this email to support@mydailytest.com and we will do our best to help you. <br/>";
 $strMailbody=$this->get_email_template($strMailbody); 
    //Send the mail to the Registered User with activation link
    mail($strTo,$strSubject,$strMailbody,$headers);
	return true;

}


function user_welcome_email(){
	$headers="";
    $strMailbody="";
    $strTo="";
    $strSubject="";	
	$strSQL = "SELECT first_name,last_name FROM users WHERE username = '".$this->username."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        	
		$this->first_name = mysql_result($rsRES,0,'first_name');
		$this->last_name = mysql_result($rsRES,0,'last_name');
		
	if($this->first_name!='' && $this->last_name!=''){
	$name=$this->first_name." ".$this->last_name;
	}else
	{
	$name=$this->username;	
		
	}
   $strFrom=EMAIL_NO_REPLY;
    $strTo = $this->username;

    $strSubject="Welcome to mydailytest.com";
	$headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= "From: Mydailytest.com <".$strFrom.">"."\r\n";
     //  $headers .= 'Reply-To: <'.$strFrom.'>'."\r\n";

    $strMailbody .= "Dear ".$name.",<br /><br />";
    $strMailbody .="Thanks for registering with us at ".WEB_NAME.". We look forward to seeing you around the site.<br />";
   
    $strMailbody .="<br />Here is your password for ".WEB_URL." Site .<br> You can change it after you log into the site.<br /><br />";
   
    
    $strMailbody .="Your Username :". $this->username ."<br />";
    $strMailbody .="Your Password :". $this->password . "<br /><br /><br /><br /><br />
    Thanks,<br />
    ".WEB_NAME."<br /><br />";
    $strMailbody .="Welcome to ".WEB_NAME."!";
   $strMailbody=$this->get_email_template($strMailbody);
    //Send the mail to the Registered User with activation link
    mail($strTo,$strSubject,$strMailbody,$headers);
	return true;

}

}







function user_password_reset_by_admin($pass){
    $headers="";
    $strMailbody="";
    $strTo="";
    $strSubject="";
	$strSQL = "SELECT username,email,first_name,last_name FROM users WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        	$this->to = mysql_result($rsRES,0,'email');
        	$this->username = mysql_result($rsRES,0,'username');
		$this->first_name = mysql_result($rsRES,0,'first_name');
		$this->last_name = mysql_result($rsRES,0,'last_name');
		$strFrom=EMAIL_NO_REPLY;            	
		$strTo=$this->username;
$headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    'X-Mailer: PHP/' . phpversion(). "\r\n";
    $headers .= "From: Mydailytest.com <".$strFrom.">"."\r\n";
       //$headers .= 'Reply-To: <'.$strFrom.'>'."\r\n";

/*

$headers .= "X-Priority: 1 (Highest)\n";
        $headers .= "X-MSMail-Priority: High\n";
        $headers .= "Importance: High\n";*/
	if($this->first_name!='' && $this->last_name!=''){
	$name=$this->first_name." ".$this->last_name;
	}else
	{
	$name=$this->username;	
		
	}

		       	
		$strSubject = "Password Reset By Admin";
        	$strMailbody = "Dear ".$name.",<br /><br />";
        	$strMailbody .= "<br>Your password has been reset by Admin. You can now login with your new password mentioned below.";
        	$strMailbody .= "New Password :".$pass;
        	$strMailbody .= "<br>Thankyou.";
		$strMailbody .=	"<br />Team My Daily Test<br /><br />";
		$strMailbody=$this->get_email_template($strMailbody);
        	mail($strTo,$strSubject,$strMailbody,$headers);
	return true;
        }
}

function get_email_template($message, $template_name = "default_email.html")
{				
	ob_start();	
	$template_filename = $this->root_path."layouts/email_templates/".$template_name;
	eval("\$template_filename = \"$template_filename\";");
	if (file_exists($template_filename)) {
		$email_template_content = $message;
		include($template_filename);
	}else{
		echo 'File :: '.$template_filename ." not exists. <br/>";
	}
	$email_content .= ob_get_contents();
	ob_end_clean();
	return $email_content;
}
}
