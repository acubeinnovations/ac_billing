<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3>List Ledger</h3>

<fieldset>
<div class="row" style="font-weight:bold;">
<div class="medium-12 columns" id="ledger_list">
	<div class="medium-8 columns">Ledgers
	</div>
	<div class="medium-2 columns">Debit
	</div>
	<div class="medium-2 columns">Credit
	</div>
</div>
</div>
<br/>

<div class="row" >
<?php if($ledgers_list <> false){?>

	<div class="medium-12 columns" id="ledger_list">
	 	<ul class='master_list'>
	 		<?php 
	 		$total_credit = 0;
	 		$total_debit = 0;
	 		foreach($ledgers_list as $master){
	 			$total_credit += $master['credit'];
	 			$total_debit += $master['debit']
	 		?>
	 			<li>
	 			<div class="medium-8 columns">
	 				<?php echo $master['name'];?>
	 			</div>
	 			<div class="medium-2 columns">
	 				<?php echo number_format($master['debit'],2);?>
	 			</div>
	 			<div class="medium-2 columns">
	 				<?php echo number_format($master['credit'],2);?>
	 			</div>
	 			</li>

	 			<?php if($master['sub_ledgers']){?>
		 			<ul>
			 		<?php displayLedger($master['sub_ledgers']);?>
			 		</ul>
		 		<?php }?>

		 	<?php }?>
	 	
	 	</ul>
	</div>

<?php }?>
</div>


<div class="row" style="font-weight:bold;">
	<div class="medium-12 columns" id="ledger_list">
		<div class="medium-8 columns">Total</div>
		<div class="medium-2 columns"><?php echo number_format($total_debit,2);?></div>
		<div class="medium-2 columns"><?php echo number_format($total_credit,2);?></div>
	</div>
</div>

</fieldset>