<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


Class Vazhipadu{

  var $vazhipadu_id = gINVALID;
  var $vazhipadu_rpt_number = '';
  var $vazhipadu_date = '';
  var $star_id = gINVALID;
  var $pooja_id = gINVALID;
  var $name = '';
  var $age="";
  var $quantity = 1;
  var $amount = '';
  var $deleted = NOT_DELETED;

  var $pooja_description = "";

  var $from_date = "";
  var $to_date = "";

  var $error = false;
  var $error_number=gINVALID;
  var $error_description="";
  var $total_records='';


  function update($dataArray = array())
  {

    if ( $this->vazhipadu_id == "" || $this->vazhipadu_id == gINVALID) {
      if($dataArray){
        $strSQL = "INSERT INTO vazhipadu(vazhipadu_rpt_number,vazhipadu_date,star_id,pooja_id,name,quantity,amount,deleted) VALUES";
        for($i=0; $i<count($dataArray); $i++)
        {
          $nameData = $dataArray[$i]['name'];
          $starData = $dataArray[$i]['star_id'];

          $strSQL .= "('".addslashes(trim($this->vazhipadu_rpt_number))."',";
          $strSQL .= "'".date('Y-m-d',strtotime($this->vazhipadu_date))."',";
          $strSQL .= "'".addslashes(trim($starData))."',";
          $strSQL .= "'".addslashes(trim($this->pooja_id))."',";
          $strSQL .= "'".addslashes($nameData)."',";          
          $strSQL .= "'".addslashes(trim($this->quantity))."',";
          $strSQL .= "'".addslashes(trim($this->amount))."',";
          $strSQL .= "'".addslashes(trim($this->deleted))."'),";
        }
      }else{
        $strSQL = "INSERT INTO vazhipadu(vazhipadu_rpt_number,vazhipadu_date,star_id,pooja_id,name,quantity,amount,deleted) VALUES";
        $strSQL .= "('".addslashes(trim($this->vazhipadu_rpt_number))."',";
        $strSQL .= "'".date('Y-m-d',strtotime($this->vazhipadu_date))."',";
        $strSQL .= "'".addslashes(trim($this->star_id))."',";
        $strSQL .= "'".addslashes(trim($this->pooja_id))."',";
        $strSQL .= "'".addslashes($this->name)."',";
        $strSQL .= "'".addslashes(trim($this->quantity))."',";
        $strSQL .= "'".addslashes(trim($this->amount))."',";
        $strSQL .= "'".addslashes(trim($this->deleted))."'),";
      }
     // echo $strSQL;exit();
       mysql_query("SET NAMES utf8");
      $rsRES = mysql_query(substr($strSQL, 0,-1),$this->connection) or die ( mysql_error() . $strSQL );

      if ( mysql_affected_rows($this->connection) > 0 ) {
        $this->vazhipadu_id = mysql_insert_id();
        return $this->vazhipadu_id;
      }else{
        $this->error_number = 3;
        $this->error_description="Can't insert vazhipadu ";
        return false;
      }
  }

}
  
  public function getRptNumber($vazhipadu_id = gINVALID)
  {
    if($vazhipadu_id >0){
        $strSQL = "SELECT vazhipadu_rpt_number as rpt_number FROM vazhipadu WHERE vazhipadu_id = '".$vazhipadu_id."'";
         mysql_query("SET NAMES utf8");
        $rsRES  = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
        $row    = mysql_fetch_assoc($rsRES);
        if($row['rpt_number']){
          return $row['rpt_number'];
        }else{
           return false;
        }
    }else{
      return false;
    }
    
  }

 







  



  public function get_vazhipadu_details()
  {
      if($this->vazhipadu_rpt_number != ""){
        $strSQL =" SELECT v.vazhipadu_id,v.vazhipadu_date,v.vazhipadu_rpt_number,v.name AS name,v.age AS age,p.name AS pooja,p.rate,s.name AS star FROM vazhipadu v";
        $strSQL .= " LEFT JOIN pooja p ON p.id = v.pooja_id";
        $strSQL .= " LEFT JOIN stars s ON s.id = v.star_id";
         $strSQL .=" WHERE v.deleted ='".NOT_DELETED."' AND v.vazhipadu_rpt_number = '".$this->vazhipadu_rpt_number."'";

         //echo $strSQL;exit();
          mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
          $vazhipadu = array();$i=0;
          while($row = mysql_fetch_assoc($rsRES)){
            
            $this->vazhipadu_date    = date('d-m-Y',strtotime($row['vazhipadu_date']));
            $this->pooja_description = $row['pooja'];
            $this->vazhipadu_rpt_number = $row['vazhipadu_rpt_number'];

            $vazhipadu[$i]['vazhipadu_id']    = $row['vazhipadu_id'];
            $vazhipadu[$i]['name']            = $row['name'];
            $vazhipadu[$i]['age']             = $row['age'];
            $vazhipadu[$i]['star']            = $row['star'];
            $vazhipadu[$i]['rate']            = $row['rate'];
            $i++;
          }
          return $vazhipadu;
        }else{
          $this->error_description = "No Records found";
          return false;
        }
      }
  }

  function get_filter_array_by_limit($start_record = 0,$max_records = 25,$dataArray = array())
  {
    $vazhipadu = array();$i=0;
    $strSQL = "SELECT  v.vazhipadu_rpt_number,v.vazhipadu_date,v.amount,p.name as pooja_name,sum(quantity) as quantity FROM vazhipadu v";
    $strSQL .=" LEFT JOIN pooja p ON p.id=v.pooja_id ";
    $strSQL .= " WHERE v.deleted ='".NOT_DELETED."'";

    if($this->vazhipadu_date != ""){
      $strSQL .=" AND vazhipadu_date = '".date('Y-m-d',strtotime($this->vazhipadu_date))."'";
    }else if(isset($dataArray['from_date']) and isset($dataArray['to_date'])){
      $this->from_date = date('Y-m-d',strtotime($dataArray['from_date']));
      $this->to_date = date('Y-m-d',strtotime($dataArray['to_date']));
      $strSQL .=" AND (vazhipadu_date BETWEEN '".$this->from_date."' AND '".$this->to_date."')";
    }

    if($this->vazhipadu_rpt_number != ""){
      $strSQL .=" AND vazhipadu_rpt_number = '".mysql_real_escape_string($this->vazhipadu_rpt_number)."'";
    }
  
    $strSQL .= " GROUP BY vazhipadu_rpt_number";
    $strSQL .= " ORDER BY vazhipadu_rpt_number";
    //echo $strSQL;exit();
   
    $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
     mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

    if ( mysql_num_rows($rsRES) > 0 )
    {
      if (trim($this->total_records)!="" && $this->total_records > 0) {
      } else {
        $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
        $this->total_records = mysql_num_rows($all_rs);
      }

        while ( $row = mysql_fetch_assoc($rsRES) ){

          $strSQL_dtl = "SELECT v.name,v.star_id,s.name FROM vazhipadu v LEFT JOIN stars s ON s.id=v.star_id WHERE v.deleted = '".NOT_DELETED."' AND vazhipadu_rpt_number = '".$row['vazhipadu_rpt_number']."'";
           mysql_query("SET NAMES utf8");
           //echo  $strSQL_dtl;exit();
          $rsRES_dtl = mysql_query($strSQL_dtl,$this->connection) or die(mysql_error(). $strSQL_dtl );

          if ( mysql_num_rows($rsRES_dtl) > 0 )
          {
            $dtlArray = array();$j=0;
            while ( list($name,$star_id,$star) = mysql_fetch_row($rsRES_dtl) ){
              if($name!="" and $star_id >0){
                $dtlArray[$j]['name'] = $name;
                $dtlArray[$j]['star'] = $name;
                $j++;
              }
            }
            $vazhipadu[$i]["details"] = $dtlArray;
          }else{
            $vazhipadu[$i]["details"] = false;
          }

          $vazhipadu[$i]["vazhipadu_rpt_number"] = $row['vazhipadu_rpt_number'];
          $vazhipadu[$i]["vazhipadu_date"] = date('d-m-Y',strtotime($row['vazhipadu_date']));
          $vazhipadu[$i]["quantity"] = $row['quantity'];
          $vazhipadu[$i]["unit_rate"] = $row['amount'];
          $vazhipadu[$i]["amount"] = $row['amount']*$row['quantity'];
          $vazhipadu[$i]["pooja_name"] = $row['pooja_name'];
          $i++;
        } 
        return $vazhipadu;
      }else{    
        $this->error_number = 4;
        $this->error_description="Can't list vazhipadu";
        return false;
      }
  }

  function get_array_by_limit($start_record = 0,$max_records = 25,$dataArray = array())
  {
    $vazhipadu = array();$i=0;
    $strSQL = "SELECT v.vazhipadu_id,v.vazhipadu_rpt_number,v.vazhipadu_date,v.amount,v.name,s.name as star_name,p.name as pooja_name FROM vazhipadu v";
    $strSQL .=" LEFT JOIN pooja p ON p.id=v.pooja_id ";
    $strSQL .=" LEFT JOIN stars s ON s.id=v.star_id ";
    $strSQL .= " WHERE v.deleted ='".NOT_DELETED."'";
    if($this->from_date != "" and $this->to_date != ""){
      if($this->from_date == $this->to_date){
        $strSQL .=" AND (v.vazhipadu_date = '".date('Y-m-d',strtotime($this->from_date))."')";
      }else{
        $strSQL .=" AND (v.vazhipadu_date BETWEEN '".date('Y-m-d',strtotime($this->from_date))."' AND '".date('Y-m-d',strtotime($this->to_date))."')";
      }
    }
   // $strSQL .= " GROUP BY vazhipadu_rpt_number";
    $strSQL .= " ORDER BY vazhipadu_rpt_number";
    //echo $strSQL;exit();
   
    $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
     mysql_query("SET NAMES utf8");
    $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

    if ( mysql_num_rows($rsRES) > 0 )
    {
      if (trim($this->total_records)!="" && $this->total_records > 0) {
      } else {
        $all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
        $this->total_records = mysql_num_rows($all_rs);
      }

        while ( $row = mysql_fetch_assoc($rsRES) ){
          $vazhipadu[$i]["vazhipadu_id"] = $row['vazhipadu_id'];
          $vazhipadu[$i]["vazhipadu_rpt_number"] = $row['vazhipadu_rpt_number'];
          $vazhipadu[$i]["vazhipadu_date"] = date('d-m-Y',strtotime($row['vazhipadu_date']));
          $vazhipadu[$i]["unit_rate"] = $row['amount'];
          $vazhipadu[$i]["name"] = $row['name']; 
          $vazhipadu[$i]["pooja_name"] = $row['pooja_name'];
          $vazhipadu[$i]["star_name"] = $row['star_name'];          
          $i++;
        } 
        return $vazhipadu;
      }else{    
        $this->error_number = 4;
        $this->error_description="Can't list vazhipadu";
        return false;
      }
  }


  public function cancelVazhipadu()
  {
    if($this->vazhipadu_rpt_number != ''){
      $strSQL = "UPDATE vazhipadu SET deleted = '".DELETED."' WHERE vazhipadu_rpt_number = '".$this->vazhipadu_rpt_number."'";
      $rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
      if ( mysql_affected_rows($this->connection) > 0 ) {
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
