<?php 
	// prevent execution of this page by direct call by browser
	if ( !defined('CHECK_INCLUDED') ){
		exit();
	}
    //This forms most of the HTML contents of User Password Change

 ?>
<!-- form start-->
<form data-abide target="_self" method="post" action="<?php echo $current_url?>" name="frmchange_passwd">
<fieldset>
	<legend>Reset Password Password</legend>

	<div class="row">
		<div class="medium-6 columns">
			<label for="new_passwd">New password <small>required</small></label>
			<input placeholder=""  required = ""  type="password" name="new_passwd" id="new_passwd" >
			<small class="error">Empty Password.</small>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
			<label for="retype_passwd ">Retype password <small>required</small></label>
			<input placeholder=""  required =""  data-equalto="new_passwd"  type="password" name="retype_passwd" id="retype_passwd" >
			<small class="error" data-error-message="">Passwords must match.</small>
		 </div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
			<input class="small button" value="submit" type="submit" name="submit" >
		</div>
	</div>

</fieldset>
</form>

<!-- form end-->

