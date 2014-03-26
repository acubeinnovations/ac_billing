<?php
$mylanguage = new Language($myconnection);
$mylanguage->connection = $myconnection;
   if(isset($_POST["submit"]) && $_POST["submit"] == "submit"   )
	{	
		$mylanguage->language= $_POST["txtlanguage"]; 
		$mylanguage->publish= $_POST["lstpublish"];
				$mylanguage->id  = $_POST['h_id']; 
				$mylanguage->update();
		$_SESSION[SESSION_TITLE.'flash'] = "Language Updated.";
		//$_SESSION[SESSION_TITLE.'flash_redirect_page'] = "languages.php";
		header( "Location: languages.php");
		exit();
				
	}
  if(isset($_GET["id"]) && $_GET["id"] > 0   ){
		$mylanguage->id = $_GET["id"];
		$mylanguage->get_detail(); 
  }
  
    if(isset($_GET["delid"]) && $_GET["delid"] > 0   ){ echo "deleted";
		$mylanguage->id = $_GET["delid"];
		$mylanguage->delete(); 
		header('location:languages.php');
  }
?>
