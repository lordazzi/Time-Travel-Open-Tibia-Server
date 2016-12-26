/*
	# AUTHOR: RICARDO AZZI #
	#  CREATED: 10/11/12   #
*/
$(function(){
	var f = new Form();
	
	//Baguios padrões
	$("#account-create-lang").val(navigator.language.toLowerCase());
	f.iamValid($("#account-create-gender"));
	accept("#account-create-gender-logtip");
	
	f.iamValid($("#account-create-country"));
	accept("#account-create-country-logtip");
	
	f.iamValid($("#account-create-lang"));
	accept("#account-create-lang-logtip");
	
	//Verificando se o login é válido
	$("#account-create-login").on("keyup focus blur", function(){
		$.ajax({
			type: "POST",
			url: "post/login-already-exists.php",
			data: {
				account: $("#account-create-login").val()
			},
			success: function(ret) {
				eval("ret = "+ret);
				var response = f.isntLogin($("#account-create-login"), ret.exists);
				if (response != false) {
					error("#account-create-login-logtip", response);
				} else {
					accept("#account-create-login-logtip");
				}
			}
		});
	});
	
	//verificando se a senha é válido
	$("#account-create-pass").on("keyup focus blur", function(){
		var response = f.isntPassword($("#account-create-pass"));
		if (response != false) {
			error("#account-create-pass-logtip", response);
		} else {
			accept("#account-create-pass-logtip");
		}
	});
	
	//verificando se as senhas batem
	$("#account-create-confirm").on("keyup focus blur", function(){
		var response1 = f.isntPassword($(this));
		var response2 = f.passwodDontMatch($("#account-create-pass"), $(this));
		if (response2 != false) {
			confirmIsAllRight = false;
			error("#account-create-confirm-logtip", response2);
		} else if (response1 != false) {
			error("#account-create-confirm-logtip", response1);
		} else {
			accept("#account-create-confirm-logtip");
		}
	});
	
	//verificando se você digitou o nome conforme o solicitado
	$("#account-create-name").on("keyup focus blur", function(){
		var response = f.isntFullName($(this));
		if (response != false) {
			error("#account-create-name-logtip", response);
		} else {
			accept("#account-create-name-logtip");
		}
	});
	
	//Verificando se o que ele digitou é um email
	$("#account-create-mail").on("keyup focus blur", function(){
		$.ajax({
			type: "POST",
			url: "post/email-already-exists.php",
			data: {
				mail: $("#account-create-mail").val()
			},
			success: function(ret) {
				eval("ret = "+ret);
				var response = f.isntEmail($("#account-create-mail"), ret.exists);
				if (response != false) {
					error("#account-create-mail-logtip", response);
				} else {
					accept("#account-create-mail-logtip");
				}
			}
		});
	});

	
	$("#account-create-submit").on("click", function(){
		$.ajax({
			type: "POST",
			url: "post/account-create.php",
			data: {
				login: $("#account-create-login").val(),
				pass: $("#account-create-pass").val(),
				confirm: $("#account-create-confirm").val(),
				name: $("#account-create-name").val(),
				gender: $("#account-create-gender").val(),
				mail: $("#account-create-mail").val(),
				country: $("#account-create-country").val(),
				lang: $("#account-create-lang").val(),
			},
			success: function(ret) {
				eval("ret = "+ret);
				if (ret.error_on_login == false && ret.error_on_pass == false && ret.error_on_name == false && ret.error_on_mail == false) {
					window.location.href = "account-myaccount.php";
				}
				
				if (ret.error_on_gender == 501) {//O seu sexo não existe
					$("#account-create-gender-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-gender-error-msg").text("Seu sexo não existe... e_________é");
					} else if (lang == "en-us") {
						$("#account-create-gender-error-msg").text("Your sex does not exist... e_________é");
					}
				}
				
				if (ret.error_on_login == 401) {//login já existe
					$("#account-create-login-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-login-error-msg").text("Login já em uso.");
					} else if (lang == "en-us") {
						$("#account-create-login-error-msg").text("Login already in use.");
					}
				} else if (ret.error_on_login == 402) {//login nulo
					$("#account-create-login-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-login-error-msg").text("Login não pode ser nulo.");
					} else if (lang == "en-us") {
						$("#account-create-login-error-msg").text("Login field can't be null.");
					}
				} else if (ret.error_on_login == 403) {//login fora dos padrões estabelecidos
					$("#account-create-login-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-login-error-msg").text("Isso não é um login.");
					} else if (lang == "en-us") {
						$("#account-create-login-error-msg").text("This is not a login.");
					}
				} else if (ret.error_on_login == 404) {//quantidade de letras insuficientes
					$("#account-create-login-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-login-error-msg").text("O campo de login deve ter mais de 4 letras.");
					} else if (lang == "en-us") {
						$("#account-create-login-error-msg").text("The login field must had more then 4 letters.");
					}
				}
				
				if (ret.error_on_pass == 301) {//senha nula
					$("#account-create-pass-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-pass-error-msg").text("O campo da senha não pode ser nulo.");
					} else if (lang == "en-us") {
						$("#account-create-pass-error-msg").text("The password field can't be null.");
					}
				} else if (ret.error_on_pass == 302) {//senha com poucas letras
					$("#account-create-pass-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-pass-error-msg").text("A senha deve ter mais do que 4 letras.");
					} else if (lang == "en-us") {
						$("#account-create-pass-error-msg").text("The passwords must had more then 4 letters.");
					}
				} else if (ret.error_on_pass == 303) {//senhas não coincidem
					$("#account-create-pass-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-pass-error-msg").text("Os campos de senha não coincidem.");
					} else if (lang == "en-us") {
						$("#account-create-pass-error-msg").text("Password not match.");
					}
				}
				
				if (ret.error_on_name == 201) {//nome nulo
					$("#account-create-name-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-name-error-msg").text("O nome não pode ser nulo.");
					} else if (lang == "en-us") {
						$("#account-create-name-error-msg").text("The name can't be null.");
					}
				} else if (ret.error_on_name == 202) {//caracteres estranhos
					$("#account-create-name-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-name-error-msg").text("Há caracteres estranhos no campo do nome.");
					} else if (lang == "en-us") {
						$("#account-create-name-error-msg").text("There is strange caracters in the name field.");
					}
				} else if (ret.error_on_name == 203) {//não é o seu nome completo
					$("#account-create-name-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-name-error-msg").text("Isso não é o seu nome completo.");
					} else if (lang == "en-us") {
						$("#account-create-name-error-msg").text("This isn't your full name.");
					}
				}
				
				if (ret.error_on_mail == 101) {//e-mail já cadastrado
					$("#account-create-mail-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-mail-error-msg").text("Este e-mail já está em uso.");
					} else if (lang == "en-us") {
						$("#account-create-mail-error-msg").text("This e-mail already in use.");
					}
				} else if (ret.error_on_mail == 102) {//e-mail inválido
					$("#account-create-mail-error-msg").css("display", "block");
					if (lang == "pt-br") {
						$("#account-create-mail-error-msg").text("E-mail inválido.");
					} else if (lang == "en-us") {
						$("#account-create-mail-error-msg").text("Invalid e-mail.");
					}
				}
			}
		});
	});
	
	//Calendário
	$('#account-create-birth').mask("99/99/9999");
});