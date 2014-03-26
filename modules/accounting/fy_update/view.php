<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3>Add Financial Year</h3>

<form id="frm-fymaster" name="frm-fymaster" method="POST" action="<?php echo $current_url;?>" data-abide >
<input type="hidden" value="<?php echo $financial_year->id;?>" name="hdfyid" />
 	<fieldset>
 			<div class="row">
	 			<div class="medium-3 columns">
	 				<label for="financial-year">Financial Year Start
		 				<?php if(isset($_GET['edt'])) {?>
		 				<input  name="txtfystart" id="fystart" value="<?php echo $financial_year->fy_start;?>" disabled requierd type="text"/> 
		 				<?php }else{?>
		 				<input  name="txtfystart" id="fystart" value="<?php echo $financial_year->fy_start;?>" class="mydatepicker" requierd type="text"/>
		 				<?php }?>
	 				</label>

	 			</div>
	 			<div class="medium-3 columns">
	 				<label for="financial-year">Financial Year End
	 				<?php if(isset($_GET['edt'])) {?>
	 				<input type="text" name="txtfyend" id="fystart" value="<?php echo $financial_year->fy_end;?>" disabled requierd type="date"/> 
	 				<?php }else{?>
	 				<input name="txtfyend" id="fyend" value="<?php echo $financial_year->fy_end;?>" class="mydatepicker" requierd type="text"/>
	 				<?php }?>
	 				</label>
	 			</div>
	 			<div class="medium-4 columns">
	 				<label for="financial-year">Financial Year Name<small>required</small>
	 				<input type="text" name="txtfyname" id="fyname" value="<?php echo $financial_year->fy_name;?>" required/>
	 				</label>
	 			</div>

	 			<div class="medium-2 columns">

	 				<input type="submit" name="submit" value="<?php echo $submit_value;?>"  class="tiny button"/>


	 			</div>

 			</div>

 	</fieldset>
 </form>

<?php if($count_financial_years > 0){?>

<table width="100%">
	<thead>
		<tr>
			<td>Sl no</td>
			<td>Finacial Year Start</td>
			<td>Finacial Year End</td>
			<td>Finacial Year Name</td>
			<td>Closed</td>
			<td></td>
		</tr>
	</thead>
	<tbody>
	<?php 
		$closing_year = false;
		$closing_count = 0;
		
		$slno = ($pagination->page_num*$pagination->max_records)+1;
	for($i=0; $i<$count_financial_years; $i++){
			
			$edit = $current_url."?edt=".$financial_years[$i]['fy_id'];
			$delete = $current_url."?dlt=".$financial_years[$i]['fy_id'];
			$close = $current_url."?cls=".$financial_years[$i]['fy_id'];
	?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $financial_years[$i]['fy_start'];?></td>
			<td><?php echo $financial_years[$i]['fy_end'];?></td>
			<td><?php echo $financial_years[$i]['fy_name'];?></td>
			<td><?php echo $financial_years[$i]['fy_status'];?></td>
			<td>
				<a href="<?php echo $edit; ?>">Edit</a>
				<?php  if($closing_year==false && ($count_financial_years - $closing_count) > 1 && $financial_years[$i]['status'] == FINANCIAL_YEAR_OPEN  ){ ?>
				<a href="javascript:closeFY(<?php echo $financial_years[$i]['fy_id']?>)" >Close</a>
				
				<?php 
						$closing_year=true; } $closing_count++; ?>
				<!--<a href="javascript:deleteFY(<?php echo $financial_years[$i]['fy_id']?>)" >Delete</a>-->
			</td>
		</tr>
	<?php $slno++; }?>
		<tr>
			<td colspan="6"><?php echo $pagination->pagination_style_numbers();?></td>
		</tr>
	</tbody>

</table>

<?php }?>
