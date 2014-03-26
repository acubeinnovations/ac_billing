<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Tax{

	var $connection ="";
	var $id  =  gINVALID; //master voucher
	var $name ="";
	var $rate = 0; //voucher
	var $status = "";
	var $deleted = NOT_DELETED;
	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$strSQL= "INSERT INTO tax_master(name,rate,status,deleted) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->name)."','";
    		$strSQL.= mysql_real_escape_string($this->rate)."','";
    		$strSQL.= mysql_real_escape_string($this->status)."','";
    		$strSQL.= mysql_real_escape_string($this->deleted)."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->id = mysql_insert_id();
				$this->error_description="Success";
				return $this->id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->id > 0 ) {
    		$strSQL = "UPDATE tax_master SET name = '".addslashes(trim($this->name))."',";
    		$strSQL .= "rate = '".addslashes(trim($this->rate))."',";
    		$strSQL .= "deleted = '".addslashes(trim($this->deleted))."',";
			$strSQL .= "status = '".addslashes(trim($this->status))."'";
			$strSQL .= " WHERE id = '".$this->id."'";
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
		$strSQL = "SELECT name FROM tax_master WHERE deleted = '".NOT_DELETED."' AND name LIKE '".$this->name."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 ){
			$row 	= mysql_fetch_assoc($rsRES);
			$this->error_description="Tax ,".$row['item_name']." is already exists";
			return false;
		}else{
			return true;
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$tax = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,name,rate,status FROM tax_master WHERE deleted = '".NOT_DELETED."' AND status = '".STATUS_ACTIVE."'";

        $strSQL .= " ORDER BY id";
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
				$this->total_records = mysql_num_rows($all_rs);
			}
			while ( list ($id,$name,$rate,$status) = mysql_fetch_row($rsRES) ){
				$tax[$i]["id"] =  $id;
				$tax[$i]["name"] = $name;
				$tax[$i]["rate"] = $rate;
				$tax[$i]["status"] = $status;
				$i++;
			}
			return $tax;
		} else {
			return false;
		}
    }

     public function get_details(){
    	
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ) {
			$strSQL = "SELECT * FROM tax_master WHERE deleted = '".NOT_DELETED."' AND status = '".STATUS_ACTIVE."' AND id = '".$this->id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 			= $row['id'];
				$this->name 		= $row['name'];
				$this->rate			= $row['rate'];
				$this->status		= $row['status'];
				return true;
			}else{
				return false;
			}
		}
    }

    

    function get_list_array()
	{
		$tax = array();$i=0;
		$strSQL = "SELECT  id,name,rate,status FROM tax_master WHERE deleted = '".NOT_DELETED."' AND status = '".STATUS_ACTIVE."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( list ($id,$name,$rate,$status) = mysql_fetch_row($rsRES) ){
				$tax[$i]["id"] =  $id;
				$tax[$i]["name"] = $name;
				$tax[$i]["rate"] = $rate*100;
				$tax[$i]["status"] = $status;
				$i++;
           	}
            return $tax;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list tax names";
			return false;
    	}
	}

	public function delete()
    {
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ){
    		$strSQL = "UPDATE tax_master SET deleted = '".DELETED."' WHERE id = '".$this->id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Tax not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Tax";
			return false;
    	}
    }

    public function getRate($taxid)
    {
    	$tax_rate = 0;
    	if($taxid >0){
    		$strSQL = "SELECT rate FROM tax_master WHERE id= '".$taxid."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    		if(mysql_num_rows($rsRES) > 0){
    			$row = mysql_fetch_assoc($rsRES);
    			$tax_rate = $row['rate'];
    		}
    	}
    	return $tax_rate;
    }



}
?>