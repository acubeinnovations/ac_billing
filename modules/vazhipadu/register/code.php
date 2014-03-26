<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$pagination = new Pagination(10);

$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;

$vazhipadu->total_records=$pagination->total_records;

$data = array();

if(isset($_GET['submit'])){
	
	$vazhipadu->from_date =  $_GET['txtfrom'];
	$vazhipadu->to_date   = $_GET['txtto'];

}else{
	$vazhipadu->from_date =  date('d-m-Y',strtotime(CURRENT_DATE));
	$vazhipadu->to_date   = date('d-m-Y',strtotime(CURRENT_DATE));
}


$vazhipadu_list = $vazhipadu->get_array_by_limit($pagination->start_record,$pagination->max_records,$data);
$vazhipadu_total_list = $vazhipadu->get_array_by_limit($pagination->start_record,$vazhipadu->total_records,$data);

if($vazhipadu_list){
	$pagination->total_records = $vazhipadu->total_records;
	$pagination->paginate();
	$count = count($vazhipadu_list);
}else{
	$count = 0;
}


?>