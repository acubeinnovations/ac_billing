<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$form_type = new FormType($myconnection);
$form_type->connection = $myconnection;


$form_variable = new FormVariable($myconnection);
$form_variable->connection = $myconnection;


$form_variables = $form_variable->get_list_array();

if(isset($_GET['slno'])){
	$form_type->id = $_GET['slno'];
	$form_type->get_details();


	$variable_array = unserialize($form_type->form_variables);
	$form_type_variables = $form_variable->getFormVariables($variable_array);
}










?>