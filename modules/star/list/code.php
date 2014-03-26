<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
$add_stars=new Stars($myconnection);
$add_stars->connection=$myconnection;
$pagination= new pagination(10);

if(isset($_POST['submit'])){
	$add_stars->name=$_POST['search'];
}

$array_stars=$add_stars->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($array_stars!=false){
	$stars_count=count($array_stars);
	$pagination->total_records=$add_stars->total_records;
	$pagination->paginate();
}else{
	$stars_count=0;
}







?>