<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<form id="" name="form1" method="GET" action="" >
<div class="row" >
	<div class="medium-6 columns">
		<h3><?php echo $type?> Register</h3>
	</div>
	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<input type="button" class="tiny button" value="print" id="button-print"/>
		</div>
	</div>
</div>

<fieldset>
	<div class="row">		
		<div class="medium-2 columns">
			<label for="name"> From Date</label>
			<input class="mydatepicker" name="txtfrom" id="" value="<?php echo $stock_register->date_from;?>" />
		</div>

		<div class="medium-2 columns">
			<label for="name"> To Date</label>
			<input class="mydatepicker" name="txtto" id="" value="<?php echo $stock_register->date_to;?>" />
		</div>
		<div class="medium-2 columns">
			<input type="submit" class="small button" value="Search" name="submit">
		</div>
			<div class="medium-4 columns">
			&nbsp;
		</div>
		
	</div>
</fieldset>





<?php if($count_items > 0){?>

<div class="row">
	<div class="medium-12 columns">
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
</div>

<?php }?>



<?php ob_start();?>
	<h3><?php echo $account_settings->organization_name; ?></h3>
	<p><?php echo $account_settings->organization_address; ?></p>
<?php if(count($all_items) > 0){?>

<h5><?php echo $type?> Register</h5>
<p>Date : <?php echo ($stock_register->date_from == $stock_register->date_to)?$stock_register->date_from:$stock_register->date_from." - ".$stock_register->date_to;?></p>



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
		<?php $slno = 1;
		foreach ($all_items as $item) {?>
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
		</tbody>
	</table>
<?php }?>

<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	
?>
</form>
