<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3><?php echo (isset($_GET['edt']))?"Edit Tax":"Add Tax";?></h3>

<form id="frm-tax" name="frm-tax" method="POST" action="<?php echo $current_url;?>">
	<input type="hidden" value="<?php echo $tax->id;?>" name="hd_taxid" />
 	<fieldset>
 		<div class="row">
 			<div class="large-4 columns">
 				<label for="stock">Name</label>
 				<input type="text" name="txtname" id="txtname" value="<?php echo $tax->name;?>"/>
 			</div>

 			<div class="large-2 columns">
 				<label for="stock">Tax Rate in %</label>
 				<input type="text" name="txtrate" id="txtrate" value="<?php echo $tax->rate*100;?>"/>
 			</div>

 			<div class="large-3 columns">
 				<label for="stock">Status</label>
 				<?php echo populate_list_array("lststatus", $g_ARRAY_LIST_STATUS, 'id','name', $tax->status,$disable=false,false);?>
 			</div>

 			<div class="large-3 columns">
 				<input type="submit" name="submit" value="Save" class="tiny button"/>
 			</div>

 		</div>


 	</fieldset>
</form>

<?php if($count_tax > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="10%">Sl no</td>
		<td width="50%">Name</td>
		<td width="20%">Tax rate(%)</td>
		<td>Status</td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_tax; $i++){
			$edit = $current_url."?edt=".$tax_list[$i]['id'];
			$delete = $current_url."?dlt=".$tax_list[$i]['id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $tax_list[$i]['name'];?></td>
		<td><?php echo $tax_list[$i]['rate']*100;?></td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteTax(<?php echo $tax_list[$i]['id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>
