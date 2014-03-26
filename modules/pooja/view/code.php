<?php
if(!defined('CHECK_INCLUDED')){
	exit();
} 

$poojas= new Pooja($myconnection);
$poojas->connection=$myconnection;
$pagination = new Pagination(10);

$poojas->total_records=$pagination->total_records;

if(isset($_GET['submit'])){
$poojas->name=$_GET['search'];
}else{

}
$array_poojas=$poojas->get_list_array_bylimit($pagination->start_record,$pagination->max_records);

if($array_poojas!=false){
	$pagination->total_records = $poojas->total_records;
	$pagination->paginate();
	$count_poojas=count($array_poojas);
	}else{
	$count_poojas=0;
}


?>