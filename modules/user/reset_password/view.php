<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
 $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/reset_password.php">Reset Password</a>';



if(isset($myuser)) { $_SESSION[SESSION_TITLE.'flash']= $myuser->error_description; echo $passwd_error ; }?>


<fieldset>
    <legend><?php echo $CAP_page_caption?></legend>
<div class="row" >
	<div class="medium-12 columns">
		<div class="medium-12 columns ">
			<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmreset_passwd" id="ajax-contact-form">	
			<div class="medium-5 columns ">
				<label><?php echo $CAP_newpassword ?> <small>*</small></label>
				<input type="password" class="text" required name="new_password" id="new_password" value="">
			 </div>
			<div class="medium-5 columns ">
		
			</div>
		</div>

		<div class="medium-12 columns ">
			<div class="medium-5 columns ">
				<label><?php echo $CAP_confirmnewpassword ?> <small>*</small></label>
				<input type="password" class="text" required name="confirm_new_password" id="confirm_new_password" value="">
			 </div>
			<div class="medium-5 columns ">
		
			</div>
		</div>
		
		<div class="medium-12 columns ">
			<div class="medium-5 columns ">
					<input  type="hidden" name="password_token" value="<?php echo $password_token; ?>" id="password_token" >
								<input type="submit" class="tiny success button" value="<?php echo $CAP_reset; ?>" name="submit" onClick="return confirmPassword();">
								<input type="reset" class="tiny alert button " value="Cancel">
			 </div>
			<div class="medium-5 columns ">
		
			</div>
		</div>
	</div>
</div>
</fieldset>
<script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("newpassword").focus();
   //-->
    </script>
