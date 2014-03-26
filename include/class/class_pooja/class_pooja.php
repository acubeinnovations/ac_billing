
<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class Pooja{

	var $connection ="";
	var $id  =  gINVALID;
	var $name ="";
	var $rate ="";
	var $ledger_sub_id = gINVALID;
	var $status_id ="";

	var $vazhipadu_date = CURRENT_DATE;

	var $from_date = "";
  	var $to_date = "";

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';



    function update()
	{

		if ( $this->id == "" || $this->id == gINVALID) {
			$strSQL = "INSERT INTO pooja(name,rate,ledger_sub_id,status_id) VALUES ('";
			$strSQL .= addslashes(trim($this->name)) ."','";
			$strSQL .= addslashes(trim($this->rate)) . "','";
			$strSQL .= addslashes(trim($this->ledger_sub_id)) . "','";
			$strSQL .= addslashes(trim($this->status_id)) . "')";
 			mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

          if ( mysql_affected_rows($this->connection) > 0 ) {
              $this->id = mysql_insert_id();
              return $this->id;
        		}else{
              $this->error_number = 3;
              $this->error_description="Can't insert pooja ";
              return false;
              }
        }

		elseif($this->id > 0 ) {
			$strSQL = "UPDATE pooja SET name = '".addslashes(trim($this->name))."',";
			$strSQL .= "rate = '".addslashes(trim($this->rate))."',";
			$strSQL .= "status_id = '".addslashes(trim($this->status_id))."'";
			$strSQL .= " WHERE id = ".$this->id;
			 mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                  return true;
           	     }else{
               	 $this->error_number = 3;
              	 $this->error_description="Can't update Pooja";
               	return false;
           		 }
    		}
  	}



function get_details()
{
	if($this->id >0){
		$strSQL = "SELECT id,name,rate,ledger_sub_id,status_id FROM pooja WHERE id = '".$this->id."'";
		 mysql_query("SET NAMES utf8");
		$rsRES	= mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
		 if(mysql_num_rows($rsRES) > 0){
			$row 	= mysql_fetch_assoc($rsRES);
			$this->id 		= $row['id'];
			$this->name 	= $row['name'];
			$this->rate= $row['rate'];
			$this->ledger_sub_id= $row['ledger_sub_id'];
			$this->status_id = $row['status_id'];
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
		$pooja = array();$i=0;
		$strSQL = "SELECT  id,name,rate,status_id FROM pooja";
		 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if ( mysql_num_rows($rsRES) > 0 )
			{
			while ( list ($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
				$pooja[$i]["id"] =  $id;
				$pooja[$i]["name"] = $name;
				$pooja[$i]["rate"] = $rate;
				$pooja[$i]["status_id"] = $status_id;
				$i++;
           	}
            return $pooja;
       		}else{
			$this->error_number = 4;
			$this->error_description="Can't list pooja";
			return false;
    	}
}



function get_array()

	{
        	$pooja = array();
			$i=0;
			$strSQL = "SELECT id,name,rate,status_id FROM pooja";
			 mysql_query("SET NAMES utf8");
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			if ( mysql_num_rows($rsRES) > 0 ){
				 while(list($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
						$pooja[$i]['id'] =  $id;
						$pooja[$i]['name'] =  $name;
						$pooja[$i]['rate'] =  $rate;
						$pooja[$i]['status_id'] =  $status_id;
						$i++;
           		 		}
            		return $pooja;
       				}else{
					$this->error_number = 4;
					$this->error_description="Can't list pooja";
					return false;
    				}
}		



 function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $pooja = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,name,rate,status_id FROM pooja WHERE 1";
		if($this->id!='' && $this->id!=gINVALID){
           $strSQL .= " AND id = '".addslashes(trim($this->id))."'";
      	 }
        if ($this->name!='') {
       	$strSQL .= " AND name LIKE '%".addslashes(trim($this->name))."%'";
        }


        $strSQL .= " ORDER BY id";
		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
	   if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
			 $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
             $this->total_records = mysql_num_rows($all_rs);
					}
			while ( list ($id,$name,$rate,$status_id) = mysql_fetch_row($rsRES) ){
					$pooja[$i]["id"] =  $id;
					$pooja[$i]["name"] = $name;
					$pooja[$i]["rate"] = $rate;
					$pooja[$i]["status_id"] = $status_id;
					$i++;}
					return $pooja;
    				} else {
      			 return false;
        	}
        
    }

    public function get_vazhipadu_pooja_list($start_record = 0,$max_records = 25)
    {

    	$strSQL = "SELECT v.pooja_id,p.name,p.rate,v.vazhipadu_date,sum(v.quantity) AS quantity FROM vazhipadu v";
    	$strSQL .= " LEFT JOIN pooja p ON p.id=v.pooja_id";
    	$strSQL .= " WHERE deleted = '".NOT_DELETED."'";
    	
    	 if($this->from_date != "" and $this->to_date != ""){
	      if($this->from_date == $this->to_date){
	        $strSQL .=" AND (v.vazhipadu_date = '".date('Y-m-d',strtotime($this->from_date))."')";
	      }else{
	        $strSQL .=" AND (v.vazhipadu_date BETWEEN '".date('Y-m-d',strtotime($this->from_date))."' AND '".date('Y-m-d',strtotime($this->to_date))."')";
	      }
	    }

    	$strSQL .= " GROUP BY p.id";
    	$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
    	//echo $strSQL;exit();
    	 mysql_query("SET NAMES utf8");
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		$pooja = array();$i=0;
        if ( mysql_num_rows($rsRES) > 0 ){
			if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
            	$this->total_records = mysql_num_rows($all_rs);
			}
			while ( list ($id,$name,$rate,$date,$quantity) = mysql_fetch_row($rsRES) ){
				$pooja[$i]["id"] =  $id;
				$pooja[$i]["name"] = $name;
				$pooja[$i]["rate"] = $rate;
				$pooja[$i]["date"] = $date;
				$pooja[$i]["total"] = $rate*$quantity;
				$pooja[$i]["quantity"] = $quantity;
				$i++;
			}
			return $pooja;
		} else {
  			return false;
        }
    }


    public function validate()
    {
    	if ( $this->id >0) {
    		$this->get_details();
    		return true;
    	}else{
	    	$strSQL = "SELECT * FROM pooja WHERE name = '".$this->name."'";
	    	$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
	    	if(mysql_num_rows($rsRES) > 0){
	    		$this->error_description = "Pooja already exists";
	    		return false;//pooja exist
	    	}else{
	    		return true;
	    	}
	    }

    }


}



?>