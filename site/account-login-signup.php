<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 17/01/13 #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$acc = new Account(@$_SESSION["account"]);
if ($acc->isLogin()) { redirect("account-myaccount.php"); }
$page = new Page(array(
	"js"=>TRUE
));
?>

<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Minha Conta" en-us="My Account"></h1>
		<span class="content">
			<fieldset>
				<legend pt-br="Acesse sua conta" en-us="Access your account"></legend>
				<form>
					<label>Login:</label> <input maxlength="32" id="account-login-signup-login" name="login" type="text" /><br />
					<label maxlength="32" pt-br="Senha: " en-us="Password: "></label> <input id="account-login-signup-pass" name="pass" type="password" /><br />
					<?php $captcha = new Captcha("captcha-system", $acc->isCaptcha()); ?>
					<span id="account-login-signup-error" class="msg error"> <img src="plugins/icon/16/alert.png" /> Login ou Senha incorreto.</span>
					<div id="account-login-signup-submit" class="large btn" type="submit" name="login-submit" pt-br="Fazer login" en-us="Login" /></div>
				</form>
			</fieldset>
			<br />
			<fieldset>
				<legend pt-br="Ainda não joga Time Travel?" en-us="Don't play Time Travel yet?"></legend>
				<form method="POST" action="">
					<strong pt-br="Por que jogar Time Travel" en-us="Why to play Time Travel"></strong>
					<ul>
						<li pt-br="Tibia versão 9.61" en-us="Tibia version 9.61"></li>
						<li pt-br="Sprites editadas e client próprio" en-us="Editted sprites and own client"></li>
						<li pt-br="Temos bacon" en-us="We have bacon"></li>
						<li pt-br="Todos os monstros foram alterados" en-us="All monsters was changed"></li>
						<li pt-br="Vocações diferentes" en-us="Different vocations"></li>
						<li pt-br="Muito RPG" en-us="Much RPG"></li>
						<li pt-br="Você pode entrar num vortex que atravessa o tempo e o espaço" en-us="You can enter in a vortex that across the time and space"></li>
					</ul>
					<input class="large" type="button" id="account-signup" name="account-signup" pt-br-value="Aew! Cadastrar!" en-us-value="Wow! Sign Up!" />
				</form>
			</fieldset>
		</span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>