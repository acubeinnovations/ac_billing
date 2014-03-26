<?php 	
	$flash_location = "/index.php";
	if(isset($_SESSION[SESSION_TITLE.'flash_redirect_page']) && trim($_SESSION[SESSION_TITLE.'flash_redirect_page'])!=""){
		$flash_location = $_SESSION[SESSION_TITLE.'flash_redirect_page'];
		
	}
	header('location:'. $flash_location);
	exit();
?>
