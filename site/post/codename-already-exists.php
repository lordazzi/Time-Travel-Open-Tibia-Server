<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 30/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$sql = new Mysql("ttotsite");
$existe = $sql->Query("SELECT count(`id`) as retorno FROM `accounts` WHERE `txtcodename` = '".post("codename")."'");
callback(array(
	"exists" => (bool) $existe[0]["retorno"]
));
?>