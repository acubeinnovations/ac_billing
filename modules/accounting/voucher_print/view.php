<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
ob_start();
?>


<div id="wrapper" style="margin-top:10px;">
	<div id="header">
		<?php echo $voucher->header; ?>
	</div>
	<div id="content">
		<table width="600px">
			<tr>
				<td style="font-weight:bold;"><?php echo $voucher->voucher_name; ?></td>
				<td>
					Receipt Number :<?php echo $voucher->number_series; ?><br/>
					Date :<?php echo $account->date; ?>
				</td>
			</tr>
			<tr>
				<td colspan="2">
					<?php if($voucher->source == VOUCHER_FOR_ACCOUNT){?>
						<table width="580px">
							<tr>
								<td colspan="3">
								<b>Narration : </b><?php echo $account->narration; ?>
								</td>
							</tr>
							<tr>
								<th width="330px" align="left">Ledger</th>
								<th width="125px" align="left">Credit</th>
								<th width="125px" align="left">Debit</th>
							</tr>
							<?php 
								$i=0;$debit_total = 0;$credit_total = 0;
								while($i < count($voucher_print)){
							?>
							<tr>
								<td><?php echo $voucher_print[$i]['ledger_name'];?></td>
								<td><?php echo $voucher_print[$i]['credit']; ?></td>
								<td><?php echo $voucher_print[$i]['debit']; ?></td>
							</tr>
							<?php
									$debit_total += $voucher_print[$i]['debit'];
									$credit_total += $voucher_print[$i]['credit'];
									$i++;
								}?>
							<tr style="font-weight:bold;">
								<td>Amount</td>
								<td><?php echo $credit_total;?></td>
								<td><?php echo $debit_total;?><br/><?php echo convert_digit_to_words($debit_total);?></td>
							</tr>
							
						</table>
					<?php }else if($voucher->source == VOUCHER_FOR_INVENTORY){?>
						<table width="580px">
							<tr>
								<td colspan="5">
								<b>Narration : </b><?php echo $account->narration; ?>
								</td>
							</tr>
							<?php if($items){?>
							<tr>
								<th width="330px" align="left">Item</th>
								<th width="50px" align="left">Quantity</th>
								<th width="100px" align="left">Rate</th>
								<th>Tax (%)</th>
								<th width="100px" align="left">Total</th>
							</tr>
							<?php 
							$i=0;$grand_total = 0;
							while($i < count($items)){
							?>
							<tr>
								<td><?php echo $items[$i][4];?></td>
								<td><?php echo $items[$i][8];?></td>
								<td><?php echo $items[$i][7];?></td>
								<td><?php echo $items[$i][6];?></td>
								<td><?php echo $items[$i][15];?></td>
							</tr>
							<?php 
								$grand_total += $items[$i][15]; 
								$i++;
							}?>
							<tr style="font-weight:bold;">
								<td colspan="4" align="right">Grand Total</td>
								<td><?php echo $grand_total; ?></td>
							</tr>
							<?php }?>
						</table>
					<?php }?>
				</td>
			</tr>
		</table>
	</div>
	<div id="footer">
		<?php echo $voucher->footer;?>
	</div>
</div>


<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	echo $print_content;
	
?>