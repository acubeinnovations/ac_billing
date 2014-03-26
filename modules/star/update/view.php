<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
 ?>

<h3>Add Star</h3>

 <form id="" name="" method="POST" action="" data-abide >
 	<fieldset>
 		

 		<div class="row">
 			<div class="large-4 columns">
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<label for="star">Star <small>required</small> 
 					<input type="text" name="name" id="star" value="<?php  echo $star->name;?>" required/>
 				</label>
 			</div>
 		</div>

 		<div class="row">
 			<div class= "medium-6 columns">
 				<label for="liststar">Status <small>required</small></label>
				<?php echo populate_list_array("liststar", $g_ARRAY_LIST_STATUS, 'id','name', $star->status_id,$disable=false,false);?>
 	
 			</div>
 		</div>

 		<div class="row">
 			<div class="medium-6 columns">
 				<input class="tiny button"  value="submit" name="submit" type="submit"/>
 				<input type="hidden" name="h_id" value="<?php echo $star->id; ?>" />

 			</div>
 		</div>

 	</fieldset>
 </form>

