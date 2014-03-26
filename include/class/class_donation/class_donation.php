<?php 

if(!defined('CHECK_INCLUDED')){
	exit();
}

Class Donation{

var $id=gINVALID;
var $bill_item_id=gINVALID;
var $date="";
var $name="";
var $address="";
var $star_id=gINVALID;
var $amount="";
var $description="";

var $error = false;
var $error_number=gINVALID;
var $error_description="";
var $total_records='';



function update()
		{

			if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO donations(name,address,star_id,amount,description) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->address)) ."','";
			$strSQL .= addslashes(trim($this->star_id)) ."','";
			$strSQL .= addslashes(trim($this->amount)) ."','";
			$strSQL .= addslashes(trim($this->description)) . "')";
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

       if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		  }else{
              $this->error_number = 3;
              $this->error_description="Can't insert Donation ";
              return false;
              }
         }

	elseif($this->id > 0 ) {
			$strSQL = "UPDATE donations SET name ='".addslashes(trim($this->name))."',"; 
			$strSQL .= "address = '".addslashes(trim($this->address))."',";
			$strSQL .= "star_id = '".addslashes(trim($this->star_id))."',";
			$strSQL .= "amount = '".addslashes(trim($this->amount))."',";
			$strSQL .= "description = '".addslashes(trim($this->description))."'";
			$strSQL .= " WHERE id = ".$this->id;
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

        if ( mysql_affected_rows($this->connection) >= 0 ) {
                 return true;
           	     }else{
               	 $this->error_number = 3;
              	 $this->error_description="Can't update donations";
               	return false;
           		 }
    		  }
  }




function get_list_array()
	{
		$donation = array();$i=0;
		$strSQL = "SELECT  name,address,star_id,amount,description FROM donations";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( list ($name,$address,$star_id,$amount,$description) = mysql_fetch_row($rsRES) ){
				//$donation[$i]["id"] =  $id;
				$donation[$i]["name"] = $name;
				$donation[$i]["address"] = $address;
				$donation[$i]["star_id"] = $star_id;
				$donation[$i]["amount"] = $amount;
				$donation[$i]["description"] = $description;
				$i++;
           	}
            return $donation;
       		}else{
			$this->error_number = 4;
			$this->error_description="Can't list donation";
			return false;
    	}
}

function get_details()
	{
	if($this->id >0){
		$strSQL = "SELECT id,name,address,star_id,amount FROM donations WHERE id = '".$this->id."'";
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		 if(mysql_num_rows($rsRES) > 0){
			$user 	= mysql_fetch_assoc($rsRES);
			$this->id 		= $user['id'];
			$this->name 	= $user['name'];
			$this->address= $user['address'];
			$this->star_id = $user['star_id'];
			$this->amount = $user['amount'];
			return true;
			}else{
			return false;
			}
			}else{
			return false;
			}
}








}

?>