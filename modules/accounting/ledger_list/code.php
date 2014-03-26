<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);
$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$ledgers = $ledger->generateLedgerList();

$ledgers_list = $ledger->getLedgerTransaction();


	
?>