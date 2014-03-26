<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
 ?>

<h3>Add Pooja</h3>

 <form id="" name="" method="POST" action="" data-abide >
 	<fieldset>
 		

 		<div class="row">
 			<div class="large-4 columns">
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<label for="pooja">Pooja <small>required</small>
 					<input type="text" name="name" id="pooja" value="<?php echo $pooja->name;?>" required/>
 				</label>
 			</div>
 		</div>

	<div class="row">
 			<div class="medium-6 columns">
 				<label for="rate">Rate <small>required</small>
 				<input type="number" required pattern="[0-9]+[.[0-9]+]?" name="rate" id="rate" value="<?php echo $pooja->rate;?>"  />
 				</label>
 			</div>
 		</div>

 		<div class="row">
 			<div class= "medium-6 columns">
 				<label for="listpooja">Status <small>required</small></label>
				<?php echo populate_list_array("listpooja", $g_ARRAY_LIST_STATUS, 'id','name', $pooja->status_id,$disable=false,false);?>
 	
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<input class="tiny button"  value="submit" name="submit" type="submit"/>
 				<input type="hidden" name="h_id" value="<?php echo $pooja->id; ?>" />

 			</div>
 		</div>

 	</fieldset>
 </form>

