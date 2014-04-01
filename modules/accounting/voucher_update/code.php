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
$voucher_source_item_list = $voucher_source_items->get_list_array();

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
		
        $_SESSION[SESSION_TITLE.'flash'] = "Please fill all required fields";
        header( "Location:".$current_url);
        exit();

	}else{

		$voucher->voucher_name = $_POST['txtname'];
		$voucher->voucher_master_id = $_POST['lstmvoucher'];
		$voucher->voucher_description = $_POST['txtdescription'];
		$voucher->fy_id = $account_settings->current_fy_id;

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
		$voucher->source = $_POST['lstsource'];

		if(isset($_POST['chk_header'])){
			$voucher->default_header = $_POST['chk_header'];
		}

		if(isset($_POST['chk_footer'])){
			$voucher->default_footer  = $_POST['chk_footer'];
		}
		if(isset($_POST['chk_currency'])){
			$voucher->default_currency  = $_POST['chk_currency'];
			$voucher->currency_id = $_POST['lstcurrency'];
		}else{
			$voucher->currency_id = $currency->default_currency_id;
		}
		if(isset($_POST['chk_drc'])){
			$voucher->discount_rc_amt = $_POST['chk_drc'];
		}
		if(isset($_POST['chk_fad'])){
			$voucher->frieght_demurge = $_POST['chk_fad'];
		}
		if(isset($_POST['chk_drc'])){
			$voucher->round_off = $_POST['chk_drc'];
		}
		

		

		if(isset($_POST['chk_hidden'])){
			$voucher->hidden = VOUCHER_HIDDEN;	
			$voucher->module_id = $_POST['lstmodules'];
			$voucher->default_from = $_POST['lstfromledger'];
			$voucher->default_to = $_POST['lsttoledger'];
		}else{
			//voucher account details
			if($_POST['lstsource'] == VOUCHER_FOR_ACCOUNT){//voucher for account
				if($_POST['lstaccount'] == FROM){//from account
					$voucher->default_from = $_POST['lstledger'];
				}elseif($_POST['lstaccount'] == TO){//to account
					$voucher->default_to = $_POST['lstledger'];
				}

			}elseif($_POST['lstsource'] == VOUCHER_FOR_INVENTORY){//voucher for inventory

				if(isset($_POST['lstsourceitem']) and $_POST['lstsourceitem'] >0){
					$voucher->voucher_source_item_id = $_POST['lstsourceitem'];
					switch($_POST['lstsourceitem']){
						case 1:$voucher->default_to = LEDGER_SUNDRY_CREDITORS;break;
						case 2:$voucher->default_to = LEDGER_SUNDRY_CREDITORS;break;
						case 3:$voucher->default_to = LEDGER_SUNDRY_DEBITORS;break;
						case 4:$voucher->default_to = LEDGER_SUNDRY_DEBITORS;break;
						default:$voucher->default_to =-1;
					}
				}else{
					$voucher->default_to = ($_POST['lsttoledger'])?$_POST['lsttoledger']:'';
				}
				$voucher->default_from = ($_POST['lstfromledger'] > 0)?$_POST['lstfromledger']:'';
				
				$voucher->form_type_id	= $_POST['lstformtype'];
				$voucher->no_of_copies = $_POST['lstcopy'];
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
	print $voucher->voucher_master_source;exit();
}

//jquery post
if(isset($_POST['default_header'])){
	print 1;exit();
}





?>