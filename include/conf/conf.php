<?php
header('Content-type: text/html; charset=utf-8');

//timezone
date_default_timezone_set('Asia/Kolkata');
define("CURRENT_DATETIME",date('Y-m-d H:i:s'));
define("CURRENT_DATE",date('Y-m-d'));
define("CURRENT_TIME",date('H:i:s'));


//User Types
//define("ADMINISTRATOR", 999);

define("COUNTER", 1);
define("FINANCE", 2);
define("ADMINISTRATOR", 3);

//
define("NOT_DELETED", 1);
define("DELETED", 2);

//User Status
define("USERSTATUS_ACTIVE", 1);
define("USERSTATUS_WAITING_EMAIL_ACTIVATION", 2);
define("USERSTATUS_SUSPENDED", 3);
define("USERSTATUS_DISABLED", 4);


// Status
define("STATUS_ACTIVE", 1);
define("STATUS_INACTIVE", 2);

//REPORT FEATURE POSITION
define("LHS", 1);
define("RHS", 2);


//report position
define("LHS_ONLY",1);
define("LHS_AND_RHS",2);

//lhs status
define("LHS_STATUS_ACTIVE", 1);
define("LHS_STATUS_INACTIVE", 2);

//rhs status
define("RHS_STATUS_ACTIVE", 1);
define("RHS_STATUS_INACTIVE", 2);

//voucher show or hide in menu list
define("VOUCHER_SHOW", 1);
define("VOUCHER_HIDDEN", 2);


// Voucher source
define("VOUCHER_FOR_ACCOUNT", 1);
define("VOUCHER_FOR_INVENTORY", 2);
define("VOUCHER_FOR_MODULE",3);

//stock input type
define("INPUT_PURCHASE","Purchase");
define("INPUT_SALE", "Sale");
define("INPUT_DONATION","Donation");
define("INPUT_AUCTION", "Auction");
define("INPUT_OPENING", "Opening");

//PRIORITY FOR REPORT FEATURE
define("PRIORITY_MASTER",1);
define("PRIORITY_SUB", 2);

//VOUCHER MASTER IDS
define("SALES",13);
define("PURCHASE",14);


//modules
define("MODULE_VAZHIPADU", 1);
$g_ARRAY_LIST_MODULE = array();
$g_ARRAY_LIST_MODULE[0]["id"] = 1;
$g_ARRAY_LIST_MODULE[0]["name"] = "MODULE_VAZHIPADU";

//ledger for from or to
define("FROM", 1);
define("TO", 2);



$g_ARRAY_LIST_STATUS = array();
$g_ARRAY_LIST_STATUS[0]["id"] = 1;
$g_ARRAY_LIST_STATUS[0]["name"] = "Active";
$g_ARRAY_LIST_STATUS[1]["id"] = 2;
$g_ARRAY_LIST_STATUS[1]["name"] = "Inactive";





$g_ARRAY_STATUS = array();
$g_ARRAY_STATUS[1] = "Active";
$g_ARRAY_STATUS[2] = "Inactive";


$g_ARRAY_record_per_page = array();
$g_ARRAY_record_per_page[0]["no_of_records"] = "10";
$g_ARRAY_record_per_page[1]["no_of_records"] = "20";
$g_ARRAY_record_per_page[2]["no_of_records"] = "50";
$g_ARRAY_record_per_page[3]["no_of_records"] = "100";



//timer arrays
$g_ARRAY_hours 		= array();
$g_ARRAY_minutes	= array();
$g_ARRAY_seconds	= array();
for($i=0; $i <= 5; $i++){
	$g_ARRAY_hours[$i]['hour'] = sprintf("%02s", $i);
}
for($i=0; $i < 60; $i++){
	$g_ARRAY_minutes[$i]['minute'] = sprintf("%02s", $i);
	$g_ARRAY_seconds[$i]['second'] = sprintf("%02s", $i);
}


GLOBAL $g_msg_unauthorized_request;
$g_msg_unauthorized_request = "<strong>Unauthorized Page Request</strong><br/> <br/> You are not authorized to access this page. This attempt will be reported to the system Administrator. ";

GLOBAL $g_msg_unauthorized_request_redirect_page;
$g_msg_unauthorized_request_redirect_page = "index.php";

GLOBAL $g_obj_select_default_text;
$g_obj_select_default_text = "Choose from list..";


//Email
define("EMAIL_FEEDBACK", "feedback@temple_soft.local");
define("EMAIL_NO_REPLY", "noreply@temple_soft.local");
define("EMAIL_INFO", "noreply@temple_soft.local");
define("EMAIL_SUPPORT", "noreply@temple_soft.local");


define("WEB_URL", "http://temple_soft.local");
define("ADMIN_URL", "http://temple_soft.local/admin");
define("WEB_NAME", "temple_soft.local");
define("ORG_NAME", "Sree Hariharasudha Ayyappa Temple");




//credit types
define("CREDIT_TYPE_PAYMENT", '1');
define("CREDIT_TYPE_TEST", '2');
define("CREDIT_TYPE_OFFER", '3');
define("CREDIT_TYPE_REPORT", '4');
define("CREDIT_TYPE_ORGANIZATION_CREDIT", '5');
define("CREDIT_TYPE_VOUCHER", '6');


//import default delimiter
define("DEFAULT_IMPORT_DELIMITER", ',');
define("DEFAULT_OPTION_DELIMITER", '#!@$&');
define("DEFAULT_ANSWER_KEY_DELIMITER", ',');
define("DEFAULT_IDS_DELIMITER", ',');

//Financial Year Status
define("FINANCIAL_YEAR_OPEN",'1');
define("FINANCIAL_YEAR_CLOSE", '0');


//vouchers
define('VOUCHER_VAZHIPADU',1);
define('VOUCHER_CASH_RECEIPT',8);
define('VOUCHER_CASH_PAYMENT', 9);
define('VOUCHER_BANK_RECEIPT', 10);
define('VOUCHER_BANK_PAYMENT', 11);


//MASTER LEDGERS
define('LEDGER_CAPITAL_ACCOUNT',5);
define('LEDGER_DIRECT_INCOME', 11);
define('LEDGER_DUTIES_AND_TAXES', 12);
define('LEDGER_SUNDRY_CREDITORS', 31);
define('LEDGER_SUNDRY_DEBITORS', 32);

//SUB LEDGER
define('LEDGER_SUB_VAZHIPADU', 'വഴിപാട്');

//vazhipadu cancel
define('CANCEL_STATUS_TRUE', 2);
define('CANCEL_STATUS_FALSE',1);


?>
