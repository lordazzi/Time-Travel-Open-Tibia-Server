<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 31/01/13   #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

if (isSet($_POST) AND isSet($_POST["notificationCode"]) AND isSet($_POST["notificationType"])) {
	$status = file_get_contents("https://ws.pagseguro.uol.com.br/v2/transactions/notifications/$_POST[notificationCode]?email=".buyPoints::pagseguro_email."&token=".buyPoints::pagseguro_token);
	$status = simplexml_load_string($status);
	$status = json_encode($status);
	$status = json_decode($status, TRUE);
	
	$status["date"] = strtotime($status["date"]);
	$time = date("Y-m-d H:i:s", $status["date"]);
	
	$sql = new MySql("ttotsite");
	$sql->Query("INSERT INTO accounts_pontos_pagsegurostatus (txttransacao, idstatus, idtype, idmeio, dtstatus, dtcadastro) VALUES
		('$status[reference]', '$status[status]', '$status[paymentMethod][type]', '$status[paymentMethod][code]', '$time', NOW())");
		
	if ($status["idstatus"] == 3) {
		$nrvippoints = $sql->Query("SELECT a.nrvippoints, idaccount
			FROM accounts_vipinformacao a
			INNER JOIN accounts_pontos_history b ON a.idaccount = b.idaccount
		WHERE b.txttransacao = '$status[reference]'");
		$idaccount = (int) $nrvippoints[0]["idaccount"];
		$nrvippoints = (int) $nrvippoints[0]["nrvippoints"];
		
		$pontos = $sql->Query("SELECT a.nrqtdd, b.nrpontos
			FROM accounts_pontos_history a
			INNER JOIN pontos_compraveis ON a.idponto = b.idponto
			WHERE a.txtplugin = 'pagseguro'");
		
		$ganho = 0;
		foreach ($pontos as $ponto) {
			$ganho += ($ponto["nrqtdd"] * $ponto["nrpontos"]);
		}
		
		$sql->Query("UPDATE accounts_vipinformacao SET nrvippoints='".($nrvippoints + $pontos)."' WHERE idaccount='$idaccount'");
	}
}
?>