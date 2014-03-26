<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Administrator {
    var $connection;
    var $id = gINVALID;
    var $username;
    var $password;
    var $emailid;
    var $registrationdate;
    var $lastlogin;
    var $securityquestion_id = gINVALID;
    var $answer = "";

    var $created = "";
    var $updated = "";
    var $record_user_id= gINVALID;

    var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

    function __construct()
    {

    }


    function update(){
        if ( $this->id == "" || $this->id == gINVALID) {
              $strSQL = "INSERT INTO administrators (username,password,emailid,registrationdate,securityquestion_id,answer,created) ";
              $strSQL .= "VALUES ('".addslashes(trim($this->username))."','";
              $strSQL .= md5(addslashes(trim($this->password)))."','";
              $strSQL .= addslashes(trim($this->emailid))."',";
              $strSQL .= "now(),";
              $strSQL .= addslashes(trim($this->securityquestion_id)).",'";
              $strSQL .= addslashes(trim($this->answer))."',";
              $strSQL .= "now())";

              $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();;
                    return true;
              }
              else{
                $this->error_description = "Insert data Failed";
                return false;
              }

        }
        elseif($this->id > 0 ) {
            $strSQL = "UPDATE administrators SET ";
            $strSQL .= "emailid = '".addslashes(trim($this->emailid))."',";
            $strSQL .= "securityquestion_id = '".addslashes(trim($this->securityquestion_id))."',";
            $strSQL .= "answer = '".addslashes(trim($this->answer))."',";
            $strSQL .= "updated = now(), ";
			$strSQL .= "record_user_id = '".addslashes(trim($this->record_user_id))."'";
            $strSQL .= " WHERE id = ".$this->id;
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_description = "Update data Failed";
                return false;
            }
        }

    }



    function change_password($newpasswd,$oldpasswd){
                    $strSQL = "UPDATE administrators SET ";
                    $strSQL .= "password = '" .mysql_real_escape_string($newpasswd). "' ";
                    $strSQL .= "WHERE id = '" . $this->id . "' AND password = '".mysql_real_escape_string($oldpasswd)."'";
                    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                    if ( mysql_affected_rows($this->connection) > 0 ) {
                        return true;
                    }
                    else{
                        return false;
                        $this->error_description = "Incorrect password";
                    }
    }


    function exist(){
        $strSQL = "SELECT 1 FROM administrators WHERE username = '".$this->username."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
            return true;
        }
        else{
            return false;
        }
    }



    function get_detail(){
        $strSQL = "SELECT * FROM administrators WHERE id = ".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');
                $this->username = mysql_result($rsRES,0,'username');
                $this->emailid = mysql_result($rsRES,0,'emailid');
                $this->registrationdate = mysql_result($rsRES,0,'registrationdate');
                $this->lastlogin = mysql_result($rsRES,0,'lastlogin');
                $this->securityquestion_id = mysql_result($rsRES,0,'securityquestion_id');
                $this->answer = mysql_result($rsRES,0,'answer');
                return true;
        }
        else{
            return false;
        }
    }




    function get_list_array_bylimit($username,$start_record = 0,$max_records = 25){
        $limited_data = array();$i=0;
        $strSQL = "SELECT id,username,emailid,registrationdate FROM administrators WHERE 1 ";

        if ($username != "" ) {
                $str_condition .= " AND username  LIKE '%" . $username . "%' " ;
         }
 
		$strSQL .= $str_condition . "  ";

		$strSQL .= "ORDER BY username";

		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){
		    while ( list ($id,$username,$emailid,$registrationdate,$image) = mysql_fetch_row($rsRES) ){
		          $limited_data[$i]["id"] = $id;
		          $limited_data[$i]["username"] = $username;
		          $limited_data[$i]["emailid"] = $emailid;
		          $registrationdate = date('m/d/Y', strtotime($registrationdate));
		          $limited_data[$i]["registrationdate"] = $registrationdate;
		          $i++;
		    }
        	return $limited_data;
        }
        else{
        	return false;
        }
    }


}
?>
