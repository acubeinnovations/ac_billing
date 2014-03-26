<?php

require(ROOT_PATH."/include/connection/connection.php");

$strSQL = "SELECT V.voucher_id ,V.voucher_name AS voucher FROM voucher V";
$rsRES = mysql_query($strSQL,$myconnection) or die(mysql_error(). $strSQL );
$vouchers = array();$i=0;
if ( mysql_num_rows($rsRES) > 0 )
{
  while ( list ($id,$name) = mysql_fetch_row($rsRES) ){
      $vouchers[$i]['id'] =$id;
      $vouchers[$i]['name'] =$name;
      $i++;
  }
    
}else{
    $vouchers = false;
}

$strSQL1 = "SELECT  id,name,ledgers FROM ac_books";
$rsRES1 = mysql_query($strSQL1,$myconnection) or die(mysql_error(). $strSQL1 );
$books = array();$i=0;
if ( mysql_num_rows($rsRES1) > 0 )
{
  while ( list ($id,$name,$ledgers) = mysql_fetch_row($rsRES1) ){
    $books[$i]["id"] =  $id;
    $books[$i]["name"] = $name;
    $books[$i]["ledgers"] = $ledgers;
    $i++;
  }
}else{
  $books = false;
}

$strSQL2 = "SELECT report_id,report_head FROM report";
$rsRES2 = mysql_query($strSQL2,$myconnection) or die(mysql_error(). $strSQL2 );
$reports = array();$i=0;
if ( mysql_num_rows($rsRES2) > 0 )
{
  while ( list ($id,$name) = mysql_fetch_row($rsRES2) ){
    $reports[$i]["id"] =  $id;
    $reports[$i]["name"] =  $name;
    
    $i++;
  }
  
}else{
  $reports =  false;
}


?>



<!-- Right Nav Section -->
<ul class="right">
  <?php if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == FINANCE && isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0){ ?>
    <li class="divider"></li>
    <li><a href="dashboard.php" >Dash Board</a></li>
    <li class="divider"></li>
    
    <li><a href="change_password.php">Change Password</a></li>
    <li class="divider"></li>

    <!--ACCOUNTING MENU STARTS-->
   
    <li class="has-dropdown">
      <a href="#">Accounting</a>
      <ul class="dropdown">
        <li class="has-dropdown">  
          <a href="#">Books</a>
          <ul class="dropdown">
            <li><a href="ac_books.php">Add Book</a></li>
            <?php if($books){
               $i=0;
              while($i<count($books)){
               $url = "ac_generated_vouchers.php?bid=".$books[$i]['id'];
            ?>
            <li><a href="<?php echo $url;?>"><?php echo $books[$i]['name'];?></a></li>
            <?php 
                $i++;
              }
            }
            ?>
          </ul>
        </li>

        <li><a href="ac_customer.php">Customer</a></li>
        <li><a href="ac_supplier.php">Supplier</a></li>
        <li class="has-dropdown"><a href="ac_ledgers.php">Ledgers</a>
          <ul class="dropdown">
            <li><a href="ac_ledgers.php">Add Ledger</a></li>
            <li><a href="ac_ledger_list.php">List Ledgers</a></li>
            <li><a href="ac_single_ledger.php">Single Ledger</a></li>
          </ul>
        </li>

        <li class="has-dropdown"> 
          <a href="ac_vouchers.php">Voucher</a>
          <ul class="dropdown">
            <li><a href="ac_vouchers.php">Add Voucher</a></li>
            <?php if($vouchers){
               $i=0;
              while($i<count($vouchers)){
               $url = "ac_generate_voucher.php?v=".$vouchers[$i]['id'];
            ?>
            <li><a href="<?php echo $url;?>"><?php echo $vouchers[$i]['name'];?></a></li>
            <?php 
                $i++;
              }
            }
            ?>
          </ul>
        </li>

        <li class="has-dropdown"><a href="ac_report.php">Reports</a>
          <ul class="dropdown">
            <li><a href="ac_report.php">Add Reports</a>
            <li><a href="ac_report_list.php">List Reports</a>
            <?php if($reports){
               $i=0;
              while($i<count($reports)){
               $url = "ac_show_report.php?slno=".$reports[$i]['id'];
            ?>
            <li><a href="<?php echo $url;?>"><?php echo $reports[$i]['name'];?></a></li>
            <?php 
                $i++;
              }
            }
            ?>
          </ul>
        </li>

        <li><a href="ac_financial_year.php">Financial Year</a></li> 

        <li class="has-dropdown">
          <a href="ac_stock.php">Stock</a>
          <ul class="dropdown">
            <li><a href="ac_stock.php">Add Item</a></li>
            <li><a href="ac_stock_register.php">Stock Register</a></li>
            <li><a href="ac_sale_register.php">Sale Register</a></li>
            <li><a href="ac_purchase_register.php">Purchase Register</a></li>
          </ul>
        </li>

        <li><a href="ac_account_settings.php">Settings</a></li>
        <li class="divider"></li>
      </ul>
    </li>
   
    <!--ACCOUNTING MENU ENDS-->

  <?php } ?>

  <li class="divider"></li>
  <?php if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0){ ?>
    <li><a href="logout.php"  >Logout</a></li>
  <?php } else {?>
    <li><a href="index.php"  >Login</a></li>
  <?php }?>

</ul>
