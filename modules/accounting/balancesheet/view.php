<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>


<?php ob_start(); ?>


<div class="row" >
	<div class="medium-10 columns">
		<div class="print-head">
			<h3><?php echo $account_settings->organization_name; ?></h3>
			<p><?php echo $account_settings->organization_address; ?></p>
			<h6>Balance Sheet for year <?php echo $mybalancesheet->fy_name ." (" . date("d-m-Y",strtotime($mybalancesheet->fy_start)) . " to " .date("d-m-Y",strtotime($mybalancesheet->fy_end)) .")";	 ?></h6>
		</div>
		<div class="page-head">
			<h4>Balance Sheet for year <?php echo $mybalancesheet->fy_name ." (" . date("d-m-Y",strtotime($mybalancesheet->fy_start)) . " to " .date("d-m-Y",strtotime($mybalancesheet->fy_end)) .")";	 ?></h4>
		</div>

	</div>
	<div class="medium-2 columns">
		<div class="text-right" style="margin-top:5px;">
			<input type="button" class="tiny button" value="print" id="button-print"/>
		</div>
	</div>
</div>

<div class="row">
<div class="medium-12 columns">
	<table width="100%">
		<tr>
			<td width="50%" valign="top">
				<table width="100%">
					<tr><th colspan="2">Liabilities</th></tr>
					<?php foreach ($sheet["liabilities"] as $key => $value) {?>
					<tr>
						<td align="left" ><?php echo $value["ledger_name"]; ?></td>
						<td align="right"><?php echo $value["balance"]; ?></td>
					</tr>
					<?php } ?>
				</table>
			</td>

			<td width="50%" valign="top">
				<table width="100%">
					<tr><th colspan="2" >Assets</th></tr>
					<?php foreach ($sheet["assets"] as $key => $value) {?>
					<tr>
						<td align="left" ><?php echo $value["ledger_name"]; ?></td>
						<td align="right"><?php echo $value["balance"]; ?></td>
					</tr>
					<?php } ?>
				</table>
			</td>

		</tr>

		<tr>
			<td>
				<?php if($sheet["loss"]>0){ ?>
				<table width="100%">
					<tr><td align="left" >Net Loss </td> <td align="right"><?php echo $sheet["loss"]; ?></td>
				</table>
				<?php 
					$total_liabilities = $sheet["total_liabilities"] +  $sheet["loss"];
				}else{
					$total_liabilities = $sheet["total_liabilities"];
				}

				if($sheet["difference_in_opening_balance"] > 0){ ?>
				<table width="100%">
					<tr>
						<td align="left" >Difference in opening Balance</td>
						<td align="right"><?php echo $sheet["difference_in_opening_balance"]; ?></td>
					</tr>
				</table>
				<?php 
					$total_liabilities = $sheet["total_liabilities"] +  $sheet["difference_in_opening_balance"];
				}
				?>
			</td>

			<td>
				<?php if($sheet["profit"]>0){ ?>
				<table width="100%">
					<tr><td align="left" >Net Profit </td><td align="right"><?php echo $sheet["profit"]; ?></td></tr>
				</table>
				<?php 
					$total_assets = $sheet["total_assets"] +  $sheet["profit"];
				}else{
					$total_assets = $sheet["total_assets"];

				}

				if($sheet["difference_in_opening_balance"] < 0){ ?>
				<table width="100%">
					<tr><td align="left" >Difference in opening Balance</td> <td align="right"><?php echo abs($sheet["difference_in_opening_balance"]); ?></td></tr>
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
					<tr><td align="left" >Total</td> <td align="right"><?php echo $total_liabilities; ?></td></tr>
				</table>
			</td>
			<td>
				<table width="100%">
					<tr><td align="left" >Total</td> <td align="right"><?php echo $total_assets; ?></td></tr>
				</table>
			</td>
		</tr>

	</table>

</div>
</div>

<?php

$print_content = ob_get_contents();
ob_end_clean();

echo $print_content;
?>
