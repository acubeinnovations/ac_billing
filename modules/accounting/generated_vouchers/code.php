<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$stock=new Stock($myconnection);
$stock->connection=$myconnection;

$stock_register = new StockRegister($myconnection);
$stock_register->connection=$myconnection;

$voucher = new Voucher($myconnection);
$voucher->connection = $myconnection;

$account = new Account($myconnection);
$account->connection = $myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$acbook = new AcBook($myconnection);
$acbook->connection = $myconnection;

$page_heading = "";
$count_list = 0;
$new_url = "#";





if(isset($_GET['submit'])){
	$account->date_from = date('d-m-Y',strtotime($_GET['txtfrom']));
	$account->date_to = date('d-m-Y',strtotime($_GET['txtto']));
}else{
	$account->date_from = date('d-m-Y',strtotime(CURRENT_DATE));
	$account->date_to = date('d-m-Y',strtotime(CURRENT_DATE));
}


if(isset($_GET['slno'])){

	$new_url = "ac_generate_voucher.php?v=".$_GET['slno'];
	$list_url = "ac_generated_vouchers.php?slno=".$_GET['slno'];
	$account->total_records=$pagination->total_records;

	$voucher->voucher_id = $_GET['slno'];
	$voucher->get_details();
	$page_heading = $voucher->voucher_name;

	$dataArray = array();

	$from_data =  @unserialize($voucher->default_from);
	$to_data = @unserialize($voucher->default_to);
	if($from_data != false){
		$dataArray['account_from'] = $from_data;
	}else{
		$dataArray['account_from'] = $voucher->default_from;
	}
	if($to_data != false){
		$dataArray['account_to'] = $to_data;
	}else{
		$dataArray['account_to'] = $voucher->default_to;
	}

	
	$account->voucher_type_id = $voucher->voucher_id;
 
	$account_list = $account->getAccountTransaction($pagination->start_record,$pagination->max_records,$dataArray);
	$account_total_list = $account->getAllAccountTransaction($dataArray);
	
	if($account_list){
		$pagination->total_records = $account->total_records;
		$pagination->paginate();
		$count_list = count($account_list);
	}else{
		$count_list = 0;
	}
	//echo $count_list;exit();
}
//ac books start here-------------------------------------
else if(isset($_GET['bid'])){
	$list_url = "ac_generated_vouchers.php?bid=".$_GET['bid'];
	$acbook->id = $_GET['bid'];
	$acbook->get_details();
	$page_heading = $acbook->name;

	$account_list = $account->getBookDetails($pagination->start_record,$pagination->max_records,unserialize($acbook->ledgers));
	$account_total_list = $account->getAllBookDetails(unserialize($acbook->ledgers));

	if($account_list){
		$pagination->total_records = $account->total_records;
		$pagination->paginate();
		$count_list = count($account_list);
	}


}




?>