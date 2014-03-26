<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}



?><!-- form update start-->
    <form target="_self" method="post" action="<?php echo $current_url; ?>" name="frmsettings">

    <table  border="0" cellpadding="0" cellspacing="2" >

    <tr>
        <td colspan="2" align="center" class="page_caption"><?php echo $conf_page_caption?> </td>
    </tr>


    <tr>
        <td><?php if(isset($error_msg) && trim($error_msg)) echo $error_msg; ?></td>
    </tr>   


    <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
    </tr>


<?php if ( isset($_SESSION[SESSION_TITLE.'administrator_type']) && $_SESSION[SESSION_TITLE.'administrator_type'] == ADMINISTRATOR ) { ?>

     <tr>
      <td><?php echo $conf_show_debug_window ?></td>
      <td><input <?php if($_SESSION[SESSION_TITLE.'gDEBUG'] == true){ ?> checked="true" <?php }?>  type ="checkbox" name="chkdebug" value="1" size="20" /></td>
    </tr> 
     

<?php } ?>


      <tr>
      <td><?= $conf_enable_online_editting ?></td>
      <td><input <?php if(isset($_SESSION[SESSION_TITLE.'gEDIT_MODE']) && $_SESSION[SESSION_TITLE.'gEDIT_MODE'] == true){ ?> checked="true" <?php }?> type ="checkbox" name="chkeditor" value="1" size="20" /></td>
    </tr> 

    <tr>
    <td>&nbsp;</td>    
    <td><input name="update" value="<?php echo $conf_submit_update ?>" type="submit"> &nbsp;&nbsp;
    <input type="hidden" name="h_check" value="<?php echo md5("CONF_SETTINGS"); ?>">

    
    </td>
    </tr>


    <tr>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
    </tr>

    </table>
    <br>
    </form> <!-- form update ends-->
