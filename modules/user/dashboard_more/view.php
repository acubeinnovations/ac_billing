<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/dashboard.php">Dashboard</a> &raquo; <a href="/dashboard.php?id='.$id.'">Quizzes</a>'; ?>

<div class="innercontainer-blk">
					<p class="heading">
					
						<span class="fleft">Dashboard</span>
						<span class="pagination fright">
						<?php  $Mypagination->pagination_style_number_with_button();?>		
						</span>
					</p>
					
										<div class="two-thirds column mright8 bottom-1">
											<div class="inner-box">
											<p class="sub-heading bottom-1">Quizzes</p>
											
							<?php if ( $data_real_quiz == false ){?>
								<?php }else{ 
		$index = 0;
		$slno = 1;
		//echo $exams[$data_real_quiz[$index]["exam_id"]];
		?><p class="bottom-1 description"><strong><?php echo $exams[$data_real_quiz[$index]["exam_id"]];?></strong></p><?php
		while ($count_real_quiz > $index ){	
			$link = "/test_start.php?id=".$data_real_quiz[$index]["id"];
			


?>
			<p class="bottom-1 description"><?php echo $slno; ?> :  <?php echo $data_real_quiz[$index]["name"]; ?> ( <?php echo $data_real_quiz[$index]["credit"]; ?> Credits )<br /><a href="<?php echo $link; ?>"><input type="submit" class="button" value="TAKE TEST"></a></p>														
							
							<?php 
		
		$slno++;
		$index++;
			}
			
			
		 } ?>		
		 
					</div>	
					</div>
					
			

		
			
			<div class="one-third column mright8 bottom-1">
						<div class="inner-box">
							<div class="credit-balance">
								<p class="head">Credit Balance:</p>
								<div class="dblk">
									<p class="fleft"><?php if(isset($_SESSION[SESSION_TITLE.'user_credit'])) echo $_SESSION[SESSION_TITLE.'user_credit']; ?></p>
									<p class="fright"><a href="/get_credit.php"><input type="button" class="button" value="Get Credit"></a></p>
								</div>
							</div>
			
			
			
			
			
			
								<div class="other-blk">
								<div class="dblk">
									<p class="head"><?php echo $total_quiz_number;?></p>
									<p>Quiz attempted</p>
								</div>
								
								<div class="dblk no-border">
									<p class="head"><?php echo $total_finished_quiz_number;?></p>
									<p>Quiz completed so far</p>
								</div>
			
						</div>	
					</div>
					<div class="sixteen columns bottom-1">
						<span class="pagination fright">
							<?php  $Mypagination->pagination_style_number_with_button();?>		
						</span>
					</div>
				</div>

