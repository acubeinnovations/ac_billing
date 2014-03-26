<?php
if(!defined('CHECK_INCLUDED')){
	exit();
} 
?>

<form id="" name="donation" method="POST" >
	<fieldset>
		<legend>Donations</legend>


		<div class="row">
			<div class="medium-5 columns">
				<label>Name</label>
				<input type="text" name="name" id="" value="<?php echo $add_donation->name;?>">
			</div>
		</div>

		<div class="row">
   		 <div class="medium-5 columns">
      			<label>Address</label>
     		 <textarea name="address"></textarea>
   		 	</div>
  		</div>

  		<div class="row">
		<div class="medium-5 columns">
			<label for="liststar"> Select Star</label>
			<?php echo populate_list_array("liststar", $array_stars, 'id','name',$add_donation->star_id,$disable=false); ?>
		</div>
	</div>
	
	<div class="row">
			<div class="medium-5 columns">
				<label>Amount</label>
				<input type="text" name="amount" id="" value="">
			</div>
	</div>

		<div class="row">
   			 <div class="medium-5 columns">
      			<label>Description</label>
     			 <textarea  name="desc"></textarea>
   		 	</div>
  		</div>

  		<div class="row">
			<div class="medium-5 columns">
			<input class="small button" name="submit" id="" value="submit" type="submit"/>
			<input type="hidden" name="h_id" value=""/>
		</div>
	</div>
		</fieldset>
			</form>