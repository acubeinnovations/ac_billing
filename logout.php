<?php
session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', './');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/conf/conf.php');
require(ROOT_PATH.'include/conf/system_conf.php');
require(ROOT_PATH.'include/connection/connection.php');
require(ROOT_PATH.'include/class/class_user_session/class_user_session.php');



$myuser = new UserSession("","","");
$chk = $myuser->logout();
if ($chk == true){
    header("Location: index.php");
    exit();
}
?>
