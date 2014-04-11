$(document).ready(function(){

	//default settings
	setDefault();

	//master voucher change
	$("#lstmvoucher").change(function(){
		setAccountDestinations();
		createVoucherSourceitems()		;
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


	//get header content
	$("#chk_header").click(function(){
		if($(this).prop("checked")){	
			var value = $("#default_header_content").html();
			CKEDITOR.instances['txtheader'].setData(value);	
		}else{
			CKEDITOR.instances['txtheader'].setData();	
		}
	});

	//get footer content
	$("#chk_footer").click(function(){
		if($(this).prop("checked")){	
			var value = $("#default_footer_content").html();
			CKEDITOR.instances['txtfooter'].setData(value);	
		}else{
			CKEDITOR.instances['txtfooter'].setData();	
		}
	});

	

//validation
	$("#frmvoucher").submit(function(){

		var msg ="";
		var voucher_type = $("#lstmvoucher").val();
	
		if(voucher_type > 0){
			if($("#lstinventory").val() == -1){
				msg += "Select Inventory Account<br>";
			}
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
	//alert(voucher_master);return false;
	if($("#chk_hidden").prop("checked")){
		$("#dv-dflt-from").show();
		$("#dv-dflt-to").show();
	}else{
		$.ajax({
			type:'POST',
			url:CURRENT_URL,
			data:{master_for_default_account:voucher_master},
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

function createVoucherSourceitems()
{
	var voucher_master = $("#lstmvoucher").val();
	var label_txt = "";
	var invt_txt = '<label for="ledger">Select Inventory Account</label>';
	$.ajax({
		type:'POST',
		url:CURRENT_URL,
		data:{master_for_source:voucher_master},
		success: function (data) {
			
			if(data == INVENTORY_TYPE_PURCHASE){
				label_txt += '<label for="ledger">Supplier';
				label_txt += inv_list_push;
				label_txt += '</label>';
				invt_txt += purchase_ledger_list;
				$("#hd_invt_type").val(INVENTORY_TYPE_PURCHASE);
			}else if(data == INVENTORY_TYPE_SALE){
				label_txt += '<label for="ledger">Customer';
				label_txt += inv_list_pull;
				label_txt += '</label>';
				invt_txt  += sale_ledger_list;
				$("#hd_invt_type").val(INVENTORY_TYPE_SALE);
			}else{
				invt_txt += ledger_list;
				label_txt = "";
				$("#hd_invt_type").val(-1);
			}
			$("#dv-invt").html(invt_txt);
			$("#src_items").html(label_txt);
		}
	});
	
}