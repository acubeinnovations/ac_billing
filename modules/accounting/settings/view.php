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
			<div class="medium-6 columns">
						<label for="ledger"> Holding Organization</label>
						<input type="text" name="organization" id="organization" value=""/>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> Address</label>
						<textarea name="address" id="address" value=""/></textarea>
			</div>

			
			<div class="medium-6 columns">
						<label for="ledger"> Tax Payers Identification Number</label>
						<input type="text" name="tin" id="tin" value=""/>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> Central Sales Tax Reg Number</label>
						<input type="text" name="cst" id="cst" value=""/>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> Central Excise Reg Number</label>
						<input type="text" name="ce" id="ce" value=""/>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> SSI / MSI / LSI Reg Number</label>
						<input type="text" name="ssi" id="ssi" value=""/>
			</div>
			
		</div>	
 		<div class="row">
 			<div class="medium-6 columns">
 				<label for="ledger">Financial Year</label>
 				<?php echo populate_list_array("lstfy", $financial_years, 'fy_id','fy_name', '',$disable=false);?>
 				<label for="ledger">(Current Fy : <?php echo $financial_year->fy_name; ?>)</label>
 			</div>
 			
 		
 			<div class="medium-6 columns">
 				<label for="ledger">Default Capital Ledger:</label>
 				<?php echo populate_list_array("lstledger", $ledgers, 'id','name', '',$disable=false);?>
 				<label for="ledger">(Selcted Default)</label>
 			</div>
 			
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<input class="tiny button"  value="Save" name="submit" type="submit"/>
 			</div>
 		</div>

 	</fieldset>
</div>

</form>