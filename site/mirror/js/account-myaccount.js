$(function(){
	var f = new Form();
	
	$("#account-character-create-modal").on("click", function(){
		$("#account-character-suggest-name").click();
		$("#account-create-character").css("display", "block");
		$("#account-create-character, #account-create-character div.modal").animate({
			opacity: 1
		}, 500);
	});
	
	$("#account-character-create-cancel").on("click", function(){
		$("#account-create-character input[type='text']").val("");
		$("#account-create-character select").val(1);
		$("#account-create-character, #account-create-character div.modal").animate({
			opacity: 0
		}, 500);
		setTimeout(function(){
			$("#account-create-character").css("display", "none");
		}, 500);
		$("#account-character-name").focus();
	});
	
	$("#account-character-name").on("keyup focus blur change", function(){
		me = this;
		$.ajax({
			type: "POST",
			url: "post/character-already-exists.php",
			data: {
				chara_name: $("#account-character-name").val()
			},
			success: function(retorno) {
				eval("retorno = "+retorno);
				var response = f.isntCharacterName($(me), retorno.exists);
				if (response != false) {
					error("#account-character-name-logtip", response);
				} else {
					accept("#account-character-name-logtip");
				}
			}
		});
	});
	
	$("#account-character-suggest-name").on("click", function(){
		$.ajax({
			type: "POST",
			url: "post/character-name-gerator.php",
			data: {
				gender: $("#account-character-gender").val()
			},
			success: function(retorno) {
				eval("retorno = "+retorno);
				var gender = "";
				$("#account-character-name").val(retorno.name);
				accept("#account-character-name-logtip");
				f.isntCharacterName($("#account-character-name"), false);
				
				if ($("#account-character-gender").val() == 0) {
					gender = "feminino";
				} else {
					gender = "masculino";
				}
				
				$("#account-character-name-sublog").text("Um nome "+gender+" foi gerado");
			}
		});
	});
	
	$("#account-character-gender").on("change", function(){
		var gender = $("#account-character-gender").val();
		if (gender == 0) {
			$(".only-female").css("display", "block");
			$(".only-male").css("display", "none");
		} else if (gender == 1) {
			$(".only-female").css("display", "none");
			$(".only-male").css("display", "block");
		}
	});
	
	f.iamValid($("#account-character-gender"));
	accept("#account-character-gender-logtip");
	
	f.iamValid($("#account-character-vocation"));
	accept("#account-character-vocation-logtip");
	
	f.iamValid($("#account-character-city"));
	accept("#account-character-city-logtip");
	
	$("#account-character-create-done").on("click", function(){
		$.ajax({
			type: "POST",
			url: "post/character-create.php",
			data: {
				name: $("#account-character-name").val(),
				gender: $("#account-character-gender").val(),
				vocation: $("#account-character-vocation").val(),
				city: $("#account-character-city").val()
			},
			success: function(retorno) {
				eval("retorno = "+retorno);
				if (retorno.success == true) {
					window.location.href = window.location.href.replace("#", "");
				}
			}
		});
	});
	
	//editando informações cadastrais
	$("#account-edit-username").on("keyup focus blur", function(){
		var response = f.isntFullName($(this));
		if (response != false) {
			error("#account-edit-username-logtip", response);
		} else {
			accept("#account-edit-username-logtip");
		}
	});
	
	$("#account-edit-codename").on("keyup focus blur", function(){
		$.ajax({
			type: "POST",
			url: "post/codename-already-exists.php",
			data: {
				codename: $("#account-edit-codename").val()
			},
			success: function(ret) {
				eval("ret = "+ret);
				var response = f.isntFullName($("#account-edit-codename"), ret.exists);
				if (response != false) {
					error("#account-edit-codename-logtip", response);
				} else {
					accept("#account-edit-codename-logtip");
				}
			}
		});
	});
	
	//Verificando se o que ele digitou é um email
	$("#account-edit-mail").on("keyup focus blur", function(){
		$.ajax({
			type: "POST",
			url: "post/email-already-exists.php",
			data: {
				mail: $("#account-edit-mail").val()
			},
			success: function(ret) {
				eval("ret = "+ret);
				var response = f.isntEmail($("#account-edit-mail"), ret.exists);
				if (response != false) {
					error("#account-edit-mail-logtip", response);
				} else {
					accept("#account-edit-mail-logtip");
				}
			}
		});
	});
	
	//	Apenas homens podem ser Dwarfian, apenas garotas podem ser Amazon
	$("#account-character-vocation").on("change select click focus", function(){
		var $sexo = $("#account-character-gender").val();
		if ($sexo == 0) {
			$("#vocations-amazon").css("display", "block");
			$("#vocations-dwarfian").css("display", "none");
		} else if ($sexo == 1) {
			$("#vocations-amazon").css("display", "none");
			$("#vocations-dwarfian").css("display", "block");
		} else {
			$("#vocations-amazon").css("display", "none");
			$("#vocations-dwarfian").css("display", "none");
		}
	});
	
	//	Salvando informações premmy adicionais
	$("#account-premmy-info-save").on("click", function(){
		$.ajax({
			type: "POST",
			url: "post/save-address-information.php",
			data: {
				telprefixo: $("#account-telefone-prefix").val(),
				telefone: $("#account-telefone").val(),
				cep: $("#account-cep").val(),
				logradouro: $("#account-rua").val(),
				numero: $("#account-numero").val(),
				complemento: $("#account-complemento").val(),
				bairro: $("#account-bairro").val(),
				cidade: $("#account-cidade").val(),
				estado: $("#account-estado").val(),
			},
			success: function(retorno){
				eval("var retorno = "+retorno);
				if (retorno.success == true) {
					scrollup($("#account-comprar-pontos-vip").offset().left + 50);
					$("#account-agora-voce-pode-comprar-pontos-vip").css("display", "block");
				}
			}
		});
	});
	
	//	mudando o link do valor do preço
	$("#pontos-vip-quantidade").on("click focus change blur", function(){
		$("#please-change-my-value").attr("href", "account-buy-vip-points.php?" + $(this).val());
	});
});