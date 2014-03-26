<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
	exit();
}

class Page {
	// top part of html

	
	var $title='Acube MVC';
	var $page_name='';
	var $layout='default.html';

	var $connection_list = array();
	var $conf_list = array();
	var $menuconf_list = array();
	var $class_list = array();

	var $dynamic_content_list = array();

	var $content_list = array();
	var $script_list = array();
	var $script_list_link = array();
	var $style_list = array();
	var $function_list = array();
    var $access_list = array();

	var $root_path='./';
	var $connection_path='include/connection/';
	var $conf_path='include/conf/';
	var $menuconf_path='include/menuconf/';

	var $dynamic_content_path='include/dynamic_content/';

	var $class_path='include/class/';
	var $include_path='include/';
	var $function_path='include/functions/';
	var $content_path='include/class/class_content/';

	var $script_path='script/';
	var $script_link_path='script/';
	var $style_path='style/';
	var $current_url ;

	var $module_path='modules/';


	var $use_dynamic_content=false;
	var $content;
	
	var $debug_state=false;
	var $debug_output='';

	var $module = "" ;

	var $style='';
	var $script='';
	var $print_page='';

	var $logger = false;
	var $log = "";
	var $log_path = "files/logs/";
	var $log_file = "";

    function __construct()
    {

    }




	function display(){
		
		$page_name = $this->page_name;
		$current_url = $this->current_url;
	
		ob_start();
		if($this->logger==true){
			$this->log_file = date('d-m-Y').".log";
			$this->log .= "\n ---------------Start:".$this->page_name."----------------";
			$this->log .= "\n -------------".$this->get_time("Y-m-d H:i:s") ." -- ".microtime()."----------------\n";
		}
		ob_end_clean();

		ob_start();	
		$filename = $this->root_path.$this->conf_path.'system_conf.php';
		eval("\$filename = \"$filename\";");
		if (file_exists($filename)) {
			include($filename);
		}else{
			echo 'File :: '.$filename ." not exists. <br/>";
		}
		$debug_output .= ob_get_contents();
		ob_end_clean();






		if(count($this->conf_list) > 0){
			foreach ($this->conf_list as $conf_file){
				ob_start();	
				$filename = $this->root_path.$this->conf_path.$conf_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					include($filename);
				}else{
					echo 'File :: '.$filename ." not exists. <br/>";
				}
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}
			
		}








        if(count($this->access_list) > 0){
       $chk = false;
                foreach ($this->access_list as $user_type){
  
				
                        if ( isset($_SESSION[SESSION_TITLE.'user_type']) && $_SESSION[SESSION_TITLE.'user_type'] == constant($user_type) ) {
                                       $chk = true;
                        }
                        
                }

                 if ( $chk == false ){
                            $_SESSION[SESSION_TITLE.'flash'] = $g_msg_unauthorized_request;
                            //$_SESSION[SESSION_TITLE.'flash_redirect_page'] = $g_msg_unauthorized_request_redirect_page;
                            header( "Location: index.php");
                            exit();
                 }


        }
			
	








		if(count($this->connection_list) > 0){
			foreach ($this->connection_list as $connection_file){
				ob_start();	
				$filename = $this->root_path.$this->connection_path.$connection_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					include($filename);
				}else{
					echo 'File :: '.$filename ." not exists. <br/>";
				}
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}
			
		}













		if ($this->use_dynamic_content == true){

			ob_start();	
			$filename = $this->root_path.$this->content_path.'class_content_conf.php';
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				include($filename);

			}else{
				echo 'File :: '.$filename ." not exists. <br/>";
			}
			$debug_output .= ob_get_contents();
			ob_end_clean();




			ob_start();	
			$filename = $this->root_path.$this->content_path.'class_content.php';
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				include($filename);
			
				$this->content = new Content;
				$this->content->connection = $myconnection;
				
			}else{
				echo 'File :: '.$filename ." not exists. <br/>";
			}
			$debug_output .= ob_get_contents();
			ob_end_clean();





			ob_start();	
			$filename = $this->root_path.$this->dynamic_content_path.'default_dynamic_content.php';
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				include($filename);
			}else{
				echo 'File :: '.$filename ." not exists. <br/>";
			}
			$debug_output .= ob_get_contents();
			ob_end_clean();




		}












		if(count($this->menuconf_list) > 0){
			foreach ($this->menuconf_list as $menuconf_file){
				ob_start();	
				$filename = $this->root_path.$this->menuconf_path.$menuconf_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					include($filename);
				}else{
					echo 'File :: '.$filename ." not exists. <br/>";
				}
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}
			
		}




		if(count($this->function_list) > 0){
			foreach ($this->function_list as $function_file){
				ob_start();	
				$filename = $this->root_path.$this->function_path.$function_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					include($filename);
				}else{
					echo 'File :: '.$filename ." not exists. <br/>";
				}
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}
			
		}

		if(trim($this->module) != ""){
			ob_start();	
			$filename = $this->root_path.$this->module_path.$this->module."/conf.php";
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				include($filename);
			}else{
				echo 'File :: '.$filename ." not exists. <br/>";
			}
			$debug_output .= ob_get_contents();
			ob_end_clean();		
		}





		if(count($this->class_list) > 0){
			foreach ($this->class_list as $class_file){
				$class_file = substr($class_file,0,strlen($class_file)-4);


				ob_start();	
				$filename = $this->root_path.$this->class_path.$class_file."/".$class_file."_conf.php";
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					include($filename);
				}else{
					echo 'File :: '.$filename ." not exists. <br/>";
				}
				$debug_output .= ob_get_contents();
				ob_end_clean();



				ob_start();	
				$filename = $this->root_path.$this->class_path.$class_file."/".$class_file.".php";
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					include($filename);
				}else{
					echo 'File :: '.$filename ." not exists. <br/>";
				}
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}
			
		}



		if(count($this->dynamic_content_list) > 0){
			foreach ($this->dynamic_content_list as $dynamic_content_file){
				ob_start();	
				$filename = $this->root_path.$this->dynamic_content_path.$dynamic_content_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					include($filename);
				}else{
					echo 'File :: '.$filename ." not exists. <br/>";
				}
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}
			
		}


		if(count($this->style_list) > 0){
			foreach ($this->style_list as $style_file){
				$filename =$this->root_path.$this->style_path.$style_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					$this->style.='<link rel="stylesheet" type="text/css" href="'.$filename.'">';
				}else{
					$debug_output .= 'File :: '.$filename ." not exists <br/>";
				}
				
			}
			
		}	

	
		if(count($this->script_list_link) > 0){
			foreach ($this->script_list_link as $script_link_file){
				$filename =$this->root_path.$this->script_link_path.$script_link_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					$this->script.='<script src="'.$filename.'" language="JavaScript" type="text/JavaScript"></script>';
				}else{
					$debug_output .= 'File :: '.$filename ." not exists. <br/>";
				}
			}	
		}


		if(count($this->script_list) > 0){
			$this->script.='<script language="JavaScript" type="text/JavaScript">';
			foreach ($this->script_list as $script_file){
				$filename = $this->root_path.$this->script_link_path.$script_file;
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)) {
					ob_start();
					include($filename);
					$this->script .= ob_get_contents();
					ob_end_clean();
				}else{
					$debug_output .='File :: '.$filename ." not exists. <br/>";
				}
			}
			$this->script.='</script>';	
		}


		if(trim($this->module) != ""){

			$filename = $this->root_path.$this->module_path.$this->module."/style.css";
		                    
			eval("\$filename = \"$filename\";");
		            
			if (file_exists( $filename)) {
				$this->style.='<link rel="stylesheet" type="text/css" href="'.$filename.'">';
			}else{
				$debug_output .= 'File :: '.$filename ." not exists <br/>";
			}
		





			$filename = $this->root_path.$this->module_path.$this->module."/script.js";
			eval("\$filename = \"$filename\";");
		            
			if (file_exists($filename)) {
				$this->script.='<script src="'.$filename.'" language="JavaScript" type="text/JavaScript"></script>';
			}else{
				$debug_output .= 'File :: '.$filename ." not exists. <br/>";
			}






		}



		if(count($this->content_list) > 0){
			foreach ($this->content_list as $content_tmp){

				$filename = $this->root_path.$this->include_path.$content_tmp['file_name'];
				eval("\$filename = \"$filename\";");
				if (file_exists($filename)){ 
					ob_start();
					include($filename);
					if(isset($content_tmp['var_name']) && trim($content_tmp['var_name']) != ""){	
						if(isset($$content_tmp['var_name']) && trim($$content_tmp['var_name'])!=""){
							$$content_tmp['var_name'] .= ob_get_contents();
						}else{
							$$content_tmp['var_name'] = ob_get_contents();
						}
	
					}else{
							$debug_output .= ob_get_contents();
					}
					ob_end_clean();
				}else{
					$debug_output .= 'File :: '.$filename ." not exists. <br/>";
				}
			}
		}

		if(trim($this->module) != ""){
			$filename = $this->root_path.$this->module_path.$this->module."/functions.php";
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				ob_start();	
				include($filename);
				$this->print_page .= ob_get_contents();
				ob_end_clean();

			}else{
				ob_start();
				echo 'File :: '.$filename ." not exists. <br/>";
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}


			$filename = $this->root_path.$this->module_path.$this->module."/code.php";
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				ob_start();	
				include($filename);
				$this->print_page .= ob_get_contents();
				ob_end_clean();

			}else{
				ob_start();
				echo 'File :: '.$filename ." not exists. <br/>";
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}

			$filename = $this->root_path.$this->module_path.$this->module."/style.php";
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				ob_start();
				include($filename);
				$this->style.='<style>';
				$this->style .= ob_get_contents();
				$this->style.='</style>';
				ob_end_clean();
			}else{
				$debug_output .='File :: '.$filename ." not exists. <br/>";
			}

						$filename = $this->root_path.$this->module_path.$this->module."/script.php";
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				ob_start();
				include($filename);
				$this->script.='<script language="JavaScript" type="text/JavaScript">';
				$this->script .= ob_get_contents();
				$this->script.='</script>';
				ob_end_clean();
			}else{
				$debug_output .='File :: '.$filename ." not exists. <br/>";
			}

			$filename = $this->root_path.$this->module_path.$this->module."/view.php";
			eval("\$filename = \"$filename\";");
			if (file_exists($filename)) {
				ob_start();	
				include($filename);
				$this->print_page .= ob_get_contents();
				ob_end_clean();

			}else{
				ob_start();
				echo 'File :: '.$filename ." not exists. <br/>";
				$debug_output .= ob_get_contents();
				ob_end_clean();
			}
		}

		if (defined('gDEBUG') ){
			$this->debug_state = gDEBUG;
		}

		$this->debug_output.=$debug_output;

		if($this->debug_state == true){
			$this->debug_output($this->debug_output);
		}

		include($this->root_path.'layouts/'.$this->layout);
		ob_start();
		if($this->logger==true){
			$this->log .= "\n -------------".$this->get_time("Y-m-d H:i:s") ." -- ".microtime()."----------------";
			$this->log .= "\n ---------------End:".$this->page_name."----------------";
			$this->write_log();
		}
		ob_end_clean();
	}


	
	
	
	function get_content($content_list){
	
	ob_start();
		
		$current_url = $this->current_url;
		$myconnection = $this->db_connection;
		$page_name = $this->page_name;
		foreach ($content_list as $content){	
			include($this->root_path.$include_path.$content);	
		}
		$output = ob_get_contents();
	ob_end_clean();
		return $output;
	}

	function debug_output($debug_output){
		echo '<div style="overflow:auto; width:100%; height:130px;background-color:#FFF87B; position:absolute;" onclick="this.style.display=\'none\';" title="Click to close Error Console">';
		echo '<div align="center"><span style="font-weight : bold; font-size:16px;" >Debug Window</span></div> <br/>';
		
		echo 'Pagename : '.$this->page_name.'<br/>';
		echo $debug_output;
		echo '<br/><div align="center"><a href="#" onclick="this.style.display=\'none\'; return false;">Close</a></div>';
		echo  '</div>';
	}



	function write_log(){
		$log_file = $this->root_path.$this->log_path.$this->log_file; 
		//eval("\$filename = \"$filename\";");
		if (!file_exists($log_file)) {
			$file = fopen($log_file, "a+") or exit("Unable to open file!");
			fclose($file);
		}
		file_put_contents($log_file, $this->log, FILE_APPEND);
		exit();
	}



	function get_time($format, $utimestamp = null) {
	  if (is_null($utimestamp))
		$utimestamp = microtime(true);

	  $timestamp = floor($utimestamp);
	  $milliseconds = round(($utimestamp - $timestamp) * 1000000);

	  return date(preg_replace('`(?<!\\\\)u`', $milliseconds, $format), $timestamp);
	}


}// calss Page **************  END
?>
