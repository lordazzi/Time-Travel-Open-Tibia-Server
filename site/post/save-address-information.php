<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 24/12/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$acc = new Account($_SESSION["account"]);
if ($acc->isLogin()) {
	$telprefixo = post("telprefixo");
	$telefone = post("telefone");
	$cep = post("cep");
	$logradouro = post("logradouro");
	$numero = post("numero");
	$complemento = post("complemento");
	$bairro = post("bairro");
	$cidade = post("cidade");
	$estado = strtoupper(post("estado"));

	$sql = new MySql("ttotsite");
	$isvip = $sql->Query("SELECT COUNT(idvip) AS isvip FROM accounts_vipinformacao WHERE idaccount=".$acc->getAccountId());
	$isvip = (bool) $isvip[0]["isvip"];
	if ($isvip == TRUE) {
		$sql->Query("UPDATE accounts_vipinformacao SET txttelprefix='$telprefixo', txttelefone='$telefone', txtcep='$cep', txtlogradouro='$logradouro',
			txtnumero='$numero', txtcomplemento='$complemento', txtbairro='$bairro', txtcidade='$cidade', txtestado='$estado' WHERE idaccount=".$acc->getAccountId());
	} else {
		$sql->Query("INSERT INTO accounts_vipinformacao(idaccount, txttelprefix, txttelefone, txtcep, txtlogradouro, txtnumero, txtcomplemento, txtbairro, txtcidade, txtestado)
			VALUES (".$acc->getAccountId().", '$telprefixo', '$telefone', '$cep', '$logradouro', '$numero', '$complemento', '$bairro', '$cidade', '$estado')");
	}
	
	$acc->reload();
	callback(array(
		"success" => TRUE
	));
	
} else {
	callback(array(
		"success" => FALSE
	));
}

?>