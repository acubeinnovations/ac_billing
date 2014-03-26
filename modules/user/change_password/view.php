<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>

	
    <?php   /*
    This forms most of the HTML contents of User Login page
    On clicking the Login Button
    the page is called by itself
    If successful user is redirected to the concerned Logged in page
    Else
    Invalid Login information is displayed
    */

    ?>


      
<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/change_password.php">Change Password</a>';?>


<br>
<fieldset>
    <legend><?php echo $CAP_page_caption?>      <?php if(isset($myuser)) { echo $myuser->error_description; echo $passwd_error ; }?></legend>
<div class="row" >
	<div class="medium-12 columns">
		
		<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmchange_passwd" id="ajax-contact-form" >
		<div class="medium-12 columns ">
				<div class="medium-5 columns ">
					<label><?php echo $CAP_password ?> <small>*</small></label>
					<input type="password" name="passwd" id="passwd" value="" class="text">
				</div>
				<div class="medium-5 columns ">
					
				</div>
		</div>

		<div class="medium-12 columns ">
				<div class="medium-5 columns ">
					<label><?php echo $CAP_new_password ?> <small>*</small></label>
					<input  type="password" name="new_passwd" id="new_passwd" class="text" >
				</div>
				<div class="medium-5 columns ">
					<label><?php echo $CAP_retype_password ?> <small>*</small></label>
					<input type="password" name="retype_passwd" id="retype_passwd" class="text">
				</div>
		</div>

		<div class="medium-12 columns ">
				<div class="medium-5 columns ">
					<input value="<?php echo $CAP_update ?>" type="submit" name="submit" class=" tiny success button" onClick="return validate_change_passwd();" />&nbsp;<input type="reset" class="tiny button alert" value="Cancel">
								
				</div>
				<div class="medium-5 columns ">
					
				</div>
		</div>
		</form>
	</div>
</div>
</fieldset>

<script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("passwd").focus();
   //-->
    </script>
