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

$form_type = new FormType($myconnection);
$form_type->connection = $myconnection;

$form_variable = new FormVariable($myconnection);
$form_variable->connection = $myconnection;

$form_variables = $form_variable->get_list_array();

if(isset($_GET['ac'])){//url parameter account id

	$account->account_id = $_GET['ac'];
	$account->get_details();
	$voucher->voucher_id = $account->voucher_type_id;
	$voucher->get_details();
	$form_type->id =$voucher->form_type_id;
	$form_type->get_details();
	$form_type_variables = unserialize($form_type->form_variables);
	$count_columns = count($form_type_variables);
	




	$stock_register->voucher_type_id = $account->voucher_type_id;
	$stock_register->voucher_number = $account->voucher_number;
	list($items,$totals) = $stock_register->get_voucher_inventory_details();
	

}else{
	$_SESSION[SESSION_TITLE.'flash'] = "Invalid voucher";
    header( "Location:dashboard.php");
    exit();
}

?>