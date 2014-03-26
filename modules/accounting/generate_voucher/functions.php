<?php

	function calculateTotal($dataArray = array())
	{
		$total = 0;
		$tax = 0;
		foreach($dataArray as $line){
			$total_no_tax = $line['rate']*abs($line['quantity']);
			$tax = $total_no_tax*$line['tax_rate'];
			$total_with_tax = $total_no_tax + $tax;
			$total += $total_with_tax;
		}

		return $total;

	}

?>