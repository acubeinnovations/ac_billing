<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class BalanceSheet{
	var $connection 		= "";
	var $ledgers_liabilities = array(2,3,5,8,22,24,29,31,34);
	var $ledgers_assets = array(1,6,7,9,15,20,21,26,27,32,33);

	var $p_and_l_expenses = array(10,13,14,19);
	var $p_and_l_income = array(11,16,17,18);

	var $fy_id = "";
	var $fy_name = "";
	var $fy_start = "";
	var $fy_end = "";
	
	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';


public function __construct($connection)
    {

		$this->connection=$connection;
        $strSQL = "SELECT FYM.* FROM account_settings AST,fy_master FYM WHERE AST.id = '1' AND AST.current_fy_id = FYM.fy_id";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
            $row = mysql_fetch_assoc($rsRES);
            $this->fy_id =$row['fy_id'];
            $this->fy_name =$row['fy_name'];
            $this->fy_start =$row['fy_start'];
            $this->fy_end =$row['fy_end'];
            $this->error= false;
        }else{
            $this->error = true;
        }
    }





	function get(){
		$balancesheet = array();

		$strSQL = "SELECT LS.ledger_id, LM.ledger_name , SUM(AM.account_debit), SUM(AM.account_credit), ( SUM(AM.account_debit) -SUM(AM.account_credit)) as balance 
FROM 
 ledger_sub LS, fy_ledger_sub FYLS , ledger_master LM , account_master AM
WHERE 
LS.ledger_id=LM.ledger_id 
AND  LS.ledger_sub_id = FYLS.ledger_sub_id
AND FYLS.fy_id='".$this->fy_id."'
AND  AM.ref_ledger=LS.ledger_sub_id 
AND AM.fy_id='".$this->fy_id."' 
AND AM.deleted='".NOT_DELETED."'
GROUP BY LS.ledger_id 
ORDER BY LS.ledger_id ASC";

		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
			$sheet_liabilities = array();
			$sheet_assets = array();
			$total_liabilities =0;
			$total_assets =0;
			$total_expenses =0;
			$total_income =0;
			$index = 0;

            while($row = mysql_fetch_assoc($rsRES)){

				if(in_array($row['ledger_id'],$this->ledgers_liabilities)){

					if($row['balance'] < 0){
						$sheet_assets[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_assets[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_assets[$index]["balance"] = abs($row['balance']);
						$total_assets += abs($row['balance']);
					}else{
						$sheet_liabilities[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_liabilities[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_liabilities[$index]["balance"] = abs($row['balance']);
						$total_liabilities += abs($row['balance']);
					}


				}
				if(in_array($row['ledger_id'],$this->ledgers_assets)){

					if($row['balance'] < 0){
						$sheet_liabilities[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_liabilities[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_liabilities[$index]["balance"] = abs($row['balance']);
						$total_liabilities += abs($row['balance']);
					}else{
						$sheet_assets[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_assets[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_assets[$index]["balance"] = abs($row['balance']);
						$total_assets += abs($row['balance']);
					}
					
				}
				if(in_array($row['ledger_id'],$this->p_and_l_expenses)){
						$total_expenses += abs($row['balance']);
				}
				if(in_array($row['ledger_id'],$this->p_and_l_income)){
						$total_income += abs($row['balance']);
				}

				$index++;
			}
			$balancesheet["liabilities"] = $sheet_liabilities;
			$balancesheet["assets"] = $sheet_assets;
			$balancesheet["total_liabilities"] = $total_liabilities;
			$balancesheet["total_assets"] = $total_assets;
			$balancesheet["total_expenses"] = $total_expenses;
			$balancesheet["total_income"] = $total_income;
			if(($total_income - $total_expenses)<0){
				$balancesheet["profit"]  = 0;
				$balancesheet["loss"]  = abs($total_income - $total_expenses);
				$balancesheet["difference_in_opening_balance"]  = (abs($total_income - $total_expenses)+$total_liabilities)-$total_assets;
			}elseif(($total_income - $total_expenses)>0){
				$balancesheet["profit"]  = $total_income - $total_expenses;
				$balancesheet["loss"]  = 0;
				$balancesheet["difference_in_opening_balance"]  = (abs($total_income - $total_expenses)+$total_assets)-$total_liabilities;
			}else{

				$balancesheet["profit"]  =0;
				$balancesheet["loss"]  = 0;
				$balancesheet["difference_in_opening_balance"]  = ($total_assets)-$total_liabilities;
			}
			
			
        }else{
			$balancesheet =false;
		}

		return $balancesheet;
	}



	function get_closing(){
		$balancesheet = array();

		$strSQL = "SELECT LS.ledger_id, LM.ledger_name , LS.ledger_sub_id, LS.ledger_sub_name,  SUM(AM.account_debit), SUM(AM.account_credit), ( SUM(AM.account_debit) -SUM(AM.account_credit)) as balance 
FROM 
ledger_sub LS, fy_ledger_sub FYLS , ledger_master LM , account_master AM
WHERE 
LS.ledger_id=LM.ledger_id 
AND  LS.ledger_sub_id = FYLS.ledger_sub_id
AND FYLS.fy_id='".$this->fy_id."'
AND  AM.ref_ledger=LS.ledger_sub_id 
AND AM.fy_id='".$this->fy_id."' 
AND AM.deleted='".NOT_DELETED."'
GROUP BY LS.ledger_sub_id 
ORDER BY LS.ledger_sub_id ASC";

		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
			$sheet_liabilities = array();
			$sheet_assets = array();
			$sheet_income = array();
			$sheet_expenses = array();
			$total_liabilities =0;
			$total_assets =0;
			$total_expenses =0;
			$total_income =0;
			$index = 0;

            while($row = mysql_fetch_assoc($rsRES)){

				if(in_array($row['ledger_id'],$this->ledgers_liabilities)){

					if($row['balance'] < 0){
						$sheet_assets[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_assets[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_assets[$index]["ledger_sub_name"] = $row['ledger_sub_name'];
						$sheet_assets[$index]["ledger_sub_id"] = $row['ledger_sub_id'];
						$sheet_assets[$index]["balance"] = abs($row['balance']);
						$total_assets += abs($row['balance']);
					}else{
						$sheet_liabilities[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_liabilities[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_liabilities[$index]["ledger_sub_name"] = $row['ledger_sub_name'];
						$sheet_liabilities[$index]["ledger_sub_id"] = $row['ledger_sub_id'];
						$sheet_liabilities[$index]["balance"] = abs($row['balance']);
						$total_liabilities += abs($row['balance']);
					}


				}
				if(in_array($row['ledger_id'],$this->ledgers_assets)){

					if($row['balance'] < 0){
						$sheet_liabilities[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_liabilities[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_liabilities[$index]["ledger_sub_name"] = $row['ledger_sub_name'];
						$sheet_liabilities[$index]["ledger_sub_id"] = $row['ledger_sub_id'];
						$sheet_liabilities[$index]["balance"] = abs($row['balance']);
						$total_liabilities += abs($row['balance']);
					}else{
						$sheet_assets[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_assets[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_assets[$index]["ledger_sub_name"] = $row['ledger_sub_name'];
						$sheet_assets[$index]["ledger_sub_id"] = $row['ledger_sub_id'];
						$sheet_assets[$index]["balance"] = abs($row['balance']);
						$total_assets += abs($row['balance']);
					}
					
				}
				if(in_array($row['ledger_id'],$this->p_and_l_expenses)){
						$sheet_expenses[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_expenses[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_expenses[$index]["ledger_sub_name"] = $row['ledger_sub_name'];
						$sheet_expenses[$index]["ledger_sub_id"] = $row['ledger_sub_id'];
						$sheet_expenses[$index]["balance"] = abs($row['balance']);
						$sheet_expenses[$index]["balance_raw"] = $row['balance'];
						$total_expenses += abs($row['balance']);
				}
				if(in_array($row['ledger_id'],$this->p_and_l_income)){
						$sheet_income[$index]["ledger_name"] = $row['ledger_name'];
						$sheet_income[$index]["ledger_id"] = $row['ledger_id'];
						$sheet_income[$index]["ledger_sub_name"] = $row['ledger_sub_name'];
						$sheet_income[$index]["ledger_sub_id"] = $row['ledger_sub_id'];
						$sheet_income[$index]["balance"] = abs($row['balance']);
						$sheet_income[$index]["balance_raw"] = $row['balance'];
						$total_income += abs($row['balance']);
				}

				$index++;
			}
			$balancesheet["liabilities"] = $sheet_liabilities;
			$balancesheet["assets"] = $sheet_assets;
			$balancesheet["income"] = $sheet_income;
			$balancesheet["expenses"] = $sheet_expenses;

			$balancesheet["total_liabilities"] = $total_liabilities;
			$balancesheet["total_assets"] = $total_assets;
			$balancesheet["total_expenses"] = $total_expenses;
			$balancesheet["total_income"] = $total_income;
			if(($total_income - $total_expenses)<0){
				$balancesheet["profit"]  = 0;
				$balancesheet["loss"]  = abs($total_income - $total_expenses);
				$balancesheet["difference_in_opening_balance"]  = (abs($total_income - $total_expenses)+$total_liabilities)-$total_assets;
			}elseif(($total_income - $total_expenses)>0){
				$balancesheet["profit"]  = $total_income - $total_expenses;
				$balancesheet["loss"]  = 0;
				$balancesheet["difference_in_opening_balance"]  = (abs($total_income - $total_expenses)+$total_assets)-$total_liabilities;
			}else{

				$balancesheet["profit"]  =0;
				$balancesheet["loss"]  = 0;
				$balancesheet["difference_in_opening_balance"]  = ($total_assets)-$total_liabilities;
			}
			
			
        }else{
			$balancesheet =false;
		}

		return $balancesheet;
	}




function get_subledger_closing($ledger_sub_id = "", $closing_date = ""){
		$condition = "";
		if($ledger_sub_id > 0){
			$condition .=" AND LS.ledger_sub_id = '".$ledger_sub_id."'";
		}

		if($closing_date == ""){
			$closing_date = date("Y-m-d");
			$condition .=" AND AM.date <= '".$closing_date."'";
		}else{
			$condition .=" AND AM.date <= '".$closing_date."'";
		}

		$strSQL = "SELECT LS.ledger_id, LM.ledger_name , LS.ledger_sub_id, LS.ledger_sub_name,  SUM(AM.account_debit), SUM(AM.account_credit), ( SUM(AM.account_debit) -SUM(AM.account_credit)) as balance 
FROM 
ledger_sub LS, fy_ledger_sub FYLS , ledger_master LM , account_master AM
WHERE 
LS.ledger_id=LM.ledger_id 
AND  LS.ledger_sub_id = FYLS.ledger_sub_id
AND FYLS.fy_id='".$this->fy_id."'
AND  AM.ref_ledger=LS.ledger_sub_id 
AND AM.fy_id='".$this->fy_id."' 
AND AM.deleted='".NOT_DELETED."' ".$condition."
GROUP BY LS.ledger_sub_id 
ORDER BY LS.ledger_sub_id ASC";

		mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
			$subledgers = array();

			$index = 0;

            while($row = mysql_fetch_assoc($rsRES)){
				$subledgers[$index]["ledger_name"] = $row['ledger_name'];
				$subledgers[$index]["ledger_id"] = $row['ledger_id'];
				$subledgers[$index]["ledger_sub_name"] = $row['ledger_sub_name'];
				$subledgers[$index]["ledger_sub_id"] = $row['ledger_sub_id'];
				$subledgers[$index]["balance"] = abs($row['balance']);
				if($row['balance'] > 0){
					$subledgers[$index]["balance_dr"] = abs($row['balance']);
					$subledgers[$index]["balance_cr"] = 0;
				}elseif($row['balance'] < 0){
					$subledgers[$index]["balance_dr"] = 0;
					$subledgers[$index]["balance_cr"] = abs($row['balance']);
				}else{
					$subledgers[$index]["balance_dr"] = 0;
					$subledgers[$index]["balance_cr"] = 0;
				}
				
				$index++;
			}

        }else{
			$subledgers =false;
		}

		return $subledgers;
	}

}

?>
