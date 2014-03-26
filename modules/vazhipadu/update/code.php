<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$voucher=new Voucher($myconnection);
$voucher->connection=$myconnection;

$account=new Account($myconnection);
$account->connection=$myconnection;

$add_vazhipadu=new Vazhipadu($myconnection);
$add_vazhipadu->connection=$myconnection;

$add_pooja=new Pooja($myconnection);
$add_pooja->connection=$myconnection;

$array_vazhipadu=$add_pooja->get_array();
if($array_vazhipadu==false){
	$array_vazhipadu=array();
}


$add_star=new Stars($myconnection);
$add_star->connection=$myconnection;
$array_star=$add_star->get_array();

if(isset($_POST['submit'])){

	$errorMSG = "";
	if($_POST['listpooja'] >0){
	}else{
		$errorMSG .= "Select Pooja ";
	}
	if(!isset($_POST['hd_row'])){
		$errorMSG .= "Name not added ";
	}

	if($errorMSG == ""){
		$total_amount = 0;
		$add_vazhipadu->pooja_id=$_POST['listpooja'];
		$add_vazhipadu->amount=$_POST['txtamount'];
		$add_vazhipadu->vazhipadu_date = $_POST['txtdate'];
		

		$dataArray = array();
		$i=0;
		
		$total_amount = $_POST['txtamount']*count($_POST['hd_row']);
		foreach($_POST['hd_row'] as $row){
			$list = explode("_", $row);
			$dataArray[$i]['name'] = $list[0];
			$dataArray[$i]['star_id'] = $list[1];
			$i++;
		}
		
		//add voucher entry
		$voucher->module_id = $_POST['hd_moduleid'];
		$voucher->get_details_with_moduleid();
		//get next voucher number
		$next_voucher_number = $account->getNextVoucherNumber($voucher->voucher_id);
		if($next_voucher_number){
			$voucher_number = $next_voucher_number;
		}else{
			$voucher_number = $voucher->series_start;
		}
		//echo $voucher_number;exit();
		
		$account->voucher_number 	= $voucher_number;
		$account->voucher_type_id	= $voucher->voucher_id;
		$dataAccount = array();
		$account->fy_id				= $voucher->fy_id;
		$account->account_from 		= $voucher->default_from;
		$account->account_to		= $_POST['hd_ledger_id'];//$voucher->default_to;
		$account->date				= CURRENT_DATE;
		$dataAccount[0]['account_debit']  = $total_amount;
		$dataAccount[0]['account_credit'] = "";
		$dataAccount[0]['ref_ledger'] = $voucher->default_from;
		$dataAccount[1]['account_debit']  = "";
		$dataAccount[1]['account_credit'] = $total_amount;
		$dataAccount[1]['ref_ledger'] = $voucher->default_to;

		//print_r($dataAccount);exit();
		$insert = $account->insert_batch($dataAccount);
		//voucher entry ends

		if($insert){
			$account->get_details();
			$vazhipadu_rpt_number = $voucher->series_prefix.$voucher->series_seperator.$account->voucher_number.$voucher->series_seperator.$voucher->series_sufix;
			$add_vazhipadu->vazhipadu_rpt_number = $vazhipadu_rpt_number;
//echo $add_vazhipadu->vazhipadu_rpt_number;
//print_r($dataArray);exit();
			$last_id = $add_vazhipadu->update($dataArray);
			if($last_id){
				if($vazhipadu_rpt_number){
					header("Location:vazhipadu_print.php?id=".$vazhipadu_rpt_number);
					exit();
				}else{
					header("Location:vazhipadu.php");
					exit();
				}
			}
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}

}

if(isset($_GET['pooja']) and $_GET['pooja'] > 0)
{
	$json = array();
   	$add_pooja->id=$_GET['pooja'];
   	$add_pooja->get_details();
   	$json['rate'] = $add_pooja->rate;
   	$json['ledger'] = $add_pooja->ledger_sub_id;
   	echo json_encode($json);exit();
     
}





?>