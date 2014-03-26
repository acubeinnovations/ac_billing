<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$stock_register = new StockRegister($myconnection);
$stock_register->connection = $myconnection;

$items = $stock_register->get_list_array_bylimit($pagination->start_record,$pagination->max_records);

if($items <> false){
	$pagination->total_records = $stock_register->total_records;
	$pagination->paginate();
	$count_items = count($items);
}else{
	$count_items = 0;
}


?>