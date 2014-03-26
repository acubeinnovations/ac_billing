<?php
	
	$editor = 'style="width:400px; height:200px; margin-right:25%;" ';

	if (isset($_GET["id"]) && ($_GET["id"]!= "" || $_GET["id"] > 0)  ) {
		$int_contnent_id =$_GET["id"];
	}elseif($_POST["h_contentid"]!= "" || $_POST["h_contentid"] < 0  ) {
		$int_contnent_id =$_POST["h_contentid"];
	}else{
		$_SESSION[SESSION_TITLE.'flash'] = $errmsg_invalid_id;
		$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $errmsg_invalid_id_redirect_page;
		header( "Location: flash.php");
		exit();
		
	}
	
	if(isset($_POST["h_contentid"]) && $_POST["h_contentid"] != ""  && $_POST["h_contentinfo"] == md5("CONF_INFO") ){
		$int_contnent_id = $_POST["h_contentid"];
	
		if ($int_contnent_id == -1) {
			$_SESSION[SESSION_TITLE.'flash'] = $errmsg_invalid_id;
			$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $errmsg_invalid_id_redirect_page;
			header( "Location: flash.php");
			exit();
		}else {
			$this->content->id=$int_contnent_id;
			$this->content->content=$_POST["txt_content"];
			if(isset($_POST["chk_publish"]) && $_POST["chk_publish"] == CONF_PUBLISH){
				$this->content->publish=CONF_PUBLISH;
			}else{
				$this->content->publish=CONF_NOT_PUBLISH;
			}
			if(isset($_POST["update"])) {
				if($this->content->update() == true){
					$_SESSION[SESSION_TITLE.'flash'] = $msg_update_success;
					$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $msg_update_success_redirect_page;
					header( "Location: flash.php");
					exit();
				}else{
					$_SESSION[SESSION_TITLE.'flash'] = $msg_update_failed;
					$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $msg_update_failed_redirect_page;
					header( "Location: flash.php");
					exit();
				}
			}elseif(isset($_POST["delete"])) {
				if($this->content->delete()== true){
					$_SESSION[SESSION_TITLE.'flash'] = $msg_delete_success;
					$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $msg_delete_success_redirect_page;
					header( "Location: flash.php");
					exit();
				}else{
					$_SESSION[SESSION_TITLE.'flash'] = $msg_delete_failed;
					$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $msg_delete_failed_redirect_page;
					header( "Location: flash.php");
					exit();
				}		
			}

		}
		
	}

		$this->content->id=$int_contnent_id;
		if ($this->content->get_detail() == true) {
			$str_content =stripcslashes($this->content->content);
			$intpublish =stripcslashes($this->content->publish);
			$int_contnent_id = $this->content->id;
			$contenttype_id= $this->content->contenttype_id;
			if($this->content->contenttype_id == CONF_TYPE_HTML ){
				$editor = 'class="ckeditor"';
			}
			 
		}else{
// 			$str_content ="";
// 			$int_contnent_id = -1;
			$_SESSION[SESSION_TITLE.'flash'] = $errmsg_invalid_id;
			$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $errmsg_invalid_id_redirect_page;
			header( "Location: flash.php");
			exit();
		}


 ?>
