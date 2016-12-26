<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 30/11/12   #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$acc = new Account($_SESSION["account"]);
if ($acc->isLogin()) {
	$sql = new MySql("ttotsite");

	$txtcomentario = nl2br(trim(strip_tags(post("txtcomentario"))));
	$idparent = post("idparent");
	if ($idparent == "individual") { $idparent = $acc->getAccountId(); }
	$tipo = post("tipo");
	$idaccount = $acc->getAccountId();

	if ($txtcomentario != "") {
	
		$sql->Query("INSERT INTO comentarios (idparent, idtipo, idaccount, txtcomentario, dtcadastro) VALUES ('$idparent', '$tipo', '$idaccount', '$txtcomentario',  NOW())");
		
		callback(array(
			"success" => TRUE,
			"txtcomentario" => $txtcomentario,
			"time" => date("d/m/Y H:i"),
			"master" => $acc->getCodeName(),
			"idparent" => $idparent,
			"idtipo" => $tipo
		));
	} else {
		callback(array(
			"success" => FALSE
		));
	}
} else {
	callback(array(
		"success" => FALSE
	));
}
?>