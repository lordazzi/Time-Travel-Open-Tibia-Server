<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 15/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$sql = new Mysql("ttotserver");
$existe = $sql->Query("SELECT COUNT(id) AS existe FROM `players` WHERE `name` = '".post("chara_name")."'");
callback(array(
	"exists" => (bool) $existe[0]["existe"]
));
?>