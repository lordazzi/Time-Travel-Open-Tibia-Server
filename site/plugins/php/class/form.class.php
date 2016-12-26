<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 16/10/12 #
class Form { //DEPRECATED, n�o utilizar mais esta classe
	private $sql;
	
	public function __construct() {
		$this->sql = new MySql("ttotserver");
	}
	
	public function isntLogin($login) {
		$existe = $this->sql->Query("SELECT count(`id`) as retorno FROM `accounts` WHERE `name` = '".post("account")."'");
		print_r($existe);
		$existe = (bool) $existe[0]["retorno"];
		if ($existe == TRUE) {
			return 401; //Login j� existe
		} else if ($login == "") {
			return 402; //Login vazio
		} else if (!preg_match("/^[a-z0-9]+$/", $login)) {
			return 403; //Login fora dos padr�es estabelecidos
		} else if (strlen($login) <= 4) {
			return 404; //quantidade de letras insuficiente
		} else {
			return FALSE;
		}
	}
	
	public function passwodDontMatch($pass, $confirm) {
		if ($pass != $confirm) {
			return 303; //Senha n�o confere
		} else {
			return $this->isntPassword($pass);
		}
	}

	private function isntPassword($pass) {
		if ($pass == "") {
			return 301; //Senha nula
		} else if (strlen($pass) <= 4) { 
			return 302; //Senha com poucas letras
		} else {
			return FALSE;
		}
	}
	
	public function isntFullName($fullname) {
		$nomes = explode(" ", $fullname);
		if ($fullname == "") {
			return 201; //Nome nulo
		} else if (!preg_match(utf8_encode("/^[A-Za-z������������ ]+$/"), $fullname)) {
			return 202; //Caracter estranho
		} else if (!preg_match(utf8_encode("/^(([A-Za-z������������]+)([ ])([A-Za-z������������]+))(|[A-Za-z������������ ]+)$/"), $fullname)) {
			return 203; //N�o � o seu nome completo
		} else if (!(strlen($fullname) > 5)) {
			return 203; //N�o � o seu nome completo
		} else if (strlen($nomes[1]) < 2 AND count($nomes) == 2) {
			return 203; //N�o � o seu nome completo
		} else {
			return FALSE;
		}
	}
	
	public function isntMail($mail) {
		$existe = $this->sql->Query("SELECT count(`id`) as retorno FROM `accounts` WHERE `email` = '$mail'");
		$existe = (bool) $existe[0]["retorno"];
		if ($existe == TRUE) {
			return 101; //E-mail j� cadastrado
		} else if (!preg_match("/^([a-z0-9._\-]+)[@]([a-z]+)[.]([a-z][a-z]+)(|[.]([a-z]+))$/", $mail)) {
			return 102; //N�o � um e-mail
		} else {
			return FALSE;
		}
	}
	
	/** Transforma o telefone em n�meros */
	public function adjustPhone($phone, $prefixo = FALSE) {
		$rebuilt = "";
		for ($j = 0; $j < strlen($phone); $j++) {
			if (is_numeric($phone[$j]) AND $phone[$j] != " ") {
				$rebuilt .= $phone[$j];
			}
		}
		
		$rebuilt = (int)$rebuilt;
		$rebuilt .= ""; //retirando o zero de 011 XXXX-XXXX
		
		if ($prefixo == TRUE) {
			if (strlen($rebuilt) == 8 || strlen($rebuilt) == 9) {
				return "5511".$rebuilt;
			} else if (strlen($rebuilt) == 10 || strlen($rebuilt) == 11) {
				return "55".$rebuilt;
			} else {
				return $rebuilt;
			}
		}
	}

	/** Verifica se o valor inserido esta debaixo da mascara */
	public function isUnderMask($string, $mask, $case = 1) {
		if (strlen($string) == strlen($mask)) {
			$isvalid = true; // predefine como valido
			for ($IntFor = 0; $IntFor < strlen($string); $IntFor++) {
				if ($case == 1)	{//se case sensitive estiver ativado
					$mask = strtolower($mask);
					$string = strtolower($string);
				}
				
				if ($mask[$IntFor] == "9") { //Somente n�meros
					if (!is_numeric($string[$IntFor])) { //Se n�o for um n�mero
						$isvalid = FALSE;
					}
				}
				
				elseif ($mask[$IntFor] == "a") { //Somente letras minusculas
					if ($string[$IntFor] != strtolower($string[$IntFor]) OR !preg_match("/^[a-z������������������������]$/", $string[$IntFor])) { //se a letra n�o for igual a ela mesma em minuscula ou se ela n�o for uma letra
						$isvalid = FALSE;
					}
				}
				
				elseif ($mask[$IntFor] == "A") { //Somente letras maiusculas
					if ($string[$IntFor] != strtolower($string[$IntFor]) OR !preg_match("/^[A-Z������������������������]$/", $string[$IntFor])) { //se a letra n�o for igual a ela mesma em maiuscula ou se ela n�o for uma letra
						$isvalid = FALSE;
					}
				}
				
				elseif ($mask[$IntFor] == "*") { //Qualquer coisa
					
				}
				
				else { //Obrigat�riamente o item da mascara
					if ($mask[$IntFor] !== $string[$IntFor]) {
						$isvalid = FALSE;
					}
				}
			}//final do for
			
			return $isvalid;
		}
		
		else {
			return FALSE;
		}
	}
}
?>