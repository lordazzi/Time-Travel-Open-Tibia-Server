<?php
class Forms {
	// FUN��ES DE VALIDA��O DE FORMUL�RIO
	public static function isEmail($mail) {
		if (preg_match("/^([a-z0-9._\-]+)[@]([a-z]+)[.]([a-z][a-z]+)(|[.]([a-z]+))$/", $mail)) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function isFullName($fullname) { //desconsiderando UTF8
		$nomes = explode(" ", adjust($fullname));
		if ($fullname == "") {
			return FALSE; //Nome nulo
		} else if (!preg_match(utf8_encode("/^[A-Za-z������������ ]+$/"), $fullname)) {
			return FALSE; //Caracter estranho
		} else if (!preg_match(utf8_encode("/^(([A-Za-z������������]+)([ ])([A-Za-z������������]+))(|[A-Za-z������������ ]+)$/"), $fullname)) {
			return FALSE; //N�o � o seu nome completo
		} else if (!(strlen($fullname) > 5)) {
			return FALSE; //N�o � o seu nome completo
		} else if (strlen($nomes[1]) < 2 AND count($nomes) == 2) {
			return FALSE; //N�o � o seu nome completo
		} else {
			return TRUE;
		}
	}
	
	// FUN��ES AUXILIARES
	public static function adjustPhone($phone, $prefixo = FALSE) {
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
	
	public static function isUnderMask($string, $mask, $case = 1) {
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