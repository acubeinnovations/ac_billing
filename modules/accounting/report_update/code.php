<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$report = new Report($myconnection);
$report->connection = $myconnection;
$page_caption = "Add Report";
$radio_both = "";
$radio_lhs ="";
if(isset($_GET['slno'])){
	$report->report_id = $_GET['slno'];
	$report->get_details();
	$page_caption = "Edit Report";


	if($report->lhs == LHS_STATUS_ACTIVE and $report->rhs == RHS_STATUS_ACTIVE){
		$radio_both = "checked";
		$radio_lhs ="";
	}else if($report->lhs == LHS_STATUS_ACTIVE){
		$radio_both = "";
		$radio_lhs ="checked";
	}
}



if(isset($_POST['submit'])){
	$errorMSG = "";
	if(trim($_POST['txthead']) == ""){
		$errorMSG = "Enter Report heading";
	}

	if(trim($errorMSG) != ""){
		
        $_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields";
        header( "Location:".$current_url);
        exit();

	}else{
		$report->report_head = $_POST['txthead'];
		if($_POST['radposition'] == LHS_ONLY){
			$report->lhs = LHS_STATUS_ACTIVE;
			$report->rhs = RHS_STATUS_INACTIVE;
		}elseif($_POST['radposition'] == LHS_AND_RHS){
			$report->lhs = LHS_STATUS_ACTIVE;
			$report->rhs = RHS_STATUS_ACTIVE;
		}


		if(isset($_POST['txtlhead'])){
			$report->lhs_head = $_POST['txtlhead'];
		}
		if(isset($_POST['txtrhead'])){
			$report->rhs_head = $_POST['txtrhead'];
		}
		if(isset($_POST['txtheader'])){
			$report->header = $_POST['txtheader'];
		}
		if(isset($_POST['txtfooter'])){
			$report->footer = $_POST['txtfooter'];
		}
		
		$report->status = STATUS_ACTIVE;
		$report->report_id = $_POST['hd_reportid'];
		$update = $report->update();
		if($update){
			$_SESSION[SESSION_TITLE.'flash'] = "Report Updated";
        	header( "Location:ac_report_list.php");
        	exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Failed to Updte Report";
        	header( "Location:".$current_url);
        	exit();
		}

	}
}

?>