<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 10/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$server = new MySql("ttotserver");
$site = new MySql("ttotsite");
$f = new Form();

$login = post("login");
$pass = sha1(post("pass"));
$confirm = sha1(post("confirm"));
$name = post("name");
$mail = post("mail");
$gender = post("gender");
$lang = post("lang");
$country = post("country");

$keys = "A B C D E F G H I J K L M N O P Q R S T U V W X Y Z 2 3 4 5 6 7 8 9";
$keys = explode(" ", $keys);
$max = count($keys) - 1;

$login_retorno = $f->isntLogin($login);
$pass_retorno = $f->passwodDontMatch($pass, $confirm);
$name_retorno = $f->isntFullName($name);
$mail_retorno = $f->isntMail($mail);
if (!($gender == 1 OR $gender == 0)) { $gender_retorno = 501; }


/*
gerando recovery key: enquanto a recovery key gerada
já existir no banco de dados, gerar uma nova
*/
do {
	$recovery_key = $keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)];
	$recovery_key .= "-".$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)];
	$recovery_key .= "-".$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)];
	$recovery_key .= "-".$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)];
	$recovery_key .= "-".$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)].$keys[rand(0, $max)]; //gerando recovery Key
	echo("SELECT count(`key`) AS retorno FROM accounts WHERE `key`='$recovery_key'");
	$retorno = $server->Query("SELECT count(key) AS retorno FROM accounts WHERE key='$recovery_key'");
	$retorno = (bool) $retorno[0]["retorno"];
} while ($retorno);

if ($login_retorno == FALSE AND $pass_retorno == FALSE AND $name_retorno == FALSE AND $mail_retorno == FALSE) {
	$cript = MD5(sha1(base64_encode($mail)));
	$crip_sended = sendMail(array(
		"to" => $mail,
		"assunto" => "Bem vindo ao Time Travel! Confirme seu e-mail.",
		"mensagem" => "
			Olá <strong>$name</strong>,<br />
			<br />
			Sejam bem vindo ao nosso servidor!<br />
			Você deve confirmar o e-mail cadastrado clicando no seguinte link:<br />
			<br />
			<a href='http://www.timetravel.net.br/post/mail-confirm.php?$cript'>http://www.timetravel.net.br/post/mail-confirm.php?$cript</a><br />
			<br />
			Atenciosamente, equipe Time Travel<br />
			<br />
			<em>Se você não criou uma conta e há alguém usando seu endereço eletronico, responda este e-mail denunciando o cadastro.</em>"
	));
	if ($crip_sended == FALSE) { $cript = ""; }
	
	$rec_sended = sendMail(array(
		"to" => $mail,
		"assunto" => "Recovery Key gerada automaticamente.",
		"mensagem" => "
			<strong>Time Travel Open Tibia Server</strong><br />
			<br />
			Uma recovery key foi gerada automaticamente pelo nosso servidor:<br />
			<br />
			<h2>$recovery_key</h2>
			<br />
			Essa recovery key está vinculada com a sua conta! ($login)<br />
			No caso de perder sua senha, ou roubarem sua conta, através desta recoverykey será possível resgatar sua conta!<br />
			Não descarte essa recovery key!<br />
			<br />
			<strong>Nossa equipe <u>NUNCA</u> vai pedir seu login ou senha para nada!</strong><br />
			<strong>Nunca compartilhe suas informações de login e senha com ninguém!</strong>
		"
	));
	
	if ($rec_sended == FALSE) { $recovery_key = ""; }
	
	//apesar do campo 'name' estar recebendo o valor 'login', isso não é um erro: no servidor, name se refere ao nome do login
	$server->Query("INSERT INTO `accounts` (`name`, `password`, `salt`, `email`, `key`) VALUES ('$login', '$pass', '', '$mail', '$recovery_key')");
	$id = $server->getLastId();
	
	//Agora a variavel name é inserida em txtusername, que se refere ao nome do usuário
	$site->Query("INSERT INTO `accounts` (idaccount, txtconfirm, txtusername, isgender, txtcountry, txtlanguage, dtlastday, dtcadastro) VALUES ($id, '$cript', '$name', '$gender', '$country', '$lang', NOW(), NOW())");
	
	//fazendo login
	new Account($login, $pass, "");
}

callback(array(
	"error_on_login" => $login_retorno,
	"error_on_pass" => $pass_retorno,
	"error_on_name" => $name_retorno,
	"error_on_mail" => $mail_retorno
));
?>