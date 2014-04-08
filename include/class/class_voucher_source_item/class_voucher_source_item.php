<?php
if(!defined('CHECK_INCLUDED')){
exit();
}

Class VoucherSourceItem{

  var $id=gINVALID;
  var $name="";
  var $voucher_type = gINVALID;
  

  var $error = false;
  var $error_number=gINVALID;
  var $error_description="";
  var $total_records='';
    
 

  function get_list_array()
  {
    $list = array();$i=0;
    $strSQL = "SELECT id,name FROM `voucher_source_items`";
   
    
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 )
    {
      while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
        $list[$i]["id"] =  $id;
        $list[$i]["name"] = $name;
       
        $i++;
      } 
      return $list;
    }else{    
      $this->error_number = 4;
      $this->error_description="Can't list data";
      return false;
    }
  }


  function get_filtered_list_array($voucher_type = -1)
  {
    $list = array();$i=0;
    $strSQL = "SELECT id,name FROM `voucher_source_items` WHERE 1";
    if($voucher_type > 0){
      $strSQL .= " AND voucher_type = '".$voucher_type."'";
    }
   
    
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 )
    {
      while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
        $list[$i]["id"] =  $id;
        $list[$i]["name"] = $name;
       
        $i++;
      } 
      return $list;
    }else{    
      $this->error_number = 4;
      $this->error_description="Can't list data";
      return false;
    }
  }

  


}





?>