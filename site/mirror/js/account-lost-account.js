$(function(){
	$("#first5, #second5, #third5, #fourth5").on("keydown", function(Event){
		if ($(this).val().length == 5 && Event.keyCode != 8 && Event.keyCode != 46) {
			$(this).nextAll(".recoverykey:first").trigger("focus");
		}		
	});
	
	$("#second5, #third5, #fourth5, #last5").on("keydown", function(Event){
		if ($(this).val().length == 0 && Event.keyCode == 8) {
			$(this).prevAll(".recoverykey:first").trigger("focus");
		}
	});
	
	$("#first5, #second5, #third5, #fourth5, #last5").on("click", function(){
		$("#viarecoverykey").trigger("click");
	});
	
	$("#recuperar-via-email").on("click", function(){
		$("#viaemail").trigger("click");
	});
	
	$("#recuperar-conta-botao").on("click", function(){
		var checked = "";
		if ($("#viarecoverykey:checked").length == 1) {
			checked = "viarecoverykey";
		} else if ($("#viaemail:checked").length == 1) {
			checked = "viaemail";
		}
		
		$.ajax({
			type: "POST",
			url: "post/recuperar-informacoes.php",
			data: {
				checked: checked,
				email: $("#recuperar-via-email").val(),
				recoverykey: $("#first5").val() + "-" + $("#second5").val() + "-" + $("#third5").val() + "-" + $("#fourth5").val() + "-" + $("#last5").val(),
				captcha: $("#my-captcha-text").val()
			},
			success: function(retorno){
				
			}
		});
	});
});

