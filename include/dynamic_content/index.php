<?php 

$tmp_heading = "index page";

$heading = $this->content->get_content(CONF_TYPE_TEXT,"Index Heading","index.php",$tmp_heading);

$tmp_content = "Welcome  ....";

$index_content = $this->content->get_content(CONF_TYPE_HTML,"Index Content","index.php",$tmp_content);


?>
