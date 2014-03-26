<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<h3>Account Settings</h3>

<form id="frmsettings" name="frmsettings" action="<?php echo $current_url;?>" method="POST">

<div class="row">
	<fieldset>

 		<div class="row">
 			<div class="medium-5 columns">
 				<label for="ledger">Financial Year(Current Fy : <?php echo $financial_year->fy_name; ?>)</label>
 				<?php echo populate_list_array("lstfy", $financial_years, 'fy_id','fy_name', '',$disable=false);?>
 			</div>
 			
 		</div>
        <div class="row">
 			<div class="medium-5 columns">
 				<label for="ledger">Default Capital Ledger:</label>
 				<input type="text" />
 			</div>
 			
 		</div>

 		<div class="row">
 			<div class="medium-5 columns">
 				<input class="tiny button"  value="Save" name="submit" type="submit"/>
 			</div>
 		</div>

 	</fieldset>
</div>

</form>