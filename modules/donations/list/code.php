<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$list_donation= new Donation($myconnection);
$list_donation->connection=$myconnection;

$stars=new Stars($myconnection);
$stars->connection=$myconnection;
$array_stars=$stars->get_list_array_bylimit();

$array_list_donation=$list_donation->get_list_array();
	if($array_list_donation!=false){
	$count_list=count($array_list_donation);
	}else{
	$count_list=0;
}

?>