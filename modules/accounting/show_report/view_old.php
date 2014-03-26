
<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<h3><?php echo $page_heading; ?></h3>
</div>

<div class="row" style="border:1px solid black;">

	<?php if(isset($lhs_features)){?>
	<div class="<?php (!isset($rhs_features))?'medium-12 columns':'medium-6 columns';?>" style="border-right:1px solid black;">
	
		<div class="row" >
			<div class="medium-12 columns" >
			<h5 style="border-bottom:1px solid black;"><?php echo $report->lhs_head;?></h5>
			</div>
		</div>
	
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
						<?php echo $sub[$j]['balance']?>
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

		<div class="row" style="border:1px solid black;">
			
			<div class="medium-12 columns">
				<div class="medium-10 columns" style="font-weight:bold;padding:3px 0px 2px 0px;">
					Total
				</div>
				<div class="medium-2 columns" style="font-weight:bold;">
					<?php echo $lhs_total_balance; ?>
				</div>
			</div>
				
			
		</div>

	
	
	</div>



	<?php }?>

	<?php if(isset($rhs_features)){?>
	<div class="medium-6 columns" style="border-left:1px solid black;">
		<div class="row" style="border-bottom:1px solid black;">
			<div class="medium-12 columns" >
				<h5 style="border-bottom:1px solid black;"><?php echo $report->rhs_head;?></h5>
			</div>
		</div>

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
	<?php }?>

</div>

<!--total row-->
<div class="row" style="border:1px solid black;">
	<?php if(isset($lhs_features)){?>
	<div class="<?php (!isset($rhs_features))?'medium-12 columns':'medium-6 columns';?>" style="border-right:1px solid black;">
		<div class="row">
			<div class="medium-12 columns">
				<div class="medium-10 columns" style="font-weight:bold;padding:3px 0px 2px 0px;">
					Total
				</div>
				<div class="medium-2 columns" style="font-weight:bold;">
					<?php echo $lhs_total_balance; ?>
				</div>
			</div>
		</div>
	</div>
	<?php }?>

	<?php if(isset($rhs_features)){?>
	<div class="medium-6 columns" style="border-left:1px solid black;">
		<div class="row">
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
	<?php }?>
</div>