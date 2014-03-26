<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Customer{

	var $connection ="";
	var $customer_id  =  gINVALID; 
	var $customer_name ="";
	var $customer_address ="";
	var $customer_phone ="";
	var $customer_mobile ="";
	var $customer_fax ="";
	var $customer_email ="";
	var $customer_cst_number ="";
	var $customer_tin_number ="";
	var $deleted = NOT_DELETED;
	var $ledger_sub_id = gINVALID;
	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->customer_id == "" || $this->customer_id == gINVALID) {
    		$strSQL= "INSERT INTO customer(customer_name,customer_address,customer_phone,customer_mobile,customer_fax,customer_email,customer_cst_number,customer_tin_number,ledger_sub_id,deleted) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->customer_name)."','";
    		$strSQL.= mysql_real_escape_string($this->customer_address)."','";
    		$strSQL.= mysql_real_escape_string($this->customer_phone)."','";
    		$strSQL.= mysql_real_escape_string($this->customer_mobile)."','";
    		$strSQL.= mysql_real_escape_string($this->customer_fax)."','";
    		$strSQL.= mysql_real_escape_string($this->customer_email)."','";
    		$strSQL.= mysql_real_escape_string($this->customer_cst_number)."','";
    		$strSQL.= mysql_real_escape_string($this->customer_tin_number)."','";
    		$strSQL.= mysql_real_escape_string($this->ledger_sub_id)."','";
    		$strSQL.= mysql_real_escape_string($this->deleted)."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->customer_id = mysql_insert_id();
				$this->error_description="Success";
				return $this->customer_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->customer_id > 0 ) {
    		$strSQL = "UPDATE customer SET customer_name = '".addslashes(trim($this->customer_name))."',";
    		$strSQL .= "customer_address = '".addslashes(trim($this->customer_address))."',";
    		$strSQL .= "customer_phone = '".addslashes(trim($this->customer_phone))."',";
    		$strSQL .= "customer_mobile = '".addslashes(trim($this->customer_mobile))."',";
    		$strSQL .= "customer_fax = '".addslashes(trim($this->customer_fax))."',";
    		$strSQL .= "customer_email = '".addslashes(trim($this->customer_email))."',";
    		$strSQL .= "customer_cst_number = '".addslashes(trim($this->customer_cst_number))."',";
    		$strSQL .= "ledger_sub_id = '".addslashes(trim($this->ledger_sub_id))."',";
    		$strSQL .= "deleted = '".addslashes(trim($this->deleted))."',";
			$strSQL .= "customer_tin_number = '".addslashes(trim($this->customer_tin_number))."'";
			$strSQL .= " WHERE customer_id = '".$this->customer_id."'";
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
           	}else{
				$this->error_number = 3;
				$this->error_description="Can't update";
				return false;
           	}
    	}
    }

    public function validate()
    {
    	if($this->customer_id > 0){//edit
    		$this->get_details();
    		return true;
    	}else{
	    	if(trim($this->customer_name) !=""){
	    		$strSQL = "SELECT * FROM customer WHERE customer_name = '".$this->customer_name."'";
	    		$rsRES  = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
	    		if ( mysql_num_rows($rsRES) > 0 ){
	    			return false;
	    		}else{
	    			return true;
	    		}
	    	}else{
	    		return false;
	    	}
	    }
    }

   
    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$customers = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM customer WHERE deleted = '".NOT_DELETED."'";

        $strSQL .= " ORDER BY customer_name";
        //echo $strSQL;
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
				$this->total_records = mysql_num_rows($all_rs);
			}
			while ( $row = mysql_fetch_assoc($rsRES) ){
				$customers[$i]["customer_id"] =  $row['customer_id'];
				$customers[$i]["customer_name"] = $row['customer_name'];
				$customers[$i]["customer_address"] = $row['customer_address'];
				$customers[$i]["customer_phone"] =  $row['customer_phone'];
				$customers[$i]["customer_mobile"] = $row['customer_mobile'];
				$customers[$i]["customer_fax"] = $row['customer_fax'];
				$customers[$i]["customer_email"] =  $row['customer_email'];
				$customers[$i]["customer_cst_number"] = $row['customer_cst_number'];
				$customers[$i]["customer_tin_number"] = $row['customer_tin_number'];
				$i++;
			}
			return $customers;
		} else {
			return false;
		}
    }

     public function get_details(){
    	
    	if ( ($this->customer_id != "" || $this->customer_id != gINVALID) && $this->customer_id >0 ) {
			$strSQL = "SELECT * FROM customer WHERE deleted = '".NOT_DELETED."' AND customer_id = '".$this->customer_id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->customer_id 			= $row['customer_id'];
				$this->customer_name 		= $row['customer_name'];
				$this->customer_address		= $row['customer_address'];
				$this->customer_phone 		= $row['customer_phone'];
				$this->customer_mobile 		= $row['customer_mobile'];
				$this->customer_fax			= $row['customer_fax'];
				$this->customer_email 		= $row['customer_email'];
				$this->customer_cst_number 	= $row['customer_cst_number'];
				$this->customer_tin_number	= $row['customer_tin_number'];
				$this->ledger_sub_id		= $row['ledger_sub_id'];
				$this->deleted				= $row['deleted'];
				return true;
			}else{
				return false;
			}
		}
    }

    public function delete()
    {
    	if ( ($this->customer_id != "" || $this->customer_id != gINVALID) && $this->customer_id >0 ){
    		$strSQL = "UPDATE customer SET deleted = '".DELETED."' WHERE customer_id = '".$this->customer_id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Customer not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Customer";
			return false;
    	}
    }



}
?>