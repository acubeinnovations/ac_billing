<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


function displayLedger($sub_ledgers)
{
	foreach ($sub_ledgers as $sub) {
		echo '<li>
			 			<div class="medium-8 columns">
			 				'.$sub['name'].'
			 			</div>
			 			<div class="medium-2 columns">'.number_format($sub['debit'],2).'</div>
			 			<div class="medium-2 columns">'.number_format($sub['credit'],2).'</div>
		 			</li>';
		if(isset($sub['sub_ledgers'])){
			echo '<ul>';
			echo displayLedger($sub['sub_ledgers']);
			echo '</ul>';
		}
	}
}


?>