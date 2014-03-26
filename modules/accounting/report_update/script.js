$(document).ready(function(){
	$("input:radio[name=radposition]").click(function(){
		var position = $(this).val();
		switch(position){
			case '1':$("#txtlhead").attr('disabled',false);$("#txtrhead").attr('disabled',true);break;
			case '2':$("#txtlhead").attr('disabled',false);$("#txtrhead").attr('disabled',false);break;
		}
	});
});