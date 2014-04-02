<div class="medium-12 colum"> <a href="#" onclick="window.print();" class="button right" >Print</a></div>

<?php ob_start(); ?>
<br/>
<h4>Profit and Loss for year <?php echo $mybalancesheet->fy_name ." (" . date("d-m-Y",strtotime($mybalancesheet->fy_start)) . " to " .date("d-m-Y",strtotime($mybalancesheet->fy_end)) .")";	 ?></h4>
<table width="100%">
	<tr>
	<td width="50%" valign="top">
		<table width="100%">
			<tr><th colspan="2">Profit / Income</th></tr>
		<?php foreach ($sheet["income"] as $key => $value) {?>
			<tr><td align="left" ><?php echo $value["ledger_sub_name"]; ?></td> <td align="right"><?php echo $value["balance"]; ?></td></td>
		<?php } ?>
		</table>
	</td>
	<td width="50%" valign="top">
		<table width="100%">
			<tr><th colspan="2" >Loss / Expense</th></tr>
		<?php foreach ($sheet["expenses"] as $key => $value) {?>
			<tr><td align="left" ><?php echo $value["ledger_sub_name"]; ?></td> <td align="right"><?php echo $value["balance"]; ?></td></td>
		<?php } ?>

		</table>
	</td>
	</tr>



	<tr>
		<td>
			<table width="100%">
				<tr><td align="left" >Total</td> <td align="right"><?php echo $sheet["total_income"]; ?></td></td>
			</table>
		</td>
		<td>
			<table width="100%">
				<tr><td align="left" >Total</td> <td align="right"><?php echo $sheet["total_expenses"]; ?></td></td>
			</table>
		</td>
	</tr>

</table>

<?php

$print_content = ob_get_contents();
ob_end_clean();

echo $print_content;
?>
