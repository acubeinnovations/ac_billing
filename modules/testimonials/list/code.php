

<?php //DASHBOARD
 if ( !defined('CHECK_INCLUDED') ){
    exit();
  }

 $mytestimonials = new User_testimonials($myconnection);
 $mytestimonials->connection = $myconnection;


/*


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

*/

//for pagination
	$Mypagination = new Pagination(3);
	$myuser = new User($myconnection);
	$myuser->connection = $myconnection;
	
	$mytestimonials->status_id=STATUS_ACTIVE;
	$user_name=$myuser->get_array_username();
	$data_bylimit = $mytestimonials->get_list_array_bylimit($Mypagination->start_record,$Mypagination->max_records);
       
        if ( $data_bylimit == false ){
            $mesg = "No records found";
        }else{
			 $count_data_bylimit=count($data_bylimit);
	     $Mypagination->total_records = $mytestimonials->total_records;
            $Mypagination->paginate();

        }
		

?>
