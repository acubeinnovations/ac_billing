<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class FyLedgerSub{

	var $connection = "";
	var $fy_id  =  gINVALID; //master ledger
	var $ledger_sub_id = gINVALID;

	var $current_fy_id = gINVALID;
	var $default_capital = gINVALID;

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function __construct($connection)
    {
    	$strSQL = "SELECT * FROM account_settings WHERE id = '1'";
    	$rsRES = mysql_query($strSQL,$connection) or die(mysql_error(). $strSQL );
    	if(mysql_num_rows($rsRES) > 0){
    		$row = mysql_fetch_assoc($rsRES);
    		$this->current_fy_id =$row['current_fy_id'];
    		$this->default_capital =$row['default_capital'];
    		return true;
    	}else{
    		return false;
    	}
    }

    public function update()
    {
    	if($this->validate()){
	    	$strSQL = "INSERT INTO fy_ledger_sub(fy_id,ledger_sub_id) VALUES('".mysql_real_escape_string($this->current_fy_id)."','".mysql_real_escape_string($this->ledger_sub_id)."')";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->error_description="Data inserted Successfully";
				return true;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}
		}else{
			return false;
		}
    }

    public function insert_batch($dataArray= array())
    {
    	if(count($dataArray) > 0){
	    	$strSQL = "INSERT INTO fy_ledger_sub(fy_id,ledger_sub_id) VALUES";
	    	foreach ($dataArray as $row) {
	    		if(isset($row['fy_id'])){
	    			$this->fy_id = $row['fy_id'];
	    		}
	    		if(isset($row['ledger_sub_id'])){
	    			$this->ledger_sub_id = $row['ledger_sub_id'];
	    		}
	    		$strSQL .="('";
	    		$strSQL.= mysql_real_escape_string($this->fy_id)."','";
	    		$strSQL.= mysql_real_escape_string($this->ledger_sub_id)."'),";
			}
			$strSQL.= substr($strSQL, 0,-1);
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->error_description="Data inserted Successfully";
				return true;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}
	 
	    	
		}else{
			$this->error_description = "Invalid data";
			return false;
		}
    }

    public function getCurrentLedgers()
    {
    	$strSQL = "SELECT fls.ledger_sub_id,ls.ledger_sub_name,lm.ledger_name FROM fy_ledger_sub fls" ;
    	$strSQL .= " LEFT JOIN ledger_sub ls ON  ls.ledger_sub_id = fls.ledger_sub_id";
    	$strSQL .= " LEFT JOIN ledger_master lm ON  lm.ledger_id = ls.ledger_id";
    	$strSQL .= " WHERE ls.status='".STATUS_ACTIVE."' AND ls.deleted = '".NOT_DELETED."' AND fls.fy_id = '".$this->current_fy_id."'";
    	$strSQL .= " ORDER BY ls.ledger_id";
    	mysql_query("SET NAMES utf8");
    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    	$ledgers = array();$i=0;
    	if(mysql_num_rows($rsRES) > 0){
    		while($row = mysql_fetch_assoc($rsRES)){
    			$ledgers[$i]['ledger_sub_id'] 	= $row['ledger_sub_id'];
    			$ledgers[$i]['ledger_sub_name'] = $row['ledger_sub_name'];
    			$ledgers[$i]['ledger_name'] 	= $row['ledger_name'];
    			$i++;
    		}
    		return $ledgers;
    	}else{
    		$this->error_description = "Can't list ledgers";
    		return false;
    	}
    }

    public function validate()
    {
    	if($this->ledger_sub_id > 0){
	    	$strSQL = "SELECT * FROM fy_ledger_sub WHERE fy_id = '".$this->current_fy_id."' AND ledger_sub_id = '".$this->ledger_sub_id."'";
	    	$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
	    	if(mysql_num_rows($rsRES) > 0){
	    		return false;
	    	}else{
	    		return true;
	    	}
	    }else{
	    	return false;
	    }
    }

}

?>