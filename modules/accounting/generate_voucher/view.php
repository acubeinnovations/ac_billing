<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form name="frmvoucher" id="frmvoucher" action="" method="POST">
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
	

	<?php if($voucher->source == VOUCHER_FOR_ACCOUNT){?>
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
			<input type="text" name="txtamount" id="txtamount" value="<?php echo $amount;?>"/>
		</div>
	</div>
	<div class="row">
		<div class="medium-8 columns">
			<label for="voucher">Narration</label>
			<textarea name="txtnarration"><?php echo $account->narration;?></textarea>
		</div>
	</div>

	<div class="row">
		<div class="text-center">
			<input class="tiny button"  value="Save" name="submit" type="submit"/>
		</div>
	</div>

	<?php }else if($voucher->source == VOUCHER_FOR_INVENTORY){?>

	<div class="row">
		<div class="medium-4 columns">
			<label for="voucher">Date</label>
			<input type="text" name="txtdate" id="txtdate" value="<?php echo $account->date?>" class="mydatepicker" <?php echo $readonly;?>/>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">Voucher Number</label>
			<input type="text" name="txtvnumber" id="txtvnumber" value="<?php echo $voucher_number;?>" readonly/>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">Reference Number</label>
			<input type="text" name="txtrnumber" id="txtrnumber" value="<?php echo $account->reference_number?>"/>
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
					echo populate_list_array("lstfrom", $ledgers_all, 'id','name', $account->account_from,$disable);
				}
			?>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">To</label>
			<?php 
				if($default_to){
					echo populate_list_array("lstto", $ledgers_default_to_filtered, 'id','name', $account->account_to,$disable);
				}else{
					echo populate_list_array("lstto", $ledgers_all, 'id','name', $account->account_to,$disable);
				}
			?>
		</div>

		<div class="medium-4 columns">
			<label for="voucher">Amount</label>
			<input type="text" name="txtamount" id="txtamount" value="<?php echo $amount;?>" disabled/>
		</div>
		
	</div>
	<div class="row">

		<div class="medium-8 columns">
			<label for="voucher">Narration</label>
			<textarea name="txtnarration"><?php echo $account->narration;?></textarea>
		</div>
	</div>


	<div class="row">
		<div class="medium-12 columns">
		<table  id="tbl-append">
			<thead>
			<tr>
				<td width="10%">Item Code</td>
				<td width="30%">Item Description</td>
				<td width="10%">Quantity</td>
				<td width="10%">Unit Rate</td>
				<td width="10%">Tax(%)</td>
				<td width="10%">Total</td>
				<td></td>
			</tr>
			</thead>
			<tbody>
				<?php if($edt_items){
					foreach($edt_items as $item){
				?>
				<tr>
					<td><?php echo $item['item_id'];?><input type="hidden" name="hd_itemcode[]" value="<?php echo $item['item_id'];?>"></td>
					<td><?php echo $item['item_name'];?></td>
					<td><?php echo $item['quantity'];?><input type="hidden" name="hd_itemqty[]" value="<?php echo $item['quantity'];?>"></td>
					<td><?php echo $item['unit_rate'];?><input type="hidden" name="hd_itemrate[]" value="<?php echo $item['unit_rate'];?>"></td>
					<td><?php echo $item['tax'];?>%<input type="hidden" name="hd_itemtax[]" value="<?php echo $item['tax'];?>"></td>
					<td><?php echo $item['total'];?></td>
					<td></td>
				</tr>
				<?php }
					}
				?>
				<tr id="insert-item">
					<td><input type="text" name="txtcode" id="txtcode" value="" /></td>
					<td><?php echo populate_list_array("lstitem", $items, 'id','name', '',$disable=false);?></td>
					<td><input type="text" name="txtquantity" id="txtquantity" value="1" /></td>
					<td><input type="text" name="txtrate" id="txtrate" value=0.00 /></td>
					<td><?php echo populate_list_array("lsttax", $taxes, 'id','rate','',$disable=false,true);?></td>
					<td><label id="txtlinetotal">0.00</label></td>
					<td>
						<input type="hidden" name="hd_stock" id="hd_stock" value=0/>
						<input type="button" name="button-add" value="Add Item" id="button-add"/>
					</td>
				</tr>	
			</tbody>

		</table>
		</div>
	</div>


	<div class="row">
		<div class="text-center">
			<input class="small button"  value="Save" name="submit" type="submit"/>
		</div>
	</div>

	<?php }?>

</fieldset>	
</form>
