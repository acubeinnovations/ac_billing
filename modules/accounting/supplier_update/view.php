<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>

<h3><?php echo (isset($_GET['edt']))?"Edit supplier":"Add supplier";?></h3>

<form name="frmsupplier" id="frmsupplier" action="<?php echo $current_url;?>" method="POST">
<input type="hidden" name="hd_supplierid" value="<?php echo $supplier->supplier_id; ?>"/> 
	<fieldset>	
 		<div class="row">
	 		<div class="medium-4 columns">
				<label for="ledger">Name<span class="required">*</span></label>
				<input type="text" name="txtname" id="txtname" value="<?php echo $supplier->supplier_name;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Address<span class="required">*</span></label>
				<textarea name="txtaddress"><?php echo $supplier->supplier_address;?></textarea>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Phone<span class="required">*</span></label>
				<input type="text" name="txtphone" id="txtphone" value="<?php echo $supplier->supplier_phone;?>"/>
			</div>
		
			
		</div>
		<div class="row">
			
			<div class="medium-4 columns">
				<label for="ledger">Contact Person</label>
				<input type="text" name="txtperson" id="txtperson" value="<?php echo $supplier->contact_person;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Contact Mobile</label>
				<input type="text" name="txtmobile" id="txtmobile" value="<?php echo $supplier->contact_mobile;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Contact Email Id</label>
				<input type="text" name="txtemail" id="txtemail" value="<?php echo $supplier->contact_email;?>"/>
			</div>
	
		</div>

		
		<div class="row">

			<div class="medium-4 columns">
				<label for="ledger">Fax</label>
				<input type="text" name="txtfax" id="txtfax" value="<?php echo $supplier->supplier_fax;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">CST Number</label>
				<input type="text" name="txtcstnumber" id="txtcstnumber" value="<?php echo $supplier->supplier_cst_number;?>"/>
			</div>
		
			<div class="medium-4 columns">
				<label for="ledger">TIN Number</label>
				<input type="text" name="txttinnumber" id="txttinnumber" value="<?php echo $supplier->supplier_tin_number;?>"/>
			</div>
		</div>

		<div class="row">
			<div class="text-center">
				<input class="tiny button"  value="Save" name="submit" type="submit"/>
			</div>
		</div>
	

	</fieldset>

</form>

<?php if($count_suppliers > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="6%">Sl no</td>
		<td width="40%">Supplier</td>
		<td width="15%">Phone Number</td>
		<td >Contact Person</td>
		<td width="11%"></td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_suppliers; $i++){
			$edit = $current_url."?edt=".$suppliers[$i]['supplier_id'];
			$delete = $current_url."?dlt=".$suppliers[$i]['supplier_id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $suppliers[$i]['supplier_name']."<br/>".$suppliers[$i]['supplier_address'];?></td>
		<td><?php echo $suppliers[$i]['supplier_phone'];?></td>
		<td>
			<?php echo $suppliers[$i]['contact_person'];?>
			<span style="font-size:11px;">
			<?php
				echo ($suppliers[$i]['contact_mobile']!="")?"<br/>Mobile :".$suppliers[$i]['contact_mobile']:"";
				echo ($suppliers[$i]['contact_email']!="")?"<br/>Email :".$suppliers[$i]['contact_email']:"";
			?>
			</span>
		</td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deletesupplier(<?php echo $suppliers[$i]['supplier_id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>