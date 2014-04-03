<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-4 columns">
		<h3>Search Ledger</h3>
	</div>
	<div class="text-right" style="margin-top:5px;">
		<input type="button" class="tiny button" value="print" id="button-print"/>
	</div>
</div>





<form data-abide target="_self" method="GET" action="<?php echo $current_url?>" name="frmsearch" id="frmsearch">
	<fieldset>
 		<div class="row">
 			<div class="medium-4 columns">
 				<label for="ledger">Select Ledger</label>
    			<?php echo populate_list_array("lstledger", $ledgers, 'id','name', $account->ref_ledger,$disable=false);?>
    		</div>
    		<div class="medium-3 columns">
 				<label for="ledger">Date From</label>
    			<input type="text" name="txtfromdate" id="txtfromdate"  value="<?php echo $datefrom;?>" class="mydatepicker"/>
    		</div>

    		<div class="medium-3 columns">
 				<label for="ledger">Date To</label>
    			<input type="text" name="txttodate" id="txttodate"  value="<?php echo $dateto;?>" class="mydatepicker"/>
    		</div>
    		<div class="medium-2 columns">
	    		<div class="text-center">
					<input type="submit" name="submit" value="Search" class="tiny button" />
	 			</div>
	 		</div>
 		</div>
 	</fieldset>
 	    
</form>

<?php if(isset($count_list)){?>
<table width="100%">
	<thead>
	<tr>
		<td width="10%">Date</td>
		<td width="10%">Voucher Number</td>
		<td width="20%">Voucher Type</td>
		<td width="40%">Particulars</td>
		<td width="10%">Debit</td>
		<td width="10%">Credit</td>
	</tr>
	</thead>
	<tr>
		<td colspan="4"><b>Opening Balance </b></td>
		<td width="10%"><b><?php if(isset($subledger_opening) && $subledger_opening!=false){
				echo $subledger_opening[0]["balance_dr"];
			}else{ echo 0; }?></b></td>
		<td width="10%"><b><?php if(isset($subledger_opening) && $subledger_opening!=false){
				echo $subledger_opening[0]["balance_cr"];
			}else{ echo 0; }?></b></td>
	</tr>


	<tbody>
	<?php 
	$i=0;
	while($i < $count_list){
	?>
	<tr>
		<td><?php echo $account_list[$i]['date']; ?></td>
		<td><?php echo $account_list[$i]['voucher_number']; ?></td>
		<td><?php echo $account_list[$i]['voucher_name']; ?></td>
		<td><?php echo  $ledger->ledgerName($account_list[$i]['account_to'])."-".$account_list[$i]['narration']; ?></td>
		<td><?php echo $account_list[$i]['account_debit']; ?></td>
		<td><?php echo $account_list[$i]['account_credit']; ?></td>
	</tr>
	<?php $i++; }?>
	<tr>
		<td colspan="4"><b>Closing Balance </b></td>
		<td width="10%"><b><?php if(isset($subledger_closing) && $subledger_closing!=false){
				echo $subledger_closing[0]["balance_dr"];
			}else{ echo 0; }?></b></td>
		<td width="10%"><b><?php if(isset($subledger_closing) && $subledger_closing!=false){
				echo $subledger_closing[0]["balance_cr"];
			}else{ echo 0; } ?></b></td>
	</tr>
	<tr>
		<td colspan="6"><?php  echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
	
<?php }?>


<?php ob_start();?>
	<h3><?php echo $account_settings->organization_name; ?></h3>
	<p><?php echo $account_settings->organization_address; ?></p>
<?php if( isset($account_total_list) and count($account_total_list) > 0){?>
	<h5><?php echo $ledger_name; ?></h5>
	<p>Date :<?php echo $datestr;?></p>
	<table width="100%">
	<thead>
	<tr>
		<td width="10%">Date</td>
		<td width="10%">Voucher Number</td>
		<td width="20%">Voucher Type</td>
		<td width="40%">Particulars</td>
		<td width="10%">Debit</td>
		<td width="10%">Credit</td>
	</tr>
	</thead>
	<tr>
		<td colspan="4"><b>Opening Balance </b></td>
		<td width="10%"><b><?php if(isset($subledger_opening) && $subledger_opening!=false){
				echo $subledger_opening[0]["balance_dr"];
			}else{ echo 0; }?></b></td>
		<td width="10%"><b><?php if(isset($subledger_opening) && $subledger_opening!=false){
				echo $subledger_opening[0]["balance_cr"];
			}else{ echo 0; }?></b></td>
	</tr>


	<tbody>
	<?php 
	$i=0;
	while($i < count($account_total_list)){
	?>
	<tr>
		<td><?php echo $account_total_list[$i]['date']; ?></td>
		<td><?php echo $account_total_list[$i]['voucher_number']; ?></td>
		<td><?php echo $account_total_list[$i]['voucher_name']; ?></td>
		<td><?php echo  $ledger->ledgerName($account_total_list[$i]['account_to'])."-".$account_total_list[$i]['narration']; ?></td>
		<td><?php echo $account_total_list[$i]['account_debit']; ?></td>
		<td><?php echo $account_total_list[$i]['account_credit']; ?></td>
	</tr>
	<?php $i++; }?>
	<tr>
		<td colspan="4"><b>Closing Balance </b></td>
		<td width="10%"><b><?php if(isset($subledger_closing) && $subledger_closing!=false){
				echo $subledger_closing[0]["balance_dr"];
			}else{ echo 0; }?></b></td>
		<td width="10%"><b><?php if(isset($subledger_closing) && $subledger_closing!=false){
				echo $subledger_closing[0]["balance_cr"];
			}else{ echo 0; } ?></b></td>
	</tr>
	</tbody>
</table>

<?php }?>
<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	
?>





