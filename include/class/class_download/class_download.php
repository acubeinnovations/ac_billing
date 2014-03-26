<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

class Download {
    var $connection;
    var $id = gINVALID;
    var $name = "";
	var $date  = "" ;
	var $description  = "" ;
	var $file  = "" ;
	var $status_id  = gINVALID ;
	var $created  = "" ;
	var $updated  = "" ;
	var $record_user_id= "" ;


    var $error_number=gINVALID;
    var $error_description="";
    //for pagination
    var $total_records = "";

function __construct($connection){
    $this->connection = $connection;
}
function get_id(){
    $strSQL = "SELECT id, name, date,    description,  file,  status_id,  created,  updated,  record_user_id  FROM downloads WHERE name = '".$this->name."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->date = mysql_result($rsRES,0,'date');
        $this->description = mysql_result($rsRES,0,'description');
        $this->file = mysql_result($rsRES,0,'file');
        $this->status_id = mysql_result($rsRES,0,'status_id');
        $this->created = mysql_result($rsRES,0,'created');
        $this->updated = mysql_result($rsRES,0,'updated');
        $this->record_user_id = mysql_result($rsRES,0,'record_user_id');
        return $this->id;
    }
    else{
    $this->error_number = 1;
    $this->error_description="This File doesn't exist";
    return false;
    }
}
function get_detail(){
    $strSQL = "SELECT id,name, date, description,  file,  status_id,  created,  updated,  record_user_id FROM downloads WHERE id = '".$this->id."'";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_num_rows($rsRES) > 0 ){
        $this->id = mysql_result($rsRES,0,'id');
        $this->name = mysql_result($rsRES,0,'name');
        $this->date = mysql_result($rsRES,0,'date');
        $this->description = mysql_result($rsRES,0,'description');
        $this->file = mysql_result($rsRES,0,'file');
        $this->status_id = mysql_result($rsRES,0,'status_id');
        $this->created = mysql_result($rsRES,0,'created');
        $this->updated = mysql_result($rsRES,0,'updated');
        $this->record_user_id = mysql_result($rsRES,0,'record_user_id');
        return $this->id;
    }
    else{
    $this->error_number = 2;
    $this->error_description="This File doesn't exist";
    return false;
    }
}
function update(){
    if ( $this->id == "" || $this->id == gINVALID) {
    $strSQL = "INSERT INTO downloads (name, date,  description,  file,  status_id, created,  updated,  record_user_id) VALUES ('";
    $strSQL .= addslashes(trim($this->name)) . "','";
    $strSQL .= addslashes(trim($this->date)) . "','";
    $strSQL .= addslashes(trim($this->description)) . "','";
    $strSQL .= addslashes(trim($this->file)) . "','";
    $strSQL .= addslashes(trim($this->status_id)) . "','";
    $strSQL .= addslashes(trim($this->created)) . "','";
    $strSQL .= addslashes(trim($this->updated)) . "','";
    $strSQL .= addslashes(trim($this->record_user_id)) . "')";
    $rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
    if ( mysql_affected_rows($this->connection) > 0 ) {
        $this->id = mysql_insert_id();
        return $this->id;
    }
    else{
        $this->error_number = 3;
        $this->error_description="Can't insert this file";
        return false;
    }
    }
    elseif($this->id > 0 ) {
    $strSQL = "UPDATE downloads SET name = '".addslashes(trim($this->name))."',";
    $strSQL .= " date = '".addslashes(trim($this->date))."',";
    $strSQL .= " description = '".addslashes(trim($this->description))."',";
    $strSQL .= " file = '".addslashes(trim($this->file))."',";
    $strSQL .= " status_id = '".addslashes(trim($this->status_id))."',";
    $strSQL .= " created = '".addslashes(trim($this->created))."',";
    $strSQL .= " updated = '".addslashes(trim($this->updated))."' ";
    $strSQL .= " WHERE id = ".$this->id;
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                    return true;
            }
            else{
                $this->error_number = 3;
                $this->error_description="Can't update this file";
                return false;
            }
    }
}

function get_list_array(){
        $downloads = array();$i=0;
        $strSQL = "SELECT id, name, date,  description,  file,  status_id,  created,  updated,  record_user_id FROM downloads ORDER BY name";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
        while ( list ($id, $name, $date, $description,  $file,  $status_id,  $gallery_id,  $created,  $updated,  $record_user_id) = mysql_fetch_row($rsRES) ){
              $downloads[$i]["id"] = $id;
              $downloads[$i]["name"] = $name;
              $downloads[$i]["date"] = $date;
              $downloads[$i]["description"] = $description;
              $downloads[$i]["file"] = $file;
              $downloads[$i]["status_id"] = $status_id;
              $downloads[$i]["created"] = $created;
              $downloads[$i]["updated"] = $updated;
              $downloads[$i]["record_user_id"] = $record_user_id;
              $i++;
        }
        return $downloads;
        }
        else{
        $this->error_number = 4;
        $this->error_description="Can't list files";
        return false;
        }
}
function get_list_array_bylimit($search_string = "",$status_id = gINVALID ,$start_record = 0,$max_records = 25){

        $limited_data = array();
        $i=0;
        $str_condition = "";

        $strSQL = "SELECT id,name,  date,  description,  file,  status_id,  created,  updated,  record_user_id FROM downloads WHERE 1 ";
        if ( trim($search_string) != "" ) {
            $str_condition .= " AND CONCAT(name,' ', description, ' ', file) LIKE '%" . $search_string . "%'" ;
        }
     
        if ( trim($status_id) != "" && trim($status_id) != gINVALID ) {
            $str_condition .= " AND status_id =  '" . $status_id . "'" ;
        }
     
            $strSQL .=  $str_condition . "  ORDER BY name";
        
        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
            if (trim($this->total_records)!="" && $this->total_records > 0) {
                
            } else {
                $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
                $this->total_records = mysql_num_rows($all_rs);
            }
    
            while ( $row = mysql_fetch_assoc($rsRES) ){
                $limited_data[$i]["id"] = $row["id"];
                $limited_data[$i]["name"] = $row["name"];
                $limited_data[$i]["date"] = $row["date"];
                $limited_data[$i]["description"] = $row["description"];
                $limited_data[$i]["file"] = $row["file"];
                $limited_data[$i]["status_id"] = $row["status_id"];
                $limited_data[$i]["created"] = $row["created"];
                $limited_data[$i]["updated"] = $row["updated"];
                $limited_data[$i]["record_user_id"] = $row["record_user_id"];
                $i++;
            }
            return $limited_data;
        }else{
            $this->error_number = 5;
            $this->error_description="Can't get limited data";
            return false;
        }
}
}
?>
