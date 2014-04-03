<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$account_settings = new AccountSettings($myconnection);
$account_settings->connection = $myconnection;
$account_settings->getAccountSettings();

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$account = new Account($myconnection);
$account->connection = $myconnection;

$ledgers = $ledger->get_list_array_have_no_children();

$datefrom = "";
$dateto = "";
$ledger_name = "";

$dataArray = array();
$ledger_name = "";
$datestr = "";


$mybalancesheet = new BalanceSheet($myconnection);
$datefrom =date("d-m-Y");
$dateto =date("d-m-Y");

if(isset($_GET['submit'])){

	if($_GET['lstledger'] > 0 ){
		$ledger_name = $ledger->ledgerName($_GET['lstledger']);
		$dataArray['ref_ledger'] = $_GET['lstledger'];
		$account->ref_ledger = $_GET['lstledger'];	

	}
	
	
	if(isset($_GET['txtfromdate']) and trim($_GET['txtfromdate'])!=""){
		$dataArray['datefrom'] = $_GET['txtfromdate'];
		$datefrom = $_GET['txtfromdate'];
	}else{
		$datefrom =date("d-m-Y");
	}
	if(isset($_GET['txttodate']) and trim($_GET['txttodate'])!=""){
		$dataArray['dateto'] = $_GET['txttodate'];
		$dateto = $_GET['txttodate'];

	}else{
		$dataArray['dateto'] = $_GET['txtfromdate'];
		$dateto = $_GET['txtfromdate'];
	}

	if($datefrom == $dateto){
		$datestr = $datefrom;
	}else{
		$datestr = $datefrom." - ".$dateto;
	}

	$ledger_name = $ledger->ledgerName($account->ref_ledger);

	$account_list = $account->getAccountTransaction($pagination->start_record,$pagination->max_records,$dataArray);

	$account_total_list = $account->getAllAccountTransaction($dataArray);


	$closing_from = date('Y-m-d', strtotime('-1 day', strtotime($datefrom)));
	$closing_to = date("Y-m-d",strtotime($dateto));

	if($_GET['lstledger'] > 0 ){
		$subledger_opening = $mybalancesheet->get_subledger_closing($_GET['lstledger'],$closing_from);
		$subledger_closing = $mybalancesheet->get_subledger_closing($_GET['lstledger'],$closing_to );
	}


	if($account_list){
		$count_list = count($account_list);
		$pagination->total_records = $account->total_records;
		$pagination->paginate();
	}

	

}






?>
