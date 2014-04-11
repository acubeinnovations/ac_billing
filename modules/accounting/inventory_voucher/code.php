<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$form_type = new FormType($myconnection);
$form_type->connection = $myconnection;
$form_types = $form_type->get_list_array();


$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();


$voucher = new Voucher($myconnection);
$voucher->connection = $myconnection;

$currency = new Currency($myconnection);
$currency->connection = $myconnection;
$currencies = $currency->get_list_array();

$voucher_source_items = new VoucherSourceItem($myconnection);
$voucher_source_items->connection = $myconnection;


$voucher->voucher_master_type = INVENTORY_VOUCHER;
$masterVouchers = $voucher->get_list_master_array();

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;
$ledgers = $ledger->get_list_sub_array();
if(!$ledgers){
	$_SESSION[SESSION_TITLE.'flash'] = "No active ledgers";
    header( "Location:dashboard.php");
    exit();
}

$ledger->ledger_id = LEDGER_SALES;
$sale_ledgers = $ledger->get_list_sub_array();

$ledger->ledger_id = LEDGER_PURCHASE;
$purchase_ledgers = $ledger->get_list_sub_array();

	


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
		
        $_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();

	}else{

		//voucher elements
		$voucher->voucher_name = $_POST['txtname'];
		$voucher->voucher_master_id = $_POST['lstmvoucher'];
		$voucher->voucher_description = $_POST['txtdescription'];

		//number series
		$voucher->number_series .= (trim($_POST['txtprefix'])!="")?$_POST['txtprefix']:"";
		$voucher->number_series .= (trim($_POST['lstseperator'])!="")?$_POST['lstseperator']:"";
		$voucher->number_series .= $_POST['txtseries'];
		$voucher->number_series .= (trim($_POST['lstseperator'])!="")?$_POST['lstseperator']:"";
		$voucher->number_series .= (trim($_POST['txtsufix'])!="")?$_POST['txtsufix']:"";
		$voucher->series_prefix = $_POST['txtprefix'];
		$voucher->series_sufix = $_POST['txtsufix'];
		$voucher->series_start	= $_POST['txtseries'];
		$voucher->series_seperator = $_POST['lstseperator'];

		//form elements
		$voucher->header = $_POST['txtheader'];
		$voucher->footer = $_POST['txtfooter'];
		$voucher->source = INVENTORY_VOUCHER;
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


		//account/module settings
		if(isset($_POST['chk_hidden'])){//voucher for module
			$voucher->hidden = VOUCHER_HIDDEN;	
			$voucher->module_id = $_POST['lstmodules'];
			$voucher->default_from = $_POST['lstfromledger'];
			$voucher->default_to = $_POST['lsttoledger'];
		}else{
			if($_POST['hd_invt_type'] == INVENTORY_TYPE_SALE){
				if(isset($_POST['lstsourceitem']) and $_POST['lstsourceitem'] > 0){
					$voucher->voucher_source_item_id = $_POST['lstsourceitem'];
					$voucher->default_to = LEDGER_SUNDRY_CREDITORS;
				}
				$voucher->default_from = $_POST['lstfromledger'];
			}else if($_POST['hd_invt_type'] == INVENTORY_TYPE_PURCHASE){
				if(isset($_POST['lstsourceitem']) and $_POST['lstsourceitem'] > 0){
					$voucher->voucher_source_item_id = $_POST['lstsourceitem'];
					$voucher->default_from = LEDGER_SUNDRY_DEBITORS;
				}
				$voucher->default_to = $_POST['lsttoledger'];
			}
		}
		if(isset($_POST['chk_currency'])){
			$voucher->default_currency  = $_POST['chk_currency'];
			$voucher->currency_id = $_POST['lstcurrency'];
		}else{
			$voucher->currency_id = $currency->default_currency_id;
		}


		//inventory settings
		if(isset($_POST['chk_drc'])){
			$voucher->cash_discount = DEFAULT_TRUE;
		}
		$voucher->inventory_account = $_POST['lstinventory'];
		$voucher->frieght_demurge = $_POST['lstfreight'];
		$voucher->round_off = $_POST['lstroundoff'];
		$voucher->form_type_id	= $_POST['lstformtype'];
		$voucher->no_of_copies = $_POST['lstcopy'];

		//echo $voucher->voucher_source_item_id;exit();
		//update voucher
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
if(isset($_POST['master_for_default_account'])){
	$voucher->voucher_master_id = $_POST['master_for_default_account'];
	$voucher->get_master_details();
	print $voucher->default_account;exit();
}

//jquery post
if(isset($_POST['master_for_source'])){
	$voucher->voucher_master_id = $_POST['master_for_source'];
	$voucher->get_master_details();
	print $voucher->inventory_type;exit();
}

//jquery post
if(isset($_POST['default_header'])){
	print 1;exit();
}





?>