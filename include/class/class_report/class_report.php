<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Report{

	var $connection ="";
	var $report_id  =  gINVALID; 
	var $report_head ="";
	var $lhs = ""; 
	var $rhs = "";
	var $lhs_head = "";
	var $rhs_head = "";
	var $header = "";
	var $footer = "";
	var $status = STATUS_INACTIVE;

	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->report_id == "" || $this->report_id == gINVALID) {
    		$strSQL= "INSERT INTO report(report_head,lhs,rhs,lhs_head,rhs_head,header,footer,status) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->report_head)."','";
    		$strSQL.= mysql_real_escape_string($this->lhs)."','";
    		$strSQL.= mysql_real_escape_string($this->rhs)."','";
    		$strSQL.= mysql_real_escape_string($this->lhs_head)."','";
    		$strSQL.= mysql_real_escape_string($this->rhs_head)."','";
    		$strSQL.= mysql_real_escape_string($this->header)."','";
    		$strSQL.= mysql_real_escape_string($this->footer)."','";
    		$strSQL.= mysql_real_escape_string($this->status)."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->report_id = mysql_insert_id();
				$this->error_description="Success";
				return $this->report_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->report_id > 0 ) {
    		$strSQL = "UPDATE report SET report_head = '".addslashes(trim($this->report_head))."',";
    		$strSQL .= "lhs = '".addslashes(trim($this->lhs))."',";
    		$strSQL .= "rhs = '".addslashes(trim($this->rhs))."',";
    		$strSQL .= "lhs_head = '".addslashes(trim($this->lhs_head))."',";
    		$strSQL .= "rhs_head = '".addslashes(trim($this->rhs_head))."',";
    		$strSQL .= "header = '".addslashes(trim($this->header))."',";
    		$strSQL .= "footer = '".addslashes(trim($this->footer))."',";
			$strSQL .= "status = '".addslashes(trim($this->status))."'";
			$strSQL .= " WHERE report_id = '".$this->report_id."'";
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
		$strSQL = "SELECT report_head FROM report WHERE report_head LIKE '".$this->report_head."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 ){
			$row 	= mysql_fetch_assoc($rsRES);
			$this->error_description="Report  ,".$row['report_head']." is already exists";
			return false;
		}else{
			return true;
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$reports = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM report WHERE 1";

        $strSQL .= " ORDER BY report_id";
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
				$this->total_records = mysql_num_rows($all_rs);
			}
			while ($row = mysql_fetch_row($rsRES) ){
				$reports[$i]["report_id"] =  $row['report_id'];
				$reports[$i]["report_head"] =  $row['report_head'];
				$reports[$i]["lhs"] =  $row['lhs'];
				$reports[$i]["rhs"] =  $row['rhs'];
				$reports[$i]["lhs_head"] =  $row['lhs_head'];
				$reports[$i]["rhs_head"] =  $row['rhs_head'];
				$reports[$i]["header"] =  $row['header'];
				$reports[$i]["footer"] =  $row['footer'];
				$reports[$i]["status"] =  $row['status'];
				
				$i++;
			}
			return $reports;
		} else {
			return false;
		}
    }

     public function get_details(){
    	
    	if ( ($this->report_id != "" || $this->report_id != gINVALID) && $this->report_id >0 ) {
			$strSQL = "SELECT * FROM report WHERE report_id = '".$this->report_id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->report_id 		= $row['report_id'];
				$this->report_head 		= $row['report_head'];
				$this->lhs				= $row['lhs'];
				$this->rhs 				= $row['rhs'];
				$this->lhs_head 		= $row['lhs_head'];
				$this->rhs_head			= $row['rhs_head'];
				$this->header 			= $row['header'];
				$this->footer 			= $row['footer'];
				$this->status			= $row['status'];
				return true;
			}else{
				return false;
			}
		}
    }

    public function delete()
    {
    	if ( ($this->report_id != "" || $this->report_id != gINVALID) && $this->report_id >0 ){
    		$strSQL = "DELETE FROM report WHERE report_id = '".$this->report_id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Report not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Report";
			return false;
    	}
    }


    function get_list_array()
	{
		$reports = array();$i=0;
		$strSQL = "SELECT * FROM report";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( $row = mysql_fetch_assoc($rsRES) ){
				$reports[$i]["report_id"] =  $row['report_id'];
				$reports[$i]["report_head"] =  $row['report_head'];
				$reports[$i]["lhs"] =  $row['lhs'];
				$reports[$i]["rhs"] =  $row['rhs'];
				$reports[$i]["lhs_head"] =  $row['lhs_head'];
				$reports[$i]["rhs_head"] =  $row['rhs_head'];
				$reports[$i]["header"] =  $row['header'];
				$reports[$i]["footer"] =  $row['footer'];
				$reports[$i]["status"] =  $row['status'];
				$i++;
           	}
            return $reports;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Reports";
			return false;
    	}
}



}
?>