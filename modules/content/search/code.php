<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

		//for pagination
		$Mypagination = new Pagination(50);
		$this->content->connection = $myconnection;

		//for pagination
		$this->content->total_records = $Mypagination->total_records;

		if(isset($_GET["lstlanguage"]) && $_GET["lstlanguage"] > 0) {
			$language_id = $_GET["lstlanguage"];
		}else{
			$language_id =gINVALID;
		}


		if(isset($_GET["lstcontenttype"]) && $_GET["lstcontenttype"] > 0) {
			$contenttype_id = $_GET["lstcontenttype"];
		}else{
			$contenttype_id =gINVALID;
		}


		if(isset($_GET["txtcontentname"]) && $_GET["txtcontentname"] != "") {
			$contentname = $_GET["txtcontentname"];
		}else{
			$contentname ="";
		}


		if(isset($_GET["txtpagename"]) && $_GET["txtpagename"] != "") {
			$pagename = $_GET["txtpagename"];
		}else{
			$pagename ="";
		}



		if(isset($_GET["txtcontent"]) && $_GET["txtcontent"] != "") {
			$content = $_GET["txtcontent"];
		}else{
			$content ="";
		}

		if(isset($_GET["txtdescription"]) && $_GET["txtdescription"] != "") {
			$description = $_GET["txtdescription"];
		}else{
			$description ="";
		}


		if(isset($_GET["chk_publish"]) && $_GET["chk_publish"] != "") {
			$publish = $_GET["chk_publish"];
		}else{
			$publish ="";
		}




		$data_bylimit = $this->content->get_list_array_bylimit($language_id,$contenttype_id,$contentname,$pagename,$content,$description,$publish,$Mypagination->start_record,$Mypagination->max_records);
		
		if ( $data_bylimit == false ){
			$mesg = "No records found";
		}else{
			$count_data_bylimit=count($data_bylimit);
			$Mypagination->total_records = $this->content->total_records;
			$Mypagination->paginate();

		}


?>
