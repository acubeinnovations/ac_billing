<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/sign_up.php">Sign Up</a>';
if(isset( $myuser->error_description)) $_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
?>

<fieldset>
    <legend>Sign Up</legend>
<div class="row" >
<div class="medium-12 columns">
<form  name="frmupdate" id="ajax-contact-form" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
		 <div class="medium-12 columns ">
	
				<div class="medium-5 columns ">
					<label><?php echo$CAP_first_name; ?> <small>*</small></label>
					<input type="text" required class="text" name="txtfirst_name" id="txtfirst_name" value="">	
				</div>
				<div class="medium-5 columns ">
					<label><?php echo$CAP_last_name; ?> <small>*</small></label>
					<input type="text" required class="text" name="txtlast_name" id="txtlast_name" value="">		
				</div>
			</div>

			<div class="medium-12 columns ">
				<div class="medium-5 columns "><div class="email-field">
					<label><?php echo $CAP_username; ?> (Email ID) <small>*</small></label>
					<input type="email" required name="txtusername" id="txtusername" class="text" ><div id='username_availability_result' ></div><br>
					<input type="button" class=" tiny button" name="check_availability" id="check_availability" value="<?php echo $CAP_available?>" /></div>
				</div>
				<div class="medium-5 columns ">
					<label><?php echo $CAP_password; ?> <small>*</small></label>
					<input type="password" required class="text" name="txtpassword" id="txtpassword" value="">	
					<label><?php echo $CAP_confirm_password; ?> <small>*</small></label>
					 <input type="password" required class="text" name="txtconfirm" id="txtconfirm" value="" >
				</div>
			</div>

			<div class="medium-12 columns ">
				<div class="medium-5 columns ">
					 <label><?php echo $CAP_phone; ?></label>
					 <input type="text" class="text" name="txtphone" id="txtphone"  value="">
					 <label><?php echo $CAP_address; ?> </label>
					<textarea name="txtaddress" id="txtaddress"></textarea>
				</div>
				<div class="medium-5 columns ">
					 <label><?php echo $CAP_captcha; ?> <small>*</small></label><div name="captcha_div" id="captcha_div"><img id="captcha_id" src="/captcha.php"/></div><a href="#" class="tiny button" name="captcha_refresh" id="captcha_refresh"/>Reresh</a><input required type="text" class="text" name="txtcaptcha" id="txtcaptcha"  value="">
				</div>
		 	</div>

			<div class="medium-12 columns ">
				<div class="medium-5 columns ">
					<p class="exam_checkboxs">  <input type="checkbox" id="agree_checkbox" name="agree_checkbox" />&nbsp;I agree to <a href="/terms_and_conditions.php">terms And Conditions.</a></p>	
				 </div>
				<div class="medium-5 columns ">
					
				</div>
		    </div>
			
			
			<div class="medium-12 columns ">
				<div class="medium-5 columns ">
					<input type="button" class="tiny success button" id="submit" name="submit" value="<?php echo $CAP_add?>"  /><input type="hidden"  name="h_validate_username" id="h_validate_username"  value="false">
				 </div>
				 <div class="medium-5 columns ">
		
				 </div>	
			 </div>
		</form>
	</div>
</div>
</fieldset>

				
