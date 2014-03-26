<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$form_type = new FormType($myconnection);
$form_type->connection = $myconnection;

$form_variable = new FormVariable($myconnection);
$form_variable->connection = $myconnection;

$form_variables = $form_variable->get_list_array();


if(isset($_GET['slno'])){
	$form_type->id = $_GET['slno'];
	$form_type->get_details();
}

$form_types = $form_type->get_list_array_bylimit($pagination->start_record,$pagination->max_records);
if($form_types <> false){
	$pagination->total_records = $form_type->total_records;
	$pagination->paginate();
	$count = count($form_types);
}else{
	$count = 0;
}


if(isset($_POST['submit'])){
	$errorMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errorMSG = "Enter form name";
	}

	if($errorMSG != ""){
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
	    header( "Location:".$current_url);
	    exit();
	}else{
		$form_type->value = $_POST['txtname'];
		$form_type->form_variables = $_POST['lstvariable'];

		$update = $form_type->update();
		if($update){
			$_SESSION[SESSION_TITLE.'flash'] = "Form Type added";
		    header( "Location:".$current_url);
		    exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = "Error found";
		    header( "Location:".$current_url);
		    exit();
		}
	}
}






?>