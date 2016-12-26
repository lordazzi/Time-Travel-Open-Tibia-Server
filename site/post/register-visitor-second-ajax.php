<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 15/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$secondajax = post("secondajax");
$idvisita = post("idvisita");

$sql = new MySql("ttotsite");
$sql->Query("UPDATE visitas SET nrlasttajax='$secondajax' WHERE idvisita=$idvisita");
?>