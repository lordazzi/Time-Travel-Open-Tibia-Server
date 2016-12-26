<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 15/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$width = post("width");
$height = post("height");
$firstajax = post("firstajax");
$language = post("language");
$system = post("system");
$browser = post("browser");

$sql = new MySql("ttotsite");
$needupdate = $sql->Query("
	SELECT a.idvisita, a.idip, a.idcookie
	FROM visitas a
	INNER JOIN visitas_ip b ON a.idip = b.idip
	INNER JOIN visitas_cookie c ON a.idcookie = c.idcookie
	WHERE (b.txtip='".System::getIp(TRUE)."'
			AND a.txtbrowserstring='".System::getBrowseString()."'
			AND a.txtfullip='".System::getIp()."'
			AND (c.txtcookie = '".System::getCookie()."' OR a.idcookie IS NULL)
			AND a.dtcadastro LIKE '".date("Y-m-d")."%')
	GROUP BY a.idvisita
");

if (COUNT($needupdate) == 1) {
	$sql->Query("
		UPDATE visitas
		SET isjs=1, nrscreenwidth='$width', nrscreenheight='$height',
		txtlanguage='$language', nrfirstajax='$firstajax', txtjssystem='$system',
		txtjsbrowser='$browser' WHERE idvisita=".$needupdate[0]["idvisita"]);
	
	callback(array(
		"success" => $needupdate[0]["idvisita"]
	));
} else {
	callback(array(
		"success" => FALSE
	));
}
?>