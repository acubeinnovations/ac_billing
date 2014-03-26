<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Supplier{

	var $connection ="";
	var $supplier_id  =  gINVALID; 
	var $supplier_name ="";
	var $supplier_address ="";
	var $supplier_phone ="";
	var $supplier_fax ="";
	var $contact_person = "";
	var $contact_mobile ="";
	var $contact_email ="";
	var $supplier_cst_number ="";
	var $supplier_tin_number ="";
	var $deleted = NOT_DELETED;
	var $ledger_sub_id = gINVALID;
	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->supplier_id == "" || $this->supplier_id == gINVALID) {
    		$strSQL= "INSERT INTO supplier(supplier_name,supplier_address,supplier_phone,contact_person,contact_mobile,supplier_fax,contact_email,supplier_cst_number,supplier_tin_number,ledger_sub_id,deleted) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->supplier_name)."','";
    		$strSQL.= mysql_real_escape_string($this->supplier_address)."','";
    		$strSQL.= mysql_real_escape_string($this->supplier_phone)."','";
    		$strSQL.= mysql_real_escape_string($this->contact_person)."','";
    		$strSQL.= mysql_real_escape_string($this->contact_mobile)."','";
    		$strSQL.= mysql_real_escape_string($this->supplier_fax)."','";
    		$strSQL.= mysql_real_escape_string($this->contact_email)."','";
    		$strSQL.= mysql_real_escape_string($this->supplier_cst_number)."','";
    		$strSQL.= mysql_real_escape_string($this->supplier_tin_number)."','";
    		$strSQL.= mysql_real_escape_string($this->ledger_sub_id)."','";
    		$strSQL.= mysql_real_escape_string($this->deleted)."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->supplier_id = mysql_insert_id();
				$this->error_description="Success";
				return $this->supplier_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->supplier_id > 0 ) {
    		$strSQL = "UPDATE supplier SET supplier_name = '".addslashes(trim($this->supplier_name))."',";
    		$strSQL .= "supplier_address = '".addslashes(trim($this->supplier_address))."',";
    		$strSQL .= "supplier_phone = '".addslashes(trim($this->supplier_phone))."',";
    		$strSQL .= "contact_person = '".addslashes(trim($this->contact_person))."',";
    		$strSQL .= "contact_mobile = '".addslashes(trim($this->contact_mobile))."',";
    		$strSQL .= "supplier_fax = '".addslashes(trim($this->supplier_fax))."',";
    		$strSQL .= "contact_email = '".addslashes(trim($this->contact_email))."',";
    		$strSQL .= "supplier_cst_number = '".addslashes(trim($this->supplier_cst_number))."',";
			$strSQL .= "supplier_tin_number = '".addslashes(trim($this->supplier_tin_number))."',";
			$strSQL .= "ledger_sub_id = '".addslashes(trim($this->ledger_sub_id))."'";
			$strSQL .= " WHERE supplier_id = '".$this->supplier_id."'";
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
    	if($this->supplier_id > 0){//edit
    		$this->get_details();
    		return true;
    	}else{
	    	if(trim($this->supplier_name) !=""){
	    		$strSQL = "SELECT * FROM supplier WHERE supplier_name = '".$this->supplier_name."'";
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
    	$suppliers = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM supplier WHERE deleted = '".NOT_DELETED."'";

        $strSQL .= " ORDER BY supplier_name";
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
				$suppliers[$i]["supplier_id"] =  $row['supplier_id'];
				$suppliers[$i]["supplier_name"] = $row['supplier_name'];
				$suppliers[$i]["supplier_address"] = $row['supplier_address'];
				$suppliers[$i]["supplier_phone"] =  $row['supplier_phone'];
				$suppliers[$i]["contact_person"] = $row['contact_person'];
				$suppliers[$i]["contact_mobile"] = $row['contact_mobile'];
				$suppliers[$i]["supplier_fax"] = $row['supplier_fax'];
				$suppliers[$i]["contact_email"] =  $row['contact_email'];
				$suppliers[$i]["supplier_cst_number"] = $row['supplier_cst_number'];
				$suppliers[$i]["supplier_tin_number"] = $row['supplier_tin_number'];
				$suppliers[$i]["ledger_sub_id"] = $row['ledger_sub_id'];
				$i++;
			}
			return $suppliers;
		} else {
			return false;
		}
    }

     public function get_details(){
    	
    	if ( ($this->supplier_id != "" || $this->supplier_id != gINVALID) && $this->supplier_id >0 ) {
			$strSQL = "SELECT * FROM supplier WHERE deleted = '".NOT_DELETED."' AND supplier_id = '".$this->supplier_id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->supplier_id 			= $row['supplier_id'];
				$this->supplier_name 		= $row['supplier_name'];
				$this->supplier_address		= $row['supplier_address'];
				$this->supplier_phone 		= $row['supplier_phone'];
				$this->contact_person		= $row['contact_person'];
				$this->contact_mobile 		= $row['contact_mobile'];
				$this->supplier_fax			= $row['supplier_fax'];
				$this->contact_email 		= $row['contact_email'];
				$this->supplier_cst_number 	= $row['supplier_cst_number'];
				$this->supplier_tin_number	= $row['supplier_tin_number'];
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
    	if ( ($this->supplier_id != "" || $this->supplier_id != gINVALID) && $this->supplier_id >0 ){
    		$strSQL = "UPDATE supplier SET deleted = '".DELETED."' WHERE supplier_id = '".$this->supplier_id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="supplier not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid supplier";
			return false;
    	}
    }



}
?>