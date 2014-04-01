<?php 	
// prevent execution of this page by direct call by browser
	if ( !defined('CHECK_INCLUDED') ){
		exit();
	}
    //This forms most of the HTML contents of User Password Change

 ?>
<!-- form start-->
<form data-abide target="_self" method="post" action="<?php echo $current_url?>" name="frmuser" id="frmuser">
<fieldset>
	<legend>Add/Update User</legend>

	<div class="row">
		<div class="medium-6 columns">
			<label for="new_username">Username <small>required</small></label>
			<input placeholder=""  required = "email"  type="text" name="txtusername" id="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}elseif(isset($_GET['id'])){echo $myuser->username;}?>" >
			<small class="error">Empty Username.</small>
			
			<div class="medium-4 columns ">
				<?php if(!isset($_GET['id']) && !isset($_POST['h_id'])){ ?>
				<input class="tiny button" type="button" name="check_availability" id="check_availability" value="<?php echo$CAP_available?>" />
				<?php } if(isset($_GET['id']) || isset($_POST['h_id'])){?>
				<input  type="hidden" name="hiddenusername" value="<?php if(isset($_POST['hiddenusername'])){echo $_POST['hiddenusername'];}elseif(isset($_GET['id'])){echo $myuser->username;}?>"  ><?php } ?>
			</div>

			<div class="medium-8 columns" id='username_availability_result'></div>

		</div>


		<div class="medium-3 columns">
			<label for="status">Status</label>
			<?php 
			if(isset($_POST['txtuserstatus'])){
				$user_status_id=$_POST['txtuserstatus'];
			}else{
				$user_status_id=$myuser->user_status_id;
			}
			populate_list_array("txtuserstatus", $user_statuses, "id", "name",$user_status_id,$disable=false); ?>  
		</div>
		<div class="medium-3 columns">
			<label for="status">User Type</label>
			<?php echo populate_list_array("lstusertype", $user_types, "id", "name",$myuser->user_type_id,$disable=false); ?>  
		</div>

	</div>
 	<?php if( !isset($_GET['id']) ){ ?>
	<div class="row">

		<div class="medium-6 columns">
			<label for="passwd ">Password <small>required</small></label>
			<input placeholder=""  required =""   type="password" name="txtpassword" id="txtpassword" >
			<small class="error" data-error-message="">Empty Password.</small>
		 </div>

		<div class="medium-6 columns">
			<label for="retype_passwd ">Retype password <small>required</small></label>
			<input placeholder=""  required =""  data-equalto="txtpassword"  type="password" name="txtrepassword" id="txtrepassword" >
			<small class="error" data-error-message="">Passwords must match.</small>
		 </div>
	</div>
	<?php } ?>



	<div class="row">

		<div class="medium-6 columns">
			<label for="first_name">First Name <small>required</small></label>
			<input placeholder=""  required =""   type="text" name="txtfirstname" id="txtfirstname"  value="<?php echo $myuser->first_name; ?>">
			<small class="error" data-error-message="">Empty First Name.</small>
		 </div>

		<div class="medium-6 columns">
			<label for="first_name ">Last Name<small>required</small></label>
			<input placeholder=""  required =""   type="text" name="txtlastname" id="txtlastname" value="<?php echo $myuser->last_name; ?>">
			<small class="error" data-error-message="">Empty Last Name.</small>
		 </div>
	</div>

	<div class="row">

		<div class="medium-6 columns">
			<label for="email">Email </label>
			<input placeholder=""   type="text" name="txtemail" id="txtemail"value="<?php echo $myuser->email; ?>" >
		 </div>

		<div class="medium-6 columns">
			<label for="Phone">Phone</label>
			<input placeholder=""   type="text" name="txtphone" id="txtphone" value="<?php echo $myuser->phone; ?>" >
		 </div>
	</div>


	
	<div class="row">
		<div class="medium-6 columns">

                    <?php if ( isset($_GET['id']) || isset($_POST['h_id']) ){?>
                    <input class="tiny button" type="submit" name="submit" value="<?php echo $CAP_update?>" onClick="return validate_member_update();" >
                    <input class="tiny button" type="Submit" name="submit" value="<?php echo $CAP_delete?>" onClick="return delete_member();">
<input type="hidden" name="h_id" value="<?php if( isset($_GET['id']) ){echo $myuser->id;}elseif ( isset($_POST['h_id']) ){ echo $_POST['h_id'];}?>">
                    <?php }else{ ?>
                    <input class="tiny button" type="submit" name="submit" value="<?php echo$CAP_add?>" onClick="return validate_member_update();">
                    <?php }?>

                    




		
		</div>
	</div>

</fieldset>
</form>

<!-- form end-->



