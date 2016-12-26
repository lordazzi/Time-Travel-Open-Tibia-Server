/*
	# AUTHOR: RICARDO AZZI #
	# CREATED: 05/11/12 #
*/
var Form = (function(){
	this.iamValid = (function(obj){
		obj.attr("class", "accept");
	});
	
	this.isntDate = (function(obj){
		val = obj.val();
		mydate = val.splite("/");
		if (val == "" || val == "__/__/____") {
		} else if (!val.match("^(([0-2][0-9])|([3][0-1]))[/](([0][1-9])|([1][0-2]))[/][1-2][0-9]{3}$")) {
		} else if ((mydate[1] == 2 || mydate[1] == 4 || mydate[1] == 6 || mydate[1] == 9 || mydate[1] == 11) && mydate[0] == 31) {
		} else if (mydate[1] == 2 && mydate[2]%4 != 0 && (mydate[0] == 29 || mydate[0] == 30)) {
		}
	});
	
	this.isntCharacterName = (function(obj, alreadyexists){
		if (alreadyexists == null) { alreadyexists = false; }
		chara = obj.val();
		if (alreadyexists == true) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Esse personagem já existe.";
			} else if (lang == "en-us") {
				return "This character already exists.";
			} 
		} else if (chara == "") {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "O campo de nome não pode ser nulo.";
			} else if (lang == "en-us") {
				return "The name field can't be null.";
			}
		} else if (!chara.match("^[a-zA-Z ]+$")) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Há caracteres inválidos dentro do campo do nome.";
			} else if (lang == "en-us") {
				return "There are invalid caracters in name field.";
			}
		} else if (chara.length <= 5) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "O campo do nome deve ter mais que 5 letras.";
			} else if (lang == "en-us") {
				return "The name field must had more then 5 letters.";
			}
		} else {
			obj.attr("class", "accept");
			return false;
		}
	});

	this.isntLogin = (function(obj, alreadyexists){
		if (alreadyexists == null) { alreadyexists = false; }
		
		login = obj.val();
		if (alreadyexists == true) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Esse login já está existe.";
			} else if (lang == "en-us") {
				return "This login already exists.";
			}
		} else if (login == "") {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "O campo de login não pode ser nulo.";
			} else if (lang == "en-us") {
				return "The login field can't be null.";
			}
		} else if (!login.match("^[a-z0-9]+$")) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Há caracteres inválidos dentro do campo do login.";
			} else if (lang == "en-us") {
				return "There are invalid caracters in login field.";
			}
		} else if (login.length <= 4) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "O seu campo de login deve ter mais que 4 letras.";
			} else if (lang == "en-us") {
				return "The login field must had more then 4 letters.";
			}
		} else {
			obj.attr("class", "accept");
			return false;
		}
	});
	
	this.passwodDontMatch = (function(obj1, obj2){
		pass1 = obj1.val();
		pass2 = obj2.val();
		if (pass2.length == 0) {
			obj2.attr("class", "error");
			if (lang == "pt-br") {
				return "O campo de senha não pode ser nulo.";
			} else if (lang == "en-us") {
				return "The password field can't be null.";
			}
		} else if (pass2.length <= 4) {
			obj2.attr("class", "error");
			if (lang == "pt-br") {
				return "As senhas devem ter mais do que 4 letras.";
			} else if (lang == "en-us") {
				return "The passwords must had more then 4 letters.";
			}
		} else if (pass1 != pass2) {
			obj2.attr("class", "error");
			if (lang == "pt-br") {
				return "Senhas não batem.";
			} else if (lang == "en-us") {
				return "Passwords don't match.";
			}
		} else {
			obj2.attr("class", "accept");
			return false;
		}
	});
	
	this.isntPassword = (function(obj){
		pass = obj.val();
		if (pass.length == 0) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "O campo de senha não pode ser nulo.";
			} else if (lang == "en-us") {
				return "The password field can't be null.";
			}
		} else if (pass.length <= 4) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "As senhas devem ter mais do que 4 letras.";
			} else if (lang == "en-us") {
				return "The passwords must had more then 4 letters.";
			}
		} else {
			obj.attr("class", "accept");
			return false;
		}
	});
	
	this.isntFullName = (function(obj, alreadyexists){
		if (alreadyexists == null) { alreadyexists = false; }
		nome_completo = obj.val();
		var nomes = nome_completo.split(" ");
		if (alreadyexists == true) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Esse nome já está em uso.";
			} else if (lang == "en-us") {
				return "This name is already in use.";
			}
		} else if (nome_completo == "") {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "O campo do nome não pode ser nulo.";
			} else if (lang == "en-us") {
				return "The name field can't be null.";
			}
		} else if (!nome_completo.match("^[A-Za-záéíóúãõçâêôü ]+$")) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Há caracteres estranhos escritos.";
			} else if (lang == "en-us") {
				return "There are strange caracteres written.";
			}
		} else if (!nome_completo.match("^(([A-Za-záéíóúãõçâêôü]+)([ ])([A-Za-záéíóúãõçâêôü]+))(|[A-Za-záéíóúãõçâêôü ]+)$")) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Você não digitou seu nome completo.";
			} else if (lang == "en-us") {
				return "You haven't wroten your full name.";
			}
		} else if (!(nome_completo.length > 5)) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Você não digitou seu nome completo.";
			} else if (lang == "en-us") {
				return "You haven't wroten your full name.";
			}
		} else if (nomes[1].length < 2 && nomes.length == 2) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Você não digitou seu nome completo.";
			} else if (lang == "en-us") {
				return "You haven't wroten your full name.";
			}
		} else {
			obj.attr("class", "accept");
			return false;
		}
	});
	
	this.isntEmail = (function(obj, alreadyexists){
		if (alreadyexists == null) { alreadyexists = false; }
		email = obj.val();
		if (alreadyexists == true) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Esse e-mail já está registrado.";
			} else if (lang == "en-us") {
				return "This e-mail is already registred.";
			}
		} else if (!email.match("^([a-z0-9._\-]+)[@]([a-z]+)[.]([a-z][a-z]+)(|[.]([a-z]+))$")) {
			obj.attr("class", "error");
			if (lang == "pt-br") {
				return "Isso não é um e-mail.";
			} else if (lang == "en-us") {
				return "This isn't an e-mail.";
			}
		} else {
			obj.attr("class", "accept");
			return false;
		}
	});
});