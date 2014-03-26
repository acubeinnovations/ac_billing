<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<div class="row" >
	<div class="medium-6 columns">
		<h3>Add Form Type</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a href="ac_form_variable.php" class="tiny button">Form Variable</a>
		</div>
	</div>
</div>


<form id="frm-formtype" name="frm-formtype" method="POST" action="<?php echo $current_url;?>">
<input type="hidden" value="" name="hd_typeid" />
<fieldset>
	<legend>Update Form Type</legend>
		<div class="row">
			<div class="medium-4 columns">
				<label for="form-type">Form Name</label>
				<input type="text" name="txtname" id="txtname" value="" />
			</div>

			<div class="medium-4 columns">
				<label for="form-type">Form Variables</label>
				<?php echo populate_multiple_list_array("lstvariable", $form_variables, 'id','description',array(),$disable=false,false);?>
			</div>
			

			<div class="medium-3 columns">
				<input type="submit" name="submit" value="Add"  class="tiny button"/>

			</div>
		</div>

</fieldset>

 </form>

 <?php if($count > 0){?>

 <table width="100%" align="center">
 	<thead>
 		<tr>
 			<td width="10%">SlNo</td>
 			<td width="30%">Form Name</td>
 			<td width="20%">Number Of Variables</td>
 			<td></td> 
 		</tr>
 		<?php 
 		$slno = ($pagination->page_num*$pagination->max_records)+1;
 		foreach($form_types as $form_type){?>
 		<tr>
 			<td><?php echo $slno; ?></td>
 			<td><?php echo $form_type['value']; ?></td>
 			<td><?php echo $form_type['value']; ?></td>
 			<td><a href="ac_form_type_variable.php?slno=<?php echo $form_type['id']; ?>"> view</a></td>
 		</tr>
 		<?php $slno++; }?>

 		<tr>
 			<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
 		</tr>
 	</thead>
 </table>
 <?php }?>
