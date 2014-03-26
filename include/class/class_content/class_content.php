<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
	exit();
}

class Content {

	var $root_path='./';
	var $connection;
	var $editor_mode=false;
	var $editor_page='admin/contents_update.php';
	var $editor_page_width=700;
	var $editor_page_height=500;
	var $editor_page_top=100;
	var $editor_page_left=100;

	var $search_page='contents_search.php';

	var $id ;
	var $name ;

	var $language_id ;
	var $language_name;

	var $contenttype_id ;
	var $contenttype_name;

	var $page_id ;
	var $page_name ;

	var $content ;
	var $publish ;
	var $publish_status ;


// for error handling
	var $err_no=gINVALID;
	var $err_desc="";

// for pagination
	var $total_records = "";


	function get_content($contenttype_id,$name,$page_name,$content="",$description="",$language_id="") {
		if($language_id==""){
			if(isset($_SESSION[SESSION_TITLE.'gLANGUAGE']) && $_SESSION[SESSION_TITLE.'gLANGUAGE'] > 0){
				$language_id=$_SESSION[SESSION_TITLE.'gLANGUAGE'];
			}else{
				$language_id=CONF_LANG_ENGLISH;
			}
		}
		 
		$strSQL = "SELECT C.id, C.content, C.publish FROM contents C, pages P WHERE P.id= C.page_id AND P.name='".addslashes($page_name)."' AND C.language_id='".$language_id."'  AND C.contenttype_id='".$contenttype_id."' AND C.name='".addslashes($name)."' ";
		$result = mysql_query($strSQL, $this->connection) or die (mysql_error() . $strSQL);
		$count_content= mysql_num_rows($result);

		if ($count_content > 0) {
			$row_content = mysql_fetch_assoc($result);
			if($row_content['publish'] == CONF_NOT_PUBLISH) {
				$content = stripslashes($content);
			}else{
				$content = stripslashes($row_content['content']);
			}
			$content_id = $row_content['id'];

		} else {

			$strSQL = "SELECT P.id FROM pages P WHERE  P.name='".addslashes(nl2br($page_name))."' ";
			$result = mysql_query($strSQL, $this->connection) or die (mysql_error() . $strSQL);
			$count_page= mysql_num_rows($result);
			if ($count_page > 0) {
				$page_id = mysql_result($result,0,'id');
			}else{
				$strSQL = "INSERT INTO pages (name) VALUES ('".addslashes(nl2br($page_name))."')";
				$result = mysql_query($strSQL, $this->connection) or die (mysql_error() . $strSQL);
				$page_id = mysql_insert_id();
			}

			$strSQL = "INSERT INTO `contents` (  `name` , `page_id` , `content` , `description` , `language_id` , `contenttype_id` )  VALUES ('".addslashes($name)."', '".$page_id."', '".addslashes($content)."', '".addslashes($description)."', '".$language_id."', '".$contenttype_id."' )";
			$result = mysql_query($strSQL, $this->connection) or die (mysql_error() . $strSQL);
			$content = stripslashes($content); 
			$content_id = mysql_insert_id();
		}

	if (defined('gEDIT_MODE') ){
		$this->editor_mode = gEDIT_MODE;
	}

	if($this->editor_mode == true &&  $contenttype_id != CONF_TYPE_DYNAMIC_TEXT && $contenttype_id != CONF_TYPE_OBJECT_CAPTIONS && $contenttype_id != CONF_TYPE_SYSTEMCONF  ){
		$content = '<div style=" cursor:pointer;border:1px;border-color:red;border-style:solid; color:inherit;" onclick="window.open(\''.$this->editor_page.'?id='.$content_id.'\',\'popuppage\',\'width='.$this->editor_page_width.',menubar=0,location=0,resizable=1,scrollbars=yes,height='.$this->editor_page_height.',top='.$this->editor_page_top.',left='.$this->editor_page_left.'\');" >'.$content.'</div>';
	}
	
		return $content;

	}






    function get_list_array_bylimit($language_id=-1,$contenttype_id=-1,$name="",$page_name="",$content="",$description="", $publish="", $start_record = 0,$max_records = 25){

        $limited_data = array();
		$i=0;

        $strSQL = "SELECT C.*, P.name as page_name, L.name as language_name, CT.name as contenttype_name FROM contents C, pages P, languages L, contenttypes CT WHERE P.id= C.page_id AND L.id=C.language_id AND CT.id=C.contenttype_id";

		$str_condition = "";
		if ($language_id != -1 && $language_id != "" ) {

			$str_condition .= " AND C.language_id ='" . $language_id . "'" ;
		
		}

		if ($contenttype_id != -1 && $contenttype_id != "") {

			$str_condition .= " AND C.contenttype_id ='" . $contenttype_id . "'" ;

		}

		if ($page_name != "") {

				$str_condition .= " AND P.name LIKE '%" . addslashes($page_name) . "%'" ;

		}

		if ($name != "") {

				$str_condition .= " AND C.name LIKE '%" . addslashes($name) . "%'" ;

		}

		if ($content != "") {

				$str_condition .= " AND C.content LIKE '%" . addslashes($content) . "%'" ;

		}

		if ($description != "") {

				$str_condition .= " AND C.description LIKE '%" . addslashes($description) . "%'" ;

		}


		if ($publish != "") {

				$str_condition .= " AND C.publish LIKE '" . $publish . "'" ;

		}



		$strSQL .=  $str_condition . "  ";


        //taking limit  result of that in $rsRES .$start_record is starting record of a page.$max_records num of records in that page
        $strSQL_limit = sprintf("%s LIMIT %d, %d", $strSQL, $start_record, $max_records);
        $rsRES = mysql_query($strSQL_limit, $this->connection) or die(mysql_error(). $strSQL_limit);

        if ( mysql_num_rows($rsRES) > 0 ){

			//without limit  , result of that in $all_rs
			if (trim($this->total_records)!="" && $this->total_records > 0) {
				
			} else {
				$all_rs = mysql_query($strSQL, $this->connection) or die(mysql_error(). $strSQL_limit); 
				$this->total_records = mysql_num_rows($all_rs);
			}
	
			while ( $row = mysql_fetch_assoc($rsRES) ){
				$limited_data[$i]["id"] = $row["id"];
				$limited_data[$i]["language_id"] = $row["language_id"];
				$limited_data[$i]["language_name"] = $row["language_name"];
				$limited_data[$i]["contenttype_id"] = $row["contenttype_id"];
				$limited_data[$i]["contenttype_name"] = $row["contenttype_name"];
				$limited_data[$i]["page_name"] = $row["page_name"];
				$limited_data[$i]["name"] = $row["name"];
				$limited_data[$i]["content"] = $row["content"];
				$limited_data[$i]["description"] = $row["description"];
				$limited_data[$i]["publish"] = $row["publish"];
				if($row["publish"]==CONF_PUBLISH){
					$limited_data[$i]["publish_status"] = "Yes";	
				}else{
					$limited_data[$i]["publish_status"] = "No";
				}
				$i++;
			}
			return $limited_data;
        }else{
        	return false;
        }
    }


    function update(){

        if ( $this->id == "" || $this->id == gINVALID) {

			$strSQL = "SELECT P.id FROM pages P WHERE  P.name='".addslashes($this->page_name)."' ";
			$result = mysql_query($strSQL, $this->connection) or die (mysql_error() . $strSQL);
			$count_page= mysql_num_rows($result);
			if ($count_page > 0) {
				$this->page_id = mysql_result($result,0,'id');
			}else{
				$strSQL = "INSERT INTO pages (name) VALUES ('".addslashes($this->page_name)."')";
				$result = mysql_query($strSQL, $this->connection) or die (mysql_error() . $strSQL);
				$this->page_id = mysql_insert_id();
			}


			$strSQL = "INSERT INTO `contents` (  `name` , `page_id` , `content` , `description` , `language_id` , `contenttype_id` )  VALUES ('".addslashes($this->name)."', '".$this->page_id."', '".addslashes($this->content)."', '".addslashes($this->description)."', '".$this->language_id."', '".$this->contenttype_id."' )";

              $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
              if ( mysql_affected_rows($this->connection) > 0 ){
                    $this->id = mysql_insert_id();;
                    return true;
              }
              else{
                $this->err_desc = "Can't add Configuration";
                return false;
              }

        }
        elseif($this->id > 0 ) {
            $strSQL = "UPDATE `contents` SET ";
            $strSQL .= "publish = '".$this->publish."',";
            $strSQL .= "content = '".addslashes(trim($this->content))."'";

            $strSQL .= " WHERE id = ".$this->id;

            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) >= 0 ) {
                return true;
            }
            else{
                $this->err_desc = "Can't edit Configuration";
                return false;
            }
        }

    }



    function delete(){

        $strSQL = "DELETE FROM `contents` WHERE id =".$this->id;
        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
            if ( mysql_affected_rows($this->connection) > 0 ) {
                    return true;
            }
            else{
                $this->err_desc = "Can't Delete This Configuration";
                return false;
            }
    }




    function get_detail(){


        $strSQL = "SELECT C.*, P.name as page_name, L.name as language_name, CT.name as contenttype_name FROM contents C, pages P, languages L, contenttypes CT WHERE P.id= C.page_id AND L.id=C.language_id AND CT.id=C.contenttype_id AND C.id = ".$this->id;

        $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
        if ( mysql_num_rows($rsRES) > 0 ){
                $this->id = mysql_result($rsRES,0,'id');

                $this->name = mysql_result($rsRES,0,'name');

                $this->page_id = mysql_result($rsRES,0,'page_id');
                $this->page_name = mysql_result($rsRES,0,'page_name');

                $this->language_id = mysql_result($rsRES,0,'language_id');
                $this->language_name = mysql_result($rsRES,0,'language_name');

                $this->contenttype_id = mysql_result($rsRES,0,'contenttype_id');
                $this->contenttype_name = mysql_result($rsRES,0,'contenttype_name');


                $this->content = mysql_result($rsRES,0,'content');
                $this->description = mysql_result($rsRES,0,'description');

                $this->publish = mysql_result($rsRES,0,'publish');
               if($this->publish==CONF_PUBLISH){
						$this->publish_status = "Yes";	
					}else{
						$this->publish_status = "No";
					}
		
                return true;
        }
        else{
            return false;
        }
    }

function publish_all($language_id){
            $strSQL = "UPDATE `contents` SET ";
            $strSQL .= "publish = '".CONF_PUBLISH."' ";
            $strSQL .= " WHERE language_id = '".$language_id."'";
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                return true;
            
}
function unpublish_all($language_id){
            $strSQL = "UPDATE `contents` SET ";
            $strSQL .= "publish = '".CONF_NOT_PUBLISH."' ";
            $strSQL .= " WHERE language_id = '".$language_id."'";
            $rsRES = mysql_query($strSQL,$this->connection) or die(mysql_error(). $strSQL );
                return true;
            
}


}// class Content **************  END
?>
