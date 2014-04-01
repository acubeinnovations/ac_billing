<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}?>

<h3>Login</h3> 
<fieldset>
<div class="row" >
<div class="medium-4 columns"><img src="../../images/ayyappa.png" alt="" name="" width="321" height="268" />
</div>
	<div class="medium-8 columns">
    <br />
<br /><br />


		<form  id="ajax-contact-form" target="_self" method="post" action="<?php echo $current_url?>" name="frmlogin">
		<div class="medium-12 columns ">
						<div class="medium-5 columns ">
							<label>User Name <small>*</small></label>
							<input name="loginname"  type="text" required class="text " id="loginname"  title=""  value=""  >
		  </div>
						<div class="medium-5 columns ">
					
						</div>
		</div>
		
		<div class="medium-12 columns ">
						<div class="medium-5 columns ">
							<label>Password <small>*</small></label>
							<input name="passwd"  type="password" required class="text" id="passwd" >
		  </div>
						<div class="medium-5 columns ">
					
						</div>
		</div>
	
		<div class="medium-12 columns ">
						<div class="medium-5 columns ">
							<input  value="<?php echo $capSIGNIN; ?>" type="submit" name="submit" class="small button" >
         					    <input name="h_id" value="" type="hidden"><input name="h_login" value="pass" type="hidden">
								<!--<a href="forgot_password.php" class="button-link">Forgot Password?</a>-->
		  </div>
						<div class="medium-5 columns ">
					
						</div>
		</div>
		</form>
	</div>
</div>
</fieldset>	
	
