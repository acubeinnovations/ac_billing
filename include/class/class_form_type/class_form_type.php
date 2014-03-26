<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class FormType{

	var $connection ="";
	var $id  =  gINVALID; //master voucher
	var $value ="";
	var $form_variables = "";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';


    public function update()
    {
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$strSQL= "INSERT INTO form_type(value,form_variables) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->value)."','";
			$strSQL.= mysql_real_escape_string(serialize($this->form_variables))."')";
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->voucher_id = mysql_insert_id();
				$this->error_description="Successfully";
				return $this->voucher_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->id > 0 ) {
    		$strSQL = "UPDATE form_type SET value = '".addslashes(trim($this->value))."',form_variables = '".addslashes(trim($this->form_variables))."'";
			$strSQL .= " WHERE id = ".$this->id;
			echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
           	}else{
				$this->error_number = 3;
				$this->error_description="Can't update ";
				return false;
           	}
    	}
    }

    	//list all
    public function get_list_array()
    {
    	
    	$form_types = array();$i=0;
		$strSQL = "SELECT id,value,form_variables FROM form_type"; 

			
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$value,$form_variables) = mysql_fetch_row($rsRES) ){
				$form_types[$i]['id'] =$id;
				$form_types[$i]['value'] =$value;
				$form_types[$i]['form_variables'] =$form_variables;
				
				$i++;
       		}
            return $form_types;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list form types";
			return false;
    	}
	   
    }

    public function get_details(){
    	
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ) {
			$strSQL = "SELECT id,value,form_variables FROM form_type WHERE id = '".$this->id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 					= $row['id'];
				$this->value 				= $row['value'];
				$this->form_variables 		= $row['form_variables'];
				return true;
			}else{
				return false;
			}
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$form_types = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,value,form_variables FROM form_type WHERE 1";

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
			while ( list ($id,$value,$form_variables) = mysql_fetch_row($rsRES) ){
				$form_types[$i]["id"] =  $id;
				$form_types[$i]["value"] = $value;
				$form_types[$i]["form_variables"] = $form_variables;
				$i++;
			}
			return $form_types;
		} else {
			return false;
		}
    }



}
?>