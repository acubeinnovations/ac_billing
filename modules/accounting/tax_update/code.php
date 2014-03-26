<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$pagination = new Pagination(10);

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$tax = new Tax($myconnection);
$tax->connection = $myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$tax->total_records=$pagination->total_records;

$tax_list = $tax->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($tax_list <> false){
	$pagination->total_records = $tax->total_records;
	$pagination->paginate();
	$count_tax = count($tax_list);
}else{
	$count_tax = 0;
}

if(isset($_GET['edt'])){
	$tax->id = $_GET['edt'];
	$tax->get_details();
	
}else if(isset($_GET['dlt'])){
	$tax->id = $_GET['dlt'];
	$tax->get_details();
	$ledger->ledger_sub_name = $tax->name;
	$ledger_sub_id = $ledger->getLedgerId();
	$delete = $tax->delete();
	if($delete){
		if($ledger_sub_id){
			$ledger->ledger_sub_id = $ledger_sub_id;
			$ledger->delete();
		}
	}
	header( "Location:".$current_url);
    exit();
	
}


if(isset($_POST['submit'])){

	$errorMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errorMSG = "Tax name is empty \n";
	}

	if(trim($_POST['txtrate']) == ""){
		$errorMSG = "Enter tax rate\n";
	}
	

	if(trim($errorMSG) == ""){
		$tax->id = $_POST['hd_taxid'];
		if($tax->id > 0){
			$tax->get_details();
			$ledger->ledger_sub_name = $tax->name;
			$ledger_sub_id = $ledger->getLedgerId();
		}else{
			$ledger_sub_id = false;
		}

		$tax->name = $_POST['txtname'];
		$tax->rate = $_POST['txtrate']/100;
		$tax->status = $_POST['lststatus'];
		$update = $tax->update();
		if($update){
			if($ledger_sub_id){
				$ledger->ledger_sub_id = $ledger_sub_id;
			}
			$ledger->ledger_sub_name = $_POST['txtname'];
			$ledger->ledger_id = LEDGER_DUTIES_AND_TAXES;
			$ledger->fy_id = $account_settings->current_fy_id;

			$ledger->update();
			$_SESSION[SESSION_TITLE.'flash'] = "Success";
	        header( "Location:".$current_url);
	        exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Failed to add data";
	        header( "Location:".$current_url);
	        exit();
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Please fill the required fields";
        header( "Location:".$current_url);
        exit();
	}
}


?>