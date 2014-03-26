<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>




<!-- form start-->
<form data-abide target="_self" method="post" action="<?php echo $current_url?>" name="frmsearch" id="frmsearch">
  <fieldset>
  <legend>Users</legend>

     <div class="row">
		<div class="medium-6 columns">
			<label for="new_username">User Name</label>
			<input type="text" name="txtusername" value="<?php if(isset($_POST['txtusername'])){echo $_POST['txtusername'];}?>" />
		</div>
		<div class="medium-6 columns">
			<label for="new_username">Email</label>
			<input type="text"  name="txtemail" value="<?php if(isset($_POST['txtemail'])){echo $_POST['txtemail'];}?>" />
		</div>
    </div>
     <div class="row">
		<div class="medium-6 columns">
			<label for="new_username">First Name</label>
			<input type="text" name="txtfirstname"  value="<?php if(isset($_POST['txtfirstname'])){echo $_POST['txtfirstname'];}?>" />
		</div>
		<div class="medium-6 columns">
			<label for="new_username">Last Name</label>
			<input type="text" name="txtlastname"  value="<?php if(isset($_POST['txtlastname'])){echo $_POST['txtlastname'];}?>" />
		</div>
    </div>


    <div class="row">
		<div class="medium-6 columns">
			<label for="new_username">Phone</label>
			<input type="text" name="txtphone" value="<?php if(isset($_POST['txtphone'])){echo $_POST['txtphone'];}?>"  />
		</div>
		<div class="medium-6 columns">
			<label for="new_username">Status</label>
			<?php populate_array("txtuserstatus", $user_statuses,$myuser->user_status_id,$disable=false); ?> 
		</div>
    </div>

    <div class="row">

        <div class="medium-6 columns">
            <input class="tiny button" value="Search" type="submit" name="submit" >
			<a href="user.php" class = "tiny secondary button" > Add New User</a>
        </div>
    </div>




</fieldset>
</form>



<table width="100%">
	<thead>
		<tr>
			<th class="slno"></th>
			<th>User Name</th>
			<th>First Name</th>
			<th>Lans Name</th>
			<th>Status</th>
			<th>Reg Date</th>
			<th>Email</th>
			<th>Phone</th>
			<th>Action</th>

		</tr>
	</thead>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="9" align="center" class="message" >No Records Found!</td></tr>
  </table>
    <?php
     }
     else{?>
<?php
     //to number each record in a page
    
     $style = "row_lite";
     $index = 0;
     $slno = ($Mypagination->page_num*$Mypagination->max_records)+1;
     while ( $count_data_bylimit > $index ){
        $link = "user.php?id=".$data_bylimit[$index]["id"]."";
	    $link_reset_pswd="update_user_password.php?id=".$data_bylimit[$index]["id"]."";
        $link_credit = "set_credit.php?id=".$data_bylimit[$index]["id"]."";
		if ( $style == "row_lite" ){
			$style="row_dark";
		}else{
			$style="row_lite";
		}

?>
	<tr>
		<td><?php echo $slno++ ?></td>
		<td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["username"]; ?></a></td>
		<td><?php echo $data_bylimit[$index]["first_name"]; ?></td>
		<td><?php echo $data_bylimit[$index]["last_name"]; ?></td>

		<td><?php echo $user_statuses[$data_bylimit[$index]["user_status_id"]]; ?></td>
		<td><?php echo date("d-m-Y H:i:s",strtotime($data_bylimit[$index]["registration_date"])); ?></td>
		<td><?php echo $data_bylimit[$index]["email"]; ?></td>
		<td><?php echo $data_bylimit[$index]["phone"]; ?></td>
		<td><a href="<?php echo $link_reset_pswd; ?>">Reset password</a></td>
	</tr>
<?php
		$index++;
	}
?>
  </table>

<?php $Mypagination->pagination_style_numbers_with_buttons(); ?>
<?php } ?>


