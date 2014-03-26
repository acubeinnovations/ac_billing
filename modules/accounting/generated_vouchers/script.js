function deleteVoucher(id)
{
	
	var confrm = confirm("Do you want to delete this voucher?");
	if(confrm){

		window.location = "ac_generate_voucher.php?dlt="+id;
	}else{
		
	}
}