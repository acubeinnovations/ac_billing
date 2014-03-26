<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
?>
<h3><?php echo (isset($_GET['edt']))?"Edit Customer":"Add Customer";?></h3>

<form name="frmcustomer" id="frmcustomer" action="<?php echo $current_url;?>" method="POST">
<input type="hidden" name="hd_customerid" value="<?php echo $customer->customer_id; ?>"/> 
	<fieldset>
 		
 		<div class="row">
	 		<div class="medium-4 columns">
				<label for="ledger">Name<span class="required">*</span></label>
				<input type="text" name="txtname" id="txtname" value="<?php echo $customer->customer_name;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Phone</label>
				<input type="text" name="txtphone" id="txtphone" value="<?php echo $customer->customer_phone;?>"/>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Mobile<span class="required">*</span></label>
				<input type="text" name="txtmobile" id="txtmobile" value="<?php echo $customer->customer_mobile;?>"/>
			</div>
		
			
		</div>
		<div class="row">
			<div class="medium-4 columns">
				<label for="ledger">Address<span class="required">*</span></label>
				<textarea name="txtaddress"><?php echo $customer->customer_address;?></textarea>
			</div>

			<div class="medium-4 columns">
				<label for="ledger">Email</label>
				<input type="text" name="txtemail" id="txtemail" value="<?php echo $customer->customer_email;?>"/>
			</div>
	
			<div class="medium-4 columns">
				<label for="ledger">Fax</label>
				<input type="text" name="txtfax" id="txtfax" value="<?php echo $customer->customer_fax;?>"/>
			</div>
		</div>

		
		<div class="row">
			<div class="medium-4 columns">
				<label for="ledger">CST Number</label>
				<input type="text" name="txtcstnumber" id="txtcstnumber" value="<?php echo $customer->customer_cst_number;?>"/>
			</div>
		
			<div class="medium-4 columns">
				<label for="ledger">TIN Number</label>
				<input type="text" name="txttinnumber" id="txttinnumber" value="<?php echo $customer->customer_tin_number;?>"/>
			</div>
		</div>

		<div class="row">
			<div class="text-center">
				<input class="tiny button"  value="Save" name="submit" type="submit"/>
			</div>
		</div>
	

	</fieldset>

</form>

<?php if($count_customers > 0){?>

<table width="100%">
  	<thead>
	<tr>
		<td width="10%">Sl no</td>
		<td width="40%">Customer</td>
		<td width="30%">Contact number</td>
		<td>Edit / Delete</td>
	</tr>
	</thead>
	<tbody>
	<?php
		$slno = ($pagination->page_num*$pagination->max_records)+1;
		for($i=0; $i<$count_customers; $i++){
			$edit = $current_url."?edt=".$customers[$i]['customer_id'];
			$delete = $current_url."?dlt=".$customers[$i]['customer_id'];
	?>
	<tr>
		<td><?php echo $slno; ?></td>
		<td><?php echo $customers[$i]['customer_name']."<br/>".$customers[$i]['customer_address'];?></td>
		<td><?php echo $customers[$i]['customer_mobile'];?></td>
		<td><a href="<?php echo $edit; ?>">Edit</a> / <a href="javascript:deleteCustomer(<?php echo $customers[$i]['customer_id']?>)">Delete</a></td>
	</tr>
	<?php $slno++; }?>
	<tr>
		<td colspan="4"><?php echo $pagination->pagination_style_numbers();?></td>
	</tr>
	</tbody>
</table>
<?php }?>