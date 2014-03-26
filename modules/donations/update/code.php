<?php 
if(!defined('CHECK_INCLUDED')){
	exit();
}


$add_donation= new Donation($myconnection);
$add_donation->connection=$myconnection;

$add_star=new Stars($myconnection);
$add_star->connection=$myconnection;
$array_stars=$add_star->get_array();

if(isset($_GET['id'])){
	$add_donation=$_GET['id'];
	$add_donation->get_details();
}
$msg="";
if(isset($_POST['submit'])){
	$add_donation->name=$_POST['name'];
	$add_donation->address=$_POST['address'];
	$add_donation->star_id=$_POST['liststar'];
	$add_donation->amount=$_POST['amount'];
	$add_donation->description=$_POST['desc'];
	$add_donation->update();
	header("Location:donations.php");
}else{
	$msg="Cant Update Danation";

}


?>