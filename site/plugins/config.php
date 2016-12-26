<?php
session_start();
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/php/functions.php");

function __autoload($class) {
	$class = strtolower($class);
	if (strpos($class, "pagseguro") === FALSE) {
		require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/php/class/$class.class.php");
	}
}

System::saveCookie();
$GLOBALS["SERVER_PATH"] = "/home/timetravel";

$mysql = new MySql("ttotsite");
if (@$GLOBAL["nocount"] == FALSE) {
	if (@$_SESSION["registrado"]["date"] == date("dmY")) { //	avisando que a visita já foi feita e que nem é necessario olhar o banco de dados
		$existe = $sql->Query("SELECT idvisita FROM visitas WHERE (txtfullip = '".System::getIp()."' OR (txtcookie = '".System::saveCookie()."' AND txtcookir IS NOT NULL AND txtcookie <> '')) AND txtbrowserstring='".System::getBrowseString()."'");
		if (count($existe) <> 0) { //	verificando se a visita ainda não foi feita
			$txtip = System::getIp(FALSE);
			$txtcookie = System::getCookie();
			$txtfullip = System::getIp();
			$txtbrowserstring = System::getBrowseString();
			$txtphpcomefrom = System::getComeFrom();
			
			$_SESSION["registrado"]["id"] = $mysql->Query("INSERT INTO visitas
					(txtip, txtcookie, txtfullip, txtbrowserstring,
					txtphpcomefrom, dtcadastro)
				VALUES
					('$txtip', '$txtcookie', '$txtfullip',
					'$txtbrowserstring', '$txtphpcomefrom', NOW())");
			$_SESSION["registrado"]["date"] = date("dmY");
		}		
	}
	
	if (isSet($_SESSION["registrado"])) {
		$mysql->Query("INSERT INTO visitas_atividade (idvisita, txtpage, dtcadastro) VALUES ('".$_SESSION["registrado"]["id"]."', '".$_SERVER["SERVER_NAME"].$_SERVER["REQUEST_URI"]."', NOW())");
	}
}
?>