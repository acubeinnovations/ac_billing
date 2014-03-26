<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}


$vazhipadu=new Vazhipadu($myconnection);
$vazhipadu->connection=$myconnection;

$pooja=new Pooja($myconnection);
$pooja->connection=$myconnection;

$star=new Stars($myconnection);
$star->connection=$myconnection;

if(isset($_GET['id'])){
	$vazhipadu->vazhipadu_rpt_number = $_GET['id'];
	$vazhipadu_details = $vazhipadu->get_vazhipadu_details();

	

}




?>