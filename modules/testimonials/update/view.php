<?php // prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
?>


      
<?php $breadcrumb='<a href="/index.php">Home</a> &raquo; <a href="/user_testimonials.php">Testimonials</a>';?>
<div class="innercontainer-blk">
					<p class="heading"><?php echo $CAP_page_caption?> </p>
					<form  target="_self" method="post" action="<?php echo $current_url?>" name="frmtestimonials" id="ajax-contact-form" >
						<div class="one-third column">
							<div class="form-box">
								
							</div><!-- End Box -->
						</div>
						<div class="sixteen columns">
						
							<div class="form-box">
								<label><?php echo $CAP_testimonials ?> <small>*</small></label>
								<textarea name="testimonials" id="testimonials" class="text" col=50 row=40></textarea>
							</div><!-- End Box -->
						</div>
						<div class="one-third column">
							<div class="form-box">
								
							
							</div><!-- End Box -->
						</div>
	
						<div class="sixteen columns">
							<div class="form-box">
							<input value="<?php echo $CAP_add ?>" type="submit" name="submit" class="button" />
								<input type="reset" class="button gray" value="Cancel">
							</div>
						</div>
					</form>
				</div>
				
				
            <!-- form end-->
    <script language="javascript" type="text/javascript">
    //<!--
            document.getElementById("testimonials").focus();
   //-->
    </script>
