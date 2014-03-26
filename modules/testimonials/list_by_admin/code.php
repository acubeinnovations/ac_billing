<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $mytestimonials = new User_testimonials($myconnection);
 $mytestimonials->connection = $myconnection;
 //$chk_user = $mytestimonials->get_list_array();






if ( isset($_POST['submit'])) {



    $mytestimonials = new User_testimonials();
    $mytestimonials->connection = $myconnection;
	if($_POST['txtuserid']!=''){
   	$mytestimonials->user_id = $_POST['txtuserid'];
	}
	if($_POST['txtdate']!=''){
	$mytestimonials->tdate = $_POST['txtdate'];
	}
	
	if($_POST['lststatus']==-1){
		$mytestimonials->status_id ='';
	}else{
	$mytestimonials->status_id = $_POST['lststatus'];
	}

} 



//for pagination
	$Mypagination = new Pagination(10);
	$data_bylimit = $mytestimonials->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
        $statuses=$mytestimonials->get_array_statuses();
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
			 $count_data_bylimit=count($data_bylimit);
	     $Mypagination->total_records = $mytestimonials->total_records;
            $Mypagination->paginate();

        }
		
		?>