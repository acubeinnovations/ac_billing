<?php session_start();
define('CHECK_INCLUDED', true);
define('ROOT_PATH', '../');
$current_url = $_SERVER['PHP_SELF'];

require(ROOT_PATH.'include/class/class_page/class_page.php');	// new Page Class

$page = new Page;
	$page->root_path = ROOT_PATH;
	$page->current_url = $current_url;	// current url for pages
	$page->title = "Administrator - Dashboard";	// page Title
	$page->page_name = 'index';		// page name for menu and other purpose
	$page->layout = 'default.html';		// layout name


    $page->conf_list = array("conf.php");
    $page->menuconf_list = array("menu_conf.php");
	$page->connection_list = array("connection.php");
	$page->function_list = array("functions.php");
	$page->class_list = array("class_administrator_session.php");

	$page->access_list = array("ADMINISTRATOR");

	$page->script_list_link = array("jquery.min.js");

    $index=0;
    $content_list[$index]['file_name']='administrator/inc_menu.php';
    $content_list[$index]['var_name']='menu';
    $index++;




	$page->content_list = $content_list;

    $page->module_path = 'modules/administrator/';
    $page->module = 'dashboard';

	$page->display(); //completed page with dynamic cintent will be displayed
?>
