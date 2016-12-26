<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 30/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

/* colocar acesso nesse arquivo */
$idcomentario = post("idcomentario");
$acc = new Account(@$_SESSION["account"]);
if ($acc->isLogin()) {
	$sql = new MySql("ttotsite");
	$sql->Query("INSERT INTO ouvidoria_sanados (idcomentario, idaccount, dtcadastro) VALUES ($idcomentario, ".$acc->getAccountId().", NOW())");
	callback(array(
		"success" => TRUE
	));
} else {
	callback(array(
		"success" => FALSE
	));
}
?>