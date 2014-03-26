<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
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

$tax = new Tax($myconnection);
$tax->connection = $myconnection;
$taxes = $tax->get_list_array();

$ledgers_all = $ledger->get_list_array();
$items = $stock->get_list_array();

$page_heading = "Generate Voucher";
$list_url = "#";
$readonly = "";
$amount = "";
$edt_items = false;



//editgenerated voucher -account id as url parameter
if(isset($_GET['edt']) || isset($_GET['v'])){
	
	//edit voucher
	if(isset($_GET['edt'])){
		$account->account_id = $_GET['edt'];
		$account->get_details();

		$voucher->voucher_id = $account->voucher_type_id;
		$voucher->get_details();
		$voucher_number = $account->voucher_number;
		$readonly = "readonly='readonly'";

		if($account->account_from ==$account->ref_ledger){
			$amount = $account->account_debit;
		}elseif($account->account_to ==$account->ref_ledger){
			$amount = $account->account_credit;
		}

		if($voucher->source == VOUCHER_FOR_INVENTORY){
			$stock_register->voucher_type_id = $account->voucher_type_id;
			$stock_register->voucher_number = $account->voucher_number;	
			$edt_items = $stock_register->get_voucher_items();
			
		}
	}
	//new voucher
	if(isset($_GET['v'])){//url parameter voucher id
		$list_url = "ac_generated_vouchers.php?slno=".$_GET['v'];
		$voucher->voucher_id = $_GET['v'];
		$voucher->get_details();

		//get next voucher number
		$next_voucher_number = $account->getNextVoucherNumber($voucher->voucher_id);
		if($next_voucher_number){
			$voucher_number = $next_voucher_number;
		}else{
			$voucher_number = $voucher->series_start;
		}
		//echo $voucher_number;exit();
	}
	
	$page_heading = $voucher->voucher_name;

	if($voucher->default_from != ""){
		$default_from = true;
		$ids = unserialize($voucher->default_from);
		$filter = "ledger_sub_id IN (".implode(",",$ids).")";
		$ledgers_default_from_filtered = $ledger->get_list_array($filter);
		$filter1 = "ledger_sub_id NOT IN (".implode(",",$ids).")";
		$ledgers_exept_default_from_filtered = $ledger->get_list_array($filter1);
	}else{
		$default_from = false;	
	}

	if($voucher->default_to != ""){
		$default_to = true;
		$ids = unserialize($voucher->default_to);
		$filter = "ledger_sub_id IN (".implode(",",$ids).")";
		$ledgers_default_to_filtered = $ledger->get_list_array($filter);
		$filter1 = "ledger_sub_id NOT IN (".implode(",",$ids).")";
		$ledgers_exept_default_to_filtered = $ledger->get_list_array($filter1);
	}else{
		$default_to = false;
	}

}elseif(isset($_GET['dlt'])){
	$account->account_id = $_GET['dlt'];
	$account->get_details();
	$voucher_type_id = $account->voucher_type_id;

	$delete = $account->delete_with_voucher();
	
	
	$_SESSION[SESSION_TITLE.'flash'] = $account->error_description;
    header( "Location:ac_generated_vouchers.php?slno=".$voucher_type_id);
    exit();
	
}
else if(isset($_GET['item'])){//jquery select item

	
	$stock->item_id = $_GET['item'];
	$stock->get_details();

	
	$quantity_in_hand = $stock_register->quantityInStock($stock->item_id);
	print $quantity_in_hand;exit();

}
else{
	$_SESSION[SESSION_TITLE.'flash'] = "Invalid voucher";
    header( "Location:dashboard.php");
    exit();
}



//submit form
if(isset($_POST['submit'])){

	$voucher->voucher_id = $_POST['hd_voucherid'];
	$voucher->get_details();

	$errorMSG = "";
	if($_POST['txtvnumber'] == ""){
		$errorMSG .= "Invalid voucher<br>";
	}
	if($_POST['lstfrom'] == gINVALID || $_POST['lstfrom'] == ""){
		$errorMSG .= "Select From account<br>";
	}
	if($_POST['lstto'] == gINVALID || $_POST['lstto'] == ""){
		$errorMSG .= "Select To account<br>";
	}

	if($voucher->source == VOUCHER_FOR_INVENTORY){
		if(!isset($_POST['hd_itemcode'])){
			$errorMSG .= "Select Items<br>";
		}
	}else{
		if(!filter_var($_POST['txtamount'],FILTER_VALIDATE_FLOAT)){
			$errorMSG .= "Invalid amount<br>";
		}
	}

	if($errorMSG != ""){
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url."?v=".$voucher->voucher_id);
        exit();
	}else{

		$account->voucher_number 	= $_POST['txtvnumber'];
		$account->voucher_type_id	= $voucher->voucher_id;
		$exist = $account->exist();
		if($exist){ //edit
			$account_id = $account->account_id;
			$arr = array();
			if($voucher->source == VOUCHER_FOR_ACCOUNT){//update account master only
				$arr['narration'] = $_POST['txtnarration'];
				$arr['amount'] 	  = $_POST['txtamount'];
				$update = $account->update_batch($arr);
				header( "Location:ac_voucher_print.php?ac=".$account_id);
		    	exit();

			}elseif($voucher->source == VOUCHER_FOR_INVENTORY and isset($_POST['hd_itemcode'])){
				$item_count = count($_POST['hd_itemcode']);

				$arr['narration'] = $_POST['txtnarration'];
				$dataArray = array();
				for($i=0; $i<$item_count; $i++){
					$dataArray[$i]['item_id'] 	= $_POST['hd_itemcode'][$i];
					$dataArray[$i]['quantity'] 	= ($voucher->voucher_master_id = SALES)?-($_POST['hd_itemqty'][$i]):$_POST['hd_itemqty'][$i];
					$dataArray[$i]['rate'] 		= $_POST['hd_itemrate'][$i];
					$dataArray[$i]['tax'] 		= $_POST['hd_itemtax'][$i];
				}
				$arr['amount'] = calculateTotal($dataArray);
				
				$update = $account->update_batch($arr);
				
				//delete and reinsert items
				$stock_register->voucher_number = $voucher_number;
				$stock_register->voucher_type_id = $voucher->voucher_id;
				$delete=$stock_register->delete();
				if($delete){
					if($voucher->voucher_master_id = SALES){
						$stock_register->input_type =INPUT_SALE; 
					}elseif($voucher->voucher_master_id = PURCHASE){
						$stock_register->input_type =INPUT_PURCHASE; 
					}
				
					$stock_register->purchase_reference_number = $_POST['txtrnumber'];
					$stock_register->date = $_POST['txtdate'];
					$stock_register->insert_batch($dataArray);
				}

				
				header( "Location:ac_voucher_print.php?ac=".$account_id);
			    exit();
			   
					
				
			}

			


		}else{//new entry

			$dataAccount = array();
			$account->reference_number 	= $_POST['txtrnumber'];
			$account->fy_id				= $voucher->fy_id;
			$account->account_from 		= $_POST['lstfrom'];
			$account->account_to		= $_POST['lstto'];
			$account->date				= $_POST['txtdate'];
			$account->narration 		= $_POST['txtnarration'];

			
			
			if($voucher->source == VOUCHER_FOR_ACCOUNT){//update account master only
				$dataAccount[0]['account_debit']  = $_POST['txtamount'];
				$dataAccount[0]['account_credit'] = "";
				$dataAccount[0]['ref_ledger'] = $_POST['lstfrom'];
				$dataAccount[1]['account_debit']  = "";
				$dataAccount[1]['account_credit'] = $_POST['txtamount'];
				$dataAccount[1]['ref_ledger'] = $_POST['lstto'];
				$insert = $account->insert_batch($dataAccount);
			}elseif($voucher->source == VOUCHER_FOR_INVENTORY and isset($_POST['hd_itemcode'])){//update both account master and stock register	
				
				$item_count = count($_POST['hd_itemcode']);
				$dataArray = array();
				for($i=0; $i<$item_count; $i++){
					$dataArray[$i]['item_id'] 	= $_POST['hd_itemcode'][$i];
					$dataArray[$i]['quantity'] 	= ($voucher->voucher_master_id == SALES)?-($_POST['hd_itemqty'][$i]):$_POST['hd_itemqty'][$i];
					$dataArray[$i]['rate'] 		= $_POST['hd_itemrate'][$i];
					$dataArray[$i]['tax'] 		= $_POST['hd_itemtax'][$i];
					$dataArray[$i]['tax_rate']  = $tax->getRate($_POST['hd_itemtax'][$i]);
				}
				
				$dataAccount[0]['account_debit']  = calculateTotal($dataArray);
				$dataAccount[0]['account_credit'] = "";
				$dataAccount[0]['ref_ledger'] = $_POST['lstfrom'];
				$dataAccount[1]['account_debit']  = "";
				$dataAccount[1]['account_credit'] = calculateTotal($dataArray);
				$dataAccount[1]['ref_ledger'] = $_POST['lstto'];

				$insert = $account->insert_batch($dataAccount);
				if($insert){
					$stock_register->voucher_number = $voucher_number;
					$stock_register->voucher_type_id = $voucher->voucher_id;
					if($voucher->voucher_master_id == SALES){
						$stock_register->input_type =INPUT_SALE; 
					}elseif($voucher->voucher_master_id == PURCHASE){
						$stock_register->input_type =INPUT_PURCHASE; 
					}
					
					$stock_register->purchase_reference_number = $_POST['txtrnumber'];
					$stock_register->date = $_POST['txtdate'];
					$stock_register->insert_batch($dataArray);
				}
					
			}

			if($insert){
				
				if($voucher->source == VOUCHER_FOR_INVENTORY && $voucher->form_type_id > 0){
					header( "Location:ac_form_print.php?ac=".$insert);
		    		exit();
				}else{
					header( "Location:ac_voucher_print.php?ac=".$insert);
					exit();
				}
				
			}
		}
	}

}







?>