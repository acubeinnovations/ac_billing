<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$financial_year = new FinancialYear($myconnection);
$financial_year->connection = $myconnection;

$mybalancesheet = new BalanceSheet($myconnection);


$mystock_register = new StockRegister($myconnection);
$mystock_register->connection = $myconnection;



//edit
if(isset($_GET['edt'])){
	$financial_year->id = $_GET['edt'];
	$financial_year->get_details();
	$submit_value = $CAP_update;
	
}else{
	
	$submit_value = $CAP_addnew;
}

//delete
if(isset($_GET['dlt'])){
	$financial_year->id = $_GET['dlt'];
	$financial_year->delete();
}



//close
if(isset($_GET['cls'])){
	$_SESSION[SESSION_TITLE.'flash'] = "";
	if($mybalancesheet->error == false){

	$financial_year->id = $_GET['cls'];
	$financial_year->get_details();
		if($financial_year->checkNextFY($financial_year->fy_end) == true){
			// Stock Close
			$result = $mystock_register->close($_GET['cls'],$financial_year->next_fy_id,date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))));
//				echo "<pre>";
//				print_r($close_data);
//				echo "</pre>";
//				exit();

			if($result == true){
				//fetched closing data
				$close_data = $mybalancesheet->get_closing();
				$close_data_liabilities = $close_data["liabilities"];
				$close_data_assets = $close_data["assets"];
				$close_data_income = $close_data["income"];
				$close_data_expenses = $close_data["expenses"];
			
				// set new FY id as current
				$financial_year->current_fy_id = $financial_year->next_fy_id;
				$financial_year->updateCurrentFY();

				// add opening balance for liabilities
				foreach ($close_data_liabilities as $row_liabilities){
					//echo $row_liabilities["ledger_sub_id"].",".$row_liabilities["ledger_sub_name"].",".$row_liabilities["balance"]."<br>";

					$account = new Account($myconnection);
					$account->connection = $myconnection;
					$account->ref_ledger = $row_liabilities["ledger_sub_id"];
					$account->date = date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))); 
					$account->account_to = $row_liabilities["ledger_sub_id"];
					$account->account_credit = $row_liabilities["balance"];
	//				echo "<pre>";
	//				print_r($account);
	//				echo "</pre>";
					$account->update();

				}

				// add opening balance for assets
				foreach ($close_data_assets as $row_assets){
					//echo $row_assets["ledger_sub_id"].",".$row_assets["ledger_sub_name"].",".$row_assets["balance"]."<br>";
					$account = new Account($myconnection);
					$account->connection = $myconnection;
					$account->ref_ledger = $row_assets["ledger_sub_id"];
					$account->date = date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))); 
					$account->account_from = $row_assets["ledger_sub_id"];
					$account->account_debit = $row_assets["balance"];
	//				echo "<pre>";
	//				print_r($account);
	//				echo "</pre>";
					$account->update();
				}

	// add profit or loss to capital
					$default_capital = $financial_year->get_default_capital_account();
					$result = false;
					if($default_capital > 0){
						$account = new Account($myconnection);
						$account->connection = $myconnection;
						$account->ref_ledger = $default_capital;
						$account->date = date('Y-m-d', strtotime('+1 day', strtotime($financial_year->fy_end))); 
						$account->account_from = $default_capital;
						if ($close_data["profit"] >0){
							$account->account_debit = $close_data["profit"];
						}elseif ($close_data["loss"] >0){
							$account->account_credit = $close_data["loss"];				
						}

						$account->update();
						$result=true;
					}else{
						$_SESSION[SESSION_TITLE.'flash'] .= "Default capital account not in settings<br>";
						$result=false;
					}

				if($financial_year->next_fy_id > 0 && $result==true  ){
					// create subledgers for New FY
					$result = $financial_year->create_FY_subledgers($financial_year->next_fy_id);
					if($result == true){
						// close FY
						$result = $financial_year->close();
					}else{
						$_SESSION[SESSION_TITLE.'flash'] .= "Adding sub ledges for next Fy failed <br>";
						$result =false;
					
					}
				}else{
					$_SESSION[SESSION_TITLE.'flash'] .= "Please check for next FY <br>";
					$result =false;
				}
			}else{
					$_SESSION[SESSION_TITLE.'flash'] .= "Stock closing failed <br>";
					$result =false;
			}
			if($result==false){
				// error occured remove added account entries for New FY
				 $financial_year->delete_FY_account_entries($financial_year->next_fy_id);

				// error occured remove added subledgers for New FY
				 $financial_year->delete_FY_subledgers($financial_year->next_fy_id);
				// error occured revert close
				$financial_year->id = $_GET['cls'];
				$financial_year->revert_close();
				//error occured  set reset FY id as current
				$financial_year->current_fy_id = $_GET['cls'];
				$financial_year->updateCurrentFY();
				// error occured revert stock closing
				$mystock_register->revert_close($financial_year->next_fy_id);
			}
			
			
		}else{
			$_SESSION[SESSION_TITLE.'flash'] .= "Please check for next FY <br>";
			$result =false;
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] .= "Unable to fetch closing data, Please check for FY in account settings <br>";
		$result =false;
	}

	if($result==true){

		$_SESSION[SESSION_TITLE.'flash'] = "Financial Year Closed";
	    header( "Location:".$current_url);
	    exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] .= "Unable to close Financial Year.";
	    header( "Location:".$current_url);
	    exit();
	}
}






$financial_year->total_records=$pagination->total_records;

$financial_years = $financial_year->get_list_array_bylimit($pagination->start_record,$pagination->max_records);


if($financial_years <> false){
	$pagination->total_records = $financial_year->total_records;
	$pagination->paginate();
	$count_financial_years = count($financial_years);
}else{
	$count_financial_years = 0;
}



//submit action
if(isset($_POST['submit'])){

	$errMSG = "";
	if($_POST['hdfyid'] >0){

	}else{
		if(trim($_POST['txtfystart']) == ""){
			$errMSG .= "Invalid start Date<br>";
		}
		if(trim($_POST['txtfyend']) == ""){
			$errMSG .= "Enter financial year end<br>";
		}
	}
	if(trim($_POST['txtfyname']) == ""){
		$errMSG .= "Enter financial year Name<br>";
	}

	if($errMSG == ""){

		$financial_year->id	= $_POST['hdfyid'];
		$financial_year->fy_start	= $_POST['txtfystart'];
		$financial_year->fy_end		= $_POST['txtfyend'];
		$financial_year->fy_name    = $_POST['txtfyname'];
		$financial_year->status 	= FINANCIAL_YEAR_OPEN;
		$financial_year->update();
		header("Location:".$current_url);
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errMSG;
	    header( "Location:".$current_url);
	    exit();
	}
}


?>
