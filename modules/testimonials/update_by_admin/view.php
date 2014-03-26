<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?><form  name="frmupdate" id="frmupdate" method="post" action="<?php echo $current_url; ?>" enctype="multipart/form-data">
      <!--<html> --> 
            <table border="0" cellpadding="0" cellspacing="2"  >
                <tr>
                    <td colspan="2" class="page_caption">
                   
                    <?php echo $CAP_page_caption;   ?>
                    </td>
                </tr>
                <tr>
                    <td>&nbsp;&nbsp;</td>    
                    <td>&nbsp;</td>
                </tr>
                <tr>
		<td>
                        <?php echo$CAP_date?> :
                    </td>
                    <td>
                   <?php echo $mytestimonials->tdate; ?> 
                    </td>
                </tr>
                
                <tr>
                    <td>
                     <?php echo$CAP_testimonials?> :
                    </td>   
                    <td>
                          <textarea readonly> <?php echo $mytestimonials->testimonial; ?></textarea>
                    </td>
                </tr>

            
		
		

		<tr>
                    <td>
                       <input  type="checkbox" name="chkverify" id="chkverify" <?php if($mytestimonials->status_id==STATUS_ACTIVE){ echo "checked"; } ?> />
                    </td>   
                    <td>
                         <?php echo $CAP_verify ?> 
                    </td>
                </tr>
                
                <tr>
                    <td>&nbsp;</td>    
                    <td>&nbsp;</td>
                </tr>


                <tr>
					<td>&nbsp;</td>
                    <td><br />
                    
                    <input type="submit" name="submit" value="<?php echo $CAP_update?>" onClick="return validate_member_update();" >
                    <input type="Submit" name="submit" value="<?php echo $CAP_delete?>" onClick="return delete_member();">
<input type="hidden" name="h_id" value="<?php if( isset($_GET['id']) ){echo $mytestimonials->id;}elseif ( isset($_POST['h_id']) ){ echo $_POST['h_id'];}?>">
                    
                    
                   
                    </td>
                </tr>

                <tr>
                    <td colspan="2" align="center"><br />
                    
                    </td>
                </tr>
            </table>
            </form>
