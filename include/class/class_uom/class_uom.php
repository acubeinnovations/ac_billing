<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Uom{

	var $connection ="";
	var $uom_id  =  gINVALID; 
	var $uom_value ="";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    function get_details()
	{
		if($this->uom_id >0){
			$strSQL = "SELECT uom_id,uom_value FROM uom_master WHERE uom_id = '".$this->uom_id."'";
			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			 if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->uom_id 		= $row['uom_id'];
				$this->uom_value 	= $row['uom_value'];
				return true;
			}else{
				return false;
			}
		}else{
			return false;
		}
	}




	function get_list_array()
	{
		$uom = array();$i=0;
		$strSQL = "SELECT  uom_id,uom_value FROM uom_master";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
		{
			while ( list ($id,$value) = mysql_fetch_row($rsRES) ){
				$uom[$i]["id"] =  $id;
				$uom[$i]["value"] = $value;
				$i++;
	        }
	        return $uom;
	    }else{
			$this->error_number = 4;
			$this->error_description="Can't list pooja";
			return false;
	    }
	}



}
?>