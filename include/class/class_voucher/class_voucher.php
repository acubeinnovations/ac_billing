<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Voucher{

	var $connection ="";
	var $voucher_master_id  =  gINVALID; //master voucher
	var $voucher_master_name ="";

	var $voucher_id = gINVALID; //voucher
	var $voucher_name = "";
	var $voucher_description = "";
	var $fy_id	= gINVALID;
	var $header = "";
	var $footer = "";
	var $number_series = "";
	var $series_prefix = "";
	var $series_sufix = "";
	var $series_start = "";
	var $series_seperator = "";
	var $default_from = "";
	var $default_to = "";
	var $form_type_id = gINVALID;
	var $source = "";
	var $hidden = VOUCHER_SHOW;
	var $module_id = "NULL";
	

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
    	if ( $this->voucher_id == "" || $this->voucher_id == gINVALID) {
    		$strSQL= "INSERT INTO voucher(voucher_name,voucher_description,fy_id,voucher_master_id,header,footer,number_series,series_prefix,series_sufix,series_start,series_seperator,default_from,default_to,form_type_id,source,hidden,module_id) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->voucher_name)."','";
    		$strSQL.= mysql_real_escape_string($this->voucher_description)."','";
    		$strSQL.= mysql_real_escape_string($this->current_fy_id)."','";
    		$strSQL.= mysql_real_escape_string($this->voucher_master_id)."','";
    		$strSQL.= mysql_real_escape_string($this->header)."','";
    		$strSQL.= mysql_real_escape_string($this->footer)."','";
    		$strSQL.= mysql_real_escape_string($this->number_series)."','";
    		$strSQL.= mysql_real_escape_string($this->series_prefix)."','";
    		$strSQL.= mysql_real_escape_string($this->series_sufix)."','";
    		$strSQL.= mysql_real_escape_string($this->series_start)."','";
    		$strSQL.= mysql_real_escape_string($this->series_seperator)."','";
    		if(is_array($this->default_from)){
    			$strSQL.= mysql_real_escape_string(serialize($this->default_from))."','";
    		}else{
    			$strSQL.= mysql_real_escape_string($this->default_from)."','";
    		}
    		if(is_array($this->default_to)){
    			$strSQL.= mysql_real_escape_string(serialize($this->default_to))."','";
    		}else{
    			$strSQL.= mysql_real_escape_string($this->default_to)."','";
    		}
    		
    		$strSQL.= mysql_real_escape_string($this->form_type_id)."','";
    		$strSQL.= mysql_real_escape_string($this->source)."','";
    		$strSQL.= mysql_real_escape_string($this->hidden)."',";
    		$strSQL.= mysql_real_escape_string($this->module_id).")";
			//echo $strSQL;exit();
			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->voucher_id = mysql_insert_id();
				$this->error_description="Voucher added Successfully";
				return $this->voucher_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert Voucher ";
				return false;
			}

    	}elseif($this->voucher_id > 0 ) {
    		$strSQL = "UPDATE voucher SET voucher_name = '".addslashes(trim($this->voucher_name))."',";
    		$strSQL .= "voucher_description = '".addslashes(trim($this->voucher_description))."',";
			$strSQL .= "fy_id = '".addslashes(trim($this->current_fy_id))."',";
			$strSQL .= "voucher_master_id = '".addslashes(trim($this->voucher_master_id))."',";
			$strSQL .= "header = '".addslashes(trim($this->header))."'";
			$strSQL .= "footer = '".addslashes(trim($this->footer))."'";
			$strSQL .= "number_series = '".addslashes(trim($this->number_series))."'";
			$strSQL .= "series_prefix = '".addslashes(trim($this->series_prefix))."'";
			$strSQL .= "series_sufix = '".addslashes(trim($this->series_sufix))."'";
			$strSQL .= "series_start = '".addslashes(trim($this->series_start))."'";
			$strSQL .= "series_seperator = '".addslashes(trim($this->series_seperator))."'";
			$strSQL .= "default_from = '".addslashes(trim($this->default_from))."'";
			$strSQL .= "default_to = '".addslashes(trim($this->default_to))."'";
			$strSQL .= "form_type_id = '".addslashes(trim($this->form_type_id))."'";
			$strSQL .= " WHERE voucher_id = ".$this->voucher_id;
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

    	//list all sub vouchers
    public function get_list_array()
    {
    	
    	$vouchers = array();$i=0;
		$strSQL = "SELECT V.voucher_id ,V.voucher_name AS voucher"; 
		$strSQL .= " FROM voucher V";
		$strSQL .= " WHERE V.fy_id = '".$this->current_fy_id."'";
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$vouchers[$i]['id'] =$id;
				$vouchers[$i]['name'] =$name;
				$i++;
       		}
            return $vouchers;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Vouchers";
			return false;
    	}
	   
    }


    	//list all master vouchers
    public function get_list_master_array()
    {
    	$vouchers = array();$i=0;
		$strSQL = "SELECT  voucher_master_id,voucher_master_name FROM voucher_master WHERE status = '".STATUS_ACTIVE."'";
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$vouchers[$i]["id"] =  $id;
				$vouchers[$i]["name"] = $name;
			
				$i++;
       		}
            return $vouchers;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Vouchers";
			return false;
    	}
    }

    	//list vouchers of a perticular master voucher
    public function get_list_sub_array()
    {
    	if ( $this->voucher_master_id != "" || $this->voucher_master_id != gINVALID && $this->voucher_master_id >0) {

	    	$sub_vouchers = array();
			$strSQL = "SELECT V.voucher_id ,V.voucher_name AS voucher"; 
			$strSQL .= " FROM voucher V";
			$strSQL .= " WHERE  V.fy_id = '".$this->current_fy_id."' AND V.voucher_master_id = '".$this->voucher_master_id."'";
			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 )
			{
				while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
					$sub_vouchers[$id] =$name;
	       		}
	            return $sub_vouchers;
	       	}else{
				$this->error_number = 4;
				$this->error_description="Can't list Sub Vouchers";
				return false;
	    	}
	    }else{
	    	return false;
	    }
    }



    public function get_details(){
    	
    	if ( ($this->voucher_id != "" || $this->voucher_id != gINVALID) && $this->voucher_id >0 ) {
			$strSQL = "SELECT * FROM voucher WHERE  fy_id = '".$this->current_fy_id."' AND voucher_id = '".$this->voucher_id."'";
			 mysql_query("SET NAMES utf8");
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->voucher_id 			= $row['voucher_id'];
				$this->voucher_name 		= $row['voucher_name'];
				$this->voucher_description 	= $row['voucher_description'];
				$this->fy_id 				= $row['fy_id'];
				$this->voucher_master_id 	= $row['voucher_master_id'];
				$this->header 				= $row['header'];
				$this->footer 				= $row['footer'];
				$this->number_series 		= $row['number_series'];
				$this->series_prefix 		= $row['series_prefix'];
				$this->series_sufix 		= $row['series_sufix'];
				$this->series_start 		= $row['series_start'];
				$this->series_seperator 	= $row['series_seperator'];
				$this->default_from 		= $row['default_from'];
				$this->default_to 			= $row['default_to'];
				$this->form_type_id 		= $row['form_type_id'];
				$this->source 				= $row['source'];
				
				return true;
			}else{
				return false;
			}
		}
    }

    public function get_details_with_moduleid(){
    	
    	if ( ($this->module_id != "" || $this->module_id != gINVALID) && $this->module_id >0 ) {
			$strSQL = "SELECT * FROM voucher WHERE fy_id = '".$this->current_fy_id."' AND module_id = '".$this->module_id."'";
			 mysql_query("SET NAMES utf8");
			// echo $strSQL;exit();
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->voucher_id 			= $row['voucher_id'];
				$this->voucher_name 		= $row['voucher_name'];
				$this->voucher_description 	= $row['voucher_description'];
				$this->fy_id 				= $row['fy_id'];
				$this->voucher_master_id 	= $row['voucher_master_id'];
				$this->header 				= $row['header'];
				$this->footer 				= $row['footer'];
				$this->number_series 		= $row['number_series'];
				$this->series_prefix 		= $row['series_prefix'];
				$this->series_sufix 		= $row['series_sufix'];
				$this->series_start 		= $row['series_start'];
				$this->series_seperator 	= $row['series_seperator'];
				$this->default_from 		= $row['default_from'];
				$this->default_to 			= $row['default_to'];
				$this->form_type_id 		= $row['form_type_id'];
				$this->source 				= $row['source'];
				$this->hidden 				= $row['hidden'];
				$this->module_id 			= $row['module_id'];
				
				return true;
			}else{
				return false;
			}
		}
    }


}
?>