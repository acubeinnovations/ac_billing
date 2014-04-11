<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$voucher = new Voucher($myconnection);
$voucher->connection = $myconnection;

$account = new Account($myconnection);
$account->connection = $myconnection;

$ledger = new Ledger($myconnection);
$ledger->connection = $myconnection;

$ledgers_all = $ledger->get_list_array_have_no_children();

$page_heading = "Generate Voucher";
$list_url = "#";
$readonly = "";
$amount = 0;

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
		$list_url = "ac_generated_ac_vouchers.php?slno=".$voucher->voucher_id;

		if($account->account_from ==$account->ref_ledger){
			$amount = $account->account_debit;
		}elseif($account->account_to ==$account->ref_ledger){
			$amount = $account->account_credit;
		}

	}
	//new voucher
	if(isset($_GET['v'])){//url parameter voucher id
		$list_url = "ac_generated_ac_vouchers.php?slno=".$_GET['v'];
		$voucher->voucher_id = $_GET['v'];
		$voucher->get_details();
		//get next voucher number
		$next_voucher_number = $account->getNextVoucherNumber($voucher->voucher_id);
		if($next_voucher_number){
			$voucher_number = $next_voucher_number;
		}else{
			$voucher_number = $voucher->series_start;
		}
		if($voucher_number ==''){
			$_SESSION[SESSION_TITLE.'flash'] = "Invalid Voucher";
		    header( "Location:ac_vouchers.php");
		    exit();
		}
	}
	$voucher->get_master_details();
	$page_heading = $voucher->voucher_name;

	if($voucher->default_account == DEFAULT_ACCOUNT_FROM){
		$default_from =true;
		$ids = @unserialize($voucher->default_from);
		if(is_array($ids)){
			$filter = "ledger_sub_id IN (".implode(",",$ids).")";
			$filter1 = "ledger_sub_id NOT IN (".implode(",",$ids).")";
		}else if($voucher->default_from >0){
			$filter = "ledger_sub_id = '".$voucher->default_from."'";
			$filter1 = "ledger_sub_id <> '".$voucher->default_from."'";
		}
		$ledgers_default_from_filtered = $ledger->get_list_array_have_no_children($filter);
		$ledgers_exept_default_from_filtered = $ledger->get_list_array_have_no_children($filter1);
	}else{
		$default_from = false;
	}

	if($voucher->default_account == DEFAULT_ACCOUNT_TO){
		$default_to = true;
		$ids = @unserialize($voucher->default_to);
		if(is_array($ids)){
			$filter = "ledger_sub_id IN (".implode(",",$ids).")";
			$filter1 = "ledger_sub_id NOT IN (".implode(",",$ids).")";
		}else if($voucher->default_to >0){
			$filter = "ledger_sub_id = '".$voucher->default_to."'";
			$filter1 = "ledger_sub_id <> '".$voucher->default_to."'";
		}
		$ledgers_default_to_filtered = $ledger->get_list_array_have_no_children($filter);
		$ledgers_exept_default_to_filtered = $ledger->get_list_array_have_no_children($filter1);
	}else{
		$default_to = false;
	}
	
	

}elseif(isset($_GET['dlt'])){
	$account->account_id = $_GET['dlt'];
	$account->get_details();
	$voucher_type_id = $account->voucher_type_id;

	$delete = $account->delete_with_voucher();
	
	
	$_SESSION[SESSION_TITLE.'flash'] = $account->error_description;
    header( "Location:ac_generated_ac_vouchers.php?slno=".$voucher_type_id);
    exit();
	
}
else{
	$_SESSION[SESSION_TITLE.'flash'] = "Invalid voucher";
    header( "Location:dashboard.php");
    exit();
}



//submit form
if(isset($_POST['submit'])){
	$account->account_id = $_POST['hd_ac_id'];
	$voucher->voucher_id = $_POST['hd_voucherid'];
	$voucher->get_details();

	//validation start
	$errorMSG = "";
	if($_POST['txtvnumber'] == ""){
		$errorMSG .= "Invalid voucher<br>";
	}
	if($account->account_id ==gINVALID || $account->account_id == ''){
		if($_POST['lstfrom'] == gINVALID || $_POST['lstfrom'] == ""){
			$errorMSG .= "Select From account<br>";
		}
		if($_POST['lstto'] == gINVALID || $_POST['lstto'] == ""){
			$errorMSG .= "Select To account<br>";
		}
	}	
	if(!filter_var($_POST['txtamount'],FILTER_VALIDATE_FLOAT)){
		$errorMSG .= "Invalid amount<br>";
	}
	//validation end
	
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
			$arr['narration'] = $_POST['txtnarration'];
			$arr['amount'] 	  = $_POST['txtamount'];
			$update = $account->update_batch($arr);
			//check print voucher or not
			if(isset($_POST['ch_print'])){
				header( "Location:ac_voucher_print.php?ac=".$insert);
				exit();
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = $account->error_description;
				header( "Location:ac_generated_ac_vouchers.php?slno=".$voucher->voucher_id);
				exit();

			}	
		}else{//new entries in account master
			$dataAccount = array();
			$account->reference_number 	= $_POST['txtrnumber'];
			$account->date				= $_POST['txtdate'];
			$account->narration 		= $_POST['txtnarration'];
			$index = 0;
			$dataAccount[$index]['account_from'] = $_POST['lstfrom'];
			$dataAccount[$index]['account_to'] = $_POST['lstto'];
			$dataAccount[$index]['account_debit']  = $_POST['txtamount'];
			$dataAccount[$index]['account_credit'] = "";
			$dataAccount[$index]['ref_ledger'] = $_POST['lstfrom'];
			$index++;
			$dataAccount[$index]['account_from'] = $_POST['lstfrom'];
			$dataAccount[$index]['account_to'] = $_POST['lstto'];
			$dataAccount[$index]['account_debit']  = "";
			$dataAccount[$index]['account_credit'] = $_POST['txtamount'];
			$dataAccount[$index]['ref_ledger'] = $_POST['lstto'];
			$insert = $account->insert_batch($dataAccount);

			if($insert){
				if(isset($_POST['ch_print'])){
					header( "Location:ac_voucher_print.php?ac=".$insert);
					exit();	
				}else{
					$_SESSION[SESSION_TITLE.'flash'] = $account->error_description;
					header( "Location:".$current_url."?v=".$voucher->voucher_id);
					exit();
				}	
			}
		}//new entry close
	}//validation close

}//post close







?>