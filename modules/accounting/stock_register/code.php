<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$stock_register = new StockRegister($myconnection);
$stock_register->connection = $myconnection;

if(isset($_GET['type'])){
	$stock_register->input_type = $_GET['type'];
	$type = $_GET['type'];
}else{
	$type = "Stock";
}

$items = $stock_register->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
$all_items = $stock_register->get_list_array();

if($items <> false){
	$pagination->total_records = $stock_register->total_records;
	$pagination->paginate();
	$count_items = count($items);
}else{
	$count_items = 0;
}


?>