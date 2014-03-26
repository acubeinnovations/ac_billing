<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3>Search by Pooja</h3>
<form data-abide target="_self" method="GET" action="<?php echo $current_url?>" name="frmsearch" id="frmsearch">
<fieldset>
 		

 		<div class="row">
 			<div class="medium-5 columns">
    			<input type="text" name="search"  value="<?php  if(isset($_GET['search'])) { echo $_GET['search'];}?>"/>
    		</div>
    		<div class="medium-2 columns">
     	 		<input type="submit" name="submit" value="Search" class="tiny button" />
     	 	</div>

     	 	<div class="medium-5 columns">
	 			<div class="text-right">
	 			<a href="pooja.php" class="tiny button">Add New</a>
	 				<a href="pooja_register.php" class="tiny button">Register</a>
	 			</div>
 			</div>

 		</div>
 </fieldset>
    
</form>

      


	
 		
<table width="100%">
	<thead>
	<tr>

		<td>SlNo</td>
		<td>Pooja Name</td>
		<td>Rate</td>
		<td>Status</td>

	</tr>
	</thead>
	<tbody>
	<tr>

	<?php
		if($array_poojas==false){

	?>
	
	<tr><td colspan="4">No Records found</td></tr>
	
	<?php } else { 
		$i=0;
		while($i<$count_poojas){
		?>
	<tr>
	
		<td><?php echo $array_poojas[$i]['id']?></td>
		<td><a href="pooja.php?id=<?php echo $array_poojas[$i]['id'] ?>"><?php echo $array_poojas[$i]['name']?></a></td>
		<td><?php echo $array_poojas[$i]['rate']?></td>
		<td><?php if(isset($g_ARRAY_STATUS[$array_poojas[$i]['status_id']])){ echo $g_ARRAY_STATUS[$array_poojas[$i]['status_id']];}?></td>

	

	<?php $i++;}?>
	</tr>
	<?php	}?>
	

	<tr>
		<td colspan="4"><?php  $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>

</table>
</fieldset>


