<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Stock{

	var $connection ="";
	var $item_id  =  gINVALID; //master voucher
	var $item_name ="";
	var $uom_id = gINVALID; //voucher
	var $deleted = "";
	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->item_id == "" || $this->item_id == gINVALID) {
    		$strSQL= "INSERT INTO stock_master(item_name,uom_id) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->item_name)."','";
    		$strSQL.= mysql_real_escape_string($this->uom_id)."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->item_id = mysql_insert_id();
				$this->error_description="Success";
				return $this->item_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->item_id > 0 ) {
    		$strSQL = "UPDATE stock_master SET item_name = '".addslashes(trim($this->item_name))."',";
			$strSQL .= "uom_id = '".addslashes(trim($this->uom_id))."'";
			$strSQL .= " WHERE item_id = '".$this->item_id."'";
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
		$strSQL = "SELECT item_name FROM stock_master WHERE deleted = '".NOT_DELETED."' AND item_name LIKE '".$this->item_name."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 ){
			$row 	= mysql_fetch_assoc($rsRES);
			$this->error_description="Item ,".$row['item_name']." is already exists";
			return false;
		}else{
			return true;
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$items = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT sm.item_id,sm.item_name,um.uom_value FROM stock_master sm LEFT JOIN uom_master um ON sm.uom_id = um.uom_id  WHERE  deleted = '".NOT_DELETED."'";

        $strSQL .= " ORDER BY item_id";
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
				$this->total_records = mysql_num_rows($all_rs);
			}
			while ( list ($id,$name,$uom) = mysql_fetch_row($rsRES) ){
				$items[$i]["id"] =  $id;
				$items[$i]["name"] = $name;
				$items[$i]["uom"] = $uom;
				$i++;
			}
			return $items;
		} else {
			return false;
		}
    }

     public function get_details(){
    	
    	if ( ($this->item_id != "" || $this->item_id != gINVALID) && $this->item_id >0 ) {
			$strSQL = "SELECT * FROM stock_master WHERE deleted = '".NOT_DELETED."' AND item_id = '".$this->item_id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->item_id 			= $row['item_id'];
				$this->item_name 		= $row['item_name'];
				$this->uom_id		= $row['uom_id'];
				return true;
			}else{
				return false;
			}
		}
    }

    public function delete()
    {
    	if ( ($this->item_id != "" || $this->item_id != gINVALID) && $this->item_id >0 ){
    		$strSQL = "UPDATE stock_master SET deleted = '".DELETED."' WHERE item_id = '".$this->item_id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Item not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Item";
			return false;
    	}
    }


    function get_list_array()
	{
		$items = array();$i=0;
		$strSQL = "SELECT  item_id,item_name FROM stock_master WHERE  deleted = '".NOT_DELETED."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
				$items[$i]["id"] =  $id;
				$items[$i]["name"] = $name;
				$i++;
           	}
            return $items;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list items";
			return false;
    	}
	}



}
?>