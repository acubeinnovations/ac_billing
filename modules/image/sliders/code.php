<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
if (isset($_POST['submit']) &&  $_POST['submit'] == $CAP_OBJ_upload ) {
$strERR = "";
    if ( trim ( $_FILES['fleimage']['name'] ) == "" ){
    $strERR .= $MSG_VAL_image;
    }

    if ( trim ( $_FILES['fleimage']['name'] ) != ""  && $strERR == "" ) {
        $myimage = new Image;
        $imgfilename = basename($_FILES["fleimage"]["name"]);
        $imgfilesize = $_FILES["fleimage"]["size"];
        //move the uploaded file to the CAR image directory and create the thumbnail
        $arrupload = $myimage->upload_image($_FILES['fleimage'], 48, 800, 48, 600, 1048576, ROOT_PATH.SLIDER_DIR);

        if ($arrupload["err_code"] == -1) {
        $strERR .= $MSG_VAL_image_err1;
        }
        elseif ($arrupload["err_code"] == -2) {
        $strERR .= $MSG_VAL_image_err2;
        }
        elseif ($arrupload["err_code"] == -3) {
        $strERR .= $MSG_VAL_image_err3;
        }
        elseif ($arrupload["err_code"] == -4) {
        $strERR .= $MSG_VAL_image_err4;
        }
        elseif ($arrupload["err_code"] == -5) {
        $strERR .= $MSG_VAL_image_err5;
        }
        elseif ($arrupload["err_code"] == -6) {
        $strERR .= $MSG_VAL_image_err6;
        }
        else{
            rename_image ($_FILES["fleimage"]["name"], $arrupload["imagefile"], ROOT_PATH.SLIDER_DIR);
            $_SESSION[SESSION_TITLE.'flash'] = $RD_MSG_image_uploaded;
            $_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
            header( "Location: ".$FLASH_file_name);
            exit();
        }
        //the first image uploaded is set as the default
        $int_default = 0;
    }

    }elseif (isset($_POST['submit']) &&  $_POST['submit'] == $CAP_OBJ_delete ) {
		
			if ($_POST['h_image'] != "" ) {
				$image = $_POST['h_image'];
				$file = explode('/', $image);
				$file = $file[count($file)-1];
				$image_file = ROOT_PATH.SLIDER_DIR.$file;

				eval("\$image_file = \"$image_file\";");
				unlink($image_file);
		        $_SESSION[SESSION_TITLE.'flash'] = "Slider Deleted";
		        $_SESSION[SESSION_TITLE.'flash_redirect_page'] = $current_url;
		        header( "Location: ".$FLASH_file_name);
		        exit();
			}		

    }
    ?>
