$(document).ready(function(){

	setDefault();

	//validation
	$("#frmvoucher").submit(function(){

		var msg ="";
		var voucher_type = $("#lstmvoucher").val();

		if(voucher_type > 0){
			var ac_destination = $("#hd_ac_dest").val();
			if(ac_destination == DEFAULT_ACCOUNT_FROM){
				if($("#lstfromledger").val() == null){
					msg += "Select Default From Account<br>";
				}
			}else if(ac_destination == DEFAULT_ACCOUNT_TO){
				if($("#lsttoledger").val() == null){
					msg += "Select Default To Account<br>";
				}
			}
			
		}else{
			msg += "Select voucher type<br>";
		}

		if($("#chk_hidden").prop("checked")){
			if($("#lstmodules").val() == -1){
				msg += "Module not selected<br>";
			}
		}

		
		
		if(msg == ""){
			return true;
		}else{
			popup_alert(msg,false);
			return false;
		}
		
	});

	//checkbox default currency
	$("#chk_currency").click(function(){
		if($(this).prop("checked")){
			$("#div_cnr").hide();
		}else{
			$("#div_cnr").show();
		}
	});

	//checkbox module or not
	$("#chk_hidden").click(function(){
		setAccountDestinations();
		if($(this).prop("checked")){
			$("#dv-modules").show();
		}else{
			$("#dv-modules").hide();
			
		}
	});

	//master voucher change
	$("#lstmvoucher").change(function(){
		setAccountDestinations();		
	});

	$("#chk_header").click(function(){
		if($(this).prop("checked")){	
			var value = $("#default_header_content").html();
			CKEDITOR.instances['txtheader'].setData(value);	
		}else{
			CKEDITOR.instances['txtheader'].setData();	
		}
	});

	$("#chk_footer").click(function(){
		if($(this).prop("checked")){	
			var value = $("#default_footer_content").html();
			CKEDITOR.instances['txtfooter'].setData(value);	
		}else{
			CKEDITOR.instances['txtfooter'].setData();	
		}
	});




});


function setDefault()
{
	$("#div-dtls1").hide();
	$("#div-dtls2").hide();
	$("#div_cnr").hide();
	$("#dv-dflt-from").hide();
	$("#dv-dflt-to").hide();

}

function setAccountDestinations()
{
	var voucher_master = $("#lstmvoucher").val();
	if($("#chk_hidden").prop("checked")){
		$("#dv-dflt-from").show();
		$("#dv-dflt-to").show();
	}else{
		$.ajax({
			type:'POST',
			url:CURRENT_URL,
			data:{master:voucher_master},
			success: function (data) {
				if(data == DEFAULT_ACCOUNT_FROM){
					$("#dv-dflt-from").show();
					$("#dv-dflt-to").hide();
					$("#hd_ac_dest").val(DEFAULT_ACCOUNT_FROM);
				}else if(data == DEFAULT_ACCOUNT_TO){
					$("#dv-dflt-from").hide();
					$("#dv-dflt-to").show();
					$("#hd_ac_dest").val(DEFAULT_ACCOUNT_TO);
				}else{
					$("#dv-dflt-from").hide();
					$("#dv-dflt-to").hide();
					$("#hd_ac_dest").val(-1);
				}
			}
		});
	}

	
}