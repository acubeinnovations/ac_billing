<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class AcBook{

	var $connection ="";
	var $id  =  gINVALID;
	var $name ="";
	var $ledgers = ""; 
	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

    public function update()
    {
    	if ( $this->id == "" || $this->id == gINVALID) {
    		$strSQL= "INSERT INTO ac_books(name,ledgers) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->name)."','";
    		$strSQL.= mysql_real_escape_string(serialize($this->ledgers))."')";
   
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

    	}elseif($this->id > 0 ) {
    		$strSQL = "UPDATE ac_books SET name = '".addslashes(trim($this->name))."',";
			$strSQL .= "ledgers = '".mysql_real_escape_string(serialize($this->ledgers))."'";
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
		$strSQL = "SELECT name FROM ac_books WHERE name LIKE '".$this->name."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 ){
			$row 	= mysql_fetch_assoc($rsRES);
			$this->error_description="Account Book ,".$row['name']." is already exists";
			return false;
		}else{
			return true;
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$books = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,name,ledgers FROM ac_books WHERE 1";

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
			while ( list ($id,$name,$ledgers) = mysql_fetch_row($rsRES) ){
				//echo $ledgers;exit();
				$books[$i]["id"] =  $id;
				$books[$i]["name"] = $name;
				$ledger_array = unserialize($ledgers);
				$strSQL_ledgers = "SELECT ledger_sub_id,ledger_sub_name FROM ledger_sub WHERE ledger_sub_id IN (".implode(',',$ledger_array).")";
				mysql_query("SET NAMES utf8");
				$rsRES_ledgers = mysql_query($strSQL_ledgers, $this->connection) or die(mysql_error(). $strSQL_ledgers);
				$ledger_name_array = array();$j=0;
				if ( mysql_num_rows($rsRES_ledgers) > 0 ){
					while($row_ledgers = mysql_fetch_assoc($rsRES_ledgers)){
						$ledger_name_array[$j]['id'] =  $row_ledgers['ledger_sub_id'];
						$ledger_name_array[$j]['name'] =  $row_ledgers['ledger_sub_name'];
						$j++;
					}
				}
				$books[$i]["ledgers"] = $ledger_name_array;
				
				$i++;
			}
			return $books;
		} else {
			return false;
		}
    }

     public function get_details(){
    	
    	if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ) {
			$strSQL = "SELECT * FROM ac_books WHERE id = '".$this->id."'";

			$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
			if(mysql_num_rows($rsRES) > 0){
				$row 	= mysql_fetch_assoc($rsRES);
				$this->id 			= $row['id'];
				$this->name 		= $row['name'];
				$this->ledgers		= $row['ledgers'];
				return true;
			}else{
				return false;
			}
		}
    }

    public function delete()
    {
    	/*if ( ($this->id != "" || $this->id != gINVALID) && $this->id >0 ){
    		$strSQL = "UPDATE ac_books WHERE id = '".$this->id."'";
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
            	return true;
            }else{
            	$this->error_description="Account Book not deleted";
				return false;
            }
    	}else{
    		$this->error_description="Invalid Account Book";
			return false;
    	}*/
    	return false;
    }


    function get_list_array()
	{
		$books = array();$i=0;
		$strSQL = "SELECT  id,name,ledgers FROM ac_books";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( list ($id,$name,$ledgers) = mysql_fetch_row($rsRES) ){
				$books[$i]["id"] =  $id;
				$books[$i]["name"] = $name;
				$books[$i]["ledgers"] = $ledgers;
				$i++;
           	}
            return $books;
       	}else{
			$this->error_number = 4;
			$this->error_description="Can't list Account Books";
			return false;
    	}
}



}
?>