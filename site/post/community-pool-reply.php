<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 29/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$e = post("e");
$acc = new Account($_SESSION["account"]);
$sql = new MySql("ttotsite");
if ($acc->isLogin()) { //verificar se esta logado
	$opicoes = $sql->Query("SELECT b.idopicao, COUNT(c.idaccount) AS nrrespondido, a.ismulti
	FROM enquetes a
	INNER JOIN enquete_opicoes b ON a.idenquete = b.idenquete
	LEFT JOIN enquete_respostas c ON b.idopicao = c.idopicao AND c.idaccount = ".$acc->getAccountId()."
	WHERE a.isactive=1 AND a.idenquete=$e AND (a.dtfim IS NULL OR NOW() BETWEEN a.dtinicio AND a.dtfim)
	GROUP BY b.idopicao, a.ismulti");
	
	$ismulti = $opicoes[0]["ismulti"];
	$respondido = FALSE;
	$respostas = array();
	
	foreach ($opicoes AS $opicao) {
		if ($opicao["nrrespondido"] > 0) {
			$respondido = TRUE;
		}
		
		if ($ismulti == TRUE) {
			if (isSet($_POST["enquete".$e.$opicao["idopicao"]])) {
				$respostas[] = (int) post("enquete".$e.$opicao["idopicao"]);
			}
		}
	}
	
	if ($ismulti == FALSE) {
		if (isSet($_POST["enquete$e"])) {
			$respostas[] = (int) post("enquete$e");
		}
	}
	
	if ($ismulti == FALSE AND COUNT($respostas) == 1) {
		$sql->Query("INSERT INTO enquete_respostas (idopicao, idaccount) VALUES (".$respostas[0].", ".$acc->getAccountId().")");
		callback(array(
			"success"=>TRUE
		));
	} else if ($ismulti == TRUE AND COUNT($respostas) != 0) {
		foreach($respostas as $resposta) {
			$sql->Query("INSERT INTO enquete_respostas (idopicao, idaccount) VALUES ($resposta, ".$acc->getAccountId().")");
		}
		callback(array(
			"success"=>TRUE
		));
	} else {
		callback(array(
			"success"=>FALSE
		));
	}
} else {
	callback(array(
		"success"=>FALSE
	));
}
?>