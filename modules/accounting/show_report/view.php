<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<?php ob_start();?>


<div class="row" >
	<div class="medium-4 columns">
		<h3><?php echo $page_heading; ?></h3>
	</div>
	<div class="medium-8 columns">
		<div class="text-right" style="margin-top:5px;">
			<input type="button" class="tiny button" value="print" id="button-print"/>
		</div>
	</div>
</div>

<div class="row">
<div class="medium-12 columns">
	<table width="100%">
	<tr>

		<?php if($report->lhs == LHS_STATUS_ACTIVE){?>
		<td valign="top" style="border-right:#CCCCCC solid 1px;">
			<div class="medium-12 columns">
				<div class="row" >
					<div class="medium-12 columns" >
					<h5><?php echo $report->lhs_head;?></h5>
					</div>
				</div>

				<div class="row" >
					<?php
						$i=0;$lhs_total_balance = 0;
						while($i<count($lhs_features)){
						?>
							<div class="row">
								<div class="medium-12 columns">
									<div class="medium-10 columns" style="font-weight:bold;padding:3px 0px 2px 0px;">
										<?php echo $lhs_features[$i]['ledger_master_name']?>
									</div>
									<div class="medium-2 columns" style="font-weight:bold;">
										<?php 
										$lhs_total_balance += $lhs_features[$i]['balance'];
										echo $lhs_features[$i]['balance'];
										?>
									</div>
								</div>
							</div>

							<?php 
							if(isset($lhs_features[$i]['sub_ledger_details'])){
								$sub = $lhs_features[$i]['sub_ledger_details'];$j=0;
								while ($j < count($sub)) {
							?>
							<div class="new_row" >
								<div class="medium-12 columns">
									<div class="medium-7 columns" style="padding:3px 0px 3px 15px;">
										<?php echo $sub[$j]['ledger_sub_name'];?>
									</div>
									<div class="medium-5 columns">
										<?php echo number_format($sub[$j]['balance'],2)?>
									</div>
									
								</div>
							</div>
							<?php

									$j++;
								}
							 }
							?>

							
						
						<?php
							$i++;
						}
						?>
				</div>

				<div class="row" >
					<div class="medium-12 columns">
						<div class="medium-10 columns" style="font-weight:bold;padding:3px 0px 2px 0px;">
							Total
						</div>
						<div class="medium-2 columns" style="font-weight:bold;">
							<?php echo number_format($lhs_total_balance,2); ?>
						</div>
					</div>
				</div>

			</div>

		</td>
		<?php }?>

		<?php if($report->rhs == RHS_STATUS_ACTIVE){?>
		<td valign="top">
			<div class="medium-12 columns">
				<div class="row" >
					<div class="medium-12 columns" >
					<h5><?php echo $report->rhs_head;?></h5>
					</div>
				</div>

				<div class="row" >
					<?php
						$i=0;$rhs_total_balance = 0;
						while($i<count($rhs_features)){
						?>
							<div class="row" >
								<div class="medium-12 columns">
									<div class="medium-10 columns" style="font-weight:bold;padding:3px 0px 2px 0px;">
										<?php echo $rhs_features[$i]['ledger_master_name']?>
									</div>
									<div class="medium-2 columns" style="font-weight:bold;">
										<?php
											$rhs_total_balance += $rhs_features[$i]['balance'];
										 	echo $rhs_features[$i]['balance'];
										 ?>
									</div>
								</div>
							</div>

							<?php 
							if(isset($rhs_features[$i]['sub_ledger_details'])){
								$sub = $rhs_features[$i]['sub_ledger_details'];$j=0;
								while ($j < count($sub)) {
							?>
							<div class="new_row" >
								<div class="medium-7 columns" style="padding:3px 0px 3px 15px;">
									<?php echo $sub[$j]['ledger_sub_name'];?>
								</div>
								<div class="medium-5 columns">
									<?php echo $sub[$j]['balance']?>
								</div>
							</div>
							<?php

									$j++;
								}
							 }
							?>

							
						
					<?php
							$i++;
						}
					?>
				</div>
				
				<div class="row" >
					<div class="medium-12 columns">
						<div class="medium-10 columns" style="font-weight:bold;padding:3px 0px 2px 0px;">
							Total
						</div>
						<div class="medium-2 columns" style="font-weight:bold;">
							<?php echo $rhs_total_balance; ?>
						</div>
					</div>
				</div>

			</div>
		</td>
		<?php }?>

	</tr>
	</table>

</div>
</div>


<?php 
	$print_content = ob_get_contents();
	ob_end_clean();
	echo $print_content;
	
?>