<!-- form update start-->
	<form target="_self" method="post" action="<?php echo $current_url; ?>" name="frmconf">

	<table border="0" cellpadding="0" cellspacing="2"  >
		<tr>
		    <td colspan="2" class="page_caption">
		   Dynamic Content
		    </td>
		</tr>
		<tr>
			<td align="center" class="errormessage" colspan="2"><?php if(isset($error_msg)) { echo $error_msg; } ?></td>
		</tr>	

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>

		<tr>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>



		<tr>
			
			<td colspan="2" class="td_ckeditor">
				<textarea <?php echo $editor; ?> name="txt_content"><?php echo $str_content; ?></textarea>
			</td>
		</tr>
		
	<tr>
	<td>&nbsp;</td>
	<td><strong>[</strong> <input <?php if ($intpublish == CONF_PUBLISH ){ ?> checked="true" <?php } ?> type="checkbox" name="chk_publish" value="<?= CONF_PUBLISH ?>" > <?= $conf_publish ?> <strong>]</strong>&nbsp;&nbsp;&nbsp;<input name="update" value="<?= $conf_submit_update ?>" type="submit"> &nbsp;&nbsp;
<input name="delete" onClick="return delete_conf();" value="<?= $conf_submit_delete ?>" type="submit"> 
	<input type="hidden" name="h_contentinfo" value="<?php echo md5("CONF_INFO"); ?>">
	<input type="hidden" name="h_contentid" value="<?= $int_contnent_id ?>" >
	
	</td>
	</tr>


	<tr>
	<td>&nbsp;</td>
	<td>&nbsp;</td>
	</tr>
	</tbody>
	</table>
	<br>
	</form> <!-- form update ends-->
