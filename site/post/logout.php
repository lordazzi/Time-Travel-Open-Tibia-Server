<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 09/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$acc = new Account($_SESSION["idaccount"]);
$acc->logout();
?>