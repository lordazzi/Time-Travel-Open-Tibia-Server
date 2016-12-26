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
		<h1 pt-br="Notícias Rápidas" en-us="Tickers"></h1>
		<span class="content">
			<span class="justtext">
				Conforme foi prometido durante a execução do seu cadastro, nosso servidor nunca irá apresentar nenhum dos seus dados pessoais para os outros jogadores,
				porém, para você ter acesso a áreas comunais (enquetes, forúms), existe a necessidade de que você se apresente com um nome diante dos outros usuários.
				Associe um <em>nickname</em> à sua conta para continuar:
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