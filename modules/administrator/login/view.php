<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>

<form data-abide target="_self" method="post" action="<?php echo $current_url?>" name="frmlogin">
<fieldset>
	<legend>Admin Login </legend>


	<div class="row">
		<div class="medium-6 columns">
			<label for="loginname">User Name <small>required</small></label>
			<input placeholder=""  required pattern="alpha_numeric"  type="text" name="loginname"   >
			<small class="error">Please Enter Your User Name.</small>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
			<label for="password">Password <small>required</small></label>
			<input placeholder="" required pattern="alpha_numeric"  type="password" name="passwd" id ="passwd">
			<small class="error">Password Required.</small>
		</div>
	</div>

	<div class="row">
		<div class="medium-6 columns">
			<input class="small button" value="Sign In" type="submit" name="submit" >
			<input name="h_id" value="<?php if(isset($h_id))echo $h_id; ?>" type="hidden">
			<input name="h_login" value="pass" type="hidden">
		</div>
	</div>

</fieldset>
</form>


