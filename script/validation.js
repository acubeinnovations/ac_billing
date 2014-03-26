function isNull(val)
{
	if(val != ""){
		return false;
	}else{
		return true;
	}
}

function isNumber(val)
{
	if(isNaN(val)){
		return false;
	}else{
		return true;
	}
}

function isEmail(val)
{
	var atpos=val.indexOf("@");
	var dotpos=val.lastIndexOf(".");
	if (atpos<1 || dotpos<atpos+2 || dotpos+2>=val.length){
 		return false;
  	}else{
  		return true;
  	}
}

function isInteger(val)
{
	if(parseInt(val) > 0){
		return true;
	}else{
		return false;
	}
}