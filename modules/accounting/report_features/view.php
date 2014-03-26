<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

?>

<form name="frmreport" id="frmreport" action="<?php echo $current_url;?>" method="POST">
<input type="hidden" name="hd_reportid" value="<?php echo $report->report_id;?>" />
<h3>Add Report Features - <?php echo $report->report_head;?></h3>	

	<div class="row">
		<table  id="tbl-append" width="100%">
			<thead>
			<tr>
				<td width="30%">Master Ledger</td>
				<td width="30%">Sub Ledgers</td>
				<td width="15%">Position</td>
				<td></td>
			</tr>
			</thead>
			<tbody>
<!--
			<?php if($features){
				foreach ($features as $feature) {
			?>

			<tr id="row<?php echo $feature['feature_id'];?>">
				<td><?php echo $feature['ledger_master_name'];?></td>
				<td>
				<?php foreach($feature['sub_ledgers'] as $id=>$name){
					echo $name."<br/>";				
				}
				?>
				<td>
					<?php
						if($feature['position'] == LHS){
							echo "LHS";
						}else if($feature['position'] == RHS){
							echo "RHS";
						}
					?>
				</td>
				
				<td>
					<input type="button" name="button-edit" value="edit" id="button-edit" feature="<?php echo $feature['feature_id'];?>"/>
				</td>
			</tr>
			<?php }}?>

-->
			<tr id="insert">
				<td><?php echo populate_list_array("lstmledger", $ledgers, 'id','name', '',$disable=false);?></td>
				<td id="sub-ledger"><?php echo populate_multiple_list_array("lstsledger", array(), 'id','name', '',$disable=false);?></td>
				<td>
					<select name="lstposition" id="lstposition">
						<option value=1>LHS</option>
						<option value=2>RHS</option>
					</select>
				</td>
				
				<td><input type="button" name="button-add" value="+" id="button-add"/></td>
			</tr>	
			</tbody>
		</table>
	</div>
	

	<div class="row">
		<div class="text-center">
			<input class="tiny button"  value="Save" name="submit" type="submit"/>
		</div>
	</div>

</form>