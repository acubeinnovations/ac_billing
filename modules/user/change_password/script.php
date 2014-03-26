   <!--
    function Trim(strInput) {
    while (true) {
        if (strInput.substring(0, 1) != " ")
            break;
        strInput = strInput.substring(1, strInput.length);
    }
    while (true) {
        if (strInput.substring(strInput.length - 1, strInput.length) != " ")
            break;
        strInput = strInput.substring(0, strInput.length - 1);
    }
   return strInput;
}

    function validate_change_passwd(){
        error = "";
        if(document.getElementById("passwd").value==""){
            error = "<?php echo $MSG_empty_password ?><br/>";
        }
        if(document.getElementById("new_passwd").value==""){
            error += "<?php echo $MSG_empty_new_password ?><br/>";
        }
        if(document.getElementById("retype_passwd").value==""){
            error += "<?php echo $MSG_empty_retype_password ?><br/>";
        }
        if( document.getElementById("new_passwd").value != document.getElementById("retype_passwd").value ){
            error += "<?php echo $MSG_unmatching_passwords ?><br/>";
        }
        if ( error == "" ){
             pattern = /[a-zA-Z0-9_-]{5,}/;
             result = pattern.test(document.getElementById("new_passwd").value);
             if(result == false)
             error = "<?php echo $MSG_length_password ?><br/>" ;
        }
        if ( error != "" ){
            popup_alert(error,"","","close");
            return false;
        }else{
            return true;
        }
    }
    -->
