<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?><form target="_self" method="GET" action="<?php echo $current_url; ?>" name="frmsearch">
<table align="center">
	<tr>
        <td colspan="5" align="center" class="page_caption">
        <?php echo $CAP_page_caption?>
        </td>
	</tr>
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>

     <tr>
      <td><?= $CAP_language ?></td>
      <td><?php loadlanguage_admin("lstlanguage", -1, "Select Language",$language_id,false,'style="width:210px; height:22;"'); ?></td>
    </tr> 
     <tr>
      <td><?= $CAP_contenttype ?></td>
      <td><?php loadcontenttypes("lstcontenttype", -1, "Select content Type",$contenttype_id,false,'style="width:210px; height:22;"'); ?></td>
    </tr> 

     <tr>
      <td><?= $CAP_pagename ?></td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35"
 name="txtpagename" value="<?php echo $pagename; ?>"></td>
    </tr> 
     

    <tr>
      <td><?=  $CAP_confname; ?></td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35"
 name="txtcontentname" value="<?php echo $contentname; ?>"></td>
    </tr>    
    
     <tr>
      <td><?=  $CAP_content; ?></td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35"
 name="txtcontent" value="<?php echo $content; ?>"></td>
    </tr>    
     <tr>
      <td><?=  $CAP_description; ?></td>
      <td><input  style="width: 210px; height:22;"  maxlength="100" size="35"
 name="txtdescription" value="<?php echo $description; ?>"></td>
    </tr>    
    
     <tr>
      <td><?=  $CAP_publish; ?></td>
      <td><input type="checkbox"  name="chk_publish" value="1" <?php if($publish == 1) { ?> checked="true" <?php } ?> ></td>
    </tr>  
 
    <tr>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <tr>
      <td>&nbsp;&nbsp;</td>
      <td><input name="submit" value="<?= $CAP_submit_search ?>" type="submit"><input type="hidden" name="h_CAP_search" value="<?php echo md5("CONF_SEARCH"); ?>"></td>
    </tr>

</table>
</form>
<table  border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="6">&nbsp;</td></tr>
   <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="6">&nbsp;</td></tr>
     <tr><td colspan="6" align="center" class="message" ><?= $mesg ?></td></tr>
     <tr><td colspan="6">&nbsp;</td></tr>
    <?
     }
     else{?>
    <tr>
		<th class="slno"></th>
		<th>Language  </th>  
		<th>Conf Type</th>
		<th>Conf Name</th>
		<th>Page name</th>
		<th>Content</th>
		<th>Description</th>
		<th>Publish</th>

    </tr>

     <?
     //to number each record in a page
    
     $style = "row_lite";
	 $index = 0;
	 $slno = $Mypagination->start_record+1;

     while ( $count_data_bylimit > $index ){
        $link = "contents_update.php?id=".$data_bylimit[$index]["id"]."";
         if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }

        ?>
    <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?= $slno++ ?></td>
        <td><?php echo $data_bylimit[$index]["language_name"]; ?></td>
        <td><?php echo $data_bylimit[$index]["contenttype_name"]; ?></td>
        <td><a target="_blank" href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["name"]; ?></a></td>
        <td><?php echo $data_bylimit[$index]["page_name"]; ?></td>
        <td><?php echo  substr(htmlentities( stripslashes( nl2br($data_bylimit[$index]["content"]))) ,0,50) ; ?></td>
        <td><?php echo $data_bylimit[$index]["description"]; ?></td>
        <td align="center"><?php echo $data_bylimit[$index]["publish_status"]; ?></td>
    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="6">&nbsp;</td></tr>
    <tr><td colspan="6" align="center">
        <!--For pagination. we can create a  diff style  & use-->
        <?$Mypagination->pagination_style1();?>
        </td></tr>
      <?}?>
      </table>
