<?php
session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/conf/conf.php');
require(ROOT_PATH.'include/class/class_administrator_session/class_administrator_session.php');
 

$myuser = new AdministratorSession("","","");
$chk = $myuser->logout();
if ($chk == true){
    header("Location:".ROOT_PATH);
    exit();
}
?>
