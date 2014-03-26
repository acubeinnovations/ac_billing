<?php //USER HISTORY

	$usertest = new UserTest($myconnection);
	$usertest->connection = $myconnection;
	$Mypagination = new Pagination(4);
	
	$data_bylimit = $usertest->get_list_array_bylimit($_SESSION[SESSION_TITLE.'userid'],$Mypagination->start_record,$Mypagination->max_records);
	//print_r($data_bylimit); exit();
	
	 $counts=count($data_bylimit);
	
	if ( $data_bylimit == false ){
	$mesg = "No records found";
	}else{
	$count_data_bylimit=count($data_bylimit);
	$Mypagination->total_records = $usertest->total_records;
	$Mypagination->paginate();
	
	}
?>
<?php  
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}



$myexam = new Exam($myconnection);
$myexam->connection = $myconnection;
$my_exams = $myexam->get_detail_all();

$user_id =$_SESSION[SESSION_TITLE.'userid'];
$user_name=$_SESSION[SESSION_TITLE.'username'];
 $myuser = new User($myconnection);
 $myuser->connection = $myconnection;
 $myuser->id = $user_id;
 $chk_user = $myuser->get_detail();

 


 if ( isset($_GET['id']) && $_GET['id'] > 0 ){
      $myuser = new User();
      $myuser->id = $_GET['id'];
      $myuser->connection = $myconnection;
      $chk1 = $myuser->get_detail();
      if ( $chk == false ){
		  header("Location: index.php");
		  exit();
      }
 }




 if ( isset($_POST['submit']) && $_POST['submit'] == $CAP_update ) {
		
		$myuser = new User($myconnection);
		$myuser->connection = $myconnection;
		$strERR="";
		$myuser->id = $user_id;

		$myuser->error_description = $strERR;
		 if ( $strERR == "" ){
			$myuser->get_detail();
 			$exam_ids = $myuser->exam_ids;

			$myuser = new User($myconnection);
			$myuser->connection = $myconnection;
			$myuser->id = $user_id;
			$myuser->exam_ids = $exam_ids;

			$myuser->username= $_POST['txtusername'];
			$myuser->first_name= $_POST['txtfirst_name'];
			$myuser->last_name= $_POST['txtlast_name'];
			$myuser->email = $_POST['txtemail'];
			$myuser->occupation= $_POST['txtoccupation'];
			$myuser->phone= $_POST['txtphone'];
			$myuser->address= $_POST['txtaddress'];


		$chk = $myuser->update();	
		if ( $chk == true ){
			$myuser->get_detail();
			$_SESSION[SESSION_TITLE.'name'] = $myuser->first_name." ".$myuser->last_name;
			$_SESSION[SESSION_TITLE.'exam_ids'] = $myuser->exam_ids;
			$_SESSION[SESSION_TITLE.'flash'] = $MSG_update_success;
			$_SESSION[SESSION_TITLE.'flash_redirect_page'] ="profile.php";
			header( "Location: dashboard.php");
			exit();
		}else{
			$_SESSION[SESSION_TITLE.'flash'] = $myuser->error_description;
			//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
			header( "Location:".$current_url );

			exit();
		}
	
		}else{
		$_SESSION[SESSION_TITLE.'flash'] = $strERR;
		header( "Location:".$current_url);
		exit();
		}
}

?>
