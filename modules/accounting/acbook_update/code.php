<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}

$pagination = new Pagination(10);

$acbook=new AcBook($myconnection);
$acbook->connection=$myconnection;

$acbook->total_records=$pagination->total_records;

$books = $acbook->get_list_array_bylimit($pagination->start_record,$pagination->max_records);

$acbook_ledgers = array();

if($books <> false){
	$pagination->total_records = $acbook->total_records;
	$pagination->paginate();
	$count_books = count($books);
}else{
	$count_books = 0;
}


//edit
if(isset($_GET['edt'])){
	$acbook->id = $_GET['edt'];
	$acbook->get_details();

	$acbook_ledgers = unserialize($acbook->ledgers);
	
}

if(isset($_GET['dlt'])){
	$acbook->id = $_GET['dlt'];
	$delete = $acbook->delete();
	if($delete){
		$_SESSION[SESSION_TITLE.'flash'] = "Book deleted";
        header( "Location:".$current_url);
        exit();
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $acbook->error_description;
        header( "Location:".$current_url);
        exit();
	}
}


$ledger=new Ledger($myconnection);
$ledger->connection=$myconnection;

$ledgers = $ledger->get_list_array();
if(!$ledgers){
	$_SESSION[SESSION_TITLE.'flash'] = "No active ledgers";
    header( "Location:dashboard.php");
    exit();
}


if(isset($_POST['submit'])){

	

	$errorMSG = "";
	if(trim($_POST['txtname']) == ""){
		$errorMSG = "Book name is empty \n";
	}

	if(!isset($_POST['lstledger'])){
		echo $errorMSG = "Select Ledgers\n";
	}

	if(trim($errorMSG) == ""){
		$acbook->id = $_POST['hd_acbookid'];
		$acbook->name = $_POST['txtname'];
		$acbook->ledgers = $_POST['lstledger'];
//print_r($acbook->ledgers);exit();
		if($acbook->id > 0){
			$check = true;
		}else{
			$check = $acbook->validate();
		}

		if($check){

			$update = $acbook->update();

			if($update){
				$_SESSION[SESSION_TITLE.'flash'] = "Book udated successfully";
		        header( "Location:".$current_url);
		        exit();
		    }else{
		    	$_SESSION[SESSION_TITLE.'flash'] = "Failed to add Book";
		        header( "Location:".$current_url);
		        exit();
		    }
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $acbook->error_description;
	        header( "Location:".$current_url);
	        exit();
		}
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = "Please fill the required fields";
        header( "Location:".$current_url);
        exit();
	}
}

?>