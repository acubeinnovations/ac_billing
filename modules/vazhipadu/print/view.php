<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
ob_start();
?>
<div style="width:600px;">	
	
	<div class="row" style="height:75px;">
			<div class="medium-6 columns">
				Pooja :<?php echo $vazhipadu->pooja_description; ?>	
			</div>

			<div class="medium-4 columns">
				Receipt Number :<?php echo $vazhipadu->vazhipadu_rpt_number; ?><br/>
				Date :<?php echo $vazhipadu->vazhipadu_date; ?>
			</div>
	</div>

	<?php if($vazhipadu_details){?>
	

	<div class="row">
		<table width="100%" >
			<thead>
				<tr>
					<td>Name</td>
					<td>Star</td>
					<td>Amount</td>
				</tr>
			</thead>
			<tbody>
				<?php $i=0;$total = 0;
				while($i<count($vazhipadu_details)){
					$total += $vazhipadu_details[$i]['rate'];
				?>
				<tr>
					<td><?php echo $vazhipadu_details[$i]['name']	;?></td>
					<td><?php echo $vazhipadu_details[$i]['star']; ?></td>
					<td><?php echo $vazhipadu_details[$i]['rate']; ?></td>
					
				</tr>
				<?php $i++;}?>
				<tr>
					<td></td>
					<td align="right" style="font-weight:bold;">Total</td>
					<td style="font-weight:bold;"><?php echo $total;?></td>
				</tr>
			</tbody>
		</table>
	</div>
	<?php }?>

</div>


<?php 
$print_content = ob_get_contents();
ob_end_clean();
echo $print_content;?>
