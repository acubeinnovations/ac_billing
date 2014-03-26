<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

?>
<h3>List Reports</h3>

<?php if($count_data > 0){?>
<table width="100%">
	<thead>
		<tr>
			<td width="5%">SlNo</td>
			<td width="30%">Report Head</td>
			<td width="30%">Sub Head</td>
			<td width="10%">Status</td>
			<td></td>
		</tr>
	</thead>

	<tbody>
	<?php 
		$i=0;
		while($i < $count_data){
			$slno = $i+1;
	?>
		<tr>
			<td><?php echo $slno;?></td>
			<td><?php echo $reports[$i]['report_head'];?></td>
			<td>
				<?php 
					if($reports[$i]['lhs'] == LHS_STATUS_ACTIVE and $reports[$i]['rhs'] == RHS_STATUS_ACTIVE){
						echo "LHS:".$reports[$i]['lhs_head']."<br/>RHS:".$reports[$i]['rhs_head'];
					}elseif($reports[$i]['lhs'] == LHS_STATUS_ACTIVE){
						echo "LHS:".$reports[$i]['lhs_head'];
					}
				?>
			</td>
			
			<td>
				<?php
					if($reports[$i]['status'] == STATUS_ACTIVE){
						echo "Active";
					}else{
						echo "Inactive";
					}
				?>
			</td>
			<td>
				<a href="ac_report.php?slno=<?php echo $reports[$i]['report_id']; ?>">Edit</a>/
				<a href="ac_show_report.php?slno=<?php echo $reports[$i]['report_id']; ?>">Show</a>/
				<a href="ac_report_features.php?slno=<?php echo $reports[$i]['report_id']; ?>">Features</a>
			</td>
		</tr>
	<?php $i++;}?>
	</tbody>
</table>
<?php }?>
