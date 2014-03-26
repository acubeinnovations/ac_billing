<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Ledger{

	var $connection ="";
	var $ledger_id  =  gINVALID; //master ledger
	var $ledger_name ="";

	var $ledger_sub_id = gINVALID; //sub_ledger
	var $ledger_sub_name = "";
	var $fy_id	= gINVALID;
	var $parent_sub_ledger_id = gINVALID;
	var $status = STATUS_ACTIVE;
	var $deleted = NOT_DELETED;

	
	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    var $debit = 0;
    var $credit = 0;

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
    	if ( $this->ledger_sub_id == "" || $this->ledger_sub_id == gINVALID) {
    		$strSQL= "INSERT INTO ledger_sub(ledger_sub_name,ledger_id,parent_sub_ledger_id,fy_id,status,deleted) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->ledger_sub_name)."','";
    		$strSQL.= mysql_real_escape_string($this->ledger_id)."','";
    		$strSQL.= mysql_real_escape_string($this->parent_sub_ledger_id)."','";
    		$strSQL.= mysql_real_escape_string($this->current_fy_id)."','";
    		$strSQL.= mysql_real_escape_string($this->status)."','";
    		$strSQL.= mysql_real_escape_string($this->deleted)."')";
			//echo $strSQL;exit();
 			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->ledger_sub_id = mysql_insert_id();
				$this->error_description="Ledger added Successfully";
				return $this->ledger_sub_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert Ledger ";
				return false;
			}

    	}elseif($this->ledger_sub_id > 0 ) {
    		$strSQL = "UPDATE ledger_sub SET ledger_sub_name = '".addslashes(trim($this->ledger_sub_name))."',";
			$strSQL .= "ledger_id = '".addslashes(trim($this->ledger_id))."',";
			$strSQL .= "parent_sub_ledger_id = '".addslashes(trim($this->parent_sub_ledger_id))."',";
			$strSQL .= "status = '".addslashes(trim($this->status))."',";
			$strSQL .= "deleted = '".addslashes(trim($this->deleted))."',";
			$strSQL .= "fy_id = '".addslashes(trim($this->current_fy_id))."'";
			$strSQL .= " WHERE ledger_sub_id = ".$this->ledger_sub_id;
			//echo $strSQL;exit();
			 mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
           	}else{
				$this->error_number = 3;
				$this->error_description="Can't update Ledger";
				return false;
           	}
    	}
    }

    public function get_list_array($filter = "")
    {
    	$ledgers = array();$i=0;
		$strSQL = "SELECT ledger_sub_id,ledger_sub_name FROM ledger_sub WHERE deleted = '".NOT_DELETED."'AND status = '".STATUS_ACTIVE."' AND fy_id = '".$this->current_fy_id."'";
		if($filter != ""){
			$strSQL .= " AND ".$filter;
		}
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$ledgers[$i]['id'] = $id;
				$ledgers[$i]['name'] = $name; 
				$i++;
				
       		}
            return $ledgers;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Ledgers";
			return false;
    	}
    }

    public function get_list_sub_level1_with_account_master($ledger_id)
    {
    	$strSQL = "SELECT ledger_sub_id,ledger_sub_name ,(SELECT SUM(account_debit)  FROM account_master WHERE account_from = ledger_sub_id AND deleted = '".NOT_DELETED."') AS debit ,(SELECT SUM(account_credit)  FROM account_master WHERE account_to = ledger_sub_id AND deleted = '".NOT_DELETED."') AS credit FROM ledger_sub,account_master
			WHERE ledger_sub.deleted = '".NOT_DELETED."' AND ledger_sub.fy_id = '".$this->current_fy_id."' AND account_master.fy_id = '".$this->current_fy_id."' AND ledger_sub.status = '".STATUS_ACTIVE."' AND ledger_id = '".$ledger_id."' AND parent_sub_ledger_id = '-1'
			GROUP BY ledger_sub_id";
			//echo $strSQL;exit();
		$ledgers = array();$i=0;
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name,$debit,$credit) = mysql_fetch_row($rsRES) ){
				$ledgers[$i]['id'] = $id;				
				$ledgers[$i]['name'] = $name;
				$ledgers[$i]['debit'] = ($debit ==NULL)?0:$debit;
				$ledgers[$i]['credit'] = ($credit ==NULL)?0:$credit;
				$i++;
       		}
       	}else{
       		$ledgers = false;
       	}
       	return $ledgers;
    }

    public function get_list_sub_level1($ledger_id)
    {
    	$strSQL = "SELECT ledger_sub_id,ledger_sub_name FROM ledger_sub WHERE deleted = '".NOT_DELETED."' AND fy_id = '".$this->current_fy_id."' AND status = '".STATUS_ACTIVE."' AND ledger_id = '".$ledger_id."' AND parent_sub_ledger_id = '-1' GROUP BY ledger_sub_id";
			//echo $strSQL;exit();
		$ledgers = array();$i=0;
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$ledgers[$i]['id'] = $id;				
				$ledgers[$i]['name'] = $name;
				
				$i++;
       		}
       	}else{
       		$ledgers = false;
       	}
       	return $ledgers;
    }
    public function getLedgerTransaction()
    {
    	$ledger_list = array();$i=0;
    	$masterLedgers = $this->get_list_master_array();
    	if($masterLedgers){
    		$i=0;
	    	foreach($masterLedgers as $master){
	    		$ledger_list[$i]['id'] = $master['id'];
	    		$ledger_list[$i]['name'] = $master['name'];
	    		$sub_ledgers = $this->get_list_sub_level1_with_account_master($master['id']);
	    		if($sub_ledgers){
	    			$level1 = array();$j=0;$total_credit=0;$total_debit=0;
	    			foreach ($sub_ledgers as $sub) {
	    				$level1[$j]['id'] = $sub['id'];
	    				$level1[$j]['name'] = $sub['name'];
	    				$next = $this->getSibblingsArray($sub['id']);

	    				if($next){
	    					$level1[$j]['sub_ledgers'] = $next['sibblings'];
	    					$level1[$j]['credit'] = $next['credit'];
	    					$level1[$j]['debit'] = $next['debit'];

	    				}else{
	    					$level1[$j]['credit'] = ($sub['credit'] ==NULL)?0:$sub['credit'];
	    					$level1[$j]['debit'] = ($sub['debit'] ==NULL)?0:$sub['debit'];
	    				}
	    				$total_credit+=$level1[$j]['credit'];
	    				$total_debit+=$level1[$j]['debit'];

	    				$j++;

	    			}
	    			$ledger_list[$i]['debit'] = $total_debit;
	    			$ledger_list[$i]['credit'] = $total_credit;
	    			$ledger_list[$i]['sub_ledgers'] = $level1;
	    			
	    			
	    		}else{
	    			$ledger_list[$i]['sub_ledgers'] = false;
	    			$ledger_list[$i]['debit'] = 0;
	    			$ledger_list[$i]['credit'] = 0;
	    		}
	    		$i++;
	    	}
	    	//echo "<pre>";
	    	//print_r($ledger_list);echo "<pre>";
	    	return $ledger_list;
    	}else{
    		return false;
    	}
    }

    public function getSibblingsArray($id)
    {
    	$strSQL = "SELECT ledger_sub_id,ledger_sub_name ,(SELECT SUM(account_debit)  FROM account_master WHERE account_from = ledger_sub_id AND deleted = '".NOT_DELETED."') AS debit ,(SELECT SUM(account_credit)  FROM account_master WHERE account_to = ledger_sub_id AND deleted = '".NOT_DELETED."') AS credit FROM ledger_sub,account_master
			WHERE ledger_sub.deleted = '".NOT_DELETED."'AND ledger_sub.status = '".STATUS_ACTIVE."' AND parent_sub_ledger_id = '".$id."' GROUP BY ledger_sub_id";
			 mysql_query("SET NAMES utf8");
		
		$rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 ){
			$sibblings = array();$i=0;$total_debit=0;$total_credit = 0;
$output =array();
			while ( list ($id,$name,$debit,$credit) = mysql_fetch_row($rsRES) ){
				$sibblings[$i]['id'] = $id;
				$sibblings[$i]['name'] = $name;
				$total_credit += $credit;
				$total_debit += $debit;
				$this->debit += $debit;
	    		$this->credit += $credit;
				$next = $this->getSibblingsArray($id);
				if($next){
					$sibblings[$i]['sub_ledgers'] = $next;
					$sibblings[$i]['credit'] = $total_credit;
					$sibblings[$i]['debit'] = $total_debit;
				}else{
					$sibblings[$i]['debit'] = $debit;
					$sibblings[$i]['credit'] = $credit;
				}
				$i++;
			}
			$output['sibblings'] = $sibblings;
			$output['credit'] = $total_credit;
			$output['debit'] = $total_debit;


		}else{
			$output= false;
		}
		//echo "<pre>";
		//($output);
		//echo "<pre>";
		return $output;

    }

/*
    public function getLedgerTransaction()
    {
    	$ledger_list = array();$i=0;
    	$masterLedgers = $this->get_list_master_array();
    	if($masterLedgers){
    		$i=0;
	    	foreach($masterLedgers as $master){
	    		$this->debit = 0;$this->credit = 0;
	    		$ledger_list[$i]['id'] = $master['id'];
	    		$ledger_list[$i]['name'] = $master['name'];
	    		$sub_ledgers = $this->get_list_sub_level1_with_account_master($master['id']);
	    		if($sub_ledgers){
	    			$level1 = array();$j=0;
	    			foreach ($sub_ledgers as $sub) {
	    				$level1[$j]['id'] = $sub['id'];
	    				$level1[$j]['name'] = $sub['name'];
	    				$level1[$j]['debit'] = ($sub['debit'] ==NULL)?0:$sub['debit'];
	    				$level1[$j]['credit'] = ($sub['credit'] ==NULL)?0:$sub['credit'];
	    				$this->debit += $sub['debit'];
	    				$this->credit += $sub['credit'];
	    				$next = $this->getSibblingsArray($sub['id']);
	    				if($next){
	    					$level1[$j]['sub_ledgers'] = $next;
	    				}
	    				$j++;
	    			}
	    			$ledger_list[$i]['sub_ledgers'] = $level1;
	    			$ledger_list[$i]['debit'] = $this->debit;
	    			$ledger_list[$i]['credit'] = $this->credit;
	    			
	    		}else{
	    			$ledger_list[$i]['sub_ledgers'] = false;
	    			$ledger_list[$i]['debit'] = $this->debit;
	    			$ledger_list[$i]['credit'] = $this->credit;
	    		}
	    		$i++;
	    	}
	    	//print_r($ledger_list);exit();
	    	return $ledger_list;
    	}else{
    		return false;
    	}
    }

    public function getSibblingsArray($id)
    {
    	$strSQL = "SELECT ledger_sub_id,ledger_sub_name ,(SELECT SUM(account_debit)  FROM account_master WHERE account_from = ledger_sub_id) AS debit ,(SELECT SUM(account_credit)  FROM account_master WHERE account_to = ledger_sub_id) AS credit FROM ledger_sub,account_master
			WHERE ledger_sub.deleted = '".NOT_DELETED."'AND ledger_sub.status = '".STATUS_ACTIVE."' AND parent_sub_ledger_id = '".$id."' GROUP BY ledger_sub_id";
			 mysql_query("SET NAMES utf8");
		
		$rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 ){
			$sibblings = array();$i=0;
			while ( list ($id,$name,$debit,$credit) = mysql_fetch_row($rsRES) ){
				$sibblings[$i]['id'] = $id;
				$sibblings[$i]['name'] = $name;
				$sibblings[$i]['debit'] = $debit;
				$sibblings[$i]['credit'] = $credit;
				$this->debit += $debit;
	    		$this->credit += $credit;
				$next = $this->getSibblingsArray($id);
				if($next){
					$sibblings[$i]['sub_ledgers'] = $next;
				}
				$i++;
			}			
		}else{
			$sibblings= false;
		}
		return $sibblings;

    }
    */



    public function generateLedgerList()
    {
    	$ledgerTree = "";
    	$masterLedgers = $this->get_list_master_array();
    	if($masterLedgers){
	    	$ledgerTree .= "<ul class='master_list'>";
	    	$i=0;
	    	while(count($masterLedgers) > $i){
	    		$id = $masterLedgers[$i]['id'];
	    		$name = $masterLedgers[$i]['name'];
	    		$ledgerTree .= "<li>{$name}</li>";
	    		$sub_ledgers = $this->get_list_sub_level1($id);
	    		if($sub_ledgers){
	    			$ledgerTree .= "<ul>";
	    			foreach ($sub_ledgers as $sub) {
	    				$ledgerTree .= "<li>".$sub['name']."</li>";
	    				$ledgerTree .= $this->getSibblings($sub['id']);
	    			}
	    			$ledgerTree .= "</ul>";
	    		}
	    		$i++;
	    	}
	    	$ledgerTree .= "</ul>";
	    }
	    return $ledgerTree;
    }

    public function getSibblings($id)
    {
    	$sibblings = "";
    	$strSQL = "SELECT ledger_sub_id,ledger_sub_name FROM ledger_sub WHERE deleted = '".NOT_DELETED."' AND fy_id = '".$this->current_fy_id."' AND status = '".STATUS_ACTIVE."' AND parent_sub_ledger_id = '".$id."'";
		 mysql_query("SET NAMES utf8");
		$rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 ){
			$sibblings .= "<ul>";
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){

				$sibblings .= "<li>{$name}";
				$sibblings .= $this->getSibblings($id);
				$sibblings .= "</li>";
			}
			$sibblings .= "</ul>";
			
		}
		return $sibblings;

    }


    public function get_list_master_array()
    {
    	$ledgers = array();$i=0;
		$strSQL = "SELECT  ledger_id,ledger_name FROM ledger_master";
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$ledgers[$i]["id"] =  $id;
				$ledgers[$i]["name"] = $name;
			
				$i++;
       		}
            return $ledgers;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Ledgers";
			return false;
    	}
    }

    public function get_list_sub_array()
    {
    	$ledgers = array();$i=0;
		$strSQL = "SELECT  ledger_sub_id,ledger_sub_name FROM ledger_sub WHERE deleted = '".NOT_DELETED."' AND fy_id = '".$this->current_fy_id."' AND status = '".STATUS_ACTIVE."'";
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$ledgers[$i]["id"] =  $id;
				$ledgers[$i]["name"] = $name;
			
				$i++;
       		}
            return $ledgers;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Ledgers";
			return false;
    	}
    }

    public function get_list_sub_array_with_masterid()
    {
    	if ( $this->ledger_id != "" || $this->ledger_id != gINVALID && $this->ledger_id >0) {
	    	$sub_ledgers = array();
			$strSQL = "SELECT L1.ledger_sub_id ,L1.ledger_sub_name AS ledger_sub_name";
			$strSQL .= " FROM ledger_sub L1";
			$strSQL .= " LEFT JOIN ledger_sub L2 ON L2.ledger_sub_id = L1.ledger_sub_id";
			$strSQL .= " WHERE L1.deleted = '".NOT_DELETED."' AND L1.fy_id = '".$this->current_fy_id."' AND  L2.fy_id = '".$this->current_fy_id."' AND L1.status = '".STATUS_ACTIVE."' AND L2.deleted = '".NOT_DELETED."'AND L2.status = '".STATUS_ACTIVE."' AND L1.ledger_id = '".$this->ledger_id."'";
			 mysql_query("SET NAMES utf8");
			 
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
			{
				while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
					$sub_ledgers[$id] =$name;
	       		}
	            return $sub_ledgers;
	       	}else{
				$this->error_number = 4;
				$this->error_description="Can't list Sub Ledgers";
				return false;
	    	}
	    }else{
	    	return false;
	    }
    }

    public function ledgerName($ledger_id = gINVALID)
    {
    	$strSQL = "SELECT ledger_sub_name FROM ledger_sub WHERE deleted = '".NOT_DELETED."'AND status = '".STATUS_ACTIVE."' AND ledger_sub_id = '".$ledger_id."'";
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			$row = mysql_fetch_assoc($rsRES);
			return $row['ledger_sub_name'];
		}else{
			return false;
		}
    }

    public function ledgerID($ledger_name = "")
    {
    	$strSQL = "SELECT ledger_sub_id FROM ledger_sub WHERE deleted = '".NOT_DELETED."'AND status = '".STATUS_ACTIVE."' AND ledger_sub_name LIKE '%".$ledger_name."%'";
    	//echo $strSQL;exit();
    	 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			$row = mysql_fetch_assoc($rsRES);
			return $row['ledger_sub_id'];
		}else{
			return false;
		}
    }

    public function getLedgerId()
    {
    	$strSQL = "SELECT ledger_sub_id FROM ledger_sub WHERE deleted = '".NOT_DELETED."'AND status = '".STATUS_ACTIVE."'";
    	$str_condition = "";
    	if($this->ledger_sub_name!=""){
    		$str_condition = " AND ledger_sub_name LIKE '".$this->ledger_sub_name."'";
    	}

    	$strSQL.=$str_condition;
		//echo $strSQL;exit();

    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) == 1 ){
			$row = mysql_fetch_assoc($rsRES);
			return $row['ledger_sub_id'];
			return true;
		}else{
			return false;
		}

    }


    public function delete()
    {
    	if ( ($this->ledger_sub_id != "" || $this->ledger_sub_id != gINVALID) && $this->ledger_sub_id >0 ){
    		$strSQL = "UPDATE ledger_sub SET deleted = '".DELETED."' WHERE ledger_sub_id = '".$this->ledger_sub_id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Ledger not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Ledger";
			return false;
    	}
    }


}
?>