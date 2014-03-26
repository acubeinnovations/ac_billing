<?php 
	$url_profile ="#";
	$organization_prefix = "";

	if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == REGISTERED_ORGANISATION ){
		$organization_prefix = "/organization";
	}

	if(isset($_SESSION[SESSION_TITLE.'userid'])){ 
		
			$url_profile = $organization_prefix."/profile.php";
		
?>
<a href="<?php echo $url_profile ?>" class="no-border" >Welcome <?php echo $_SESSION[SESSION_TITLE.'name']; ?></a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php }
?>
<!--<a href="/special_demo.php" class="active no-border">Trivandrum LDC 2013</a>-->
<a href="#" class="active no-border"><b>Helpline :</b> 91882 31779</a>
<a href="<?php echo WEB_URL ; ?>/downloads/Quick User Guide - 2013 Nov 5.pdf" target="_blank" class="active no-border" style="background:#5DA79C !important;">User Guide</a>
<a href="<?php echo WEB_URL ; ?>/aboutus.php" <?php if($this->page_name == "aboutus"){?> class="active no-border"<?php  }?>>About Us</a>
<a href="<?php echo WEB_URL ; ?>/faq.php" <?php if($this->page_name == "faq"){?> class="active no-border"<?php  }?>>FAQ</a>
<a href="<?php echo WEB_URL ; ?>/contactus.php" <?php if($this->page_name == "contactus"){?> class="active no-border"<?php  }else{?> class="no-border" <?php } ?> >Contact Us</a>&nbsp;&nbsp;&nbsp;&nbsp;
<?php if(isset($_SESSION[SESSION_TITLE.'userid'])){ ?>

	<a href="<?php echo $organization_prefix; ?>/change_password.php" <?php if($this->page_name == "change_password"){?> class="active no-border"<?php  }?> >Change Password</a>
	<a href="<?php echo $organization_prefix; ?>/logout.php" class="no-border">Logout</a>

<?php }else{ ?>
	<a href="<?php echo WEB_URL ; ?>/login.php" <?php if($this->page_name == "login"){?> class="active no-border"<?php  }?>>Login</a>
	<a href="<?php echo WEB_URL ; ?>/sign_up.php"  <?php if($this->page_name == "sign_up"){?> class="active no-border"  <?php  }else{ ?> class="no-border"  <?php } ?> >Sign Up</a>
	
<?php } ?>






