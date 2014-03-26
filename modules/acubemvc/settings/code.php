<?php 
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
    if(!isset($_SESSION[SESSION_TITLE.'gDEBUG'])){
        $_SESSION[SESSION_TITLE.'gDEBUG'] = false;
    }

	if(isset($_POST["h_check"]) && $_POST["h_check"] != ""  && $_POST["h_check"] == md5("CONF_SETTINGS") ){
	
			if(isset($_POST["chkdebug"])){
				$_SESSION[SESSION_TITLE.'gDEBUG'] = true;
			}else{
				$_SESSION[SESSION_TITLE.'gDEBUG'] = false;            
			}

            if(isset($_POST["chkeditor"])){
                $_SESSION[SESSION_TITLE.'gEDIT_MODE'] = true;
            }else{
                $_SESSION[SESSION_TITLE.'gEDIT_MODE'] = false;            
            }
           
 			$_SESSION[SESSION_TITLE.'flash'] = $msg_update_success;
			$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $msg_update_success_redirect_page;
			header( "Location: flash.php");
			exit();
		
	}


 ?>
