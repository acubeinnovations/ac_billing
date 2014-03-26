<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/testimonials.php">Testimonials</a>'; ?>
<div class="innercontainer-blk">
					<p class="heading">
						<span class="fleft">Testimonials</span>
						
					</p>
					<?php $index=0; while($index<count($data_bylimit)){ ?>
					<div class="two-thirds column mright8 bottom-1">
						<div class="inner-box">
									
						</div>	
					</div>
					<div class="sixteen columns bottom-1">
						<?php echo '<label>'.$user_name[$data_bylimit[$index]["user_id"]].' Date :  '.date('d/m/Y',strtotime($data_bylimit[$index]["date"])).'</label><br><br>'.$data_bylimit[$index]["testimonial"];  ?>
					</div>
					<div class="one-third column mright8 bottom-1">
						<div class="inner-box">
							
							
							
						</div>	
					</div>
					<?php $index++; } ?>
					<div class="sixteen columns bottom-1">
						<span class="pagination fright">
						 <?php $Mypagination->pagination_style_number_with_button(); ?>	
						</span>
					</div>
			

   		</div>





