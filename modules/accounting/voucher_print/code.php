<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$voucher = new Voucher($myconnection);
$voucher->connection = $myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$account = new Account($myconnection);
$account->connection = $myconnection;

$stock_register = new StockRegister($myconnection);
$stock_register->connection = $myconnection;

if(isset($_GET['ac'])){//url parameter account id

	$account->account_id = $_GET['ac'];
	$account->get_details();
	$voucher->voucher_id = $account->voucher_type_id;
	$voucher->get_details();

	
	 

	//check source for voucher print form
	if($voucher->source == VOUCHER_FOR_ACCOUNT){
		
		$filter_by = "";
		if($voucher->default_to == ""){//receipt
			$filter_by = "account_from";
		}else if($voucher->default_from == ""){//payment
			$filter_by = "account_to";
		}
		$voucher_print = $account->get_voucher_account_details($filter_by);
	}
	else if($voucher->source == VOUCHER_FOR_INVENTORY){
		$stock_register->voucher_type_id = $account->voucher_type_id;
		$stock_register->voucher_number = $account->voucher_number;
		list($items,$totals) = $stock_register->get_voucher_inventory_details();
		//print_r($items);exit();
	}


}else{
	$_SESSION[SESSION_TITLE.'flash'] = "Invalid voucher";
    header( "Location:dashboard.php");
    exit();
}

?>