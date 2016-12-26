<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 22/02/13 #
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$page = new Page(array(
	"css" => TRUE,
	"js" => TRUE
));
$sql = new MySql("ttotserver");
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1>Recuperar</h1>
		<span class="content">
			<fieldset>
				<legend>Recuperando seus dados</legend>
				<h3> <input type="radio" name="esquecisenha" value="viaemail" id="viaemail"> Enviar um e-mail para mim com minha conta e com a opção de reiniciar minha senha:</h3>
				<input name="recuperar-via-email" id="recuperar-via-email" type="email" />
				
				<h3> <input type="radio" name="esquecisenha" value="viarecoverykey" id="viarecoverykey"> Usar minha recovery key para recuperar meus dados e reiniciar minha senha:</h3>
				<input id="first5" class="recoverykey" maxlength="5" type="text" /> - 
				<input id="second5" class="recoverykey" maxlength="5" type="text" /> - 
				<input id="third5" class="recoverykey" maxlength="5" type="text" /> - 
				<input id="fourth5" class="recoverykey" maxlength="5" type="text" /> - 
				<input id="last5" class="recoverykey" maxlength="5" type="text" /><br />
				<br />
				<?
				$c = new Captcha("my-captcha", TRUE);
				?>
				<button id="recuperar-conta-botao">Recuperar</button>
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>