$(document).ready(function(){

	$("#div-dtls1").hide();
	$("#div-dtls2").hide();


	$("#lstsource").change(function(){
		var source =$(this).val();
		if(source == "1"){
			$("#div-dtls1").show();
			$("#div-dtls2").hide();
		}else if(source == "2"){
			$("#div-dtls1").hide();
			$("#div-dtls2").show();
		}else{
			$("#div-dtls1").hide();
			$("#div-dtls2").hide();
		}
	});

	$("#chk_hidden").click(function(){

		if($(this).prop("checked")){
			$("#div-settings").show();
			$("#v_ac_dtls").hide();
		}else{
			$("#div-settings").hide();
			$("#v_ac_dtls").show();
		}
	});
	

	$("#frmvoucher").submit(function(){

		var msg ="";
		var voucher_type = $("#lstmvoucher").val();
		var source = $("#lstsource").val();

		if(voucher_type == -1){
			msg += "Select voucher type<br>";
		}

		if($("#chk_hidden").prop("checked")){
			if($("#lstmodules").val() == -1){
				msg += "Module not selected<br>";
			}
			if($("#lstfromledger").val() == -1){
				msg += "Select From Ledger<br>";
			}
			if($("#lsttoledger").val() == -1){
				msg += "Select To Ledger<br>";
			}

		}else{
			if(source == -1){
				msg += "Select Source<br>";
			}else if(source == 1){
				if($("#lstledger").val() == null){
					msg += "Select default ledgers<br>";
				}
			}else if(source == 2){
				
			}
		}

		
		if(msg == ""){
			return true;
		}else{
			popup_alert(msg,false);
			return false;
		}
		
	});


});