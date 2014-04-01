<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}



$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$fy_ledger_sub = new FyLedgerSub($myconnection);
$fy_ledger_sub->connection = $myconnection;

$account = new Account($myconnection);
$account->connection = $myconnection;

$fy_year = new FinancialYear($myconnection);
$fy_year->connection = $myconnection;
$fy_year->id = $account->current_fy_id;
$fy_year->get_details();


$ledgers = $ledger->generateLedgerList();

$ledger_masters = $ledger->get_list_master_array();

if(isset($_POST['submit'])){
	
	if(trim($_POST['txtledger'])!="" && $_POST['lstmledger'] >0)
	{
		//ledger sub update
		$ledger->ledger_sub_id	= $_POST['hd_id'];
		$ledger->ledger_sub_name	= $_POST['txtledger'];
		$ledger->ledger_id	= $_POST['lstmledger'];
		if(isset($_POST['lstsledger'])){
			$ledger->parent_sub_ledger_id		= $_POST['lstsledger'];
		}
		$insert = $ledger->update();

		if($insert){
			//add ledger in fy_ledger_sub
			$fy_ledger_sub->ledger_sub_id = $ledger->ledger_sub_id;
			$fy_ledger_sub->update();

			if($_POST['lstobtype'] > 0){
				$account->ref_ledger = $insert;
				$account->date = $fy_year->fy_start;
				if($_POST['lstobtype'] == 1){
					$account->account_to = $insert;
					$account->account_credit = $_POST['txtamount'];
				}else if($_POST['lstobtype'] == 2){
					$account->account_from = $insert;
					$account->account_debit = $_POST['txtamount'];
				}
				$account->update();
			}
			
		}
	}else{
		//do nothing
	}

	header("Location:".$current_url);
}


//jquery ajax
if(isset($_GET['master'])){
	
	$ledger->ledger_id = $_GET['master'];
	$json = $ledger->get_list_sub_array_with_masterid();
	if($json){
		echo json_encode($json);exit();
	}
	//print_r($sub_ledgers);exit();
}





?>