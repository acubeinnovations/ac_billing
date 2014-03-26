<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
 ?>
<h3><?php echo (isset($_GET['edt']))?"Edit Book":"Add Book";?></h3>
<form id="frmacbookadd" name="frmacbookadd" method="POST" action="<?php echo $current_url;?>">
	<input type="hidden" value="<?php echo $acbook->id;?>" name="hd_acbookid" />
 	<fieldset>
 		

 		<div class="row">
 			<div class="large-4 columns">
 			</div>
 		</div>

 		<div class="row">
 			<div class="large-5 columns">
 				<label for="acbook">Name</label>
 				<input type="text" name="txtname" id="txtname" value="<?php echo $acbook->name;?>"/>
 			</div>

 			<div class="large-5 columns">
 				<label for="acbook">Ledgers</label>
 				<?php echo populate_multiple_list_array("lstledger", $ledgers, 'id','name',$acbook_ledgers,$disable=false,false,"multiple");?>
 			</div>

 			<div class="large-2 columns">
 				<input type="submit" name="submit" value="Save" class="tiny button"/>
 			</div>

 		</div>


 	</fieldset>
</form>

<?php if($count_books > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="8%">Sl no</td>
		<td width="32%">Name</td>
		<td width="40%">Ledgers</td>
		<td width="20%">Edit / Delete</td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_books; $i++){
			$edit = $current_url."?edt=".$books[$i]['id'];
			$delete = $current_url."?dlt=".$books[$i]['id'];
	?>
	<tr>
		<td><?php echo $books[$i]['id']; ?></td>
		<td><?php echo $books[$i]['name'];?></td>
		<td><ul>
			<?php echo populate_multiple_list_array("lst", $books[$i]['ledgers'], 'id','name',array(),$disable=true,false,"multiple");?>
			</ul>
		</td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteBook(<?php echo $books[$i]['id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>
