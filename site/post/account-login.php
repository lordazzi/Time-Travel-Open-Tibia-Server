<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 03/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$login = post("login");
$pass = post("pass");
$captcha = post("captcha");
if (isSet($_POST["to"])) {
	$to = urlDecompile(post("to"));
} else {
	$to = "";
}

$acc = new Account($login, $pass, $captcha);
callback(array(
	"captcha" => $acc->isCaptcha(),
	"tries" => $acc->getTries(),
	"islogado" => $acc->isLogin(),
	"to" => $to
));
?>