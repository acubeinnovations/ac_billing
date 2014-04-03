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
						<label for="ledger"> Holding Organization
						<input type="text" name="organization" id="organization" value="<?php echo $account_settings->organization_name; ?>"/>
						</label>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> Address
						<textarea name="address" id="address" value=""/><?php echo $account_settings->organization_address; ?></textarea>
						</label>
			</div>

			
			<div class="medium-6 columns">
						<label for="ledger"> Tax Payers Identification Number</label>
						<input type="text" name="tin" id="tin" value="<?php echo $account_settings->tax_payers_id_no; ?>"/>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> Central Sales Tax Reg Number</label>
						<input type="text" name="cst" id="cst" value="<?php echo $account_settings->central_sales_tax_reg_no; ?>"/>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> Central Excise Reg Number</label>
						<input type="text" name="ce" id="ce" value="<?php echo $account_settings->central_exise_reg_no; ?>"/>
			</div>
			<div class="medium-6 columns">
						<label for="ledger"> SSI / MSI / LSI Reg Number</label>
						<input type="text" name="ssi" id="ssi" value="<?php echo $account_settings->reg_no; ?>"/>
			</div>
			
		</div>	
 		<div class="row">
 			<div class="medium-6 columns">
 				<label for="ledger">Financial Year (Current Fy : <?php echo $financial_year->fy_name; ?>)</label>
 				<?php echo populate_list_array("lstfy", $financial_years, 'fy_id','fy_name', '',$disable=false);?>
 				
 			</div>
 			
 		
 			<div class="medium-6 columns">
 				<label for="ledger">Default Capital Ledger</label>
 				<?php echo populate_list_array("lstledger", $ledgers, 'id','name', $account_settings->default_capital,$disable=false);?>
 				
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