<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

Class StockRegister{

	var $connection ="";
	var $stk_id  =  gINVALID; //master voucher
	var $voucher_number ="";
	var $voucher_type_id = gINVALID; //voucher
	var $item_id	= gINVALID;
	var $quantity = "";
	var $unit_rate = "";
	var $input_type = ""; //from where or how the item added in stock
	var $purchase_reference_number = "";
	var $date = "";
	var $tax_id = gINVALID;
	var $fy_id = gINVALID;
	

	var $date_from = '';
	var $date_to = '';

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
    	if(count($dataArray) > 0){
    		$strSQL= "INSERT INTO stock_register(voucher_number,voucher_type_id,item_id,quantity,unit_rate,input_type,purchase_reference_number,tax_id,fy_id,date) VALUES";
			$i=0;
			while($i<count($dataArray)){
				$strSQL.= "('";
				$strSQL.= mysql_real_escape_string($this->voucher_number)."','";
	    		$strSQL.= mysql_real_escape_string($this->voucher_type_id)."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['item_id'])."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['quantity'])."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['rate'])."','";
	    		$strSQL.= mysql_real_escape_string($this->input_type)."','";
	    		$strSQL.= mysql_real_escape_string($this->purchase_reference_number)."','";
	    		$strSQL.= mysql_real_escape_string($dataArray[$i]['tax'])."','";
	    		$strSQL.= mysql_real_escape_string($this->current_fy_id)."','";
	    		$strSQL.= date('Y-m-d',strtotime($this->date))."'),";
				$i++;
			}
			$strSQL = substr($strSQL,0,-1);
			//echo $strSQL;exit();
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

    public function update()
    {
    	if ( $this->stk_id == "" || $this->stk_id == gINVALID) {
    		$strSQL= "INSERT INTO stock_register(voucher_number,voucher_type_id,item_id,quantity,unit_rate,input_type,purchase_reference_number,tax_id,fy_id,date) VALUES('";
    		$strSQL.= mysql_real_escape_string($this->voucher_number)."','";
    		$strSQL.= mysql_real_escape_string($this->voucher_type_id)."','";
    		$strSQL.= mysql_real_escape_string($this->item_id)."','";
    		$strSQL.= mysql_real_escape_string($this->quantity)."','";
    		$strSQL.= mysql_real_escape_string($this->unit_rate)."','";
    		$strSQL.= mysql_real_escape_string($this->input_type)."','";
    		$strSQL.= mysql_real_escape_string($this->purchase_reference_number)."','";
    		$strSQL.= mysql_real_escape_string($this->tax_id)."','";
    		$strSQL.= mysql_real_escape_string($this->current_fy_id)."','";
    		$strSQL.= date('Y-m-d',strtotime($this->date))."')";
   
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die ( mysql_error() . $strSQL );

			if ( mysql_affected_rows($this->connection) > 0 ) {
				$this->stk_id = mysql_insert_id();
				$this->error_description="Success";
				return $this->stk_id;
			}else{
				$this->error_number = 3;
				$this->error_description="Can't insert data ";
				return false;
			}

    	}elseif($this->stk_id > 0 ) {
    		$strSQL = "UPDATE stock_register SET voucher_number = '".addslashes(trim($this->voucher_number))."',";
			$strSQL .= "voucher_type_id = '".addslashes(trim($this->voucher_type_id))."',";
			$strSQL .= "item_id = '".addslashes(trim($this->item_id))."',";
			$strSQL .= "quantity = '".addslashes(trim($this->quantity))."',";
			$strSQL .= "unit_rate = '".addslashes(trim($this->unit_rate))."',";
			$strSQL .= "input_type = '".addslashes(trim($this->input_type))."',";
			$strSQL .= "purchase_reference_number = '".addslashes(trim($this->purchase_reference_number))."',";
			$strSQL .= "tax_id = '".addslashes(trim($this->tax_id))."',";
			$strSQL .= "fy_id = '".addslashes(trim($this->current_fy_id))."',";
			$strSQL .= "date = '".date('Y-m-d',strtotime($this->date))."'";
			$strSQL .= " WHERE stk_id = ".$this->stk_id;
			//echo $strSQL;exit();
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );

            if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
           	}else{
				$this->error_number = 3;
				$this->error_description="Can't update";
				return false;
           	}
    	}
    }


    public function quantityInStock($item_id)
    {
		$strSQL = "SELECT sum(quantity) as quantity_in_hand FROM stock_register WHERE fy_id='".$this->current_fy_id."' AND item_id = '".$item_id."'";
		$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		$row = mysql_fetch_assoc($rsRES);
		if($row['quantity_in_hand'] == NULL){
			$quantity_in_hand = 0;
		}else{
			$quantity_in_hand = $row['quantity_in_hand'];
		}
		return $quantity_in_hand;	
    }





    public function close($current_fy_id,$next_fy_id, $opening_date)
    {

		if($current_fy_id > 0 && $next_fy_id > 0 && trim($opening_date) != ""){
			$strSQL = "SELECT SR.item_id, SR.unit_rate, sum(SR.quantity) as quantity_in_hand  FROM stock_register SR, stock_master S WHERE SR.fy_id='".$current_fy_id."' AND SR.item_id = S.item_id GROUP BY SR.item_id,SR.unit_rate ";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			while($row = mysql_fetch_assoc($rsRES)){
				if($row["quantity_in_hand"] > 0){
					$this->stk_id= gINVALID;
					$this->voucher_number ="";
					$this->voucher_type_id = gINVALID; //voucher
					$this->item_id	= $row["item_id"];
					$this->quantity = $row["quantity_in_hand"];
					$this->unit_rate = $row["unit_rate"];
					$this->input_type = INPUT_OPENING; //from where or how the item added in stock
					$this->purchase_reference_number = "";
					$this->date = $opening_date;
					$this->tax_id = gINVALID;
					$this->fy_id = gINVALID;
					$this->current_fy_id = $next_fy_id;	
					$this->update();
				}
			}

			return true;
		}else{
			return false;
		}
    }

   public function revert_close($next_fy_id) {
		if($next_fy_id > 0){
			$strSQL = "DELETE FROM stock_register WHERE fy_id='".$next_fy_id."'";
			$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
			return true;
		}else{
			return false;
		}
    }







    public function get_voucher_inventory_details()
    {
    	$items = array();$i=0;
    	$strSQL = "SELECT sm.item_id,sm.item_name,sr.quantity,sr.unit_rate,tm.rate AS tax FROM stock_register sr";
    	$strSQL .= " LEFT JOIN stock_master sm ON sm.item_id = sr.item_id";
    	$strSQL .= " LEFT JOIN tax_master tm ON tm.id = sr.tax_id";
    	

    	$strSQL .= " WHERE sr.fy_id='".$this->current_fy_id."' AND sr.voucher_number = '".$this->voucher_number."' AND sr.voucher_type_id = '".$this->voucher_type_id."'";
    	
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if(mysql_num_rows($rsRES) > 0){
			$slno = 1;
			$total_array = array();
			$total_array[9] 	= 0;//value
			$total_array[11] 	= 0;//gross value
			$total_array[13] 	= 0;//net taxable value
			$total_array[14] 	= 0;//tax
			$total_array[15] 	= 0;//total
			
			while(list($item_code,$item_name,$quantity,$unit_rate,$tax) = mysql_fetch_row($rsRES)){
				$items[$i][1] 	= $slno; //slno
				$items[$i][2] 	= '';//schl with entry no
				$items[$i][3] 	= $item_code; //commodity code
				$items[$i][4] 	= $item_name; //commodity 
				$items[$i][5] 	= ''; //hsn code
				$items[$i][6]	= $tax*100; // rate of tax
				$items[$i][7] 	= $unit_rate; //unit rate
				$items[$i][8] 	= abs($quantity);//quantity
				$items[$i][9] 	= abs($quantity)*$unit_rate;//value
				$items[$i][10] 	= '';//excise duty
				$items[$i][11] 	= ($items[$i][10] == '')?$items[$i][9]+0:$items[$i][9]+$items[$i][10];//gross value
				$items[$i][12] 	= '';//cash discount
				$items[$i][13] 	= ($items[$i][12] == '')?$items[$i][11]-0:$items[$i][11]-$items[$i][12];//net taxable value
				$items[$i][14] 	= $items[$i][13]*$tax;//tax
				$items[$i][15] 	= $items[$i][13]+$items[$i][14];//total
				$items[$i][16] 	= '';//quantity discount /gifts or free etc.

				//calculate totals
				$total_array[9] +=$items[$i][9];
				$total_array[11] +=$items[$i][11];
				$total_array[13] +=$items[$i][13];
				$total_array[14] +=$items[$i][14];
				$total_array[15] +=$items[$i][15];

				$i++;$slno++;
			}
			return array($items,$total_array);
		}else{
			return false;
		}
    }

    public function delete()
    {
    	$strSQL = "DELETE FROM stock_register WHERE voucher_number = '".$this->voucher_number."' AND voucher_type_id = '".$this->voucher_type_id."'";
    	//echo $strSQL;exit();
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
		if(mysql_affected_rows()> 0){
			return true;
		}else{
			return false;
		}
    }

    public function get_voucher_items()
    {
    	$strSQL = "SELECT sr.item_id,sr.quantity,sr.unit_rate,sm.item_name FROM stock_register sr";	
    	$strSQL .=" LEFT JOIN stock_master sm ON sm.item_id = sr.item_id";
    	$strSQL .=" INNER JOIN voucher v ON v.voucher_id = sr.voucher_type_id";
    	$strSQL .= " WHERE sr.fy_id = '".$this->current_fy_id."' AND sr.voucher_number = '".$this->voucher_number."' AND sr.voucher_type_id = '".$this->voucher_type_id."'";
    	$rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
    	$items= array();$i=0;
		if(mysql_num_rows($rsRES) > 0){
			while($row = mysql_fetch_assoc($rsRES)){
				$items[$i]['item_id'] = $row['item_id'];
				$items[$i]['item_name'] = $row['item_name'];
				$items[$i]['quantity'] = abs($row['quantity']);
				$items[$i]['unit_rate'] = $row['unit_rate'];
				$items[$i]['tax'] = 0;
				$items[$i]['total'] = $row['unit_rate']*abs($row['quantity']);
				$i++;
			}
			return $items;
		}else{
			return false;
		}
    }


    function get_list_array(){
    	$items = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT sr.item_id,sm.item_name,tm.rate,um.uom_value,sr.unit_rate,SUM(sr.quantity) AS quantity FROM stock_register sr";
        $strSQL .= " LEFT JOIN stock_master sm ON sm.item_id = sr.item_id";
        $strSQL .= " LEFT JOIN tax_master tm ON tm.id = sr.tax_id";
        $strSQL .= " LEFT JOIN uom_master um ON sm.uom_id = um.uom_id";
        $strSQL .= " WHERE sr.fy_id = '".$this->current_fy_id."'";

        if($this->date_from !=""){
           if($this->date_to !="" and $this->date_from != $this->date_to){
                 $strSQL .= " AND (sr.date BETWEEN '".date('Y-m-d',strtotime($this->date_from))."' AND '".date('Y-m-d',strtotime($this->date_to))."')";
            }else{
                $strSQL .= " AND sr.date = '".date('Y-m-d',strtotime($this->date_from))."'";
            }
            
        }

        if($this->input_type != ""){
        	$strSQL .= " AND sr.input_type = '".$this->input_type."'";
        }

        $strSQL .= " GROUP BY sr.item_id ,sr.unit_rate";
		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
		if ( mysql_num_rows($rsRES) > 0 ){
			while ( list ($id,$name,$tax,$uom,$unit_rate,$quantity) = mysql_fetch_row($rsRES) ){
				$tax_rate = ($tax == NULL)?0:$tax;
				$items[$i]["item_code"] =  $id;
				$items[$i]["item_name"] = $name;
				$items[$i]["uom_value"] = $uom;
				$items[$i]["unit_rate"] =  $unit_rate;
				$items[$i]["quantity"] = abs($quantity);
				$items[$i]['gross_amt'] =$unit_rate*abs($quantity);
				$items[$i]['tax'] = $items[$i]['gross_amt']*$tax_rate;
				$items[$i]['net_amt'] = $items[$i]['gross_amt']+$items[$i]['tax'];

				$i++;
			}
			return $items;
		} else {
			return false;
		}
    }

    function get_list_array_bylimit($start_record = 0,$max_records = 25){
    	$items = array();
		$i=0;
		$str_condition = "";
        $strSQL = "SELECT sr.item_id,sm.item_name,tm.rate,um.uom_value,sr.unit_rate,SUM(sr.quantity) AS quantity FROM stock_register sr";
        $strSQL .= " LEFT JOIN stock_master sm ON sm.item_id = sr.item_id";
        $strSQL .= " LEFT JOIN tax_master tm ON tm.id = sr.tax_id";
        $strSQL .= " LEFT JOIN uom_master um ON sm.uom_id = um.uom_id";
        $strSQL .= " WHERE sr.fy_id = '".$this->current_fy_id."'";
        if($this->date_from !=""){
           if($this->date_to !="" and $this->date_from != $this->date_to){
                 $strSQL .= " AND (sr.date BETWEEN '".date('Y-m-d',strtotime($this->date_from))."' AND '".date('Y-m-d',strtotime($this->date_to))."')";
            }else{
                $strSQL .= " AND sr.date = '".date('Y-m-d',strtotime($this->date_from))."'";
            }
            
        }

        if($this->input_type != ""){
        	$strSQL .= " AND sr.input_type = '".$this->input_type."'";
        }

       

        $strSQL .= " GROUP BY sr.item_id ,sr.unit_rate";
       // echo $strSQL;exit();

		$strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
		$rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);
		if ( mysql_num_rows($rsRES) > 0 ){

            //without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit);
				$this->total_records = mysql_num_rows($all_rs);
			}
			while ( list ($id,$name,$tax,$uom,$unit_rate,$quantity) = mysql_fetch_row($rsRES) ){
				$tax_rate = ($tax == NULL)?0:$tax;
				$items[$i]["item_code"] =  $id;
				$items[$i]["item_name"] = $name;
				$items[$i]["uom_value"] = $uom;
				$items[$i]["unit_rate"] =  $unit_rate;
				$items[$i]["quantity"] = abs($quantity);
				$items[$i]['gross_amt'] =$unit_rate*abs($quantity);
				$items[$i]['tax'] = $items[$i]['gross_amt']*$tax_rate;
				$items[$i]['net_amt'] = $items[$i]['gross_amt']+$items[$i]['tax'];

				$i++;
			}
			return $items;
		} else {
			return false;
		}
    }


    public function getItemOpeningQuantity()
    {
    	if($this->item_id >0){
    		$strSQL = "SELECT sr.quantity AS opening_qty,sr.unit_rate AS opening_rate, sr.stk_id FROM stock_register sr WHERE sr.fy_id = '".$this->current_fy_id."' AND sr.item_id = '".$this->item_id."' AND sr.input_type = '".INPUT_OPENING."'";
    		$rsRES = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL);
    		if(mysql_num_rows($rsRES) > 0){
    			$row = mysql_fetch_assoc($rsRES);
    			$id= $row['stk_id'];
    			$qty = $row['opening_qty'];
    			$rate = $row['opening_rate'];
    			
    			return array($id,$qty,$rate);
    		}else{
    			return false;
    		}

    	}else{
    		return false;
    	}
    }


}
?>
