<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$voucher = new Voucher($myconnection);
$voucher->connection = $myconnection;

$currency = new Currency($myconnection);
$currency->connection = $myconnection;
$currencies = $currency->get_list_array();

$voucher->voucher_master_type = ACCOUNT_VOUCHER;
$masterVouchers = $voucher->get_list_master_array();

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;
$ledgers = $ledger->get_list_sub_array();
if(!$ledgers){
	$_SESSION[SESSION_TITLE.'flash'] = "No active ledgers";
    header( "Location:dashboard.php");
    exit();
}

//form submission
if(isset($_POST['submit'])){
	$errorMSG = "";
	//validation
	if(trim($_POST['txtname']) == ""){
		$errorMSG .= "Enter Voucher name \n";
	}
	if($_POST['lstmvoucher'] == "" or $_POST['lstmvoucher'] <=0){
		$errorMSG .= "Select Voucher type \n";
	}
	if(trim($_POST['txtseries']) == ""){
		$errorMSG .= "Enter Number Series\n";
	}

	if(trim($errorMSG) != ""){
		
        $_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields<br/>".$errorMSG;
        header( "Location:".$current_url);
        exit();

	}else{

		$voucher->voucher_name = $_POST['txtname'];
		$voucher->voucher_master_id = $_POST['lstmvoucher'];
		$voucher->voucher_description = $_POST['txtdescription'];

		$voucher->number_series .= (trim($_POST['txtprefix'])!="")?$_POST['txtprefix']:"";
		$voucher->number_series .= (trim($_POST['lstseperator'])!="")?$_POST['lstseperator']:"";
		$voucher->number_series .= $_POST['txtseries'];
		$voucher->number_series .= (trim($_POST['lstseperator'])!="")?$_POST['lstseperator']:"";
		$voucher->number_series .= (trim($_POST['txtsufix'])!="")?$_POST['txtsufix']:"";
		
		$voucher->series_prefix = $_POST['txtprefix'];
		$voucher->series_sufix = $_POST['txtsufix'];
		$voucher->series_start	= $_POST['txtseries'];
		$voucher->series_seperator = $_POST['lstseperator'];

		$voucher->header = $_POST['txtheader'];
		$voucher->footer = $_POST['txtfooter'];
		$voucher->source = ACCOUNT_VOUCHER;

		if(isset($_POST['chk_header'])){
			$voucher->default_header = $_POST['chk_header'];
		}else{
			$voucher->default_header = DEFAULT_FALSE;
		}


		if(isset($_POST['chk_footer'])){
			$voucher->default_footer  = $_POST['chk_footer'];
		}else{
			$voucher->default_footer = DEFAULT_FALSE;
		}

		if(isset($_POST['chk_currency'])){
			$voucher->default_currency  = $_POST['chk_currency'];
			$voucher->currency_id = $_POST['lstcurrency'];
		}else{
			$voucher->currency_id = $currency->default_currency_id;
		}

		if(isset($_POST['chk_hidden'])){//voucher for module
			$voucher->hidden = VOUCHER_HIDDEN;	
			$voucher->module_id = $_POST['lstmodules'];
			$voucher->default_from = $_POST['lstfromledger'];
			$voucher->default_to = $_POST['lsttoledger'];
		}else{
			//voucher account details
			if(isset($_POST['lstfromledger']) and $_POST['lstfromledger'] > 0){
				$voucher->default_from = $_POST['lstfromledger'];
			}
			if(isset($_POST['lsttoledger']) and $_POST['lsttoledger'] > 0){
				$voucher->default_to = $_POST['lsttoledger'];
			}
		}


		$update = $voucher->update();
		if($update){
			$_SESSION[SESSION_TITLE.'flash'] = "Voucher update successfully!";
	        header( "Location:".$current_url);
	        exit();
    	}else{
    		$_SESSION[SESSION_TITLE.'flash'] = "Voucher not udated";
	        header( "Location:".$current_url);
	        exit();
    	}
	}

	
}


//jquery post
if(isset($_POST['master'])){
	$voucher->voucher_master_id = $_POST['master'];
	$voucher->get_master_details();
	print $voucher->default_account;exit();
}

//jquery post
if(isset($_POST['default_header'])){
	print 1;exit();
}





?>