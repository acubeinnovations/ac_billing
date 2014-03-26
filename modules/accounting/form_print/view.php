
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

	<?php if($form_variables){?>
	<div id="content">
		<table>
			<thead>
			<tr>
				<?php foreach($form_variables as $variable){
					if(in_array($variable['id'], $form_type_variables)){?>
					<td><?php echo $variable['description'];?></td>
				<?php }}?>
			</tr>
			</thead>
			<tbody>
			<?php foreach ($items as $item) {?>
			<tr>
				<?php 
				foreach($form_type_variables as $vble){?>
				<td>
				<?php echo $item[$vble];
				?>
				</td>
				<?php }?>
			</tr>
			<?php }?>

			
			<tr height=50>
				<td colspan="3" align="right" style="font-weight:bold;">Total</td>
				<?php $i=0;
				foreach($form_type_variables as $vble){
					if($i<3){

					}else{
				?>

				<td>
				<?php if(array_key_exists($vble, $totals)){
					echo $totals[$vble];
				}
				?>
				</td>
				<?php
					}$i++;
				}?>
			</tr>
			


			</tbody>
		</table>
	</div>
	<?php }?>

	<div id="footer">
		<?php echo $voucher->footer;?>
	</div>
</div>

<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	echo $print_content;
	
?>
