<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 10/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$sql = new Mysql("ttotserver");
$existe = $sql->Query("SELECT count(`id`) as retorno FROM `accounts` WHERE `name` = ".post("account"));
callback(array(
	"exists" => (bool) $existe[0]["retorno"]
));
?>