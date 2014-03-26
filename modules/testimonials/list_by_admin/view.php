<?php
  // prevent execution of this code by direct call from browser
  if ( !defined('CHECK_INCLUDED') ){
    exit();
  }
?>

<h1>Testimonials</h1>
<form name="frmsearch" id="frmsearch" method="POST" action="<?php echo $current_url;?>">
<table align="center">
<tr>
    <td colspan="5" class="page_caption">
   Search
    </td>
</tr>
    <tr>
      <td>User Id</td>
      <td><input   name="txtuserid" type="text" ><input type="hidden" name="testimonials_id" value="<?php if(isset($_POST['testimonials_id'])){echo $_POST['testimonials_id'];}else{ echo $mytestimonials->id;} ?>"></td>
</tr>
<tr>
	
	<td>Status</td>
      <td><?php populate_array("lststatus", $statuses,$mytestimonials->status_id,$disable=false); ?></td>
</tr>
<tr>
<td>Date</td>
      <td><input   name="txtdate" type="text" value="<?php if(isset($_POST['txtdate'])){echo $_POST['txtdate'];}else{ echo $mytestimonials->tdate;} ?>" ></td>
    </tr> 

</table>
<br />
 <input name="submit" value="submit" type="submit">
 </form>


<table  border="0" cellpadding="1px" cellspacing="1px">
     <tr><td colspan="6">&nbsp;</td></tr>
    <?php
    if ( $data_bylimit == false ){?>
     <tr><td colspan="6">&nbsp;</td></tr>
     <tr><td colspan="6" align="center" class="message" ><?php echo $MSG_mesg ?></td></tr>
     <tr><td colspan="6">&nbsp;</td></tr>
 </table>
    <?php
     }
     else{?>
    <tr>
        <th class="slno"> <?php echo $CAP_id?></th>
        <th><?php echo $CAP_userid?></th>
        <th><?php echo $CAP_statuses?></th>
        <th><?php echo $CAP_date?></th>
	<th><?php echo $CAP_edit?></th>

    </tr>

     <?php
     //to number each record in a page
    
     $style = "row_lite";
     $index = 0;
     $slno = ($Mypagination->page_num*$Mypagination->max_records)+1;

     while ( $count_data_bylimit > $index ){
        $link = "testimonial.php?id=".$data_bylimit[$index]["id"]."";
	   

         if ( $style == "row_lite" ){
            $style="row_dark";
        }
        else{
            $style="row_lite";
        }

        ?>
    <tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        <td><?php echo $data_bylimit[$index]["id"]; ?></td>
        <td><a href="<?php echo $link; ?>"><?php echo $data_bylimit[$index]["user_id"]; ?></a></td>
        <td><?php echo $statuses[$data_bylimit[$index]["status_id"]]; ?></td>
        <td><?php echo date("d/m/Y",strtotime($data_bylimit[$index]["date"])); ?></td>
	<td><a href="<?php echo $link; ?>">Edit</a></td>

    </tr><?php
         $index++;
    }
    ?>
    <tr><td colspan="5">&nbsp;</td></tr>
  </table>

        <!--For pagination. we can create a  diff style  & use-->
        <?php $Mypagination->pagination_style2(); ?>

      <?php } ?>


<div align="center">* You can Click on a user id or edit link to update or remove ""</div>
