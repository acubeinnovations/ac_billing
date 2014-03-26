<?php
if(!defined('CHECK_INCLUDED')){
	exit();
} 

$pooja= new Pooja($myconnection);
$pooja->connection=$myconnection;

$pagination = new Pagination(10);

if(isset($_GET['submit'])){
	
	$pooja->from_date =  $_GET['txtfrom'];
	$pooja->to_date   = $_GET['txtto'];

}else{
	$pooja->from_date =  date('d-m-Y',strtotime(CURRENT_DATE));
	$pooja->to_date   = date('d-m-Y',strtotime(CURRENT_DATE));
}


$pooja_list = $pooja->get_vazhipadu_pooja_list($pagination->start_record,$pagination->max_records);

$pooja_total_list = $pooja->get_vazhipadu_pooja_list($pagination->start_record,$pooja->total_records);

if($pooja_list!=false){
	$pagination->total_records = $pooja->total_records;
	$pagination->paginate();
	$count_pooja=count($pooja_list);
}else{
	$count_pooja=0;
}







?>