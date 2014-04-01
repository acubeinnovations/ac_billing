
$(document).ready(function(){

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

	
	var total_amount = 0;

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
			$("#insert-item").before('<tr><td>'+codetxt+'</td><td>'+nametxt+'</td><td>'+qtytxt+'</td><td>'+ratetxt+'</td><td>'+taxtxt+'%</td><td>'+l_totaltxt+'</td><td></td></tr>');
			clearForm();

			$("#txtamount").val(formatNumber(total_amount));
		}
    	 return false;
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
	$("#lsttax").val(1);
}

function calculateLineTotal(rate,quantity,tax)
{
	var total = parseFloat(rate)*parseInt(quantity);
	var tax_value = 0;
	if($("#lsttax").val() >0 ){
		tax_value = parseFloat($("#lsttax option:selected").text());
	}
	var tax_rate = tax_value/100;
	var tax = total*tax_rate;
	return total+tax;
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







