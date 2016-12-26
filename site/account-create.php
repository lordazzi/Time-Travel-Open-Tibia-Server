<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 03/11/12   #

require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");
$acc = new Account(@$_SESSION["account"]);
if ($acc->isLogin()) { redirect("account-myaccount.php"); }
$page = new Page(array(
	"js" => TRUE,
	"css" => TRUE
));

$page->jsClass("form");
$page->jsClass("masked");
?>
<div class="box">
	<img src="plugins/img/corner-tl.gif" />
	<img src="plugins/img/corner-tr.gif" />
	<span class="content">
		<h1 pt-br="Minha Conta" en-us="My Account"></h1>
		<span class="content">
			<fieldset>
				<legend pt-br="Criar nova conta" en-us="Create new account"></legend>
				<h3 pt-br="Preencha o formulário abaixo:" en-us="Fill in the form bellow"></h3>
				<label>Login: </label>
				<input id="account-create-login" maxlength="32" type="text" />
				<span id="account-create-login-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<label pt-br="Senha: " en-us="Password: "></label>
				<input id="account-create-pass" maxlength="32" type="password" />
				<span id="account-create-pass-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<label pt-br="Confirma: " en-us="Confirm: "></label>
				<input id="account-create-confirm" maxlength="32" type="password" />
				<span id="account-create-confirm-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<hr />
				<i
					pt-br="Precisamos de suas informações pessoais para fins estatisticos, elas <u>NUNCA</u> serão apresentadas para outros jogadores"
					en-us="We need your personal information for statistical purposes, they will <u>NEVER</u> be shown to other players"
				></i><br />
				<br />
				<label pt-br="Nome real: " en-us="Real name: "></label>
				<input maxlength="64" id="account-create-name" type="text" />
				<span id="account-create-name-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<label pt-br="Gênero: " en-us="Gender: "></label>
				<select id="account-create-gender">
					<option value="1" pt-br="Masculino" en-us="Male"></option>
					<option value="0" pt-br="Feminino" en-us="Female"></option>
				</select>
				<span id="account-create-gender-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<label>E-Mail: </label>
				<input id="account-create-mail" type="text" pt-br-placeholder="Exemplo: exemplo@exemplo.com.br" en-us-placeholder="Example: example@example.com" />
				<span id="account-create-mail-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<hr />
				<label pt-br="País: " en-us="Country: "></label>
				<select id="account-create-country">
					<option value="Brasil" pt-br="Brasil" en-us="Brazil"></option>
					<option value="México" pt-br="México" en-us="Mexico"></option>
					<option value="Polônia" pt-br="Polônia" en-us="Poland"></option>
					<option value="Estados Unidos" pt-br="Estados Unidos" en-us="Unite States"></option>
					<option value="Venezuela">Venezuela</option>
					<option value="Canadá" pt-br="Canadá" en-us="Canada"></option>
					<option value="Chile">Chile</option>
					<option value="Austrália" pt-br="Austrália" en-us="Australia"></option>
					<option value="Egito" pt-br="Egito" en-us="Egipt"></option>
					<option value="Espanha" pt-br="Espanha" en-us="Spain"></option>
					<option value="Suécia" pt-br="Suécia" en-us="Sweden"></option>
					<option value="Holanda" pt-br="Holanda" en-us="Netherland"></option>
					<option value="Outro" pt-br="Outro" en-us="Other"></option>
				</select>
				<span id="account-create-country-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				
				<label pt-br="Linguagem: " en-us="Language: "></label>
				<select id="account-create-lang">
					<option value="pt-br">Português do Brasil</option>
					<option value="en-us">English Unite States</option>
				</select>
				<span id="account-create-lang-logtip" class="logtip">
					<span></span>
					<div></div>
				</span>
				<br />
				<button id="account-create-submit" class="large" pt-br="Cadastrar Õ/" en-us="Sign Up Õ/"></button>
			</fieldset>
		</span>
		<span id="account-create-login-error-msg" class="msg error"></span>
		<span id="account-create-pass-error-msg" class="msg error"></span>
		<span id="account-create-name-error-msg" class="msg error"></span>
		<span id="account-create-gender-error-msg" class="msg error"></span>
		<span id="account-create-mail-error-msg" class="msg error"></span>
	</span>
	<img src="plugins/img/corner-bl.gif" />
	<img src="plugins/img/corner-br.gif" />
</div>