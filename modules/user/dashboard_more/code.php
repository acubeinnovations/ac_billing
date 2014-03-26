<?php
	$myexam = new Exam($myconnection);
	$myexam->connection = $myconnection;
	$exams=$myexam->get_array();// print_r($exams);
?>
<?php
if(isset($_GET["id"]) && $_GET["id"] > 0   ){
$id=$_GET["id"]; 
	$myquiz = new Quiz($myconnection);
	$myquiz->connection = $myconnection;
	$Mypagination = new Pagination(50);
		if(trim($_SESSION[SESSION_TITLE.'exam_ids'])!=""){
		$filter = " AND exam_id IN(".$_SESSION[SESSION_TITLE.'exam_ids'].")";
	}
	else{
		$filter = "";
		$_SESSION[SESSION_TITLE.'flash'] = " Choose exam preferences to attempt a test";
	//	header( "Location: dashboard.php");
	//	exit();
	}
	$data_real_quiz = $myquiz->get_list_array_bylimit("",REAL_QUIZ,$Mypagination->start_record,$Mypagination->max_records,$filter);
	if ( $data_real_quiz == false ){
			$count_real_quiz=0;
			$mesg_real_quiz = "No records found";
	}else{
		$count_real_quiz=count($data_real_quiz);
	}

}
?>
<?php //Get Quiz Count
	$usertest = new UserTest($myconnection);
	$usertest->connection = $myconnection;
	$Mypagination = new Pagination(2000);
	$data_bylimit = $usertest->get_list_array_bylimit($_SESSION[SESSION_TITLE.'userid'],$Mypagination->start_record,$Mypagination->max_records);
	$total_quiz_number=count($data_bylimit); 
	$usertest->test_status_id=TEST_ENDED;
	$data_bylimit = $usertest->get_list_array_bylimit($_SESSION[SESSION_TITLE.'userid'],$Mypagination->start_record,$Mypagination->max_records);
	$total_finished_quiz_number=count($data_bylimit); 
?>