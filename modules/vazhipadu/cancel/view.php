<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>


<h3>Cancel Vazhipadu</h3>

<form id="" name="form1" method="GET" >
	<fieldset>
		<div class="row">		
			<div class="medium-2 columns">
				<label for="name"> Date
				<input class="mydatepicker" name="txtdate" id="txtdate" value="<?php echo $vazhipadu->vazhipadu_date;?>" /></label>
			</div>

			
			<div class="medium-2 columns">
				<label for="name"> Receipt Number
				<input  name="txtrpt" id="txtrpt" value="<?php echo $vazhipadu->vazhipadu_rpt_number;?>" /></label>
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

	<table width="100%" id="tbl-append">
		<thead>
			<tr>
				<td width="10%">Voucher Number</td>
				<td width="20%">Date</td>
				<td>Pooja Details</td>
				<td width="15%">Amount</td>
				<td></td>
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
			<td><a href="javascript:cancelVazhipadu('<?php echo $vazhipadu_list[$i]['vazhipadu_rpt_number'];?>')">Cancel</a></td>

		</tr>
		<?php $total_amount+=$vazhipadu_list[$i]['amount'];$i++;}?>
		<!--<tr>
			<td colspan="3" align="right" style="font-weight:bold;">Total</td>
			<td><?php echo $total_amount;?></td>
		</tr>-->
			
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






		



