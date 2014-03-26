<?php
if(!defined('CHECK_INCLUDED')){
	exit();
} 
?>

	<form id="" name="form1" id="" method="POST">
		
	<fieldset>
		<Legend>Donation List</legend>

		

		

		<table width="100%">
			<div="row">
		<div class="medium-4 columns">
			<a href="donations.php" class="small secondary button">Add New Donation</a>
		</div>
		</div>
			<tr>
				<th>Name</th>
				<th>Address</th>
				<th>Star</th>
				<th>Amount</th>
				<th>Description</th>
			</tr>
		
		</fieldset>

	<?php if($array_list_donation==false){?>

	<tr>
		<td>No Records found</td>
	</tr>

	<?php } else {
		$i=0;
		while($i<$count_list){

	?>

	<tr>

		<td><?php echo $array_list_donation[$i]['name'];?></td>
		<td><?php echo $array_list_donation[$i]['address'];?></td>
		<td><?php echo $array_stars[$i]['name'];  ?></td>
		<td><?php echo $array_list_donation[$i]['amount'];?></td>
		<td><?php echo $array_list_donation[$i]['description'];?></td>

	</tr>

	<?php 
	$i++;
	}
	}
	?>

	</table>
	
</form>


