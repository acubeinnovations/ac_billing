<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$report = new Report($myconnection);
$report->connection = $myconnection;

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$report_feature = new ReportFeature($myconnection);
$report_feature->connection = $myconnection;

$page_heading = "";

if(isset($_GET['submit'])){
	$report_feature->date_from = date('d-m-Y',strtotime($_GET['txtfrom']));
	$report_feature->date_to = date('d-m-Y',strtotime($_GET['txtto']));
}else{
	$report_feature->date_from = date('d-m-Y',strtotime(CURRENT_DATE));
	$report_feature->date_to = date('d-m-Y',strtotime(CURRENT_DATE));
}

if(isset($_GET['slno'])){
	$report->report_id = $_GET['slno'];
	$report->get_details();
	$page_heading = $report->report_head;

	$report_feature->report_id = $report->report_id;
	
	if($report->lhs == LHS_STATUS_ACTIVE){
		$report_feature->position = LHS;
		$lhs_features = $report_feature->getFeatures();
		//$report_feature->clearTotalBalance();
		//$lhs_total_balance = $report_feature->total_balance;
	}

	if($report->rhs == RHS_STATUS_ACTIVE){
		$report_feature->position = RHS;
		$rhs_features = $report_feature->getFeatures();
		//$report_feature->clearTotalBalance();
		//$rhs_total_balance = $report_feature->total_balance;
	}
			
}

?>