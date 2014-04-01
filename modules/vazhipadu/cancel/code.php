<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;

$account=new Account($myconnection);
$account->connection=$myconnection;

$voucher=new Voucher($myconnection);
$voucher->connection=$myconnection;

$vazhipadu->total_records=$pagination->total_records;

$data = array();

if(isset($_GET['submit'])){
	$vazhipadu->vazhipadu_date =  $_GET['txtdate'];
	$vazhipadu->vazhipadu_rpt_number = $_GET['txtrpt'];
}else{
	$vazhipadu->vazhipadu_date = date('d-m-Y',strtotime(CURRENT_DATE));
}


$vazhipadu_list = $vazhipadu->get_filter_array_by_limit($pagination->start_record,$pagination->max_records,$data);

if($vazhipadu_list){
	$pagination->total_records = $vazhipadu->total_records;
	$pagination->paginate();
	$count = count($vazhipadu_list);
}else{
	$count = 0;
}

//url parameter vazhipadu receipt number
if(isset($_GET['cnl'])){ 
	$vazhipadu->vazhipadu_rpt_number = $_GET['cnl'];
	$cancel = $vazhipadu->cancelVazhipadu();
	if($cancel){
		$voucher->module_id = MODULE_VAZHIPADU;
		$voucher->get_details_with_moduleid();
		$account->voucher_type_id = $voucher->voucher_id;
		$account->voucher_number = $vazhipadu->vazhipadu_rpt_number;
		$account->delete_with_voucher();

		$_SESSION[SESSION_TITLE.'flash'] = "Vazhipadu cancelled";
        header( "Location:".$current_url);
        exit();
	}
}


?>