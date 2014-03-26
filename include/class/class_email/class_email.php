<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Email
{
	var $to_email	= "";
	var $from_email = "";
	var $message	= "";
	var $subject 	= "";
	var $cc_email 	= "";
	var $bcc_email 	= "";
	var $headers 	= "";

	var $error_description = "";

	function send_mail()
	{
		if($this->to_email != "")
		{
			// To send HTML mail, the Content-type header must be set
			
			$this->headers  = 'MIME-Version: 1.0' . "\r\n";
    		$this->headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    		'X-Mailer: PHP/' . phpversion(). "\r\n";
    		

			// Additional headers
			$this->headers .= 'To: '.$this->to_email. "\r\n";
			$this->headers .= 'From: '.$this->from_email . "\r\n";

			if($this->cc_email != "")
				$this->headers .= 'Cc: '.$this->cc_email . "\r\n";
			if($this->bcc_email != "")
				$this->headers .= 'Bcc: '.$this->bcc_email . "\r\n";

			$this->message = $this->get_email_template($this->message);
			//echo $this->message;exit();
				
			// Mail it
			if(mail($this->to_email, $this->subject, $this->message, $this->headers))
			{
				$this->error_description = "Mail send";
				return true;
			}
			else{
				$this->error_description = "Error in send mail";
				return false;
			}

		}
		else
		{
			$this->error_description = "Invalid Email Id";
			return false;
		}
	}

	function get_email_template($message, $template_name = "default_email.html")
	{				
		ob_start();	
		$template_filename = ROOT_PATH."layouts/email_templates/".$template_name;
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


?>
