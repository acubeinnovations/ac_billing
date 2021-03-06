<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form name="frmvoucher" id="frmvoucher" action="" method="POST">
<input type="hidden" name="hd_ac_id" value="<?php echo $account->account_id; ?>" />
<input type="hidden" name="hd_voucherid" value="<?php echo $voucher->voucher_id; ?>" />
<input type="hidden" name="hd_int_type" id="hd_int_type" value="<?php echo $voucher->inventory_type; ?>" />

<?php if($voucher->cash_discount == DEFAULT_TRUE){?>
<input type="hidden" name="hd_discount" id="hd_discount" value="<?php echo $voucher->cash_discount; ?>" />
<?php }?>

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
			<label for="voucher">From  :
			<input type="radio" name="radio" value="<?php echo $ac_tx_CASH;?>" checked /> Cash / 
			<input type="radio" name="radio" value="<?php echo $ac_tx_CREDIT;?>" /> Credit
			
			<?php 
				if(isset($_GET['edt'])){
					$disable=true;
				}else{
					$disable = false;
				}
				if($ledgers_from){
					echo populate_list_array("lstfrom", $ledgers_from, 'id','name', $account->account_from,$disable);
				}
			?>
			</label>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">To :

			<?php  
				if($ledgers_to){
					echo populate_list_array("lstto", $ledgers_to, 'id','name', $account->account_to,$disable);
				}
			?>
			</label>
		</div>
		<div class="medium-4 columns">
			<label for="voucher">Amount</label>
			<input type="text" name="txtamount" id="txtamount" readonly value="<?php echo number_format($amount,2);?>"/>
		</div>
	</div>
	<div class="row">
		<div class="medium-8 columns">
			<label for="voucher">Narration</label>
			<textarea name="txtnarration"><?php echo $account->narration;?></textarea>
		</div>
	</div>

	<div class="row">

		<div class="medium-4 columns">
			<input type="checkbox" value="1" name="ch_print"> Print Voucher
		</div>


	</div>
	
	
	<div class="row">
		<div class="medium-12 columns">
		<input type="hidden" name="hd_total" id="hd_total" value= 0 />

		<table  id="tbl-append">
			<thead>
			<tr>
				<td width="7%">Item Code</td>
				<td width="25%">Item Description</td>
				<td width="7%">Qty</td>
				<td width="10%">Unit Rate</td>
				<?php if($voucher->cash_discount == DEFAULT_TRUE){?>
				<td width="10%">Cash Discount</td>
				<?php }?>
				<td width="10%">Tax(%)</td>
				<td width="10%">Total</td>
				<td></td>
			</tr>
			</thead>
			<tbody>
				<?php if($edt_items){

					
					foreach($edt_items as $item){
						
				?>
				<tr id="save">
					<td><?php echo $item['item_id'];?><input type="hidden" name="hd_itemcode[]" value="<?php echo $item['item_id'];?>"></td>
					<td><?php echo $item['item_name'];?></td>
					<td><?php echo $item['quantity'];?><input type="hidden" name="hd_itemqty[]" value="<?php echo $item['quantity'];?>"></td>
					<td><?php echo $item['unit_rate'];?><input type="hidden" name="hd_itemrate[]" value="<?php echo $item['unit_rate'];?>"></td>
					<?php if($voucher->cash_discount == DEFAULT_TRUE){?>
					<td >0.00</td>
					<?php }?>
					<td><?php echo $item['tax_rate'];?>%<input type="hidden" name="hd_itemtax[]" value="<?php echo $item['tax'];?>"></td>
					<td>
						<?php echo number_format($item['total'],2);?>
						<input type="hidden" name="hd_itemtotal[]" value="<?php echo $item['total'];?>" />
					</td>
					<td>
						<img src="/images/edit.png" class="edit" title="edit"/>
						<img src="/images/delete.png" class="delete" title="delete"/>
					</td>
				</tr>
				<?php }
					}
				?>
				<tr id="insert-item">
					<td><input type="text" name="txtcode" id="txtcode" value="" /></td>
					<td><?php echo populate_list_array("lstitem", $items, 'id','name', '',$disable=false);?></td>
					<td><input type="text" name="txtquantity" id="txtquantity" value="1" /></td>
					<td><input type="text" name="txtrate" id="txtrate" value=0.00 /></td>
					<?php if($voucher->cash_discount == DEFAULT_TRUE){?>
					<td >
						<input type="text" id="txtdiscount" name="txtdiscount" value="<?php echo number_format($discount,2);?>"/>
					</td>
					<?php }?>
					<td><?php echo populate_list_array("lsttax", $taxes, 'id','rate','',$disable=false,true);?></td>
					<td><label id="txtlinetotal">0.00</label></td>
					<td>
						<input type="hidden" name="hd_stock" id="hd_stock" value=0/>
						<input type="button" name="button-add" value="+" id="button-add" class="tiny secondary button" />
					</td>
				</tr>
				<?php if($tax_rows){ 
					foreach($tax_rows as $row){
				?>
				<tr class="trtax" style="font-weight:bold;">
					<td colspan="6" align="right"><?php echo $row['ref_ledger_name'];?></td>
					<td colspan="2" align="left">
						<input type="hidden" name="hd_tax_ledger[]" value="<?php echo $row['ref_ledger'];?>" />
						<div class="medium-6 columns">
							<span id="lbl_tax">
								<?php 
								if($voucher->inventory_type == INVENTORY_TYPE_SALE){
									echo $row['account_credit'];
								}else if($voucher->inventory_type == INVENTORY_TYPE_PURCHASE){
									echo $row['account_debit'];
								}
								?>

							</span>
						</div>
					</td>
				</tr>
				<?php }
				}?>


				<?php if($voucher->freight_demurge > 0){?>
				<tr style="font-weight:bold;">
					<td colspan="6" align="right">Freight and Demurge</td>
					<td colspan="2" align="left">
						<div class="medium-6 columns">
						<input type="text" id="txtfreight" name="txtfreight" value="<?php echo number_format($freight,2);?>"/>
						</div>
					</td>
				</tr>
				<?php }?>

				<?php if($voucher->round_off > 0){?>
				<tr style="font-weight:bold;">
					<td colspan="6" align="right">Round Off</td>
					<td colspan="2" align="left">
						<div class="medium-6 columns">
						<span id="lbl_round">
							<input type="hidden" name="hd_round" id="hd_round" value="<?php echo number_format($roundoff,2);?>" />
							<?php echo number_format($roundoff,2);?>
						</span>
						</div>
					</td>
				</tr>
				<?php }?>

				<tr style="font-weight:bold;">
					<td colspan="6" align="right">Total Amount</td>
					<td colspan="2" align="left">
						<div class="medium-6 columns">
						<span id="lbl_total"><?php echo number_format($amount,2);?></span>
						</div>
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



</fieldset>	
</form>
