<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
</br>
<div class="row">
	<div class="large-4 columns">
	<?php echo $ledger->error_description;?>
	</div>
</div>


<div class="row">
	<?php if($ledgers <> false){?>
	<div class="medium-5 columns" id="ledger_list" >
		<fieldset>
	 		<legend>List Ledgers </legend>
	 		<div class="scroll-div">
	 		<?php echo $ledgers; ?>
	 		</div>
	 	</fieldset>
	</div>
	<?php }?>
	

	<div class="medium-7 columns">
		<form id="frm-ledger" name="frm-ledger" method="POST" action="<?php echo $current_url;?>">

		<fieldset>
	 		<legend>Add Ledger </legend>
	 		<div class="row">
	 			<div class="medium-8 columns">
	 				<label for="ledger">Ledger Name <small>required</small>
	 				<input type="text" name="txtledger" id="txtledger" value="<?php //echo $add_pooja->name;?>" required/></label>
	 			</div>
	 			<div class="medium-8 columns">
	 				<label for="ledger">Ledger Master</label>
	 				<?php echo populate_list_array("lstmledger", $ledger_masters, 'id','name', '',$disable=false);?>
	 			</div>

	 			<div class="medium-8 columns" id="sub-ledger">
	 				
	 				
	 			</div>

	 		</div>
	 		<div class="row">
		 		<div class="medium-4 columns">
 					<label for="ledger">Opening Balance
 					<select name="lstobtype">
 						<option value=-1>Choose from list..</option>
 						<option value=1>Credit</option>
 						<option value=2>Debit</option>
 					</select>
 					</label>
 				</div>
 				<div class="medium-4 columns">
 					<label for="ledger">Amount
 					<input type="text" name="txtamount" id="txtamount" value=""/></label>
 				</div>
	 		</div>

	 		<div class="row">
	 			<div class="medium-8 columns">
	 				<input class="tiny button"  value="submit" name="submit" type="submit"/>
	 			</div>
 			</div>

	 	</fieldset>
	 	</form>
		
	</div>
</div>
