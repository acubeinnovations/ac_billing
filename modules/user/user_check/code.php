<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}

$username = $_REQUEST["username"];

$myuser = new User();
    $myuser->connection = $myconnection;
    $myuser->username = $username;
    //check user exist or not
    $chk = $myuser->exist();
    if ( $chk == true ){
        echo 0;
    }else{
   		echo 1;
	}
?>
