<div class="medium-12 colum"> <a href="#" onclick="window.print();" class="button right" >Print</a></div>

<?php ob_start(); ?>
<br/>
<h4>Balance Sheet for year <?php echo $mybalancesheet->fy_name ." (" . date("d-m-Y",strtotime($mybalancesheet->fy_start)) . " to " .date("d-m-Y",strtotime($mybalancesheet->fy_end)) .")";	 ?></h4>
<table width="100%">
	<tr>
	<td width="50%" valign="top">
		<table width="100%">
			<tr><th colspan="2">Liabilities</th></tr>
		<?php foreach ($sheet["liabilities"] as $key => $value) {?>
			<tr><td align="left" ><?php echo $value["ledger_name"]; ?></td> <td align="right"><?php echo $value["balance"]; ?></td></td>
		<?php } ?>
		</table>
	</td>
	<td width="50%" valign="top">
		<table width="100%">
			<tr><th colspan="2" >Assets</th></tr>
		<?php foreach ($sheet["assets"] as $key => $value) {?>
			<tr><td align="left" ><?php echo $value["ledger_name"]; ?></td> <td align="right"><?php echo $value["balance"]; ?></td></td>
		<?php } ?>

		</table>
	</td>
	</tr>

	<tr>
		<td>

		<?php if($sheet["loss"]>0){ ?>
			<table width="100%">
				<tr><td align="left" >Net Loss </td> <td align="right"><?php echo $sheet["loss"]; ?></td></td>
			</table>
		<?php 
				$total_liabilities = $sheet["total_liabilities"] +  $sheet["loss"];
			}else{
				$total_liabilities = $sheet["total_liabilities"];
			}


			if($sheet["difference_in_opening_balance"] > 0){ ?>
			<table width="100%">
				<tr><td align="left" >Difference in opening Balance</td> <td align="right"><?php echo $sheet["difference_in_opening_balance"]; ?></td></td>
			</table>
		<?php 
					$total_liabilities = $sheet["total_liabilities"] +  $sheet["difference_in_opening_balance"];
			}
			?>
		</td>
		<td>
		<?php if($sheet["profit"]>0){ ?>
			<table width="100%">
				<tr><td align="left" >Net Profit </td> <td align="right"><?php echo $sheet["profit"]; ?></td></td>
			</table>
		<?php 
				$total_assets = $sheet["total_assets"] +  $sheet["profit"];
			}else{
				$total_assets = $sheet["total_assets"];

			}

			if($sheet["difference_in_opening_balance"] < 0){ ?>
			<table width="100%">
				<tr><td align="left" >Difference in opening Balance</td> <td align="right"><?php echo abs($sheet["difference_in_opening_balance"]); ?></td></td>
			</table>
		<?php 
				$total_assets = $sheet["total_assets"] +  abs($sheet["difference_in_opening_balance"]);
			}
			 ?>
		</td>
	</tr>

	<tr>
		<td>
			<table width="100%">
				<tr><td align="left" >Total</td> <td align="right"><?php echo $total_liabilities; ?></td></td>
			</table>
		</td>
		<td>
			<table width="100%">
				<tr><td align="left" >Total</td> <td align="right"><?php echo $total_assets; ?></td></td>
			</table>
		</td>
	</tr>

</table>

<?php

$print_content = ob_get_contents();
ob_end_clean();

echo $print_content;
?>
