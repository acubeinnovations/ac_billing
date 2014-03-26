function cancelVazhipadu(rpt)
{
	var cn = confirm("Do you realy want to cancel this vazhipadu?");
	if(cn){
		//alert(CURRENT_URL+"?cnl="+rpt);
		window.location	= CURRENT_URL+"?cnl="+rpt;
	}else{

	}
}