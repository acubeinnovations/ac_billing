<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class FormVariable{

	var $connection ="";
	var $id  =  gINVALID;
	var $description ="";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';




    public function update()
    {
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$strSQL = "INSERT INTO form_variables(description) VALUES('";
    		$strSQL .= mysql_real_escape_string(trim($this->description))."')";

			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->id = mysql_insert_id();
				return $this->id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data";
				return false;
			}
    	}else{

    		$strSQL = "UPDATE form_variables SET description = '".addslashes(trim($this->description))."'";
			$strSQL .= " WHERE id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                  return true;
           	}else{
               	$this->error_number = 3;
              	$this->error_description="Can't update data";
               	return false;
       		 }

    	}
    }

    public function get_details(){
    	
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ) {
			$strSQL = "SELECT id,description FROM form_variables WHERE id = '".$this->id."'";
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 			= $row['id'];
				$this->description 		= $row['description'];
				return true;
			}else{
				return false;
			}
		}
    }

    function get_list_array(){
    	$form_variables = array();
		$i=0;
		
        $strSQL = "SELECT id,description FROM form_variables WHERE 1";

        $strSQL .= " ORDER BY id";
		
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		if ( mysql_num_rows($rsRES) > 0 ){

			while ( list ($id,$description) = mysql_fetch_row($rsRES) ){
				$form_variables[$i]["id"] =  $id;
				$form_variables[$i]["description"] = $description;
				$i++;
			}
			return $form_variables;
		} else {
			return false;
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$form_variables = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,description FROM form_variables WHERE 1";

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
			while ( list ($id,$description) = mysql_fetch_row($rsRES) ){
				$form_variables[$i]["id"] =  $id;
				$form_variables[$i]["description"] = $description;
				$i++;
			}
			return $form_variables;
		} else {
			return false;
		}
    }


    public function validate()
    {
    	$strSQL = "SELECT description FROM form_variables WHERE description LIKE '".$this->description."'";
    	$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		if ( mysql_num_rows($rsRES) > 0 ){
			return false;
		}else{
			return true;
		}
    }

    public function getFormVariables($form_variables = false)
    {

    	if(is_array($form_variables)){
    		$ids = implode(',',$form_variables);
    	}
    	else{
    		$ids=false;
    	}

    	$result = array();$i=0;
    	if($ids){
    		$strSQL = "SELECT id,description FROM form_variables WHERE id IN(".$ids.")";
    		// $strSQL;exit();
	    	$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
			if ( mysql_num_rows($rsRES) > 0 ){
				while(list($id,$description) = mysql_fetch_row($rsRES)){
					$result[$i]['id'] = $id;
					$result[$i]['description'] = $description;
					$i++;
				}
				return $result;
			}else{
				return true;
			}
    	}
    	
    }



    
}

?>