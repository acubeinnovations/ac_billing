<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class User_testimonials {
    var $connection;
    var $id 			= gINVALID;
    var $user_id		= "";
    var $total_records ="";
    var $status_id	= "";
    var $testimonial	="" ; 
	var $tdate= "";


    function __construct()
    {

    }


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
		$date=date("Y/m/d H.i:s<br>", time());
		
              $strSQL = "INSERT INTO user_testimonials (user_id, status_id,testimonial,date) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->user_id))."','";
              $strSQL .= addslashes(trim($this->status_id))."','";
              $strSQL .= addslashes(trim($this->testimonial))."','";
              $strSQL .= $date."')";
		      $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
		    return true;
              }
              else{
               
                return false;
              }

        }
        elseif($this->id > 0 ) {
            $strSQL = "UPDATE user_testimonials SET ";
	     if($this->status_id!=''){
            $strSQL .= "status_id = '".addslashes(trim($this->status_id))."'";
		}
		if($this->testimonial!=''){
            $strSQL .= ",testimonial = '".addslashes(trim($this->testimonial))."'";
		}	
	    $strSQL .= " WHERE id = ".$this->id;
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
		$this->error_description = "Updated data Successfuly";                    
		return true;
            }
            else{
                $this->error_description = "Update data Failed";
                return false;
            }
        }

    }





    function get_detail(){
        $strSQL = "SELECT * FROM user_testimonials WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->user_id = mysql_result($rsRES,0,'user_id');
                $this->status_id = mysql_result($rsRES,0,'status_id');
                $this->testimonial= mysql_result($rsRES,0,'testimonial');
		$this->tdate = mysql_result($rsRES,0,'date');
                
                return true;
        }
        else{
            return false;
        }
    }


    function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT * FROM user_testimonials";
	if($this->id!='' && $this->id!=gINVALID || $this->user_id!=''|| $this->status_id!='' || $this->testimonial!='' || $this->tdate!=''){
	$strSQL .= " WHERE";
	if($this->id!='' && $this->id!=gINVALID){
            $strSQL .= " id = '".addslashes(trim($this->id))."'";
	}	
	
	if($this->user_id!=''){
            $strSQL .= " user_id LIKE '".addslashes(trim($this->user_id))."%'";
	}
	if($this->testimonial!='' && $this->user_id!='' ){
		    $strSQL .= " AND testimonial LIKE '".addslashes(trim($this->testimonial))."%'";
	}else{
	if($this->testimonial!=''){
		    $strSQL .= " testimonial LIKE '".addslashes(trim($this->testimonial))."%'";
	}
	}
	if($this->tdate!='' && ($this->testimonial!='' || $this->user_id!='')){
		    $strSQL .= " AND date LIKE '".addslashes(trim($this->tdate))."%'";
	 }else{
	if($this->tdate!=''){
		    $strSQL .= " date LIKE '%".addslashes(trim($this->tdate))."%'";
	}
	}
	if($this->status_id!='' && ($this->tdate!='' || $this->testimonial!='' || $this->user_id!=''))	{
		    $strSQL .= " AND status_id = '".addslashes(trim($this->status_id))."'";
	 }else{
	if($this->status_id!=''){
		    $strSQL .= " status_id = '".addslashes(trim($this->status_id))."'";
	}
	}
	
         $strSQL .= " ORDER BY id DESC";
	}
	$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
            } else {
				
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }



		    while ( list ($id,$user_id,$status_id,$testimonial,$date) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
		          $limited_data[$i]["user_id"] = $user_id;
		          $limited_data[$i]["status_id"] = $status_id;
		          
			  $limited_data[$i]["testimonial"] = $testimonial;
			  	$limited_data[$i]["date"] = $date;
			  $i++;
		    }
        	return $limited_data;
        }
        else{
        	return false;
        }
    }





function delete(){
    if($this->id > 0 ) {
        $strSQL = " DELETE FROM user_testimonials WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't delete this testimonials";
            return  false;
        }
    }
}

function get_array_statuses(){
        $statuses = array();
		
        $strSQL = "SELECT id,name FROM statuses ORDER BY name";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				 $statuses[$id] = $name;
               
            }
            return  $statuses;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}





}
?>
