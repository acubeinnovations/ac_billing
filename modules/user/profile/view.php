<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>
<div class="two-thirds column mright8 bottom-1">
					<div class="innercontainer-blk">
						<p class="heading">My Profile <span class="s-18"></span>  <?php if(isset( $myuser->error_description)) echo $myuser->error_description; ?></p>
						<form  name="frmupdate" id="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_username ?> (Email Id)<small>*</small></label>
<input  type="text" name="txtusername" id="txtusername" class="text" value="<?php echo $myuser->username; ?>" readonly ><!--<input  type="hidden" name="hiddenusername" value="<?php echo $myuser->username; ?>"><div id='username_availability_result' ></div>	-->						</div><!-- End Box -->
						</div>
					<!--	<div class="one-third column">
							<div class="form-box">
								<label>&nbsp;</label>
								<input type="button" class="button" name="check_availability" id="check_availability" value="<?php echo $CAP_available?>" />
							</div>--><!-- End Box 
						</div>-->
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_first_name ?> </label>
							<input  type="text" class="text" name="txtfirst_name" value="<?php echo $myuser->first_name; ?>"  >	
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_last_name ?> </label>
								<input  type="text" name="txtlast_name" class="text" value="<?php echo $myuser->last_name; ?>"  >
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_email ?><small></small></label>
								<input  type="text" name="txtemail" class="text" value="<?php echo $myuser->email;?>"  >
							</div><!-- End Box -->
						</div>
						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_occupation ?> <small></small></label>
								<input  type="text" name="txtoccupation" class="text" value="<?php echo $myuser->occupation;?>"  >
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box">
								<label><?php echo $CAP_phone?><small></small></label>
								<input  type="text" name="txtphone" class="text" value="<?php echo $myuser->phone;?>"  >
							</div><!-- End Box -->
						</div>
						<div class="one-third column mright4">
							<div class="form-box big">
								<label><?php echo $CAP_address ?> <small></small></label>
								<textarea name="txtaddress"><?php echo $myuser->address;?></textarea>
							</div><!-- End Box -->
						</div>

						<div class="clear"></div>
						<div class="one-third column mright4">
							<div class="form-box">
							 <input type="submit" name="submit" class="button" value="<?php echo $CAP_update?>" onClick="return validate_member_update();" >
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					
					</div>
				</div>
				
				<div class="one-third column mright8 bottom-1">
					<div class="credit-balance">
						<p class="head">Credit Balance:</p>
						<div class="dblk">
							<p class="fleft"><?php if(isset($_SESSION[SESSION_TITLE.'user_credit'])) echo $_SESSION[SESSION_TITLE.'user_credit']; ?></p>
							<p class="fright">
							<a href="/get_credit.php"><input type="button" class="button" value="Get Credit"></a>
							</p>
						</div>
					</div>
					
					<div class="history-blk">
					<p class="head bottom-1">Test History</p>
					<?php $index=0; while($counts > $index){ ?>
						<p class="fleft"><p class="subhead"><?php echo $data_bylimit[$index]["quiz_name"]; ?></p> <br />
						<p class="description bottom-2"><?php echo $data_bylimit[$index]["start_time_formated"]; ?></p> &nbsp;&nbsp;</p>

						
						<?php 
	
	$index++;
	}						
	
	?><p class="fright"><a href="/user_test_history.php"><input type="button" class="button" value="More"></a></p>
					</div>
		
				</div>
				
			   
</form>
