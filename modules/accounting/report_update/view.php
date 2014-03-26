<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

?>

<form name="frmreport" id="frmreport" action="<?php echo $current_url;?>" method="POST">
<input type="hidden" name="hd_reportid" value="<?php echo $report->report_id;?>" />
<h3><?php echo $page_caption;?></h3>
<fieldset>

	<div class="row">
		<div class="medium-8 columns">	
			<label for="ledger">Report Heading<span class="required">*</span></label>
			<input type="text" name="txthead" id="txthead" value="<?php echo $report->report_head;?>"/>
		</div>
	</div>
	<div class="row">

		<div class="medium-8 columns">	
			
			<input type="radio" name="radposition" id="rad1" value=1  <?php echo ($report->lhs == LHS_STATUS_ACTIVE and $report->rhs == RHS_STATUS_INACTIVE)?'checked':''; ?>/><label for="ledger">LHS Only</label>
			<input type="radio" name="radposition" id="rad3" value=2 <?php echo ($report->lhs == LHS_STATUS_ACTIVE and $report->rhs == RHS_STATUS_ACTIVE)?'checked':''; ?> /><label for="ledger">LHS AND RHS</label>
			<label for="ledger">LHS Heading</label>
			<input type="text" name="txtlhead" id="txtlhead" value="<?php echo $report->lhs_head;?>"/>
			<label for="ledger">RHS Heading</label>
			<input type="text" name="txtrhead" id="txtrhead" value="<?php echo $report->rhs_head;?>" />
		</div>

		

	</div>

	<div class="row">
		<div class="medium-12 columns">
			<label for="ledger">Header</label>
			<textarea class="ckeditor" name="txtheader"><?php echo $report->header;?></textarea>
		</div>
	</div>


	<div class="row">
		<div class="medium-12 columns">
			<label for="ledger">Footer</label>
			<textarea class="ckeditor" name="txtfooter"><?php echo $report->footer;?></textarea>
		</div>

	</div>

	

</fieldset>

<div class="row">
	<div class="text-center">
		<input class="tiny button"  value="Save" name="submit" type="submit"/>
	</div>
</div>

</form>