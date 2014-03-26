<?php
$i=0;

GLOBAL $menu_list;
GLOBAL $g_msg_unauthorized_request;

$menu_list[$i][caption] = "Home";
$menu_list[$i][url]="index.php";
$menu_list[$i][usertype] = 0;
$menu_list[$i][submenu] = "";
$i++;
$menu_list[$i][caption] = "PhpMVC Menu";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_ADMIN;
$menu_list[$i][submenu] = "phpmvc_menu";
$i++;

$g_menu_user_menu = "User Menu";

$menu_list[$i][caption] = $g_menu_user_menu;
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_ADMIN;
$menu_list[$i][submenu] = "user_menu_admin";
$i++;

$menu_list[$i][caption] = $g_menu_user_menu;
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_REGISTERED_USER;
$menu_list[$i][submenu] = "user_menu_registered_user";
$i++;

$menu_list[$i][caption] = $g_menu_user_menu;
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = USERTYPE_EMPLOYEE;
$menu_list[$i][submenu] = "user_menu_employee";
$i++;




$menu_list[$i][caption] = "Downloads";
$menu_list[$i][url]="#";
$menu_list[$i][usertype] = 0;
$menu_list[$i][submenu] = "download_menu";
$i++;

$menu_list[$i][caption] = $g_menu_Login; 
$menu_list[$i][url]="login.php";
$menu_list[$i][usertype] = 0;
$menu_list[$i][submenu] = "";
$i++;

$menu_list[$i][caption] = "Sign Up";
$menu_list[$i][url]="signup.php";
$menu_list[$i][usertype] = -1;
$menu_list[$i][submenu] = "";
$i++;


GLOBAL $phpmvc_menu;

$phpmvc_menu[$i][caption] = "Web Content";
$phpmvc_menu[$i][url]="gsconf_search.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$i++;


$phpmvc_menu[$i][caption] = "Publish Content (ALL)";
$phpmvc_menu[$i][url]="gsconf_publishall.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$i++;

$phpmvc_menu[$i][caption] = "Import Content";
$phpmvc_menu[$i][url]="gsconf_import.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$i++;


$phpmvc_menu[$i][caption] ="Settings";
$phpmvc_menu[$i][url]="settings.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$phpmvc_menu[$i][submenu] = "";
$i++;

$phpmvc_menu[$i][caption] = "Languages";
$phpmvc_menu[$i][url]="language_search.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$phpmvc_menu[$i][submenu] = "";
$i++;

$phpmvc_menu[$i][caption] = "Add Language";
$phpmvc_menu[$i][url]="language.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$phpmvc_menu[$i][submenu] = "";
$i++;

$phpmvc_menu[$i][caption] = "Images";
$phpmvc_menu[$i][url]="image_upload.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$phpmvc_menu[$i][submenu] = "";
$i++;


$phpmvc_menu[$i][caption] = "Backup Data";
$phpmvc_menu[$i][url]="backup.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$phpmvc_menu[$i][submenu] = "";
$i++;


$phpmvc_menu[$i][caption] = "Restore Data";
$phpmvc_menu[$i][url]="restore.php";
$phpmvc_menu[$i][usertype] = USERTYPE_ADMIN;
$phpmvc_menu[$i][submenu] = "";
$i++;


GLOBAL $user_menu_admin;
$user_menu_admin[$i][caption] = "Profile";
$user_menu_admin[$i][url]="profile.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;
$user_menu_admin[$i][caption] = "Change Password";
$user_menu_admin[$i][url]="change_passwd.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;

$user_menu_admin[$i][caption] = "Add Security Question";
$user_menu_admin[$i][url]="securityquestion.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;

$user_menu_admin[$i][caption] = "Search Security Question";
$user_menu_admin[$i][url]="sec_que_search.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;

$user_menu_admin[$i][caption] = "Add User";
$user_menu_admin[$i][url]="add_user.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;

$user_menu_admin[$i][caption] = "User List";
$user_menu_admin[$i][url]="user_list.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu[$i][submenu] = "";
$i++;

$user_menu_admin[$i][caption] = "FAQ search";
$user_menu_admin[$i][url]="faq_search.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu_admin[$i][submenu] = "";
$i++;

$user_menu_admin[$i][caption] = "Add FAQ";
$user_menu_admin[$i][url]="faq_update.php"; 
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu_admin[$i][submenu] = "";
$i++;



$user_menu_admin[$i][caption] = "Contact Us Forms Submitted";
$user_menu_admin[$i][url]="business_search.php";
$user_menu_admin[$i][usertype] = USERTYPE_ADMIN;
$user_menu_admin[$i][submenu] = "";
$i++;





GLOBAL $user_menu_registered_user;
$user_menu_registered_user[$i][caption] = "Profile";
$user_menu_registered_user[$i][url]="profile.php";
$user_menu_registered_user[$i][usertype] = USERTYPE_REGISTERED_USER;
$user_menu_registered_user[$i][submenu] = "";
$i++;




GLOBAL $user_menu_employee;
$user_menu_employee[$i][caption] = "Profile";
$user_menu_employee[$i][url]="profile.php";
$user_menu_employee[$i][usertype] = USERTYPE_EMPLOYEE;
$user_menu_employee[$i][submenu] = "";
$i++;



GLOBAL $download_menu;
$download_menu[$i][caption] = "Download Source";
$download_menu[$i][url]="download.php?download=phpmvc.zip"; 
$download_menu[$i][usertype] = 0;
$download_menu[$i][submenu] = "";
$i++;
$download_menu[$i][caption] = "Download DB";
$download_menu[$i][url]="download.php?download=phpmvc.sql";
$download_menu[$i][usertype] = 0;
$download_menu[$i][submenu] = "";
$i++;





?>

