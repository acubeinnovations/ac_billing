

<!-- Right Nav Section -->
<ul class="right">
<?php if(isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == COUNTER && isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0){ ?>
  <li class="divider"></li>
  <li><a href="dashboard.php" >Dash Board</a></li>

  <li class="divider"></li>

  <li class="has-dropdown">
    <a href="#">Vazhipadu</a>
    <ul class="dropdown">
      <li><a href="vazhipadu.php">Add Vazhipadu</a></li>
      <li><a href="vazhipadu_register.php">Vazhipadu Register</a></li>
      <li><a href="pooja_register.php">Pooja Register</a></li>
    </ul>
  </li>


<?php } ?>

  <li class="divider"></li>
<?php if(isset($_SESSION[SESSION_TITLE.'userid']) && $_SESSION[SESSION_TITLE.'userid'] > 0){ ?>
  <li><a href="change_password.php"  >Change Password</a></li>
  <li class="divider"></li>
  <li><a href="logout.php"  >Logout</a></li>
<?php } else {?>
  <li><a href="index.php"  >Login</a></li>
<?php }?>

</ul>
