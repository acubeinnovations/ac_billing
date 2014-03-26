<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class User {
    var $connection;
    var $id 			= gINVALID;
    var $username		= "";
    var $password		= "";
    var $first_name 	= "";
    var $last_name		= "";
    var $email			= "";
    var $address		= "";
    var $occupation 	= "";
    var $user_status_id	= "";
    var $password_token="" ; 
    var $user_type_id = "";

	var $activation_token="" ; 
    var $newpasswd=""; 
	var $name 	= "";
	var $phone	= "";	
	var $action = "";
	var $handle = "";
    var $organization_id="";
	var $registration_date="";
    var $exam_ids = "";

    var $error 			= false;
    var $error_number	= gINVALID;
    var $error_description= "";
    //for pagination
    var $total_records	= "";


    function __construct()
    {

    }


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
		$date=date("Y/m/d H.i:s<br>", time());
		
              $strSQL = "INSERT INTO users (username,password,first_name,last_name,email,phone,address,occupation, user_status_id,organization_id,registration_date,activation_token,user_type_id) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->username))."','";
              $strSQL .= md5(addslashes(trim($this->password)))."','";
              $strSQL .= addslashes(trim($this->first_name))."','";
              $strSQL .= addslashes(trim($this->last_name))."','";
              $strSQL .= addslashes(trim($this->email))."','";
	     	  $strSQL .= addslashes(trim($this->phone))."','";
              $strSQL .= addslashes(trim($this->address))."','";
              $strSQL .= addslashes(trim($this->occupation))."','";
              $strSQL .= addslashes(trim($this->user_status_id))."','";
			  $strSQL .= addslashes(trim($this->organization_id))."','";
			  $strSQL .= "$date','";
              $strSQL .= addslashes(trim($this->activation_token))."','";
		      $strSQL .= addslashes(trim($this->user_type_id))."')";
            //echo $strSQL;exit();
			  $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
		    $this->error_description = "Registration Successfull.Check Your Email For Account Activaton Link.If You Do NOt Recieve Any Email Please Contact Our Server Administrator.Thank You.";
                    return true;
              }
              else{
                $this->error_description = "Registration Unsuccessfull.Please Try Again.";
                return false;
              }

        }
        elseif($this->id > 0 ) {
            $strSQL = "UPDATE users SET ";
	    if($this->username!=''){
	    $strSQL .= "username = '".addslashes(trim($this->username))."',";
	    }
            $strSQL .= "first_name = '".addslashes(trim($this->first_name))."',";
            $strSQL .= "last_name = '".addslashes(trim($this->last_name))."',";
	    
	    if($this->user_status_id!=''){
	   
            $strSQL .= "user_status_id = '".addslashes(trim($this->user_status_id))."',";
	    }
	    
            $strSQL .= "phone = '".addslashes(trim($this->phone))."',";
            $strSQL .= "email = '".addslashes(trim($this->email))."',";
            $strSQL .= "user_type_id = '".addslashes(trim($this->user_type_id))."'";
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



    function change_password($newpasswd,$oldpasswd){
                    $strSQL3 = "UPDATE users SET ";
                    $strSQL3 .= "password = NULL";
                    $strSQL3 .= " WHERE id = '" . $this->id ."' AND password = '".mysql_real_escape_string($oldpasswd)."'";
		    $rsRES3 = mysql_query($strSQL3,$this->connection) or die(mysql_error(). $strSQL3 );
		    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL = "UPDATE users SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($newpasswd). "' ";
                    $strSQL .= "WHERE id = '" . $this->id . "'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
                        return true;
                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect password";
                    }
    }
}

    function exist(){
        $strSQL = "SELECT id FROM users WHERE username = '".$this->username."'"; 
  $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$this->id = mysql_result($rsRES,0,'id');
            return true;
        }
        else{
            return false;
        }
    }



    function get_detail(){
		$strcondition='';
        $strSQL = "SELECT * FROM users WHERE id = '".$this->id."'";//
		if($this->organization_id!='' && $this->organization_id!=gINVALID){
		$strcondition=" AND organization_id=".$this->organization_id;
		}
		if($strcondition!=''){
		$strSQL.=$strcondition;
		}
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->first_name = mysql_result($rsRES,0,'first_name');
                $this->last_name= mysql_result($rsRES,0,'last_name');
		
                $this->user_status_id= mysql_result($rsRES,0,'user_status_id');
                $this->email = mysql_result($rsRES,0,'email');
                $this->phone = mysql_result($rsRES,0,'phone');
                $this->address = mysql_result($rsRES,0,'address');
                $this->occupation = mysql_result($rsRES,0,'occupation');
		        $this->registration_date = mysql_result($rsRES,0,'registration_date');
                $this->user_type_id = mysql_result($rsRES,0,'user_type_id');
                
                return true;
        }
        else{
            return false;
        }
    }

function get_detail_by_username(){
        $strSQL = "SELECT * FROM users WHERE username = ".$this->username;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$this->id = mysql_result($rsRES,0,'id');
                $this->first_name = mysql_result($rsRES,0,'first_name');
                $this->last_name= mysql_result($rsRES,0,'last_name');
                $this->email = mysql_result($rsRES,0,'email');
                $this->phone = mysql_result($rsRES,0,'phone');
                $this->address = mysql_result($rsRES,0,'address');
                $this->occupation = mysql_result($rsRES,0,'occupation');
                $this->user_type_id = mysql_result($rsRES,0,'user_type_id');
		
                return true;
        }
        else{
            return false;
        }
    }




function get_array(){
        $users = array();
        $strSQL = "SELECT id,username FROM users ORDER BY username";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$username) = mysql_fetch_row($rsRES) ){
          $users[$id]["name"] = $username;
        }
        return $users;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list users";
        return false;
        }
}



function get_array_username(){
        $users = array();
        $strSQL = "SELECT id,username FROM users ORDER BY username";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$username) = mysql_fetch_row($rsRES) ){
          $users[$id] = $username;
        }
        return $users;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list users";
        return false;
        }
}



function get_users(){
        $users = array();$i=0;
        
        $strSQL = "SELECT id,username FROM users";
        $strSQL_where = "";
        if($this->organization_id !=""){
            $strSQL_where = ($strSQL_where=="")?" organization_id = '".$this->organization_id."'":"";
        }
        if($strSQL_where != ""){
            $strSQL = $strSQL." WHERE".$strSQL_where;
        }
        $strSQL .= " ORDER BY id DESC";//echo $strSQL;exit();
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $users[$i]["id"] = $row["id"];
                $users[$i]["username"] = $row["username"];
                $i++;
            }
            return $users;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Users";
        return false;
        }
}

 function get_array_userstatus()
    {
        $user_status = array();
		
        $strSQL = "SELECT id,name FROM user_statuses ORDER BY name";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            while ( list($id,$name) = mysql_fetch_row($rsRES) ){
				 $user_status[$id] = $name;
               
            }
            return  $user_status;
        }else{
        $this->error_number = 4;
        $this->error_description="Can't list Subjects";
        return false;
        }
	}


function get_list_array(){
        $user_status = array();$i=0;
        $strSQL = "SELECT id,name FROM user_statuses ORDER BY name";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
              $user_status[$i]["id"] = $id;
              $user_status[$i]["name"] = $name;
              $i++;

        }
        return $user_status;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list users";
        return false;
        }
}




    function get_list_array_bylimit($start_record = 0,$max_records = 25){
        $limited_data = array(); 
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT id,username,first_name,last_name,user_status_id,registration_date,email,phone,user_type_id FROM users";
	if($this->id!='' && $this->id!=gINVALID || $this->username!=''|| $this->email!='' || $this->last_name!='' || $this->first_name!='' || $this->phone!=''|| $this->user_status_id!='' || $this->organization_id!=''){
	$strSQL .= " WHERE";
	if($this->id!='' && $this->id!=gINVALID){
            $strSQL .= " id = '".addslashes(trim($this->id))."'";
	}	
	
	if($this->username!=''){
            $strSQL .= " username LIKE '".addslashes(trim($this->username))."%'";
	}
	if($this->email!='' && $this->username!='' ){
		    $strSQL .= " AND email LIKE '".addslashes(trim($this->email))."%'";
	}else{
	if($this->email!=''){
		    $strSQL .= " email LIKE '".addslashes(trim($this->email))."%'";
	}
	}
	if($this->first_name!='' && ($this->email!='' || $this->username!='')){
		    $strSQL .= " AND first_name LIKE '".addslashes(trim($this->first_name))."%'";
	 }else{
	if($this->first_name!=''){
		    $strSQL .= " first_name LIKE '".addslashes(trim($this->first_name))."%'";
	}
	}
	if($this->last_name!='' && ($this->first_name!='' || $this->email!='' || $this->username!='')){
		    $strSQL .= " AND last_name LIKE '".addslashes(trim($this->last_name))."%'";
	 }else{
	if($this->last_name!=''){
		    $strSQL .= " last_name LIKE '".addslashes(trim($this->last_name))."%'";
	}
	}
	if($this->phone!='' &&($this->last_name!='' || $this->first_name!='' || $this->email!='' || $this->username!='')){
		    $strSQL .= " AND phone LIKE '".addslashes(trim($this->phone))."%'";
	 }else{
	if($this->phone!=''){
		    $strSQL .= " phone LIKE '".addslashes(trim($this->phone))."%'";
	}
	}
	if($this->user_status_id!='' && ($this->phone!='' || $this->last_name!='' || $this->first_name!='' ||  $this->email!='' || $this->username!=''))	{
		    $strSQL .= " AND user_status_id = '".addslashes(trim($this->user_status_id))."'";
	 }else{
	if($this->user_status_id!=''){
		    $strSQL .= " user_status_id = '".addslashes(trim($this->user_status_id))."'";
	}
	}
	if($this->organization_id!='' && ($this->user_status_id!='' || $this->phone!='' || $this->last_name!='' || $this->first_name!='' ||  $this->email!='' || $this->username!=''))	{
		    $strSQL .= " AND organization_id = '".addslashes(trim($this->organization_id))."'";
	 }else{
	if($this->organization_id!=''){
		    $strSQL .= " organization_id = '".addslashes(trim($this->organization_id))."'";
	}
	}
         $strSQL .= " ORDER BY username";
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



		    while ( list ($id,$username,$firstname,$lastname,$user_status_id,$registration_date,$email,$phone,$user_type_id) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
		          $limited_data[$i]["username"] = $username;
		          $limited_data[$i]["first_name"] = $firstname;
		          $limited_data[$i]["last_name"] = $lastname;
			  $limited_data[$i]["user_status_id"] = $user_status_id;
			  $limited_data[$i]["registration_date"]=$registration_date;
		          $limited_data[$i]["email"] = $email;                
			   
			  $limited_data[$i]["phone"]=$phone;
              $limited_data[$i]["user_type_id"] = $user_type_id;
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
        $strSQL = " DELETE FROM users WHERE id = '".$this->id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }
        else{
            $this->error_number = 6;
            $this->error_description="Can't delete this User";
            return  false;
        }
    }
}



function check_email(){
	$strSQL = "SELECT id FROM users WHERE username = '".$this->username."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
		$password_token=md5(time());
		$strSQL = "UPDATE users SET ";
                    $strSQL .= "password_token = '$password_token'";
                    $strSQL .= "WHERE username = '" . $this->username. "'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		    return $password_token;
        }
        else{
            return false;
        }

}



function reset_password($newpasswd,$password_token){
		    $strSQL1 = "SELECT id FROM users WHERE password_token ='".$password_token."'";
		    $rsRES1 = mysql_query($strSQL1,$this->connection) or die(mysql_error(). $strSQL1 );
		    if ( mysql_num_rows($rsRES1) > 0 ){
                    $this->id = mysql_result($rsRES1,0,'id');
                    $strSQL3 = "UPDATE users SET ";
                    $strSQL3 .= "password = NULL";
                    $strSQL3 .= " WHERE id = '" . $this->id ."'";
		    $rsRES3 = mysql_query($strSQL3,$this->connection) or die(mysql_error(). $strSQL3 );
		    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL = "UPDATE users SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($newpasswd). "',";
					$strSQL .=  "user_status_id = '".USERSTATUS_ACTIVE."'";
                    $strSQL .= " WHERE password_token = '" . $password_token . "'";
					
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL2 = "UPDATE users SET ";
                    $strSQL2 .= "password_token = 'NULL' ";
                    $strSQL2 .= "WHERE id = '" . $this->id . "'";
                    $rsRES2 = mysql_query($strSQL2,$this->connection) or die(mysql_error(). $strSQL2 );
                    return true;

                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect Token";
                    }
		 }
		else{
			return false;
               		$this->error_description = "Incorrect Token";


		}
	}else{
			return false;
               		$this->error_description = "Incorrect Token";


		}	
    }



function activate_account($activation_token){
		    $strSQL1 = "SELECT id,phone FROM users WHERE activation_token ='".$activation_token."'";
		    $rsRES1 = mysql_query($strSQL1,$this->connection) or die(mysql_error(). $strSQL1 );
		    if ( mysql_num_rows($rsRES1) > 0 ){
                    $this->id = mysql_result($rsRES1,0,'id');
		    $this->phone = mysql_result($rsRES1,0,'phone');
                    $strSQL = "UPDATE users SET ";
                    $strSQL .= "user_status_id =". USERSTATUS_ACTIVE ;
                    $strSQL .= " WHERE activation_token = '" .$activation_token. "'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL2 = "UPDATE users SET ";
                    $strSQL2 .= "activation_token = 'NULL' ";
                    $strSQL2 .= "WHERE id = '" . $this->id . "'";
                    $rsRES2 = mysql_query($strSQL2,$this->connection) or die(mysql_error(). $strSQL2 );
                    return true;

                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect Token";
                    }
		 }
		else{
			return false;
			$this->error_description = "Incorrect Token";
		}

}



function change_user_password(){
                    $strSQL3 = "UPDATE users SET ";
                    $strSQL3 .= "password = NULL";
                    $strSQL3 .= " WHERE id = '" . $this->id ."'";
		    $rsRES3 = mysql_query($strSQL3,$this->connection) or die(mysql_error(). $strSQL3 );
		    if ( mysql_affected_rows($this->connection) > 0 ) {
		    $strSQL = "UPDATE users SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($this->password). "'";
                    $strSQL .= " WHERE id = '" . $this->id ."'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
                        return true;
                    }
                    else{
                        return false;
                        $this->error_description = "Not Changed";
                    }
   		   }else{
                        return false;
                        $this->error_description = "Not Changed";
                    }
}

function insert_mobile_registration(){
		$date=date("Y/m/d H.i:s<br>", time());
		$strSQL = "INSERT INTO users (username, password,first_name, last_name,email,phone,address, occupation, user_status_id,organization_id,registration_date) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->username))."','".md5(addslashes(trim($this->password)))."','','','','','','','".USERSTATUS_ACTIVE."','','$date')";
              
		
              $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();
		    $this->error_description = "Registration Successfull.Check Your Mobile For User Name And Passwword,If You Do NOt Recieve Any sms Please Contact Our Server Administrator.Thank You.";
                    return true;
              }
              else{
                $this->error_description = "Registration Unsuccessfull.Please Try Again.";
                return false;
              }

}


function import_user_csv(){
$date=date("Y/m/d H.i:s<br>", time());
 
           $strSQL = "INSERT INTO users (username, password,first_name, last_name,email,phone,address, occupation, user_status_id,organization_id,registration_date) VALUES('".$this->username."','".md5($this->password)."','','','','','','','".USERSTATUS_ACTIVE."','".$this->organization_id."','$date')"; 
$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
		$this->id = mysql_insert_id();
               return true;
          }else{
              $this->error_number = 3;
              $this->error_description="Can't import";
              return false;
          }
}


    function get_list_array_filter($filter = "")
    {
        $strSQL = "SELECT * FROM users WHERE ".$filter;
        $rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0)
        {
            $limited_data= array();$i=0;
            while ( $row = mysql_fetch_assoc($rsRES) )
            {
                $limited_data[$i]["id"] = $row['id'];
                $limited_data[$i]["username"] = $row['username'];
                $limited_data[$i]["first_name"] = $row['first_name'];
                $limited_data[$i]["last_name"] = $row['last_name'];
                $limited_data[$i]["user_status_id"] = $row['user_status_id'];
                $limited_data[$i]["registration_date"]= $row['registration_date'];
                $limited_data[$i]["email"] = $row['email'];
                $limited_data[$i]["phone"]=$row['phone'];
                $limited_data[$i]["user_type_id"]=$row['user_type_id'];
                $i++;
            }
            return $limited_data;
        }
        else
        {
            return false;
        }
    }


    public function get_list_user_types()
    {
        $user_types = array();$i=0;
        $strSQL = "SELECT id,name FROM user_types";
        $rsRES  = mysql_query($strSQL,$this->connection) or die(mysql_error().$strSQL);
        if(mysql_num_rows($rsRES) > 0)
        {
            while(list($id,$name) = mysql_fetch_row($rsRES)){
                $user_types[$i]['id'] = $id;
                $user_types[$i]['name'] = $name;
                $i++;
            }
            return $user_types;
        }else{
            return false;
        }
    }


}
?>
