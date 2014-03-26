<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$report = new Report($myconnection);
$report->connection = $myconnection;

$reports = $report->get_list_array();
if($reports){
	$count_data = count($reports);
}else{
	$count_data =0;
}

?>