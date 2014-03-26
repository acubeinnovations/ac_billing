
<form  target="_self" method="post" action="<?php echo $current_url?>" name="frm">

		<table>
		<tr>
			<td colspan="2" class="page_caption">Language</td>
		</tr>
		<tr>
				<td colspan="2" align="right"><a style="float:right; color:#000"; href="languages.php">List All</a> &nbsp;</td>
		</tr>
		<tr>
				<td colspan="2"></td></tr>		
		<tr>
		<td valign="top">Language <span style="color:red;">*</span> &nbsp;</td>	
		<td><input name="txtlanguage" type="text" id="txtlanguage" value= "<?php echo $mylanguage->language; ?>"/></td>
        <td>	</td>	
		<tr>
		<td valign="top">Publish <span style="color:red;">*</span> &nbsp;</td>	
		<td>
		<?php populate_array("lstpublish", $g_ARRAY_language_status, $mylanguage->publish,$disable=false); ?>
		
        <td>	</td>	
		
		<tr>
		</tr>
        <tr>
       <td colspan="2" align="center">
			<input name="submit" type="submit" value="submit" onclick="return validate();" />
			<input type="hidden" name="h_id" id="h_id" value="<?php echo $mylanguage->id;?>" >
			</td>
         </tr>   
		</tr>
		<tr>
		
</table>

</form>
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("txtlanguage").focus();
   //-->
    </script>
