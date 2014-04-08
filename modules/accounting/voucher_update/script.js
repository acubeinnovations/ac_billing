$(document).ready(function(){

	//default settings
	setDefault()
	


	//master voucher change
	$("#lstmvoucher").change(function(){
		var voucher_master = $(this).val();
		//setDefault();
		checkSourceItem();
		/*
		$.ajax({
			type:'POST',
			url:CURRENT_URL,
			data:{master:voucher_master},
			success: function (data) {
				if(data == V_MASTER_SOURCE_TRUE){
					$("#src_items").show();
					var v_src_item = $("#lstsourceitem").val();
					
				}else{
					$("#src_items").hide();
				}
			}
		});
*/
	});

	

	//checkbox default currency
	$("#chk_currency").click(function(){
		if($(this).prop("checked")){
			$("#div_cnr").hide();
		}else{
			$("#div_cnr").show();
		}
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
				if(voucher_type == SALES_VOUCHER){
					if($("#lstfromledger").val() == null || $("#lstfromledger").val() == -1){
						msg += "Select default from ledger <br/>";
					}
				}else if(voucher_type == PURCHASE_VOUCHER){
					if($("#lsttoledger").val() == null  || $("#lsttoledger").val() == -1){
						msg += "Select default to ledger <br/>";
					}
				}
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

function checkSourceItem()
{
	var voucher_type = $("#lstmvoucher").val();
	var v_src_item = $("#lstsourceitem").val();
	if(voucher_type == SALES_VOUCHER){
		$("#src2_dft_to").hide();
		$("#src2_dft_from").show();
		$("#src_items_for_sales").show();
		$("#src_items_for_purchase").hide();

	}else if(voucher_type == PURCHASE_VOUCHER){
		$("#src2_dft_to").show();
		$("#src2_dft_from").hide();
		$("#src_items_for_sales").hide();
		$("#src_items_for_purchase").show();
	}else{
		$("#src2_dft_to").show();
		$("#src2_dft_from").show();

		$("#src_items_for_sales").hide();
		$("#src_items_for_purchase").hide();
	}
}

function setDefault()
{
	$("#div-dtls1").hide();
	$("#div-dtls2").hide();
	$("#src_items").hide();
	$("#div_cnr").hide();
	$("#src_items_for_sales").hide();
	$("#src_items_for_purchase").hide();
}