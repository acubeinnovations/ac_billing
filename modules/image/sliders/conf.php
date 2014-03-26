<?php
// prevent execution of this page by direct call by browser
if ( !defined('CHECK_INCLUDED') ){
    exit();
}
$CAP_pagecaption = "ImageUpload";

$CAP_upload_image = "Upload Image </BR>( jpg Only 750X360)";

$CAP_OBJ_upload = "Upload";
$CAP_OBJ_delete = "Delete Image";


$MSG_VAL_image = "Image cannot be empty ";

$MSG_VAL_image_err1 = "File not uploaded. Please select a valid image file   <br>";

$MSG_VAL_image_err2 = "Invalid File Type. Please select a jpg/jpeg/png file   <br>";

$MSG_VAL_image_err3 = "Invalid file size. Please upload a file with size less than 1 MB    <br>";

$MSG_VAL_image_err4 = "Invalid Image Dimension. Please upload an image within the allowed dimension (150x100 to 800x600)   <br>";

$MSG_VAL_image_err5 = "Unable to move the file to the directory   <br>";

$MSG_VAL_image_err6 = "Unable to create the thumbnail<br>";

 
$RD_MSG_image_uploaded = "Image uploaded";

$MSG_image_err_upload = "Error while renaming the uploaded files. Contact administrator";


define("SLIDER_DIR","images/orbit_gallery/");
define("SLIDER_DIR_PATH","images/orbit_gallery");
?>
