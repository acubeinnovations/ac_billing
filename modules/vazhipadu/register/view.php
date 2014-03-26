<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>


<div class="row" >
	<div class="medium-4 columns">
		<h3>Vazhipadu Register</h3>
	</div>
<div class="medium-8 columns">
	<div class="text-right" style="margin-top:5px;">
		<a class="tiny button" href="vazhipadu.php">New</a>
		<input type="button" class="tiny button" value="print" id="button-print"/>
	</div>
	</div>
</div>

<form id="" name="form1" method="GET" >
	<fieldset>
		<div class="row">		
			<div class="medium-2 columns">
				<label for="name"> From Date
				<input class="mydatepicker" name="txtfrom" id="" value="<?php echo $vazhipadu->from_date;?>" /></label>
			</div>

			<div class="medium-2 columns">
				<label for="name"> To Date
				<input class="mydatepicker" name="txtto" id="" value="<?php echo $vazhipadu->to_date;?>" /></label>
			</div>
			<div class="medium-2 columns">
				<input type="submit" class="tiny button" value="Search" name="submit">
			</div>

		</div>
	</fieldset>
</form>

<div class="medium-12 columns">
<?php if(isset($count)){?>
<div class="row">

	<!--<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="10%">Voucher Number</td>
				<td width="20%">Date</td>
				<td>Pooja Details</td>
				<td width="15%">Amount</td>
			</tr>
		</thead>
		<tbody
			<?php 
			$i=0;$total_amount = 0;
			while($i<$count){
			?>
		<tr>
			<td><?php echo $vazhipadu_list[$i]['vazhipadu_rpt_number']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['vazhipadu_date']; ?></td>
			<td>
				<?php echo $vazhipadu_list[$i]['pooja_name']; 
				if($vazhipadu_list[$i]['details']){
				?>
				<table width="100%">
					<thead>
					<tr>
						<td width="40%">Name</td>
						<td width="40%">Star</td>
						<td width="20%">Amount</td>
					</tr>
					</thead>
					<tbody>
						<?php foreach ($vazhipadu_list[$i]['details'] as $details) {?>
							<tr>
								<td><?php echo $details['name'];?></td>
								<td><?php echo $details['star'];?></td>
								<td><?php echo $vazhipadu_list[$i]['unit_rate']; ?></td>
								
							</tr>
						<?php }?>
					</tbody>
				</table>
				<?php }?>
				
			</td>
			<td><?php echo number_format($vazhipadu_list[$i]['amount'],2); ?></td>

		</tr>
		<?php $total_amount+=$vazhipadu_list[$i]['amount'];$i++;}?>
		<tr>
			<td colspan="3" align="right" style="font-weight:bold;">Total</td>
			<td><?php echo $total_amount;?></td>
		</tr>
			
		</tbody>

		

	</table>-->

	<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="8%">Voucher Number</td>
				<td width="10%">Date</td>
				<td width="30%">Pooja</td>
				<td>Name</td>
				<td width="15%">Star</td>
				<td width="10%">Amount</td>
			</tr>
		</thead>
		<tbody>
			<?php 
			$i=0;$total_amount = 0;
			while($i<$count){
			?>
		<tr>
			<td><?php echo $vazhipadu_list[$i]['vazhipadu_rpt_number']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['vazhipadu_date']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['pooja_name']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['name']; ?></td>
			<td><?php echo $vazhipadu_list[$i]['star_name']; ?></td>
			<td><?php echo number_format($vazhipadu_list[$i]['unit_rate'],2); ?></td>
		</tr>
		<?php $total_amount+=$vazhipadu_list[$i]['unit_rate'];$i++;}?>
		<tr style="font-weight:bold;">
			<td colspan="5" align="right" >Total</td>
			<td><?php echo number_format($total_amount,2);?></td>
		</tr>
			
		</tbody>

		

	</table>


	</div>
</div>
<div class="medium-12 columns">
<div class="row">
	<?php echo $pagination->pagination_style_numbers();?>
</div></div>

<?php }else{?>		
<div class="medium-12 columns">
<div class="text-center">
No Records Found
</div>
</div>

<?php }?>





<?php ob_start();?>
<h3>Vazhipadu Register</h3>
<p>Date : <?php echo ($vazhipadu->from_date == $vazhipadu->to_date)?$vazhipadu->from_date:$vazhipadu->from_date." - ".$vazhipadu->to_date;?></p>
<div>
<?php if($vazhipadu_total_list){?>

<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="8%">Voucher Number</td>
				<td width="10%">Date</td>
				<td width="30%">Pooja</td>
				<td>Name</td>
				<td width="15%">Star</td>
				<td width="10%">Amount</td>
			</tr>
		</thead>
		<tbody
			<?php 
			$i=0;$total_amount = 0;
			while($i<count($vazhipadu_total_list)){
			?>
		<tr>
			<td><?php echo $vazhipadu_total_list[$i]['vazhipadu_rpt_number']; ?></td>
			<td><?php echo $vazhipadu_total_list[$i]['vazhipadu_date']; ?></td>
			<td><?php echo $vazhipadu_total_list[$i]['pooja_name']; ?></td>
			<td><?php echo $vazhipadu_total_list[$i]['name']; ?></td>
			<td><?php echo $vazhipadu_total_list[$i]['star_name']; ?></td>
			<td><?php echo number_format($vazhipadu_total_list[$i]['unit_rate'],2); ?></td>
		</tr>
		<?php $total_amount+=$vazhipadu_total_list[$i]['unit_rate'];$i++;}?>
		<tr style="font-weight:bold;">
			<td colspan="5" align="right" >Total</td>
			<td><?php echo number_format($total_amount,2);?></td>
		</tr>
			
		</tbody>

		

	</table>
<?php }?>
</div>
<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	//echo $print_content;
	
?>



		



