<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 30/11/12 #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$sql = new MySql("ttotsite");
$page = new Page(array(
	"logado" => TRUE,
	"js" => TRUE
));
$retorno = $sql->Query("SELECT count(id) as is_already_choose FROM accounts WHERE codename<>'' AND id=".$page->account->getAccountId());
if ($retorno[0]["is_already_choose"] == TRUE) {
	if (get("?") != "") {
		redirect(get("?"), TRUE);
	} else {
		redirect("account-login-signup.php", TRUE);
	}
}
$page->jsClass("form");
?>
<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Not�cias R�pidas" en-us="Tickers"></h1>
		<span class="content">
			<span class="justtext">
				Conforme foi prometido durante a execu��o do seu cadastro, nosso servidor nunca ir� apresentar nenhum dos seus dados pessoais para os outros jogadores,
				por�m, para voc� ter acesso a �reas comunais (enquetes, for�ms), existe a necessidade de que voc� se apresente com um nome diante dos outros usu�rios.
				Associe um <em>nickname</em> � sua conta para continuar:
			</span>
			<fieldset>
				<legend>Insira aqui o seu <strong>nickname:</strong></legend>
				<input id="community-codename-choose" type="text" value="<?=$page->account->getUserName()?>" />
				<span id="community-codename-choose-logtip" class="logtip">
					<span></span>
					<div></div>
				</span><br />
				<button pt-br="Continuar" en-us="Continue" id="community-codename-save"></button>
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>