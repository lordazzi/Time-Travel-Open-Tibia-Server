<?
class Str {
	
	public static function broke($term) {
		return strtr($term,"АБВГДЕЗИЙКЛМНОПСТУФХЦЩЬЪабвгдезийклмнопстуфхцщьъ","AAAAAACEEEEIIIINOOOOOUUUaaaaaaceeeeiiiinooooouuu");
	}
	
	public static function superTrim($sentence) {
		$sentence = str_replace("\r", "", $sentence);
		$sentence = str_replace("\t", " ", $sentence);
		$sentence = explode("\n", $sentence);
		foreach ($sentence as &$str) {
			while (gettype(strpos($str, "  ")) == "integer") {
				$str = str_replace("  ", " ", $str);
			}
		}
		implode("\n", $sentence);
		while (gettype(strpos($sentence, "\n\n")) == "integer") {
			$sentence = str_replace("\n\n", "\n", $sentence);
		}
		return $sentence;
	}
	
	##############################
	#
	#   funзгo isUnderMask (Estб debaixo da mascara?)
	#   Verifica se o campo estб dentro da mascara que foi proposta.
	#
	#   $string = palavra a ser avaliada
	#	$mask = mascara que ela deveria ter, 9 = nъmero, A ou a = letra, * = para qualquer coisa (se case sensitive estivar ativado, entгo A й apenas para letras maiusculas e a para minusculas)
	#	$case = se as palavras devem ser tratadas com CASE SENSITIVE
	#
	##############################
	public static function isUnderMask($string, $mask, $case = 1) {
		if (strlen($string) == strlen($mask)) {
			$isvalid = true; // predefine como valido
			for ($IntFor = 0; $IntFor < strlen($string); $IntFor++) {
				if ($case == 1)	{//se case sensitive estiver ativado
					$mask = Forms::toLowerCase($mask);
					$string = Forms::toLowerCase($string);
				}
				
				if ($mask[$IntFor] == "9") { //Somente nъmeros
					if (!onlynumbers($string[$IntFor])) { //Se nгo for um nъmero
						$isvalid = false;
					}
				}
				
				elseif ($mask[$IntFor] == "a") { //Somente letras minusculas
					if ($string[$IntFor] != Forms::toLowerCase($string[$IntFor]) OR !Forms::isOnlyLetters($string[$IntFor], "абвгдезийклмнопстуфхцщьъ")) { //se a letra nгo for igual a ela mesma em minuscula ou se ela nгo for uma letra
						$isvalid = false;
					}
				}
				
				elseif ($mask[$IntFor] == "A") { //Somente letras maiusculas
					if ($string[$IntFor] != Forms::toUpperCase($string[$IntFor]) OR !Forms::isOnlyLetters($string[$IntFor], "АБВГДЕЗИЙКЛМНОПСТУФХЦЩЬЪ")) { //se a letra nгo for igual a ela mesma em maiuscula ou se ela nгo for uma letra
						$isvalid = false;
					}
				}
				
				elseif ($mask[$IntFor] == "*") { //Qualquer coisa
					
				}
				
				else { //Obrigatуriamente o item da mascara
					if ($mask[$IntFor] !== $string[$IntFor]) {
						$isvalid = false;
					}
				}
			}//final do for
			
			return $isvalid;
		}
		
		else {
			return false;
		}
	}
}
?>