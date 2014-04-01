<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<h3><?php echo (isset($_GET['edt']))?"Edit Item":"Add Item";?></h3>

<form id="frmitemadd" name="frmitemadd" method="POST" action="<?php echo $current_url;?>">
<input type="hidden" value="<?php echo $stock->item_id;?>" name="hd_itemid" />
 	<fieldset>
 		<div class="row">
 			<div class="medium-4 columns">
 				<label for="stock">Item name</label>
 				<input type="text" name="txtname" id="txtname" value="<?php echo $stock->item_name;?>"/>
 			</div>

 			<div class="medium-2 columns">
 				<label for="stock">Unit of Measure</label>
 				<?php echo populate_list_array("lstuom", $uom_list, 'id','value', $stock->uom_id,$disable=false);?>
 			</div>

 			<div class="medium-2 columns">
 				<label for="stock">Opening Quantity</label>
 				<input type="text" name="txtqty" id="txtqty" value="<?php echo $opening_qty;?>"/>
 				<input type="hidden" name="hd_stkid" value="<?php echo $stk_id;?>"/>
 			</div>
 			<div class="medium-2 columns">
 				<label for="stock">Unit Rate</label>
 				<input type="text" name="txtrate" id="txtrate" value="<?php if($opening_rate) echo $opening_rate;?>"/>
 			</div>

 			<div class="medium-2 columns">
 				<input type="submit" name="submit" value="Save" class="tiny button"/>
 			</div>

 		</div>

 	</fieldset>
</form>

<?php if($count_items > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="10%">Sl no</td>
		<td width="50%">Item Name</td>
		<td width="20%">Unit of Measure</td>
		<td>Edit / Delete</td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_items; $i++){
			$edit = $current_url."?edt=".$items[$i]['id'];
			$delete = $current_url."?dlt=".$items[$i]['id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $items[$i]['name'];?></td>
		<td><?php echo $items[$i]['uom'];?></td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteItem(<?php echo $items[$i]['id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>
