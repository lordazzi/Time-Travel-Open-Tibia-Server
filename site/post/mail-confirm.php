<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 15/01/13 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$sql = new MySql("ttotsite");
$sql->Query("UPDATE accounts SET isconfirmed=1, txtconfirm = '' WHERE txtconfirm = '".get("?")."'");
header("location: ../account-myaccount.php");
?>