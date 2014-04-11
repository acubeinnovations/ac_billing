<!--

var CURRENT_URL = '<?php echo $current_url ?>';
var DEFAULT_ACCOUNT_FROM = '<?php echo DEFAULT_ACCOUNT_FROM; ?>';
var DEFAULT_ACCOUNT_TO = '<?php echo DEFAULT_ACCOUNT_TO; ?>';

var INVENTORY_TYPE_SALE = '<?php echo INVENTORY_TYPE_SALE; ?>';
var INVENTORY_TYPE_PURCHASE = '<?php echo INVENTORY_TYPE_PURCHASE; ?>';

var inv_list_pull = '<?php echo populate_list_array("lstsourceitem", $voucher_source_items->get_filtered_list_array(SALES), "id","name", "",$disable=false,true);?>';

var inv_list_push = '<?php echo populate_list_array("lstsourceitem", $voucher_source_items->get_filtered_list_array(PURCHASE), "id","name", "",$disable=false,true);?>';

var sale_ledger_list = '<?php echo populate_list_array("lstinventory", $sale_ledgers, "id","name", "",$disable=false,true);?>';

var purchase_ledger_list = '<?php echo populate_list_array("lstinventory", $purchase_ledgers, "id","name", "",$disable=false,true);?>';

var ledger_list = '<?php echo populate_list_array("lstinventory", $ledgers, "id","name", "",$disable=false,true);?>';



var SALES_VOUCHER = '<?php echo SALES; ?>';
var PURCHASE_VOUCHER = '<?php echo PURCHASE; ?>';
-->