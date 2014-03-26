<?php if($data > 0){ ?>
<form name="frmsearch" id="frmsearch" method="GET" action="<?php echo $current_url;?>">
<table>
	   <tr><td colspan="2" class="page_caption">  Language  </td>  </tr>
	    <tr>
				<td colspan="6"></td>
		</tr>
	   <tr><td><a style="float:right; color:#000"  href="language.php">Add Language</a><br /> Search &nbsp;<input  name="txtlanguage" value="<?php if(isset($_GET['txtlanguage'])){
	  
	  echo $_GET['txtlanguage'];
	  }
		  ?>"> <input name="submit" type="submit" value="submit" /></td><tr>
		
</table>
</form>
<table>
		<tr>
			
				<th>Sl</th>
				<th>Name</th>
				<th>Update</th>
				<th>Delete</th>
		</tr>
		<?php		
						$style = "row_lite";
						$sl=1;
						$index=0;
						while($counts > $index){
						 if ( $style == "row_lite" ){
           				 $style="row_dark";
        				}
        				else{
          			  	$style="row_lite";
        				}	
							 ?>
		<tr onmouseover="this.className='row_highlight'" onmouseout="this.className='<?php echo $style; ?>'"  class="<?php echo $style; ?>" >
        		<td align="center"><?php echo $sl; ?></td>
				<td align="center"><?php echo $data[$index]["language"]; ?></td>
				<td align="center"><a href="language.php?id=<?php echo $data[$index]["id"]; ?>">edit</a></td>
				<td align="center"><a href="language.php?delid=<?php echo $data[$index]["id"]; ?>">delete</a></td>
				
		</tr>
		<?php
						$index++;
						$sl++;
						}
		?>
	
</table>
<?php  $Mypagination->pagination_style2();

}else{?>

No Records Found.

<?php } ?>
