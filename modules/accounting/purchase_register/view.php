<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row">
	<h3>Purchase Register</h3>
</div>

<?php if($count_items > 0){?>

<div class="row">
	<table width="100%">
	  	<thead>
		<tr>
			<td width="6%">Sl no</td>
			<td width="9%">Item Code</td>
			<td width="25%">Item Name</td>
			<td width="">Unit Rate</td>
			<td width="">Qty</td>
			<td>Gross Amt</td>
			<td>Tax</td>
			<td>Net Amt</td>
		</tr>
		</thead>
		<tbody>
		<?php $slno = ($pagination->page_num*$pagination->max_records)+1;
		foreach ($items as $item) {?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $item['item_code']?></td>
			<td><?php echo $item['item_name']?></td>
			<td><?php echo $item['unit_rate']?></td>
			<td><?php echo $item['quantity']." ".$item['uom_value'];?></td>
			<td><?php echo number_format($item['gross_amt'],2)?></td>
			<td><?php echo number_format($item['tax'],2)?></td>
			<td><?php echo number_format($item['net_amt'],2)?></td>
		</tr>
		<?php $slno++; }?>
		<tr>
			<td colspan="8"><?php echo $pagination->pagination_style_numbers();?></td>
		</tr>
		</tbody>
	</table>
</div>

<?php }?>
