
$(document).ready(function(){

	var total_amount = 0;
	var total_tax = {};


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
	//select frieght	
	$("#txtfrieght").on("focus",function(){
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

	//calculate line total
	$("#lsttax").change(function(){

		var rate = $("#txtrate").val();
		var qty = $("#txtquantity").val();
		if(rate == ''){
			$("#txtlinetotal").text("0.00");
		}else{
			var lineTotal = calculateLineTotal(rate,qty);
			var lineTotalText = formatNumber(lineTotal);
			$("#txtlinetotal").text(lineTotalText);
		}
	});

	//calculate line total
	$("#txtrate").keyup(function(){

		var rate = $(this).val();formatNumber(rate);
		var qty = $("#txtquantity").val();
		if(rate == ''){
			$("#txtlinetotal").text("0.00");
		}else{
			var lineTotal = calculateLineTotal(rate,qty);
			var lineTotalText = formatNumber(lineTotal);
			$("#txtlinetotal").text(lineTotalText);
		}
	});


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
				var lineTotalText = formatNumber(lineTotal);
				$("#txtlinetotal").text(lineTotalText);
				postForm();
			}
		}

	});

	$("#txtquantity").blur(function(){
		//postForm();
	});

	$("#txtcode").blur(function(){
		postForm();
	});

	
	

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
		var stock = $("#hd_stock").val();

		

		var codetxt = code+'<input type="hidden" name="hd_itemcode[]" value="'+code+'">';
		var ratetxt = rate+'<input type="hidden" name="hd_itemrate[]" value="'+rate+'">';
		var qtytxt = qty+'<input type="hidden" name="hd_itemqty[]" value="'+qty+'">';
		var taxtxt = taxvalue+'<input type="hidden" name="hd_itemtax[]" value="'+tax+'">';


		if($("#lstitem").val() >0){
			
			total_amount += parseFloat(l_totaltxt);
			$("#hd_total").val(total_amount);
			
			if(tax > 0){
				if( total_tax[taxvalue] == undefined ) {
					total_tax[taxvalue] = 0;
				}
				
				total_tax[taxvalue] += calculateTax(qty*rate);
			}
			

			$(".trtax").remove();
			
			$("#insert-item").before('<tr><td>'+codetxt+'</td><td>'+nametxt+'</td><td>'+qtytxt+'</td><td>'+ratetxt+'</td><td>'+taxtxt+'%</td><td>'+l_totaltxt+'</td><td></td></tr>');

			$.each(total_tax, function( index, value ) {
				var hd_tax_ledger = '<input type="hidden" name="hd_tax_ledger" value="'+index+'_'+'" />'
				$("#insert-item").after('<tr class="trtax" style="font-weight:bold;"><td colspan="5" align="right">'+index+'%</td><td colspan="2" align="left">'+hd_tax_ledger+'<div class="medium-6 columns"><span id="lbl_tax">'+formatNumber(value)+'</span></div></td></tr>');
			});
			

			clearForm();
			updateTotal();
			//$("#lbl_tax").html(formatNumber(total_tax));
			
			
		}
    	 return false;
	});


	$("#txtdiscount").blur(function(){
		var discount = $(this).val();
		if(isNaN(discount)){
			$(this).val(formatNumber(0));
			popup_alert("Enter valid discount amount",false);

		}else{
			updateTotal();
		}
		
	});

	$("#txtfrieght").blur(function(){
		var discount = $(this).val();
		if(isNaN(discount)){
			$(this).val(formatNumber(0));
			popup_alert("Enter valid frieght amount",false);

		}else{
			updateTotal();
		}
		
	});


	



});





//functions 

function clearForm(){
	$("#txtcode").val('');
	$("#lstitem").val(-1);
	$("#txtrate").val("0.00");
	$("#txtquantity").val(1);
	$("#txtunit").text("0.00");
	$("#txtlinetotal").text("0.00");
	$("#lsttax").val(-1);
}

function calculateLineTotal(rate,quantity)
{
	var total = parseFloat(rate)*parseInt(quantity);
	var tax = calculateTax(total);
	return total+tax;
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

function updateTotal()
{
	var total_amount = parseFloat($("#hd_total").val());
	var value = total_amount;
	if($("#txtfrieght").length > 0){
		var frieght = parseFloat($("#txtfrieght").val());
		value += frieght;
	}

	if($("#txtdiscount").length > 0){
		var discount = parseFloat($("#txtdiscount").val());
		value -= discount;
	}
	
	changeTotal(value);
	
}
function changeTotal(total)
{
	var round_total = formatNumber(parseInt(total));
	total = formatNumber(total);
	
	$("#txtamount").val(total);
	$("#lbl_total").html(total);
	$("#lbl_total").html(total);
	$("#lbl_round").html(round_total);
	
}



function formatNumber(number)
{
	var numberText = "";
	if(parseInt(number) > 0){
	    var list = number.toString().split(".");
	   
	    
	    numberText += list[0];
	    if(list[1]){
	    	if(list[1].length == 1){
	    		numberText += "."+list[1]+"0";
	    	}else if(list[1].length == 2){
	    		numberText += "."+list[1];
	    	}else{
	    		numberText += "."+list[1].substing(0,1);
	    	}
	    	
	    }else{
	    	numberText += ".00";
	    }
	    	
	}else{
		numberText = "0.00";
	}
	return numberText;

}

//functions 

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







