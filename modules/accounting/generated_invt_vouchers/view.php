<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<form id="" name="form1" method="GET" action="" >

<div class="row" >
	<div class="medium-4 columns">
		<h3><?php echo $page_heading; ?></h3>
	</div>
	
	<div class="text-right" style="margin-top:5px;">
		<?php if(isset($_GET['slno'])){?>
		<a class="tiny button" href="<?php echo $new_url; ?>">New</a>
		<?php }?>
		<!-- <input type="button" class="tiny button" value="print" id="button-print"/> -->
	</div>
	
</div>


	<fieldset>
		<div class="row">		
			<div class="medium-2 columns">
				<label for="name"> From Date</label>
				<input class="mydatepicker" name="txtfrom" id="" value="<?php echo $account->date_from;?>" />
			</div>

			<div class="medium-2 columns">
				<label for="name"> To Date</label>
				<input class="mydatepicker" name="txtto" id="" value="<?php echo $account->date_to;?>" />
			</div>
			<div class="medium-2 columns">
				<input type="submit" class="small button" value="Search" name="submit">
			</div>
				<div class="medium-4 columns">
				&nbsp;
			</div>
			<div class="medium-2 columns">
					<input type="button" class="tiny button" value="Print" id="button-print"/>
				</div>
		</div>
	</fieldset>



<?php if(isset($_GET['bid'])){?>
<input type="hidden" name="bid" value="<?php echo $_GET['bid'];?>" />
	
	<?php if($count_list >0){?>
	<table width="100%">
		<thead>
		<tr>
			<td width="10%">Date</td>
			<td width="20%">Voucher</td>
			<td width="45%">Particulars</td>
			<td width="10%">Debit</td>
			<td width="10%">Credit</td>
			<!-- <td width="5%"></td> -->
		</tr>
		</thead>
		<tbody>
		<?php 
		$i=0;
		while($i < $count_list){
			$edit ="ac_generate_voucher.php?edt=".$account_list[$i]['account_id'];
			$delete ="ac_generate_voucher.php?dlt=".$account_list[$i]['account_id'];
			
		?>
		<tr>
			<td><?php echo $account_list[$i]['date']; ?></td>
			<td><?php echo $account_list[$i]['voucher_name']."-".$account_list[$i]['voucher_number']; ?></td>		
			<td><?php echo $account_list[$i]['ref_ledger_name'].",".$account_list[$i]['narration']; ?></td>
			<td><?php echo $account_list[$i]['account_debit']; ?></td>
			<td><?php echo $account_list[$i]['account_credit']; ?></td>
			<!-- <td>
				<div <?php if(isset($_GET['bid'])) echo 'style="display:none;"'?>>
				<a href="<?php echo $edit; ?>">Edit</a>/
				<a href="javascript:deleteVoucher(<?php echo $account_list[$i]['account_id']?>)">Delete</a>
				</div>
			</td> -->
		</tr>
		<?php $i++; }?>
		<tr>
			<td colspan="6"><?php echo $pagination->pagination_style_numbers();?></td>
		</tr>
		</tbody>
	</table>
	<?php }?>

	<?php ob_start();?>

		<div id="print_content" >
		<h3><?php echo $account_settings->organization_name; ?></h3>
		<p><?php echo $account_settings->organization_address; ?></p>

		<?php if(count($account_total_list) >0){?>
		<h3><?php echo $page_heading; ?></h3>
		<p>Date : <?php echo ($account->date_from == $account->date_to)?$account->date_from:$account->date_from." - ".$account->date_to;?></p>
		<table width="100%">
			<thead>
			<tr>
				<td width="10%">Date</td>
				<td width="20%">Voucher</td>
				<td width="50%">Particulars</td>
				<td width="10%">Debit</td>
				<td width="10%">Credit</td>
				
			</tr>
			</thead>
			<tbody>
			<?php 
			$i=0;
			while($i < count($account_total_list)){
				
			?>
			<tr>
				<td><?php echo $account_total_list[$i]['date']; ?></td>
				<td><?php echo $account_total_list[$i]['voucher_name']."-".$account_total_list[$i]['voucher_number']; ?></td>		
				<td><?php echo $account_total_list[$i]['ref_ledger_name'].",".$account_total_list[$i]['narration']; ?></td>
				<td><?php echo $account_total_list[$i]['account_debit']; ?></td>
				<td><?php echo $account_total_list[$i]['account_credit']; ?></td>
				
			</tr>
			<?php $i++; }?>
			</tbody>
		</table>
		<?php }?>
		</div>
	<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	?>

<?php }else if(isset($_GET['slno'])){?>
<input type="hidden" name="slno" value="<?php echo $_GET['slno'];?>" />

	<?php if($count_list >0){?>

	<table width="100%">
		<thead>
		<tr>
			<td width="5%">Voucher Number</td>
			<td width="10%">Date</td>
			<td width="30%">Narration</td>
			<td width="15%">From</td>
			<td width="15%">To</td>
			<td width="10%">Debit</td>
			<td width="10%">Credit</td>
			<td width="5%"></td>
		</tr>
		</thead>
		<tbody>
		<?php 
		$i=0;
		while($i < $count_list){
			if($voucher->voucher_master_type == ACCOUNT_VOUCHER){
				$edit ="ac_generate_ac_voucher.php?edt=".$account_list[$i]['account_id'];
				$delete ="ac_generate_ac_voucher.php?dlt=".$account_list[$i]['account_id'];
			}else if($voucher->voucher_master_type == INVENTORY_VOUCHER){
				$edit ="ac_generate_invt_voucher.php?edt=".$account_list[$i]['account_id'];
				$delete ="ac_generate_invt_voucher.php?dlt=".$account_list[$i]['account_id'];
			}
			
			
		?>
		<tr>
			<td><?php echo $account_list[$i]['voucher_number']; ?></td>
			<td><?php echo $account_list[$i]['date']; ?></td>
			<td><?php echo $account_list[$i]['narration']; ?></td>
			<td><?php echo $ledger->ledgerName($account_list[$i]['account_to']); ?></td>
			<td><?php echo $ledger->ledgerName($account_list[$i]['account_from']); ?></td>
			<td><?php echo $account_list[$i]['account_debit']; ?></td>
			<td><?php echo $account_list[$i]['account_credit']; ?></td>
			<td>
				<div <?php if(isset($_GET['bid'])) echo 'style="display:none;"'?>>
				<a href="<?php echo $edit; ?>">Edit</a>/
				<a href="javascript:deleteVoucher(<?php echo $account_list[$i]['account_id']?>)">Delete</a>
				</div>
			</td>
		</tr>
		<?php $i++; }?>
		<tr>
			<td colspan="8"><?php echo $pagination->pagination_style_numbers();?></td>
		</tr>
		</tbody>
	</table>

	<?php }?>


	<?php ob_start();?>

		<div id="print_content" >
		<h3><?php echo $account_settings->organization_name; ?></h3>
		<p><?php echo $account_settings->organization_address; ?></p>

		<?php if(count($account_total_list) >0){?>
			<h3><?php echo $page_heading; ?></h3>
			<p>Date : <?php echo ($account->date_from == $account->date_to)?$account->date_from:$account->date_from." - ".$account->date_to;?></p>

			<table width="100%">
			<thead>
			<tr>
				<td width="5%">Voucher Number</td>
				<td width="10%">Date</td>
				<td width="35%">Narration</td>
				<td width="15%">From</td>
				<td width="15%">To</td>
				<td width="10%">Debit</td>
				<td width="10%">Credit</td>
				
			</tr>
			</thead>
			<tbody>
			<?php 
			$i=0;
			while($i < count($account_total_list)){
				
				
			?>
			<tr>
				<td><?php echo $account_total_list[$i]['voucher_number']; ?></td>
				<td><?php echo $account_total_list[$i]['date']; ?></td>
				<td><?php echo $account_total_list[$i]['narration']; ?></td>
				<td><?php echo $ledger->ledgerName($account_total_list[$i]['account_to']); ?></td>
				<td><?php echo $ledger->ledgerName($account_total_list[$i]['account_from']); ?></td>
				<td><?php echo $account_total_list[$i]['account_debit']; ?></td>
				<td><?php echo $account_total_list[$i]['account_credit']; ?></td>
			</tr>
			<?php $i++; }?>
			</tbody>
		</table>
		<?php }?>
		</div>
	<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	?>


<?php }?>
</form>

