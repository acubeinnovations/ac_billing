
$(document).ready(function(){

	var total_amount = 0;
	var total_tax = {};

	//if lost focus then fill with default value
	$("#txtrate").on("focusout",function(){
		if($(this).val() == ''){
			$(this).val("0.00");
		}
	});
	$("#txtquantity").on("focusout",function(){
		if($(this).val() == ''){
			$(this).val(1);
		}
	});
	$("#txtdiscount").on("focusout",function(){
		if($(this).val() == ''){
			$(this).val("0.00");
		}
	});
	$("#txtfreight").on("focusout",function(){
		if($(this).val() == ''){
			$(this).val("0.00");
		}
	});


	//item code entry
	$("#lstitem").change(function(){
		var item_code = $(this).val();
		$("#txtcode").val(item_code);
		postForm();
	});

	//select unit rate	
	$("#txtrate").on("focus",function(){
		$(this).select();
	});
	//select quantity
	$("#txtquantity").on("focus",function(){
		$(this).select();
	});
	//select discount	
	$("#txtdiscount").on("focus",function(){
		$(this).select();
	});
	//select freight	
	$("#txtfreight").on("focus",function(){
		$(this).select();
	});

	//select item with item code entry
	$("#txtcode").keyup(function(){
		var item_code = $(this).val();
		$("#lstitem").val(item_code);

		if($("#lstitem").val() == null){
			$("#lstitem").val(-1);
		}

	});

	//calculate line total on change tax
	$("#lsttax").change(function(){
		var rate = $("#txtrate").val();
		var qty = $("#txtquantity").val();
		if(rate == ''){
			$("#txtlinetotal").text("0.00");
		}else{
			var lineTotal = calculateLineTotal(rate,qty);
			changeLineTotal(lineTotal);
		}
	});

	//calculate line total on enter unit rate
	$("#txtrate").keyup(function(){
		var rate = $(this).val();formatNumber(rate);
		var qty = $("#txtquantity").val();
		if(rate == ''){
			$("#txtlinetotal").text("0.00");
		}else if(rate == '.'){

		}else{
			var lineTotal = calculateLineTotal(rate,qty);
			changeLineTotal(lineTotal);
		}
	});

	//calculate line total on enter discount
	$("#txtdiscount").keyup(function(){
		var rate = $("#txtrate").val();formatNumber(rate);
		var qty = $("#txtquantity").val();
		if(rate == ''){
			$("#txtlinetotal").text("0.00");
		}else{
			var lineTotal = calculateLineTotal(rate,qty);
			changeLineTotal(lineTotal);
		}
	});

	//calculate line total on enter quantity
	$("#txtquantity").keyup(function(){
		var qty = $(this).val();
		if(isNaN(qty)){
			alert("Invalid Quantity");
			$("#txtquantity").val('');
		}
		else{
			var rate = $("#txtrate").val();
			if(qty == ''){
				$("#txtlinetotal").text(rate);
			}else{
				var lineTotal = calculateLineTotal(rate,qty);
				changeLineTotal(lineTotal);
				//var lineTotalText = formatNumber(lineTotal);
				//$("#txtlinetotal").text(lineTotalText);
				postForm();
			}
		}

	});


	//find item name
	$("#txtcode").blur(function(){
		postForm();
	});

	//select cash or credit
	$("input:radio[name=radio]").click(function(){
		var inv_type = $("#hd_int_type").val();
		if(inv_type == INVENTORY_TYPE_SALE){
			if($(this).val() == 1){//cash
				$("#lstfrom").attr('disabled',false);
			}else if($(this).val() == 2){//credit
				$("#lstfrom").attr('disabled',true);
			}
		}else if(inv_type == INVENTORY_TYPE_PURCHASE){
			if($(this).val() == 1){//cash
				$("#lstto").attr('disabled',false);
			}else if($(this).val() == 2){//credit
				$("#lstto").attr('disabled',true);
			}
		}
		
	});

	
	
	//add item row
	$("#button-add").click(function(){

		var code = $("#txtcode").val();
		var nametxt = $("#lstitem option:selected").text();
		var rate = $("#txtrate").val();
		var qty = $("#txtquantity").val();
		var tax = $("#lsttax").val();
		if(tax > 0){
			var taxvalue = $("#lsttax option:selected").text();
		}else{
			tax = 0;
			var taxvalue = 0;
		}
		var l_totaltxt = $("#txtlinetotal").text();
		var l_total = parseFloat(l_totaltxt);

		

		var stock = $("#hd_stock").val();

		if($("#txtdiscount").length > 0){
			var discount = $("#txtdiscount").val();
			var discounttxt = discount+'<input type="hidden" name="hd_discount[]" value="'+discount+'">';
			rate = rate-discount;
		}else{
			var discount = -1;
			var discounttxt = '<input type="hidden" name="hd_discount[]" value="0.00">';
		}

		var codetxt = code+'<input type="hidden" name="hd_itemcode[]" value="'+code+'">';
		var ratetxt = rate+'<input type="hidden" name="hd_itemrate[]" value="'+rate+'">';
		var qtytxt = qty+'<input type="hidden" name="hd_itemqty[]" value="'+qty+'">';
		var taxtxt = taxvalue+'<input type="hidden" name="hd_itemtax[]" value="'+tax+'">';
		l_totaltxt += '<input type="hidden" name="hd_itemtotal[]" value="'+l_totaltxt+'" />';

		

		if($("#lstitem").val() >0){
			
			total_amount += parseFloat(l_totaltxt);
			$("#hd_total").val(total_amount);
			
			if(tax > 0){
				if( total_tax[tax] == undefined ) {
					total_tax[tax] = 0;
				}
				
				total_tax[tax] += calculateTax(qty*rate);
			}
			

			
			var row = '';
			if(discount == -1){
				row += '<tr><td>'+codetxt+'</td><td>'+nametxt+'</td><td>'+qtytxt+'</td><td>'+ratetxt+discounttxt+'</td><td>'+taxtxt+'%</td><td>'+l_totaltxt+'</td><td></td></tr>';
			}else{
				row +='<tr><td>'+codetxt+'</td><td>'+nametxt+'</td><td>'+qtytxt+'</td><td>'+ratetxt+'</td><td>'+discounttxt+'</td><td>'+taxtxt+'%</td><td>'+l_totaltxt+'</td><td></td></tr>';
			}
			
			$("#insert-item").before(row);

			//tax rows 

			findTaxRows();
			

			clearForm();
			calculateTotal();
			//$("#lbl_tax").html(formatNumber(total_tax));
			
			
		}
    	 return false;
	});


	//validate discount
	$("#txtdiscount").blur(function(){
		var discount = $(this).val();
		if(isNaN(discount)){
			$(this).val(formatNumber(0));
			popup_alert("Enter valid discount amount",false);

		}
		
	});


	//validate freight
	$("#txtfreight").keyup(function(){
		var fright = $(this).val();
		if(isNaN(fright)){
			$(this).val(formatNumber(0));
			popup_alert("Enter valid freight amount",false);

		}else if(fright == ""){
			$(this).val(formatNumber(0));
			$(this).select();

		}
		calculateTotal();		
	});


	


	//Add, Save, Edit and Delete functions code
	$(function(){
		$('#tbl-append .edit').bind("click", Edit);
		$('#tbl-append .update').bind("click", Update);
		$('#tbl-append .delete').bind("click", Delete);
		
	});
	


});

//functions


var index=0;

function Edit(){
	var tax_list = $('#lsttax').clone();
	tax_list.attr('id','lsttax'+index);

	var par = $(this).parent().parent(); //tr
    var tdCode = par.children("td:nth-child(1)");
	var tdName = par.children("td:nth-child(2)");
	var tdQty = par.children("td:nth-child(3)");
	var tdUnitRate = par.children("td:nth-child(4)");
	var tdCashDiscount = par.children("td:nth-child(5)");
	var tdTax = par.children("td:nth-child(6)");
	var tdTotal = par.children("td:nth-child(7)");
	var tdButton = par.children("td:nth-child(8)");

	var qty = tdQty.children("input[type=hidden]").val();
	var rate = tdUnitRate.children("input[type=hidden]").val();
	var tax = tdTax.children("input[type=hidden]").val();

	tax_list.find("option[value="+tax+"]").attr("selected", "true");
	tdQty.html('<input type="text" name="edtquantity" id="edtquantity" value="'+qty+'" />');
	tdUnitRate.html('<input type="text" name="edttrate" id="edtrate" value="'+rate+'" />');
	tdCashDiscount.html('<input type="text" id="edtdiscount" name="edtdiscount" value="0.00"/>');
	tdTax.html(tax_list);
	tdTotal.html('-');
	tdButton.html('<img src="/images/save.png" class="update" title="update"/> <img src="/images/delete.png" class="delete" title="delete"/>');

	
	$('#tbl-append .update').bind("click", Update);
	$('#tbl-append .delete').bind("click", Delete);
	index++;
	
}


function Update(){
	var td_index = 1;
	var par = $(this).parent().parent(); //tr
    var tdCode = par.children("td:nth-child("+td_index+")");td_index++;
	var tdName = par.children("td:nth-child("+td_index+")");td_index++;
	var tdQty = par.children("td:nth-child("+td_index+")");td_index++;
	var tdUnitRate = par.children("td:nth-child("+td_index+")");td_index++;
	if($("#hd_discount").length > 0){
		var tdCashDiscount = par.children("td:nth-child("+td_index+")");td_index++;
		
	}else{
		var tdCashDiscount = false;
	}
	var tdTax = par.children("td:nth-child("+td_index+")");td_index++;
	var tdTotal = par.children("td:nth-child("+td_index+")");td_index++;
	var tdButton = par.children("td:nth-child("+td_index+")");td_index++;

	var qty = tdQty.children("input[type=text]").val();
	var rate = tdUnitRate.children("input[type=text]").val();
	if(tdCashDiscount){
		var discount = tdCashDiscount.children("input[type=text]").val();
		rate = rate-discount;
		tdCashDiscount.html('0.00');
	}else{
		var discount = 0;
	}
	
	
	var tax = tdTax.children("select").val();
	if(tax > 0){
		var taxid=tdTax.children("select").attr('id');
		var taxrate = $("#"+taxid+" option:selected").text();
	}else{
		var taxrate = 0;
	}
	

	var line_total = calculateEditLineTotal(rate,qty,taxrate);

	tdQty.html(qty+'<input type="hidden" name="hd_itemqty[]" value="'+qty+'">');
	tdUnitRate.html(rate+'<input type="hidden" name="hd_itemrate[]" value="'+rate+'">');

	
	tdTax.html(taxrate+'%<input type="hidden" name="hd_itemtax[]" value="'+tax+'">');
	tdTotal.html(formatNumber(line_total)+'<input type="hidden" name="hd_itemtotal[]" value="'+line_total+'">');
	tdButton.html('<img src="/images/edit.png" class="edit" title="edit"/> <img src="/images/delete.png" class="delete" title="delete"/>');

	findTaxRows();
	calculateTotal();
	

	$('#tbl-append .edit').bind("click", Edit);
	$('#tbl-append .delete').bind("click", Delete);


}

function Delete(){
	var par = $(this).parent().parent(); //tr
	par.remove();
}


//find tax amount for each tax with hidden rows
function findTaxRows()
{
	var total_tax = {};
	var tax_array = $('input:hidden[name="hd_itemtax[]"]');
	var qty_array = $('input:hidden[name="hd_itemqty[]"]');
	var rate_array = $('input:hidden[name="hd_itemrate[]"]');
	//var rate_array = $('input:hidden[name="hd_discount[]"]');
	var total = 0;
	var qty = 0;
	var rate = 0;
	var tax_rate = 0;


	$.each(tax_array,function(index,value){
		var tax_id = $(value).val();
		if(tax_id > 0){
			if( total_tax[tax_id] == undefined ) {
				total_tax[tax_id] = 0;
			}
			qty = qty_array[index].value;
			rate = rate_array[index].value;
			//total = parseInt(qty)*parseFloat(rate);
			//tax_rate = parseFloat(getTaxRate(tax_id));
			total = qty*rate;
			tax_rate = getTaxRate(tax_id);
			total_tax[tax_id] += total*tax_rate;
		}
	});
	insertTaxRows(total_tax);
    		
}


//function for insert tax ledger rows , parameter tax calculated array
function insertTaxRows(total_tax)
{
	$(".trtax").remove();
	$.each(total_tax, function( index, value ) {
		var hd_tax_val = index+"_"+value;
		var tax_name = getTaxName(index);
		var hd_tax_ledger = '<input type="hidden" name="hd_tax_ledger[]" value="'+hd_tax_val+'" />'
		$("#insert-item").after('<tr class="trtax" style="font-weight:bold;"><td colspan="6" align="right">'+tax_name+'</td><td colspan="2" align="left">'+hd_tax_ledger+'<div class="medium-6 columns"><span id="lbl_tax">'+formatNumber(value)+'</span></div></td></tr>');
	});
}









function clearForm(){
	$("#txtcode").val('');
	$("#lstitem").val(-1);
	$("#txtrate").val("0.00");
	$("#txtquantity").val(1);
	$("#txtunit").text("0.00");
	$("#txtlinetotal").text("0.00");
	$("#lsttax").val(-1);
	$("#txtdiscount").val("0.00");
}

function calculateLineTotal(rate,quantity)
{
	var quantity = $("#txtquantity").val();
	var rate = $("#txtrate").val();
	var discount = 0;
	if($("#txtdiscount").length > 0){
		discount = $("#txtdiscount").val();
	}
	rate = rate-discount;
	var total = (parseFloat(rate)*parseInt(quantity));
	var tax = calculateTax(total);
	return (total+tax);
}

function calculateEditLineTotal(rate=0,quantity=1,tax=0)
{
	var total = (parseFloat(rate)*parseInt(quantity));
	tax_value = parseFloat(tax);
	var tax = total*tax_value/100;

	return (total+tax);
}

function calculateTax(total)
{
	var tax_value = 0;
	if($("#lsttax").val() >0 ){
		tax_value = parseFloat($("#lsttax option:selected").text());
	}
	var tax = total*tax_value/100;

	return tax;
}

function changeLineTotal(lineTotal)
{
	var lineTotalText = formatNumber(lineTotal);
	$("#txtlinetotal").text(lineTotalText);	
}

//calculate total with all hidden line totals
function calculateTotal()
{
	var l_total_array = $('input:hidden[name="hd_itemtotal[]"]');
	var total = 0;
	$.each(l_total_array,function(index,value){
		var l_total = $(value).val();
		total += parseFloat(l_total);
		//alert(l_total);
	});

	if($("#txtfreight").length > 0){
		var freight = parseFloat($("#txtfreight").val());
		total += freight;
	}
	$("#hd_total").val(total);
	changeTotal(total);

}


function changeTotal(total)
{
	var str = formatNumber(total).split(".");
	var round_total = str[0];
	var round_off = "0."+str[1];
	
	$("#txtamount").val(formatNumber(round_total));
	$("#lbl_total").html(formatNumber(round_total));

	var round_txt = '<input type="hidden" name="hd_round" id="hd_round" value="'+round_off+'" />'+formatNumber(round_off);
	$("#lbl_round").html(round_txt);
	
}



function formatNumber(number)
{
	var numberText = "";
	if(parseFloat(number) > 0){
	    var list = number.toString().split(".");
	   
	    numberText += list[0];
	    if(list[1]){
	    	if(list[1].length == 1){
	    		numberText += "."+list[1]+"0";
	    	}else if(list[1].length == 2){
	    		numberText += "."+list[1];
	    	}else{
	    		numberText += "."+list[1].substring(0,2);
	    	}
	    	
	    }else{
	    	numberText += ".00";
	    }
	    	
	}else{
		numberText = "0.00";
	}
	
	return numberText;

}

function getTaxName(tax_id =-1)
{	

	var tax_array = jQuery.parseJSON(tax_list);
	return tax_array[tax_id];

}

function getTaxRate(tax_id =-1)
{	

	var tax_array = jQuery.parseJSON(tax_rate_list);
	return tax_array[tax_id];

}

function postForm()
{
	if(VOUCHER_MASTER == SALES){
		var item_code = $("#lstitem").val();
		var required_qty = $("#txtquantity").val();
		if(item_code == -1){
			alert("Select Item");
		}else{
			$.ajax({
				url:CURRENT_URL,
				data:{ item:item_code },
				type:"GET",
				dataType:"json"
			})
			.done(function(qty){
				
					if(parseInt(qty) == 0){
						alert("Item not in Stock");
						clearForm();
					}else if(qty < required_qty){
						var con = confirm("Limited stock.Do you want to continue with available quantity?");
						if(con){
							$("#txtquantity").val(qty);
						}else{
							clearForm();
						}
						
					}
					else{
						$("#hd_stock").val(qty);
					}		
				
			});
		}
	}else{
		//do nothing
	}
}


function editItemRow()
{
	var edit_row = $("#insert-item").clone();
	$(this).find('tr').replace(edit_row);

}







