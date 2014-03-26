<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<div class="row" >
	<div class="medium-6 columns">
		<h3>Add Form Variable</h3>
	</div>

	<div class="medium-6 columns">
		<div class="text-right" style="margin-top:5px;">
			<a href="ac_form_type.php" class="tiny button">Form Types</a>
		</div>
	</div>
</div>

<div class="row" >
<div class="medium-5 columns">
 <fieldset>
	<legend>Form Variables</legend>
	<div class="scroll-div">
	<?php if($form_variables){?>
	<table width="100%">
		<thead>
			<td width="10%">SlNo</td>
			<td>Variable</td>
		</thead>
		<tbody>
		<?php $slno =0;
			foreach($form_variables as $variable){
				$slno++;
		?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $variable['description'];?></td>
		</tr>
		<?php }?>
			
		</tbody>
	</table>
	<?php }?>
	</div>
</fieldset>
</div>


<div class="medium-7 columns">
<form id="frm-formtype" name="frm-formtype" method="POST" action="<?php echo $current_url;?>">
<fieldset>
	<legend>Update Form Variables</legend>
			<div class="medium-8 columns">
				<label for="form-type">Variable Name</label>
				<input type="text" name="txtvariable" id="txtvariable" value="" />
			</div>

			<div class="medium-2 columns">
				<input type="submit" name="submit_variable" value="Submit"  class="tiny button"/>

			</div>

</fieldset>
</form>
</div>
</div>

