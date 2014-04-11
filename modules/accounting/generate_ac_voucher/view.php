<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form name="frmvoucher" id="frmvoucher" action="" method="POST">
<input type="hidden" name="hd_ac_id" value="<?php echo $account->account_id; ?>" />
<input type="hidden" name="hd_voucherid" value="<?php echo $voucher->voucher_id; ?>" />

<div class="row" >
	<div class="medium-4 columns">
		<h3><?php echo $page_heading;?></h3>
	</div>

	<div class="text-right" style="margin-top:5px;">
		<a class="tiny button" href="<?php echo $list_url; ?>">Register</a>
	</div>
</div>

<fieldset>
	
	<div class="row">
		<div class="medium-4 columns">
			<label for="voucher">Date</label>
			<input type="text" name="txtdate" id="txtdate" value="<?php echo ($account->date =="")?date('d-m-Y',strtotime(CURRENT_DATE)):date('d-m-Y',strtotime($account->date));?>" class="mydatepicker" <?php echo $readonly;?>/>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">Voucher Number</label>
			<input type="text" name="txtvnumber" id="txtvnumber" value="<?php echo $voucher_number;?>" readonly/>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">Reference Number</label>
			<input type="text" name="txtrnumber" id="txtrnumber" value="<?php echo $account->reference_number?>" <?php echo $readonly;?>/>
		</div>
	</div>

	<div class="row">
		<div class="medium-4 columns">
			<label for="voucher">From</label>
			<?php 
				if(isset($_GET['edt'])){
					$disable=true;
				}else{
					$disable = false;
				}
				if($default_from){
					echo populate_list_array("lstfrom", $ledgers_default_from_filtered, 'id','name', $account->account_from,$disable);
				}else{
					echo populate_list_array("lstfrom", $ledgers_exept_default_to_filtered, 'id','name', $account->account_from,$disable);
				}
			?>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">To</label>
			<?php 
				if($default_to){
					echo populate_list_array("lstto", $ledgers_default_to_filtered, 'id','name', $account->account_to,$disable);
				}else{
					echo populate_list_array("lstto", $ledgers_exept_default_from_filtered, 'id','name', $account->account_to,$disable);
				}
			?>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">Amount</label>
			<input type="text" name="txtamount" id="txtamount" value="<?php echo number_format($amount,2);?>" <?php if($voucher->source == VOUCHER_FOR_INVENTORY){ echo "readonly";}?>/>
		</div>
	</div>
	<div class="row">
		<div class="medium-8 columns">
			<label for="voucher">Narration</label>
			<textarea name="txtnarration"><?php echo $account->narration;?></textarea>
		</div>
	</div>

	<div class="row">

		<div class="medium-8 columns">
			<input type="checkbox" value="1" name="ch_print"> Print Voucher
		</div>
	</div>

	<div class="row">
		<div class="text-center">
			<input class="small button"  value="Save" name="submit" type="submit"/>
		</div>
	</div>



</fieldset>	
</form>
