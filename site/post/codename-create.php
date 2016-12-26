<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 30/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$sql = new MySql("ttotsite");
$f = new Form();
$acc = new Account($_SESSION["account"]);
if ($acc->isLogin()) {
	$codename = post("codename");

	if (!$f->isntFullName($codename)) {
		$exists = $sql->Query("SELECT count(`idaccount`) as retorno FROM `accounts` WHERE `txtcodename` = '$codename'");
		$exists = (bool) $exists[0]["retorno"];
		if ($exists == FALSE) {
			$sql->Query("UPDATE `accounts` SET txtcodename='$codename' WHERE idaccount=".$acc->getAccountId());
			$acc->reload(); //recarregando as sessões
			callback(array(
				"success" => TRUE,
				"sendto" => urlDecompile(post("sendto"))
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
}

?>