<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form name="frmvoucher" id="frmvoucher" action="<?php echo $current_url;?>" method="POST" data-abide>

<h3>Add Voucher</h3>

<div class="row">
	<div class="large-4 columns">
	<?php echo $ledger->error_description;?>
	</div>
</div>


	
 <div class="row">

 		<div class="medium-8 columns" >
 		<fieldset>
 			<legend>Voucher Elements </legend>
 			<div class="medium-6 columns">
				<label for="ledger">Name<small>requied</small>
				<input type="text" name="txtname" id="txtname" value="" required/>
				</label>

				<label for="ledger">Type<small>requied</small>
				<?php echo populate_list_array("lstmvoucher", $masterVouchers, 'id','name', '',$disable=false);?>
				</label>
			
				
			</div>
			<div class="medium-6 columns">
				<label for="ledger">Description</label>
				<textarea name="txtdescription"></textarea>
			</div>
			
		</fieldset>	
 		</div>


 		

 		<div class="medium-4 columns">
 		<fieldset>
 			<legend>Number Series </legend>
 				<div class="row">
	 				<div class="medium-4 columns">
						<label for="ledger"> Prefix</label>
						<input type="text" name="txtprefix" id="txtprefix" value=""/>
					</div>
					<div class="medium-4 columns">
						<label for="ledger">Suffix</label>
						<input type="text" name="txtsufix" id="txtsufix" value=""/>
					</div>
					<div class="medium-4 columns">
						<label for="ledger">Seperator</label>
						<select name="lstseperator">
							<option value="">None</option>
							<option value="_">_</option>
							<option value="-">-</option>
							<option value=".">.</option>
							<option value=":">:</option>
							
						</select>
					</div>
				</div>
				<div class="row">
					<div class="columns">
						<label for="ledger">Start From<small>required</small>
						<input type="text" name="txtseries" id="txtseries" value="" required/>
						</label>
					</div>
				</div>

				
			</fieldset>
 		</div>


</div>			
 		
<div class="row">
<div class="medium-12 columns" >
	<fieldset>
 		<legend>Form Elements</legend>
 		
 		<div class="row">
 			<div class="medium-6 columns" >	
 				<label for="ledger">Header</label>
 				<textarea class="ckeditor" name="txtheader"></textarea>
 			</div>
 		
 			<div class="medium-6 columns">	
 				<label for="ledger">Footer</label>
 				<textarea class="ckeditor" name="txtfooter"></textarea>
 			</div>
 		</div>

 	</fieldset>
 	</div>
</div>

<div class="row" >
<div class="medium-12 columns">	
	<fieldset>
 		<legend>Voucher Settings</legend>

 		<div class="medium-3 columns" >
 			<input type="checkbox" name="chk_hidden" id="chk_hidden"/> Voucher For Module
 		</div>

 		<div class="medium-12 columns" style="display:none;" id="div-settings">

 		<div class="medium-4 columns" >
 			<label for="ledger">Module</label>
 			<?php echo populate_list_array("lstmodules", $g_ARRAY_LIST_MODULE, 'id','name', '',$disable=false,true);?>
 		</div>
 		<div class="medium-4 columns" >
 			<label for="ledger">Account From</label>
 			<?php echo populate_list_array("lstfromledger", $ledgers, 'id','name', '',$disable=false,true);?>
 		</div>
 		<div class="medium-4 columns" >
 			<label for="ledger">Account To</label>
 			<?php echo populate_list_array("lsttoledger", $ledgers, 'id','name', '',$disable=false,true);?>
 		</div>
 		</div>

 	</fieldset>
</div>
</div>


<div class="row" id="v_ac_dtls" >
<div class="medium-12 columns">	
	<fieldset>
 		<legend>Voucher account Details</legend>

 		<div class="medium-4 columns" >
 			<label for="ledger">Source<small id="error_source">required</small>
 			<select name="lstsource" id="lstsource">
 				<option value="-1">Choose from list..</option>
 				<option value="1">Voucher for account</option>
 				<option value="2">Voucher for inventory</option>
 			</select>
 			</label>
 		</div>

 		<div class="medium-8 columns" id="div-dtls1">
 			<div class="medium-6 columns" >
	 			<label for="ledger">Default Account</label>
	 			<select name="lstaccount" id="lstsource">
	 				<option value="<?php echo FROM; ?>">From</option>
	 				<option value="<?php echo TO; ?>">To</option>
	 			</select>
 			</div>
 			<div class="medium-6 columns" >
				<label for="ledger">Ledgers</label>
 				<?php echo populate_multiple_list_array("lstledger", $ledgers, 'id','name', array(),$disable=false,false);?>
 			</div>
 		</div>

 		<div class="medium-8 columns" id="div-dtls2">
 			<div class="medium-4 columns" >
	 			<label for="ledger">Default From Account</label>
	 			<?php echo populate_multiple_list_array("lstfromledger", $ledgers, 'id','name', array(),$disable=false,false);?>
 			</div>
 			<div class="medium-4 columns" >
				<label for="ledger">Default To Account</label>
 				<?php echo populate_multiple_list_array("lsttoledger", $ledgers, 'id','name',  array(),$disable=false,false);?>
 			</div>

 			<div class="medium-4 columns" >
				<label for="ledger">Form Type</label>
 				<?php echo populate_list_array("lstformtype", $form_types, 'id','value', '',$disable=false);?>
 			</div>
 		</div>

 		
	
 		
	</fieldset>	
</div>
</div>

<div class="row">
	<div class="text-center">
		<input class="tiny button"  value="Save" name="submit" type="submit"/>
	</div>
</div>

</form>
 		

