<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$report = new Report($myconnection);
$report->connection = $myconnection;

$report_feature = new ReportFeature($myconnection);
$report_feature->connection = $myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$ledgers = $ledger->get_list_master_array();



if(isset($_GET['slno'])){
	$report->report_id = $_GET['slno'];
	$report->get_details();	


	$report_feature->report_id = $report->report_id;
	
	


}/*else{
	$_SESSION[SESSION_TITLE.'flash'] = "Invalid Report";
    header( "Location:ac_report_list.php");
    exit();
}*/

$features = $report_feature->get_details_with_report();



if(isset($_POST['submit'])){
	$report_id = $_POST['hd_reportid'];
	$insert_count = (isset($_POST['hd_ledger']))?count($_POST['hd_ledger']):0;
	if($insert_count >0){

		$dataArray = array();
		$i=0;
		while($i<$insert_count){
			$report_feature->report_id 	= $report_id;
			$dataArray[$i]['ledger_master_id'] = $_POST['hd_ledger'][$i];
			$dataArray[$i]['sub_ledgers'] = $_POST['hd_subledger'][$i];
			$dataArray[$i]['position'] 	= $_POST['hd_position'][$i];
			$dataArray[$i]['sort_order'] 	= 1;
			$dataArray[$i]['status'] 	= STATUS_ACTIVE;
			
			$i++;
		}

		$insert = $report_feature->insert_batch($dataArray);
		if($insert){
			$_SESSION[SESSION_TITLE.'flash'] = "Features updated";
		    header( "Location:ac_report_list.php");
		    exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Failed to update Features";
		    header( "Location:".$current_url);
		    exit();
		}


	}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Add features from list";
        header( "Location:".$current_url."?slno=".$report_id);
        exit();
	}


}

if(isset($_GET['master'])){
	
	$ledger->ledger_id = $_GET['master'];
	$sub = $ledger->get_list_sub_array_with_masterid();
	if($sub){
		$json['sub'] = $sub;
	}
	echo json_encode($json);exit();
	//print_r($sub_ledgers);exit();
	

}

?>