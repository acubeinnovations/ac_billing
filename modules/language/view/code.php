<?php	
		$mylanguage = new Language($myconnection);
		$mylanguage->connection = $myconnection;
		$Mypagination = new Pagination(2);
		if(isset($_GET['txtlanguage'])){
			$language = $_GET['txtlanguage'];	
		}else{
			 $language = "";	
		}
		$data=$mylanguage->get_list_array_bylimit($language, gINVALID,$Mypagination->start_record,$Mypagination->max_records); 
		$counts=count($data);
		if ($data == false ){
			$mesg = "No records found";
		}
		else{
            $counts=count($data);
	    
            $Mypagination->total_records = $mylanguage->total_records;
            $Mypagination->paginate();

        }
	
	
?>
