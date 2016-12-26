<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 29/12/12   #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page();
$sql = new MySql("ttotsite");
$premission = $sql->Query("SELECT txtchangepass FROM accounts WHERE txtchangepass='".get("?")."'");
if (count($premission) == 1) {
	$validation = explode("<>", base64_decode(get("?")));
	if ($premission[0]+(60 * 60 * 48) <= time()) {
	}
	$email = $premission[1];
} else {
	exit();
}

?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Reiniciar minha senha</h1>
		<span class="content">
			<h2><strong>Alterar minha senha:</strong></h2>
			<fieldset>
				<legend>Alterar minha senha:<legend>
				<input name="pass" id="pass" type="password" />
				<input name="repeat" id="repeat" type="password" />
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>