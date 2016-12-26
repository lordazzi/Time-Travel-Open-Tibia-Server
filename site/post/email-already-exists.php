<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 10/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$sql = new MySql("ttotserver");
$acc = new Account(@$_SESSION["account"]);
$id = @$acc->getAccountId();
$existe = $sql->Query("SELECT count(`id`) as retorno FROM `accounts` WHERE `email` = '".post("mail")."' AND id <> '$id'");
callback(array(
	"exists" => (bool) $existe[0]["retorno"]
));
?>