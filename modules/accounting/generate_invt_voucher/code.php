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
//array for find tax name with id in jquery
$tax_josn = $tax->get_tax_json_array();


$ledgers_all = $ledger->get_list_array_have_no_children();
$items = $stock->get_list_array();

$page_heading = "Generate Voucher";
$list_url = "#";
$readonly = "";
$amount = 0;
$frieght = 0;
$discount = 0;
$roundoff = 0;
$edt_items = false;



//editgenerated voucher -account id as url parameter
if(isset($_GET['edt']) || isset($_GET['v'])){
	
	//edit voucher
	if(isset($_GET['edt'])){
		$account->account_id = $_GET['edt'];
		$account->get_details();

		$voucher->voucher_id = $account->voucher_type_id;
		$voucher->get_details();
		$voucher->get_master_details();
		$voucher_number = $account->voucher_number;
		$readonly = "readonly='readonly'";
		$list_url = "ac_generated_invt_vouchers.php?slno=".$voucher->voucher_id;

		if($account->account_from ==$account->ref_ledger){
			$amount = $account->account_debit;
		}elseif($account->account_to ==$account->ref_ledger){
			$amount = $account->account_credit;
		}

		
		$stock_register->voucher_type_id = $account->voucher_type_id;
		$stock_register->voucher_number = $account->voucher_number;	
		$edt_items = $stock_register->get_voucher_items();
		

	}
	//new voucher
	if(isset($_GET['v'])){//url parameter voucher id
		$list_url = "ac_generated_vouchers.php?slno=".$_GET['v'];
		$voucher->voucher_id = $_GET['v'];
		$voucher->get_details();
		$voucher->get_master_details();
		
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
	
	//set page heading
	$page_heading = $voucher->voucher_name;

	//get taxes w.r.t sale or purchase
	if($voucher->inventory_type == INVENTORY_TYPE_SALE){
		$tax->type = TAX_TYPE_SALE;
	}else if($voucher->inventory_type == INVENTORY_TYPE_PURCHASE){
		$tax->type = TAX_TYPE_PURCHASE;
	}
	$taxes = $tax->get_list_array();

	if($voucher->default_account == DEFAULT_ACCOUNT_FROM){
		$ids = @unserialize($voucher->default_from);
		$filter = "ledger_sub_id IN (".implode(",",$ids).")";
		$ledgers_from = $ledger->get_list_array_have_no_children($filter);
		if($voucher->voucher_source_item_id > 0){
			if($voucher->voucher_source_item_id == ALL_CUSTOMERS || $voucher->voucher_source_item_id == ALL_SUPPLIERS){
				$join = "";
				$filter1 = "ls.ledger_id = '".$voucher->default_to."'";
			}else if($voucher->voucher_source_item_id == CUSTOMER_TIN_CST){
				$join = " LEFT JOIN customer c ON c.ledger_sub_id = ls.ledger_sub_id";
				$filter1 = "ls.ledger_id = '".$voucher->default_to."' AND c.customer_cst_number <> '' AND c.customer_tin_number <> ''";
			}else if($voucher->voucher_source_item_id == SUPPLIER_TIN_CST){
				$join = " LEFT JOIN supplier s ON s.ledger_sub_id = ls.ledger_sub_id";
				$filter1 = "ls.ledger_id = '".$voucher->default_to."' AND s.supplier_cst_number <> '' AND s.supplier_tin_number <> ''";
			}
		}else{
			$join = "";
			$filter1 = "ledger_sub_id NOT IN (".implode(",",$ids).")";
		}
		$ledgers_to = $ledger->get_list_array_have_no_children($filter1,$join);	
	}else if($voucher->default_account == DEFAULT_ACCOUNT_TO){
		$ids = @unserialize($voucher->default_to);
		$filter = "ledger_sub_id IN (".implode(",",$ids).")";
		$ledgers_to = $ledger->get_list_array_have_no_children($filter);
		if($voucher->voucher_source_item_id > 0){
			if($voucher->voucher_source_item_id == ALL_CUSTOMERS || $voucher->voucher_source_item_id == ALL_SUPPLIERS){
				$join = "";
				$filter1 = "ls.ledger_id = '".$voucher->default_from."'";
			}else if($voucher->voucher_source_item_id == CUSTOMER_TIN_CST){
				$join = " LEFT JOIN customer c ON c.ledger_sub_id = ls.ledger_sub_id";
				$filter1 = "ls.ledger_id = '".$voucher->default_from."' AND c.customer_cst_number <> '' AND c.customer_tin_number <> ''";
			}else if($voucher->voucher_source_item_id == SUPPLIER_TIN_CST){
				$join = " LEFT JOIN supplier s ON s.ledger_sub_id = ls.ledger_sub_id";
				$filter1 = "ls.ledger_id = '".$voucher->default_from."' AND s.supplier_cst_number <> '' AND s.supplier_tin_number <> ''";
			}
		}else{
			$join = "";
			$filter1 = "ledger_sub_id NOT IN (".implode(",",$ids).")";
		}
		$ledgers_from = $ledger->get_list_array_have_no_children($filter1,$join);	
	}else{
		$ledgers_all = $ledger->get_list_array_have_no_children();
		$ledgers_to = $ledgers_all;
		$ledgers_from = $ledgers_all;
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

	$account->account_id = $_POST['hd_ac_id'];
	$voucher->voucher_id = $_POST['hd_voucherid'];

	$voucher->get_details();
	$voucher->get_master_details();

	$errorMSG = "";
	if($_POST['txtvnumber'] == ""){
		$errorMSG .= "Invalid voucher<br>";
	}
	if(isset($_POST['lstfrom'])){
		if($_POST['lstfrom'] == gINVALID || $_POST['lstfrom'] == ""){
			$errorMSG .= "Select From account<br>";
		}
	}
	if(isset($_POST['lstto'])){
		if($_POST['lstto'] == gINVALID || $_POST['lstto'] == ""){
			$errorMSG .= "Select To account<br>";
		}
	}
	if(!isset($_POST['hd_itemcode'])){
		$errorMSG .= "Select Items<br>";
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

			}else if($voucher->source == VOUCHER_FOR_INVENTORY and isset($_POST['hd_itemcode'])){
				$item_count = count($_POST['hd_itemcode']);


				$arr['narration'] = $_POST['txtnarration'];
				$dataArray = array();
				for($i=0; $i<$item_count; $i++){
					$dataArray[$i]['item_id'] 	= $_POST['hd_itemcode'][$i];
					$dataArray[$i]['quantity'] 	= ($voucher->voucher_master_id = SALES)?-($_POST['hd_itemqty'][$i]):$_POST['hd_itemqty'][$i];
					$dataArray[$i]['rate'] 		= $_POST['hd_itemrate'][$i];
					$dataArray[$i]['tax'] 		= $_POST['hd_itemtax'][$i];
				}
				//print_r($dataArray);exit();
				$arr['amount'] = calculateTotal($dataArray);
				//echo $arr['amount'];exit();
				$account->update_batch($arr);

			
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
					$update = $stock_register->insert_batch($dataArray);
				}
				
				
			}

			
			if(isset($_POST['ch_print'])){
				if($voucher->source == VOUCHER_FOR_INVENTORY && $voucher->form_type_id > 0){
					header( "Location:ac_form_print.php?ac=".$insert);
		    		exit();
				}else{
					header( "Location:ac_voucher_print.php?ac=".$insert);
					exit();
				}
			}else{
				$_SESSION[SESSION_TITLE.'flash'] = $account->error_description;
				header( "Location:ac_generated_vouchers.php?slno=".$voucher->voucher_id);
				exit();

			}	
			

		}else{//new entry
			$dataAccount = array();
			$account->reference_number 	= $_POST['txtrnumber'];
			$account->date				= $_POST['txtdate'];
			$account->narration 		= $_POST['txtnarration'];
			$amount = $_POST['txtamount'];

			$inventory_amount = 0;

			//item list array
			$dataArray = array();
			$item_count = count($_POST['hd_itemcode']);
			for($i=0; $i<$item_count; $i++){
				$dataArray[$i]['item_id'] 	= $_POST['hd_itemcode'][$i];
				$dataArray[$i]['quantity'] 	= ($voucher->voucher_master_id == SALES)?-($_POST['hd_itemqty'][$i]):$_POST['hd_itemqty'][$i];
				$dataArray[$i]['rate'] 		= $_POST['hd_itemrate'][$i];
				$dataArray[$i]['tax'] 		= $_POST['hd_itemtax'][$i];
				$dataArray[$i]['discount']  = $_POST['hd_discount'][$i];
				$dataArray[$i]['tax_rate']  = $tax->getRate($_POST['hd_itemtax'][$i]);
				$inventory_amount += ($_POST['hd_itemqty'][$i] * $_POST['hd_itemrate'][$i]);
			}
			
			//check tax rows generated
			if(isset($_POST['hd_tax_ledger'])){ 
				$tax_ledgers = $_POST['hd_tax_ledger']; 
			}else{
				$tax_ledgers = false;
			}

			//index for account entry array
			$index = 0;
			
			if($voucher->inventory_type == INVENTORY_TYPE_SALE){
				//1.sale account and customer
				$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
				$dataAccount[$index]['account_to']  	= $_POST['lstto'];
				$dataAccount[$index]['ref_ledger'] 		= $voucher->inventory_account;
				$dataAccount[$index]['account_debit']  	= "";
				$dataAccount[$index]['account_credit'] 	= $inventory_amount;
				$index++;
				$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
				$dataAccount[$index]['account_to']  	= $_POST['lstto'];
				$dataAccount[$index]['ref_ledger'] 		= $_POST['lstto'];
				$dataAccount[$index]['account_debit']  	= $amount;
				$dataAccount[$index]['account_credit'] 	= "";
				$index++;

				//2. if tax ledger
				if($tax_ledgers){ 
					for($j=0; $j < count($tax_ledgers); $j++){
						$list = explode("_", $tax_ledgers[$j]);
						$tax->id = $list[0];
						$tax->get_details();
						$tax_ledger_id = $tax->ledger_sub_id;
						$tax_amount = $list[1];
						$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
						$dataAccount[$index]['account_to']  	= $tax_ledger_id;
						$dataAccount[$index]['ref_ledger'] 		= $tax_ledger_id;
						$dataAccount[$index]['account_debit']  	= "";
						$dataAccount[$index]['account_credit'] 	= $tax_amount;
						$index++;
					}
				}
				
				//3. if freight and demurge
				if(isset($_POST['txtfrieght']) and $_POST['txtfrieght']!= "" and  $_POST['txtfrieght'] > 0){
					$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
					$dataAccount[$index]['account_to']  	= $voucher->freight_demurge;
					$dataAccount[$index]['ref_ledger'] 		= $voucher->freight_demurge;
					$dataAccount[$index]['account_debit']  	= "";
					$dataAccount[$index]['account_credit'] 	= $_POST['txtfrieght'];
					$index++;
				}
				//4.if round off
				if(isset($_POST['hd_round']) and $_POST['hd_round']!= "" and  $_POST['hd_round'] > 0){
					$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
					$dataAccount[$index]['account_to']  	= $voucher->round_off;
					$dataAccount[$index]['ref_ledger'] 		= $voucher->round_off;;
					$dataAccount[$index]['account_debit']  	= "";
					$dataAccount[$index]['account_credit'] 	= $_POST['hd_round'];
					$index++;
				}
				//5. if cash (radio click)
				if(isset($_POST['radio']) and $_POST['radio'] == $ac_tx_CASH){
					$dataAccount[$index]['account_from']  	= $_POST['lstfrom'];
					$dataAccount[$index]['account_to']  	= $_POST['lstto'];
					$dataAccount[$index]['ref_ledger'] 		= $_POST['lstfrom'];
					$dataAccount[$index]['account_debit']   = $amount;
					$dataAccount[$index]['account_credit'] 	= "";
					
					$index++;
					$dataAccount[$index]['account_from']  	= $_POST['lstfrom'];
					$dataAccount[$index]['account_to']  	= $_POST['lstto'];
					$dataAccount[$index]['ref_ledger'] 		= $_POST['lstto'];
					$dataAccount[$index]['account_debit']  	= "";
					$dataAccount[$index]['account_credit'] 	= $amount;
					
				}
			}else if($voucher->inventory_type == INVENTORY_TYPE_PURCHASE){
				//1.purchase account and customer
				$dataAccount[$index]['account_from']  	= $_POST['lstfrom'];
				$dataAccount[$index]['account_to']  	= $voucher->inventory_account;
				$dataAccount[$index]['ref_ledger'] 		= $_POST['lstfrom'];
				$dataAccount[$index]['account_debit']  	= "";
				$dataAccount[$index]['account_credit'] 	= $amount;
				$index++;
				$dataAccount[$index]['account_from']  	= $_POST['lstfrom'];
				$dataAccount[$index]['account_to']  	= $voucher->inventory_account;
				$dataAccount[$index]['ref_ledger'] 		= $voucher->inventory_account;
				$dataAccount[$index]['account_debit']  	= $inventory_amount;
				$dataAccount[$index]['account_credit'] 	= "";
				$index++;

				//2. if tax ledger
				if($tax_ledgers){ 
					for($j=0; $j < count($tax_ledgers); $j++){
						$list = explode("_", $tax_ledgers[$j]);
						$tax->id = $list[0];
						$tax->get_details();
						$tax_ledger_id = $tax->ledger_sub_id;
						$tax_amount = $list[1];
						$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
						$dataAccount[$index]['account_to']  	= $tax_ledger_id;
						$dataAccount[$index]['ref_ledger'] 		= $tax_ledger_id;
						$dataAccount[$index]['account_debit']  	= $tax_amount;
						$dataAccount[$index]['account_credit'] 	= "";
						$index++;
					}
				}
				
				//3. if freight and demurge
				if(isset($_POST['txtfrieght']) and $_POST['txtfrieght']!= "" and  $_POST['txtfrieght'] > 0){
					$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
					$dataAccount[$index]['account_to']  	= $voucher->freight_demurge;
					$dataAccount[$index]['ref_ledger'] 		= $voucher->freight_demurge;
					$dataAccount[$index]['account_debit']  	= $_POST['txtfrieght'];
					$dataAccount[$index]['account_credit'] 	= "";
					$index++;
				}
				//4.if round off
				if(isset($_POST['hd_round']) and $_POST['hd_round']!= "" and  $_POST['hd_round'] > 0){
					$dataAccount[$index]['account_from']  	= $voucher->inventory_account;
					$dataAccount[$index]['account_to']  	= $voucher->round_off;
					$dataAccount[$index]['ref_ledger'] 		= $voucher->round_off;;
					$dataAccount[$index]['account_debit']  	= $_POST['hd_round'];
					$dataAccount[$index]['account_credit'] 	= "";
					$index++;
				}
				//5. if cash (radio click)
				if(isset($_POST['radio']) and $_POST['radio'] == $ac_tx_CASH){
					$dataAccount[$index]['account_from']  	= $_POST['lstfrom'];
					$dataAccount[$index]['account_to']  	= $_POST['lstto'];
					$dataAccount[$index]['ref_ledger'] 		= $_POST['lstfrom'];
					$dataAccount[$index]['account_debit']   = $amount;
					$dataAccount[$index]['account_credit'] 	= "";
					
					$index++;
					$dataAccount[$index]['account_from']  	= $_POST['lstfrom'];
					$dataAccount[$index]['account_to']  	= $_POST['lstto'];
					$dataAccount[$index]['ref_ledger'] 		= $_POST['lstto'];
					$dataAccount[$index]['account_debit']  	= "";
					$dataAccount[$index]['account_credit'] 	= $amount;
					
				}
			}else{
				$dataAccount = false;
			}


			/*echo "<pre>";
			print_r($dataArray);exit();
			echo "</pre>";*/

			//if insert array prepared
			if($dataAccount){
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
		
					//check ask for print
					if(isset($_POST['ch_print'])){
						if($voucher->form_type_id > 0){
							header( "Location:ac_form_print.php?ac=".$insert);
				    		exit();
						}else{
							header( "Location:ac_voucher_print.php?ac=".$insert);
							exit();
						}
					}else{
						$_SESSION[SESSION_TITLE.'flash'] = "Voucher generated ";
						header( "Location:".$current_url."?v=".$voucher->voucher_id);
						exit();

					}	
				}else{
					$_SESSION[SESSION_TITLE.'flash'] = $account->error_description;
					header( "Location:".$current_url."?v=".$voucher->voucher_id);
					exit();
				}
			}			

		}//new entry close
	}//validation close

}//post close


//jquery post







?>