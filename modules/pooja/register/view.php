<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}


?>

<div class="row" >
	<div class="medium-4 columns">
		<h3>Pooja Register</h3>
	</div>
<div class="medium-8 columns">
	<div class="text-right" style="margin-top:5px;">
		<input type="button" class="tiny button" value="print" id="button-print"/>
	</div>
	</div>
</div>

<form id="frmpooja" name="frmpooja" method="GET" action="<?php echo $current_url;?>">
	<fieldset>
		<div class="row">
			<div class="medium-2 columns">
				<label for="name"> From Date
				<input class="mydatepicker" name="txtfrom" id="" value="<?php echo $pooja->from_date;?>" /></label>
			</div>

			<div class="medium-2 columns">
				<label for="name"> To Date
				<input class="mydatepicker" name="txtto" id="" value="<?php echo $pooja->to_date;?>" /></label>
			</div>
			<div class="medium-2 columns">
				<input type="submit" class="tiny button" value="Search" name="submit">
			</div>
			
		</div>
	</fieldset>
</form>

<div class="row">
<div class="medium-12 columns">
<?php if($count_pooja > 0){?>
	<table width="100%">
		<thead>
		<tr>
			<td width="10%">Slno</td>
			<td width="45%">Pooja Details</td>
			<td width="15%">Unit Rate</td>
			<td width="15%">Qty</td>
			<td width="15%">Total</td>
		</tr>
		</thead>
		<tbody>
		<?php 
			$i=0;$slno = ($pagination->page_num*$pagination->max_records)+1;
			$total_qty = 0;$total_amount =0;
			while($i<$count_pooja){
		?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $pooja_list[$i]['name']?></td>
			<td><?php echo number_format($pooja_list[$i]['rate'],2)?></td>
			<td><?php echo $pooja_list[$i]['quantity']?></td>
			<td><?php echo number_format($pooja_list[$i]['total'],2);?></td>
		</tr>
		<?php
				$total_qty += $pooja_list[$i]['quantity'];$total_amount +=$pooja_list[$i]['total'];
				$i++;$slno++;
			}
		?>
		<tr style="font-weight:bold;">
			<td colspan="3" align="right">Total</td>
			<td><?php echo $total_qty;?></td>
			<td><?php echo $total_amount;?></td>
		</tr>
		<tr>
			<td colspan="5"><?php  $pagination->pagination_style_numbers();?></td>
		</tr>
		</tbody>
	</table>
<?php }else{?>
	No Records Found;
<?php }?>

</div>
</div>

<?php ob_start();?>
<div id="print_content" >
	
	<h3><?php echo $account_settings->organization_name; ?></h3>
	<p><?php echo $account_settings->organization_address; ?></p>
	<h3>Pooja Register</h3>
	<p>Date : <?php echo ($pooja->from_date == $pooja->to_date)?$pooja->from_date:$pooja->from_date." - ".$pooja->to_date;?></p>
	<?php if(count($pooja_total_list) > 0){?>
	<table width="100%">
		<thead>
		<tr>
			<td width="10%">Slno</td>
			<td width="50%">Pooja Details</td>
			<td width="15%">Unit Rate</td>
			<td width="10%">Qty</td>
			<td >Total</td>
		</tr>
		</thead>
		<tbody>
		<?php 
			$i=0;$slno = 1;
			while($i<count($pooja_total_list)){
		?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $pooja_total_list[$i]['name']?></td>
			<td><?php echo $pooja_total_list[$i]['rate']?></td>
			<td><?php echo $pooja_total_list[$i]['quantity']?></td>
			<td><?php echo $pooja_total_list[$i]['total']?></td>
		</tr>
		<?php
				$i++;$slno++;
			}
		?>
		
		</tbody>
	</table>
<?php }else{?>
	No Records Found;
<?php }?>
</div>
<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	
?>