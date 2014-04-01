<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class ReportFeature{

	var $connection 		= "";
	var $feature_id 		=  gINVALID; 
	var $report_id 			= gINVALID; 
	var $ledger_master_id 	= gINVALID;
	var $sub_ledgers 		= "";
	var $position 			= "";
	var $sort_order 		= "";
	var $status 			= STATUS_INACTIVE;

	

	var $error = false;
    var $error_number=gINVALID;
    var $error_description="";
    var $total_records='';

     var $current_fy_id = gINVALID;
    public function __construct($connection)
    {
        $strSQL = "SELECT * FROM account_settings WHERE id = '1'";
        $rsRES = mysql_query($strSQL,$connection) or die(mysql_error(). $strSQL );
        if(mysql_num_rows($rsRES) > 0){
            $row = mysql_fetch_assoc($rsRES);
            $this->current_fy_id =$row['current_fy_id'];
            //echo $this->current_fy_id;exit();
        }else{
            header("Location:ac_account_settings.php");exit();
        }
    }

    public function insert_batch($dataArray = array())
    {
        $strSQL_exist = "SELECT * FROM report_feature WHERE report_id = '".$this->report_id."'";
        $rsRES_exist = mysql_query($strSQL_exist,$this->connection) or die ( mysql_error() . $strSQL_exist );
        if(mysql_num_rows($rsRES_exist) > 0){
            $strSQL_delete = "DELETE FROM report_feature WHERE report_id = '".$this->report_id."'";
            $rsRES_delete = mysql_query($strSQL_delete,$this->connection) or die ( mysql_error() . $strSQL_delete );
        }

    	if(count($dataArray) > 0){
    		$strSQL= "INSERT INTO report_feature(report_id,ledger_master_id,sub_ledgers,position,sort_order,status) VALUES";
			$i=0;
			while($i<count($dataArray)){
				$strSQL.= "('";
				$strSQL.= mysql_real_escape_string($this->report_id)."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['ledger_master_id'])."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['sub_ledgers'])."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['position'])."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['sort_order'])."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['status'])."'),";
				$i++;
			}
			$strSQL = substr($strSQL,0,-1);//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );
			if ( mysql_affected_rows($this->connection) > 0 ) {
				return mysql_affected_rows($this->connection);
			}else{
				return false;
			}			
    	}else{
    		return false;
    	}

    }

    

   

    public function getFeatures()
    {
    	if ( $this->report_id != "" || $this->report_id != gINVALID) {
    		$features = array();$i=0;
    		$strSQL = "SELECT RF.feature_id,RF.report_id,RF.ledger_master_id,RF.sub_ledgers,RF.position,RF.sort_order,LM.ledger_name AS ledger_master_name FROM report_feature RF";
    		$strSQL .= " LEFT JOIN ledger_master LM ON LM.ledger_id = RF.ledger_master_id";


    		$strSQL .= " WHERE RF.report_id = '".$this->report_id."' AND RF.status = '".STATUS_ACTIVE."' AND RF.position = '".$this->position."'";
            $strSQL .= " ORDER BY LM.ledger_id";

            mysql_query("SET NAMES utf8");    		
    		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    		if(mysql_num_rows($rsRES) > 0){
    			while($row = mysql_fetch_assoc($rsRES)){

    				$features[$i]['feature_id'] 		= $row['feature_id'];
    				$features[$i]['report_id'] 			= $row['report_id'];
    				$features[$i]['ledger_master_id'] 	= $row['ledger_master_id'];
    				$features[$i]['ledger_master_name'] = $row['ledger_master_name'];
    				$features[$i]['sub_ledgers'] 		= $row['sub_ledgers'];
    				$features[$i]['position'] 			= $row['position'];
    				$features[$i]['sort_order'] 		= $row['sort_order'];


					
    				$sub_ledgers = $row['sub_ledgers'];
					if(trim($sub_ledgers) == "" OR trim($sub_ledgers) == "null" ){
						$sub_ledgers =  "SELECT ledger_sub_id from ledger_sub WHERE ledger_id ='".$row['ledger_master_id']."'";
					}else{
						// Do Noting
					}

                    $strSQL_sub = "SELECT ls.ledger_sub_id,ls.ledger_sub_name, (SELECT SUM(account_debit) FROM account_master   WHERE fy_id = '".$this->current_fy_id."' AND ref_ledger = ledger_sub_id AND deleted = '".NOT_DELETED."' ) AS debit,(SELECT SUM(account_credit) FROM account_master   WHERE  fy_id = '".$this->current_fy_id."' AND ref_ledger = ledger_sub_id AND deleted = '".NOT_DELETED."') AS credit";
                    $strSQL_sub .= " FROM ledger_sub ls";
                    $strSQL_sub .= " WHERE ls.ledger_sub_id IN(SELECT ledger_sub_id FROM fy_ledger_sub WHERE fy_id = '".$this->current_fy_id."') AND ls.ledger_sub_id IN(".$sub_ledgers.")";

                    $strSQL_sub .= " ORDER BY ls.ledger_sub_name";

                   // echo $strSQL_sub;exit();

    				$rsRES_sub = mysql_query($strSQL_sub,$this->connection) or die(mysql_error(). $strSQL_sub );
    				$sub_ledger = array();$j=0;
    				$master_balance = 0;
    				if(mysql_num_rows($rsRES_sub) > 0){
    					while($row_sub = mysql_fetch_assoc($rsRES_sub)){
    						$sub_ledger[$j]['ledger_sub_id'] = $row_sub['ledger_sub_id'];
    						$sub_ledger[$j]['ledger_sub_name'] = $row_sub['ledger_sub_name'];
    						$sub_ledger[$j]['balance'] = abs($row_sub['debit']-$row_sub['credit']);
    						$master_balance += $sub_ledger[$j]['balance'];
    						$j++;
    					}
    				}
    				$features[$i]['balance'] = abs($master_balance);
    				$features[$i]['sub_ledger_details'] = $sub_ledger;
    				$i++;
    			}
    		}

    		return $features;
    	}else{
    		$this->error_description = "Invalid Report";
    		return false;
    	}
    }

    public function get_details_with_report()
    {
        $strSQL = "SELECT RF.*,LM.ledger_name FROM report_feature RF";
        $strSQL .= " LEFT JOIN ledger_master LM ON LM.ledger_id = RF.ledger_master_id";
        $strSQL .= " WHERE RF.report_id = '".$this->report_id."'";
        //echo $strSQL;exit();
        mysql_query("SET NAMES utf8");
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        $features = array();$i=0;
        if(mysql_num_rows($rsRES) > 0){
            while($row = mysql_fetch_assoc($rsRES)){
                $sub_ledgers = $row['sub_ledgers'];
                $strSQL_sub = "SELECT ledger_sub_id,ledger_sub_name FROM ledger_sub WHERE ledger_sub_id IN(".$sub_ledgers.")";
                $rsRES_sub = mysql_query($strSQL_sub,$this->connection) or die(mysql_error(). $strSQL_sub );
                $sub_ledger = array();$j=0;
                if(mysql_num_rows($rsRES_sub) > 0){
                    while(list($id,$name) = mysql_fetch_row($rsRES_sub)){
                        $sub_ledger[$id] = $name;
                    }
                }


                $features[$i]['feature_id'] = $row['feature_id'];
                $features[$i]['report_id'] = $row['report_id'];
                $features[$i]['ledger_master_id'] = $row['ledger_master_id'];
                 $features[$i]['ledger_master_name'] = $row['ledger_name'];
                $features[$i]['sub_ledgers'] = $sub_ledger;

                $features[$i]['position'] = $row['position'];
                $features[$i]['sort_order'] = $row['sort_order'];
                $features[$i]['status'] = $row['status'];
                $i++;
            }
            return $features;
        }else{
            return false;
        }
    }


    public function delete()
    {
        $strSQL = "DELETE FROM report_feature WHERE feature_id = '".$this->feature_id."'";
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_affected_rows($this->connection) > 0 ) {
            return true;
        }else{
            return false;
        }
    }

    
    



}
?>
