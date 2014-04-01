<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Account{

	var $connection ="";
	var $account_id  =  gINVALID; //master voucher
	var $voucher_number ="";
	var $voucher_type_id = gINVALID; //voucher
	var $fy_id	= gINVALID;
	var $reference_number = "";
	var $account_from = "";
	var $account_to = "";
	var $account_debit = "";
	var $account_credit = "";
	var $date = "";
	var $narration = "";
	var $ref_ledger = gINVALID;
	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    var $current_fy_id = gINVALID;
    public function __construct($connection)
    {
        $strSQL = "SELECT * FROM account_settings WHERE id = '1'";
        $rsRES = mysql_query($strSQL,$connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
            $row = mysql_fetch_assoc($rsRES);
            $this->current_fy_id =$row['current_fy_id'];
            //echo $this->current_fy_id;exit();
        }else{
            header("Location:ac_account_settings.php");exit();
        }
    }

    public function update()
    {
    	if ( $this->account_id == "" || $this->account_id == gINVALID) {
    		$strSQL= "INSERT INTO account_master(voucher_number,voucher_type_id,fy_id,reference_number,account_from,account_to,account_debit,account_credit,date,narration,ref_ledger) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->voucher_number)."','";
    		$strSQL.= mysql_real_escape_string($this->voucher_type_id)."','";
    		$strSQL.= mysql_real_escape_string($this->current_fy_id)."','";
    		$strSQL.= mysql_real_escape_string($this->reference_number)."','";
    		$strSQL.= mysql_real_escape_string($this->account_from)."','";
    		$strSQL.= mysql_real_escape_string($this->account_to)."','";
    		$strSQL.= mysql_real_escape_string($this->account_debit)."','";
    		$strSQL.= mysql_real_escape_string($this->account_credit)."','";
    		$strSQL.= date('Y-m-d',strtotime($this->date))."','";
    		$strSQL.= mysql_real_escape_string($this->narration)."','";
    		$strSQL.= mysql_real_escape_string($this->ref_ledger)."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->account_id = mysql_insert_id();
				$this->error_description="Success";
				return $this->account_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->account_id > 0 ) {
    		
    	}
    }

    public function insert_batch($dataArray = array())
    {
    	if ($dataArray) {
    		$strSQL= "INSERT INTO account_master(voucher_number,voucher_type_id,fy_id,reference_number,account_from,account_to,account_debit,account_credit,date,ref_ledger,narration) VALUES";
    		$i=0;
    		while($i < count($dataArray)){
    			$strSQL.= "('";
	    		$strSQL.= mysql_real_escape_string($this->voucher_number)."','";
	    		$strSQL.= mysql_real_escape_string($this->voucher_type_id)."','";
	    		$strSQL.= mysql_real_escape_string($this->current_fy_id)."','";
	    		$strSQL.= mysql_real_escape_string($this->reference_number)."','";
	    		$strSQL.= mysql_real_escape_string($this->account_from)."','";
	    		$strSQL.= mysql_real_escape_string($this->account_to)."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['account_debit'])."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['account_credit'])."','";
	    		$strSQL.= date('Y-m-d',strtotime($this->date))."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['ref_ledger'])."','";
	    		$strSQL.= mysql_real_escape_string($this->narration)."'),";
				$i++;
			}
   			$strSQL = substr($strSQL, 0,-1);
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->error_description="Voucher Genereted";
				return mysql_insert_id();
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->account_id > 0 ) {
    		
    	}
    }

    public function update_batch($dataArray = array())
    {
        if ($dataArray) {
            
            $strSQL = "UPDATE account_master SET narration = '".$dataArray['narration']."',";
            $strSQL .= "account_debit = CASE WHEN account_from = ref_ledger THEN '".$dataArray['amount']."' END,";
            $strSQL .= "account_credit = CASE WHEN account_to = ref_ledger THEN '".$dataArray['amount']."' END";
            $strSQL .=" WHERE voucher_number = '".$this->voucher_number."' AND voucher_type_id = '".$this->voucher_type_id."'";
           // echo $strSQL;exit();
            $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ) {
                $this->error_description="Voucher Updated";
                return mysql_insert_id();
            }else{
                $this->error_number = 3;
                $this->error_description="Can't update data ";
                return false;
            }
        }
    }

    

    public function get_details(){
        
        if ( ($this->account_id != "" || $this->account_id != gINVALID) && $this->account_id >0 ) {
            $strSQL = "SELECT * FROM account_master WHERE fy_id = '".$this->current_fy_id."' AND deleted='".NOT_DELETED."' AND account_id = '".$this->account_id."'";
            $rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
            if(mysql_num_rows($rsRES) > 0){
                $row    = mysql_fetch_assoc($rsRES);
                $this->account_id           = $row['account_id'];
                $this->voucher_number       = $row['voucher_number'];
                $this->voucher_type_id      = $row['voucher_type_id'];
                $this->fy_id                = $row['fy_id'];
                $this->reference_number     = $row['reference_number'];
                $this->account_from         = $row['account_from'];
                $this->account_to           = $row['account_to'];
                $this->account_debit        = $row['account_debit'];
                $this->account_credit       = $row['account_credit'];
                $this->date                 = date('d-m-Y',strtotime($row['date']));
                $this->narration            = $row['narration'];
                $this->ref_ledger           = $row['ref_ledger'];
                
                
                return true;
            }else{
                return false;
            }
        }
    }


    public function getNextVoucherNumber($voucher_type_id = -1)
    {
    	$strSQL = "SELECT MAX(voucher_number) as last_voucher_number FROM account_master WHERE voucher_type_id = '".$voucher_type_id."'";//echo $strSQL;exit();
    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    	if(mysql_num_rows($rsRES) > 0){
    		$row = mysql_fetch_assoc($rsRES);
    		$last = $row['last_voucher_number'];
    		if($last == NULL)   		{
    			$next_voucher_number = false;
    		}else{
	    		$digits = strlen($last);
	    		$next = $last+1;	
	    		$next_voucher_number = str_pad($next, $digits, "0", STR_PAD_LEFT);
	    	}
    		
    	}else{
    		$next_voucher_number = false;
    	}
    	return $next_voucher_number;
    }


    public function getAccountTransaction($start_record = 0,$max_records = 25,$voucher = array())
    {
       // print_r($voucher);
    		$strSQL = "SELECT am.account_id,am.voucher_number, am.voucher_type_id,am.date,am.narration,am.account_from,am.account_to,am.account_debit,am.account_credit,v.voucher_name FROM account_master am";
            $strSQL .= " LEFT JOIN voucher v ON v.voucher_id=am.voucher_type_id";
            $strSQL .= " WHERE am.fy_id = '".$this->current_fy_id."' AND am.deleted='".NOT_DELETED."'";

            if($this->voucher_type_id > 0){
              $strSQL .= " AND am.voucher_type_id = '".$this->voucher_type_id."'";
            }

    	    if(isset($voucher['account_from'])){
    			$ids = implode(",",$voucher['account_from']);
                $strSQL.= " AND am.ref_ledger IN(".$ids.")";
    		}
            else if(isset($voucher['account_to'])){
    			$ids = implode(",",$voucher['account_to']);
    			$strSQL.= " AND am.ref_ledger IN(".$ids.")";
    		}

	        if(isset($voucher['book_ledgers'])){
                $ids = implode(",",$voucher['book_ledgers']);
                $strSQL.= " AND am.ref_ledger IN(".$ids.")";
            }

            if(isset($voucher['ref_ledger'])){
                $id = $voucher['ref_ledger'];
                $strSQL.= " AND am.ref_ledger ='".$id."'";
            }
            //time period
            if(isset($voucher['datefrom']) and isset($voucher['dateto'])){
                $datefrom = date('Y-m-d',strtotime($voucher['datefrom']));
                $dateto = date('Y-m-d',strtotime($voucher['dateto']));
                $strSQL.= " AND am.date BETWEEN '".$datefrom."' AND '".$dateto."'";
            }

            mysql_query("SET NAMES utf8");

    		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
			$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
    		//echo $strSQL;exit();
    		$data = array();$i=0;
    		if(mysql_num_rows($rsRES) > 0){
    			//without limit  , result of that in $all_rs
				if (trim($this->total_records)!="" && $this->total_records > 0) {
				} else {
					$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
					$this->total_records = mysql_num_rows($all_rs);
				}
    			while($row = mysql_fetch_assoc($rsRES)){
    				$data[$i]['account_id'] 	= $row['account_id'];
    				$data[$i]['voucher_number'] = $row['voucher_number'];
                    $data[$i]['voucher_name']   = $row['voucher_name'];
    				$data[$i]['date'] 			= date('d-m-Y',strtotime($row['date']));
    				$data[$i]['narration'] 		= $row['narration'];
    				$data[$i]['account_from'] 	= $row['account_from'];
    				$data[$i]['account_to'] 	= $row['account_to'];
    				$data[$i]['account_debit'] 	= $row['account_debit'];
    				$data[$i]['account_credit'] = $row['account_credit'];
    				$i++;
    			}
    			return $data;
    		}
    	
    }
    public function getAllAccountTransaction($voucher = array())
    {
       // print_r($voucher);
            $strSQL = "SELECT am.account_id,am.voucher_number, am.voucher_type_id,am.date,am.narration,am.account_from,am.account_to,am.account_debit,am.account_credit,v.voucher_name FROM account_master am";
            $strSQL .= " LEFT JOIN voucher v ON v.voucher_id=am.voucher_type_id";
            $strSQL .= " WHERE am.fy_id = '".$this->current_fy_id."' AND am.deleted='".NOT_DELETED."'";

            if($this->voucher_type_id > 0){
              $strSQL .= " AND am.voucher_type_id = '".$this->voucher_type_id."'";
            }

            if(isset($voucher['account_from'])){
                $ids = implode(",",$voucher['account_from']);
                $strSQL.= " AND am.ref_ledger IN(".$ids.")";
            }
            else if(isset($voucher['account_to'])){
                $ids = implode(",",$voucher['account_to']);
                $strSQL.= " AND am.ref_ledger IN(".$ids.")";
            }

            if(isset($voucher['book_ledgers'])){
                $ids = implode(",",$voucher['book_ledgers']);
                $strSQL.= " AND am.ref_ledger IN(".$ids.")";
            }

            if(isset($voucher['ref_ledger'])){
                $id = $voucher['ref_ledger'];
                $strSQL.= " AND am.ref_ledger ='".$id."'";
            }
            //time period
            if(isset($voucher['datefrom']) and isset($voucher['dateto'])){
                $datefrom = date('Y-m-d',strtotime($voucher['datefrom']));
                $dateto = date('Y-m-d',strtotime($voucher['dateto']));
                $strSQL.= " AND am.date BETWEEN '".$datefrom."' AND '".$dateto."'";
            }

            mysql_query("SET NAMES utf8");            
            $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
            //echo $strSQL;exit();
            $data = array();$i=0;
            if(mysql_num_rows($rsRES) > 0){
                while($row = mysql_fetch_assoc($rsRES)){
                    $data[$i]['account_id']     = $row['account_id'];
                    $data[$i]['voucher_number'] = $row['voucher_number'];
                    $data[$i]['voucher_name']   = $row['voucher_name'];
                    $data[$i]['date']           = date('d-m-Y',strtotime($row['date']));
                    $data[$i]['narration']      = $row['narration'];
                    $data[$i]['account_from']   = $row['account_from'];
                    $data[$i]['account_to']     = $row['account_to'];
                    $data[$i]['account_debit']  = $row['account_debit'];
                    $data[$i]['account_credit'] = $row['account_credit'];
                    $i++;
                }
                return $data;
            }
        
    }

    //result for account books
    public function getBookDetails($start_record = 0,$max_records = 25,$ledgers = array())
    {
        $strSQL = "SELECT am.account_id,am.voucher_number, am.voucher_type_id,am.date,am.narration,am.account_from,am.account_to,am.account_debit,am.account_credit,v.voucher_name,ls.ledger_sub_name AS ref_ledger_name FROM account_master am";
        $strSQL .= " LEFT JOIN voucher v ON v.voucher_id = am.voucher_type_id";
        $strSQL .= " LEFT JOIN ledger_sub ls ON ls.ledger_sub_id = am.ref_ledger";
        $strSQL .= " WHERE 1";
         $strSQL .= " AND am.fy_id = '".$this->current_fy_id."' AND am.deleted='".NOT_DELETED."'";
        mysql_query("SET NAMES utf8");

        if(is_array($ledgers)){
            $ledger_ids = implode(",",$ledgers);
            $strSQL .= " AND am.ref_ledger IN(".$ledger_ids.")";
        }

        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
        //echo $strSQL;exit();
        $limited_data = array();$i=0;
        if(mysql_num_rows($rsRES) > 0){
            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
                $this->total_records = mysql_num_rows($all_rs);
            }
            while($row = mysql_fetch_assoc($rsRES)){
                $limited_data[$i]['account_id']     = $row['account_id'];
                $limited_data[$i]['voucher_number'] = $row['voucher_number'];
                $limited_data[$i]['voucher_name'] = $row['voucher_name'];
                $limited_data[$i]['voucher_type_id'] = $row['voucher_type_id'];
                $limited_data[$i]['ref_ledger_name']  = $row['ref_ledger_name'];
                $limited_data[$i]['date']           = date('d-m-Y',strtotime($row['date']));
                $limited_data[$i]['narration']      = $row['narration'];
                $limited_data[$i]['account_from']   = $row['account_from'];
                $limited_data[$i]['account_to']     = $row['account_to'];
                $limited_data[$i]['account_debit']  = $row['account_debit'];
                $limited_data[$i]['account_credit'] = $row['account_credit'];
                $i++;
            }
            //print_r($limited_data);exit();
            return $limited_data;
        }
    }

    //result for account books
    public function getAllBookDetails($ledgers = array())
    {
        $strSQL = "SELECT am.account_id,am.voucher_number, am.voucher_type_id,am.date,am.narration,am.account_from,am.account_to,am.account_debit,am.account_credit,v.voucher_name,ls.ledger_sub_name AS ref_ledger_name FROM account_master am";
        $strSQL .= " LEFT JOIN voucher v ON v.voucher_id = am.voucher_type_id";
        $strSQL .= " LEFT JOIN ledger_sub ls ON ls.ledger_sub_id = am.ref_ledger";
        $strSQL .= " WHERE 1";
         $strSQL .= " AND am.fy_id = '".$this->current_fy_id."' AND am.deleted='".NOT_DELETED."'";
        mysql_query("SET NAMES utf8");

        if(is_array($ledgers)){
            $ledger_ids = implode(",",$ledgers);
            $strSQL .= " AND am.ref_ledger IN(".$ledger_ids.")";
        }

        
        $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
        $limited_data = array();$i=0;
        if(mysql_num_rows($rsRES) > 0){
            while($row = mysql_fetch_assoc($rsRES)){
                $limited_data[$i]['account_id']     = $row['account_id'];
                $limited_data[$i]['voucher_number'] = $row['voucher_number'];
                $limited_data[$i]['voucher_name'] = $row['voucher_name'];
                $limited_data[$i]['voucher_type_id'] = $row['voucher_type_id'];
                $limited_data[$i]['ref_ledger_name']  = $row['ref_ledger_name'];
                $limited_data[$i]['date']           = date('d-m-Y',strtotime($row['date']));
                $limited_data[$i]['narration']      = $row['narration'];
                $limited_data[$i]['account_from']   = $row['account_from'];
                $limited_data[$i]['account_to']     = $row['account_to'];
                $limited_data[$i]['account_debit']  = $row['account_debit'];
                $limited_data[$i]['account_credit'] = $row['account_credit'];
                $i++;
            }
            //print_r($limited_data);exit();
            return $limited_data;
        }
    }


    public function get_voucher_account_details($filter_by = "")
    {
        $result = array();$i=0;
        if($this->voucher_type_id > 0 and $this->voucher_type_id != "")
        {
            $strSQL = "SELECT am.account_id,am.account_debit AS debit,am.account_credit AS credit,am.date,am.narration,ls.ledger_sub_id AS ledger_id,ls.ledger_sub_name AS ledger_name FROM account_master am";
            $strSQL .= " LEFT JOIN ledger_sub ls ON ls.ledger_sub_id = am.account_to";
            $strSQL .= " WHERE am.fy_id = '".$this->current_fy_id."' AND am.deleted='".NOT_DELETED."' AND voucher_type_id = '".$this->voucher_type_id."'";
            if($this->voucher_number != ""){
                $strSQL .= " AND am.voucher_number = '".$this->voucher_number."'"   ;
            }
            if($filter_by != ""){
                $strSQL .= " AND am.".$filter_by." = am.ref_ledger";
            }
           // echo $strSQL;exit();
            mysql_query("SET NAMES utf8");
            $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
            if(mysql_num_rows($rsRES) > 0){
                while($row = mysql_fetch_assoc($rsRES)){
                    $result[$i]['account_id'] = $row['account_id'];
                    $result[$i]['debit'] = $row['debit'];
                    $result[$i]['credit'] = $row['credit'];
                    $result[$i]['ledger_name'] = $row['ledger_name'];
                    $result[$i]['ledger_id'] = $row['ledger_id'];
                    $i++;
                }
                return $result;
            }else{
                $this->error_description = "No Details found";
                return false;
            }

        }else{
            return false;
        }
    }

    //CHECK LAST TRANSATION IN EXISTING, NOT DELETED LIST
    public function lastTransaction()
    {
        $strSQL = "SELECT MAX(voucher_number) AS max_value FROM account_master WHERE fy_id = '".$this->current_fy_id."' AND deleted='".NOT_DELETED."' AND voucher_type_id = '".$this->voucher_type_id."'";
        $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
        if(mysql_num_rows($rsRES) > 0){
            $row = mysql_fetch_assoc($rsRES);
            if($row['max_value'] == $this->voucher_number){
                return true;//last transaction
            }else{
                return false;
            }
        }else{
            return false;
        }
    }


    public function delete_with_voucher()
    {
       // $lastTX = $this->lastTransaction();
       
        $strSQL = "UPDATE account_master SET deleted='".DELETED."' WHERE voucher_type_id = '".$this->voucher_type_id."' AND voucher_number = '".$this->voucher_number."'";
       // echo $strSQL;exit();
        $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
        if(mysql_affected_rows() > 0){
            $this->error_description = "voucher deleted";
           return true;
        }else{
            $this->error_description = "Error in deleting record";
            return false;
        }
        

    }

    public function exist()
    {
        $strSQL = "SELECT * FROM account_master WHERE fy_id = '".$this->current_fy_id."' AND deleted='".NOT_DELETED."' AND voucher_type_id = '".$this->voucher_type_id."' AND voucher_number = '".$this->voucher_number."'";
        $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
        if(mysql_num_rows($rsRES) > 0){
            $row = mysql_fetch_assoc($rsRES);
            $this->account_id = $row['account_id'];
           return true;
        }else{
            return false;
        }
    }



    


}
?>
