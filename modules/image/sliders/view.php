<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
} ?><form  name="frmimage_upload" id="frmimage_upload" method="post" action="<?php echo $current_url; ?>" onsubmit="return validate_image_upload();" enctype="multipart/form-data">
<table border="0" cellpadding="0" cellspacing="2"  >
<tr>
    <td colspan="2" align="center" class="page_caption">
        <?php echo $CAP_pagecaption ?>
    </td>
</tr>
<tr>
    <td colspan="2" align="center" class="errormessage">
        <?php if(isset($strERR)){ echo $strERR;}?><br /><br />
    </td>
</tr>
<tr>
    <td>
        <?php echo $CAP_upload_image ?>
    </td>
    <td><input type="file" name="fleimage" id="fleimage"  />
    </td>
</tr>
<tr>
    <td>
        <input type="submit" name="submit" value="<?php echo $CAP_OBJ_upload ?>" onClick="return validate_image_upload();">
    </td>
</tr>

<tr>
    <td> &nbsp;  </td>
</tr>
</table>
</form>
<table>
<tr>
    <td colspan="2" align="center" class="sub_caption">
       Sliders
    </td>
</tr>

<?php 
		$result =get_filenames(ROOT_PATH.SLIDER_DIR_PATH,"jpg","",true);
		$n = sizeof($result);
		for ($i = 0 ; $i < $n ; $i++ ){
?>
<tr>
    <td>
        <IMG width="80" src="<?php echo $result[$i]?>"/>
    </td>
    <td>
<form method="post" action="<?php echo $current_url; ?>" onsubmit="return confirm_delete_image();" >
		<input type="hidden" name="h_image" value="<?php echo $result[$i]?>" /> <input type="submit" name="submit" value="<?php echo $CAP_OBJ_delete ?>" >
</form>
    </td>
</tr>
<?php  } ?>




</table>

