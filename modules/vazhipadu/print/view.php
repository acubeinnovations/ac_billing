
<?php
if(!defined('CHECK_INCLUDED')){
	exit();
}
ob_start();
?>
<div>	
	<?php if($vazhipadu_details){?>
	

	<div class="row">
<table width="360" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="184" height="49">&nbsp;</td>
    <td width="96" height="49">&nbsp;</td>
    <td width="80" height="49">&nbsp;</td>
  </tr>
  <tr>
    <td width="184" height="15">&nbsp;</td>
    <td width="96" height="15">&nbsp;</td>
    <td width="80" height="15"><?php echo $vazhipadu->vazhipadu_rpt_number; ?></td>
  </tr>
  <tr>
    <td width="184" height="15"><?php echo $vazhipadu->pooja_description; ?></td>
    <td width="96" height="15">&nbsp;</td>
    <td width="80" height="15"><?php echo date("d-m-Y");?></td>
  </tr>
  <tr>
    <td width="184" height="14">&nbsp;</td>
    <td width="96" height="14">&nbsp;</td>
    <td width="80" height="14">&nbsp;</td>
  </tr>
  <tr>
    <td height="79" colspan="3">
    	<table width="360">
				<?php $i=0;$total = 0;
				while($i<count($vazhipadu_details)){
					$total += $vazhipadu_details[$i]['rate'];
				?>
				<tr>
					<td width="184" height="19"><?php echo $vazhipadu_details[$i]['name']	;?></td>
					<td width="96" height="19"><?php echo $vazhipadu_details[$i]['star']; ?></td>
					<td width="80" height="19"><?php echo $vazhipadu_details[$i]['rate']; ?></td>
					
				</tr>
				<?php $i++;}?>
        </table>
    </td>
    </tr>
  <tr>
    <td width="184" height="17">&nbsp;</td>
    <td width="96" height="17">&nbsp;</td>
    <td width="80" height="17"><?php echo $total;?></td>
  </tr>
  <tr>
    <td height="23" colspan="3"><?php echo $vazhipadu->vazhipadu_date; ?></td>
  </tr>
</table>
  </div>
	<?php }?>

</div>


<?php 
$print_content = ob_get_contents();
ob_end_clean();
$print_content;?>
