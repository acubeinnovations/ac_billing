<?php
if(!defined('CHECK_INCLUDED')){
exit();
}

Class Currency{

  var $id=gINVALID;
  var $name="";
  var $symbol="";
  var $default = "";

  var $default_currency_id= gINVALID;
  var $default_currency_name = "";
  var $default_currency_symbol = "";

  var $error = false;
  var $error_number=gINVALID;
  var $error_description="";
  var $total_records='';
    
  public function __construct($connection)
  {
      $strSQL = "SELECT * FROM `currency` WHERE `default` = '".DEFAULT_TRUE."'";
      $rsRES = mysql_query($strSQL,$connection) or die(mysql_error(). $strSQL );
      if ( mysql_num_rows($rsRES) > 0 )
      {
        $row = mysql_fetch_assoc($rsRES);
        $this->default_currency_id = $row['id'];
        $this->default_currency_name = $row['name'];
        $this->default_currency_symbol = $row['symbol'];
      }
  }

  function get_list_array()
  {
    $currency = array();$i=0;
    $strSQL = "SELECT * FROM `currency` WHERE `default` = '".DEFAULT_FALSE."'";
   
    
    $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    if ( mysql_num_rows($rsRES) > 0 )
    {
      while ( list ($id,$name,$symbol) = mysql_fetch_row($rsRES) ){
        $currency[$i]["id"] =  $id;
        $currency[$i]["name"] = $name;
        $currency[$i]["symbol"] = $symbol;
        $i++;
      } 
      return $currency;
    }else{    
      $this->error_number = 4;
      $this->error_description="Can't list currencies";
      return false;
    }
  }

  


}





?>