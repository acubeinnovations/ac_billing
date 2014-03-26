<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}

$star=new Stars($myconnection);
$star->connection=$myconnection;

if(isset($_GET['id'])){
	$star->id=$_GET['id'];
	$star->get_details();
}
if(isset($_POST['submit'])){

	//validation 
	$errorMSG = "";
	if(trim($_POST['name']) == ""){
		$errorMSG .= "Star name required ";
	}

	if($errorMSG == ""){
		$star->id = $_POST['h_id'];
		$star->name=$_POST['name'];
		if($star->validate()){
			$star->status_id=$_POST['liststar'];
			$star->update();
			header("Location:stars.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $star->error_description;
	        header( "Location:".$current_url);
	        exit();
		}
		
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errorMSG;
        header( "Location:".$current_url);
        exit();
	}
	
	
}


?>