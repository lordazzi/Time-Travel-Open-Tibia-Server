<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 09/11/12 #

class Account {
	private $acessos = array();
	private $account;
	private $tries = 0;
	private $site;
	private $server;
	
	public function __construct($account = "", $pass = "", $captcha = "") {	
		$this->site = new MySql("ttotsite");
		$this->server = new MySql("ttotserver");
		
		if ($account != "" AND $pass == "") {
			$this->account = addslashes($account);
			if ($_SESSION["account"] == TRUE && $_SESSION["id"] == FALSE) {//se as informações da conta ainda não foram passadas para sessões
				$this->reload();
			}
		} else if ($account != "" AND $pass != "") {
			$this->doLogin($account, $pass, $captcha);
		}
		
		if (@$_SESSION["acessos"] != FALSE) {
			$this->acessos = $_SESSION["acessos"];
		}
	}
	
	public function lostAccountCodeGenerate($email) {
		$email = adjust($email);
		$compiled = base64_compile(time()."-$email");
		$acc = $this->server->Query("SELECT email, id FROM accounts WHERE email='$email'");
		$acc = $acc[0];
	}
	
	public function haveAccess($nr) {
		if (in_array($nr, $this->acessos)) {
			return TRUE;
		}
		return FALSE;
	}
	
	public function reload() {
		if ($_SESSION["account"] != FALSE) {
			$results = $this->server->Query(
				"SELECT a.id, a.name, a.password, a.premdays, a.lastday, a.email, a.key,
					a.group_id, b.isconfirmed, b.txtconfirm, b.txtusername, b.txtcodename,
					b.isgender, b.txtcountry, b.txtlanguage, b.dtlastday, c.idvip,
					c.nrvippoints, c.txttelprefix, c.txttelefone, c.txtcep, c.txtlogradouro,
					c.txtnumero, c.txtcomplemento, c.txtbairro, c.txtcidade, c.txtestado
				FROM ttotserver.accounts a
				INNER JOIN ttotsite.accounts b ON a.id = b.idaccount
				LEFT JOIN ttotsite.accounts_vipinformacao c ON b.idaccount = c.idaccount
				WHERE a.name='".$_SESSION["account"]."'");
			if (count($results) == 0) {
				$results = FALSE;
			} else {
				$results = $results[0];
			}
			
			$_SESSION["acessos"] = $this->site->Query("SELECT idacesso FROM accounts_acessos WHERE idaccount=".$results["id"]);
			if ($_SESSION["acessos"] != FALSE) {
				foreach($_SESSION["acessos"] as &$acesso) {
					$acesso = $acesso["idacesso"];
				}
			} else {
				$_SESSION["acessos"] = array();
			}
			
			//server accounts
			$_SESSION["id"] = (int) $results["id"];
			$_SESSION["account"] = (string) $results["name"];
			$_SESSION["password"] = (string) $results["password"];
			$_SESSION["premdays"] = (int) $results["premdays"];
			$_SESSION["lastday"] = (int) $results["lastday"];
			$_SESSION["email"] = (string) $results["email"];
			$_SESSION["key"] = (string) $results["key"];
			$_SESSION["group_id"] = (string) $results["group_id"];
			
			//site accounts
			$_SESSION["isconfirmed"] = (bool) $results["isconfirmed"];
			$_SESSION["txtconfirm"] = (string) $results["txtconfirm"];
			$_SESSION["txtusername"] = (string) $results["txtusername"];
			$_SESSION["txtcodename"] = (string) $results["txtcodename"];
			$_SESSION["isgender"] = (int) $results["isgender"];
			$_SESSION["txtlanguage"] = (string) strtolower($results["txtlanguage"]);
			$_SESSION["txtcountry"] = (string) $results["txtcountry"];
			$_SESSION["dtlastday"] = (int) $results["dtlastday"];
			
			//vip accounts
			$_SESSION["idvip"] = (int) $results["idvip"];
			$_SESSION["nrvippoints"] = (int) $results["nrvippoints"];
			$_SESSION["txttelprefix"] = (string) $results["txttelprefix"];
			$_SESSION["txttelefone"] = (string) $results["txttelefone"];
			$_SESSION["txtcep"] = (string) $results["txtcep"];
			$_SESSION["txtlogradouro"] = (string) $results["txtlogradouro"];
			$_SESSION["txtnumero"] = (string) $results["txtnumero"];
			$_SESSION["txtcomplemento"] = (string) $results["txtcomplemento"];
			$_SESSION["txtbairro"] = (string) $results["txtbairro"];
			$_SESSION["txtcidade"] = (string) $results["txtcidade"];
			$_SESSION["txtestado"] = (string) $results["txtestado"];
		}
	}
		
	//SERVER ACCOUNTS
	public function getAccountId() {
		return @$_SESSION["id"];
	}
	
	public function getAccountName() {
		return $_SESSION["account"];
	}
	
	public function getPassword() {
		return $_SESSION["password"];
	}
	
	public function getVipDays() {
		//editar
		return $_SESSION["premdays"];
	}

	public function isVip() {
		return (bool) $this->getVipDays();
	}
	
	public function getLastLogin($type, $format = "timestamp") {
		$dt;
		if ($type == "site" OR $type == "ttotsite") {
			$dt = $_SESSION["dtlastday"];
		} else if ($type == "server" OR $type == "game" OR $type == "client" OR $type == "ttotserver") {
			$dt = $_SESSION["lastday"];
		} else {
			return FALSE;
		}
		
		if ($format == "timestamp") {
			return $dt;
		} else {
			return date($format, $dt);
		}
	}
	
	public function getEmail() {
		return $_SESSION["email"];
	}
	
	public function getKey() {
		return $_SESSION["key"];
	}
	
	public function getAccountType() {
		return $_SESSION["group_id"];
	}
	
	//SITE ACCOUNTS	
	public function isConfirmed() {
		return $_SESSION["isconfirmed"];
	}
	
	public function getUrlConfirmation() {
		return $_SESSION["txtconfirm"];
	}
	
	public function getUserName() {
		return $_SESSION["txtusername"];
	}
	
	public function getCodeName() {
		return $_SESSION["txtcodename"];
	}
	
	public function getGender($type = "number") {
		if ($type == "number" OR $type == "nr" OR $type == "int") {
			return $_SESSION["isgender"];
		} else if ($type == "char" OR $type == "string") {
			if ((bool) $_SESSION["isgender"] == TRUE) {
				return "M";
			} else {
				return "F";
			}
		} else if ($type == "bool" OR $type == "boolean") {
			return (bool) $_SESSION["isgender"];
		} else {
			return $_SESSION["isgender"];
		}
	}
	
	public function getLanguage() {
		return $_SESSION["txtlanguage"];
	}
	
	public function getLang() {
		return $this->getLanguage();
	}
	
	public function getPais() {
		return $_SESSION["txtcountry"];
	}
	
	public function getCountry() {
		return $this->getPais();
	}
	
	//VIP INFORMATION
	public function getIdVip() {
		if (isSet($_SESSION["idvip"])) {
			return $_SESSION["idvip"];
		} else {
			return 0;
		}
	}
	
	public function getVipPoints() {
		return $_SESSION["nrvippoints"];
	}
	
	public function getTelefonePrefixo() {
		return $_SESSION["txttelprefix"];
	}
	
	public function getTelPrefixo() {
		return $this->getTelefonePrefixo();
	}
	
	public function getTelefone() {
		return $_SESSION["txttelefone"];
	}
	
	public function getTel() {
		return $this->getTelefone();
	}
	
	public function getCep() {
		return $_SESSION["txtcep"];
	}
	
	public function getLogradouro() {
		return $_SESSION["txtlogradouro"];
	}
	
	public function getLogr() {
		return $this->getLogradouro();
	}
	
	public function getNumeroDaCasa() {
		return $_SESSION["txtnumero"];
	}
	
	public function getCasa() {
		return $this->getNumeroDaCasa();
	}
	
	public function getNumero() {
		return $this->getNumeroDaCasa();
	}
	
	public function getComplemento() {
		return $_SESSION["txtcomplemento"];
	}
	
	public function getCompl() {
		return $this->getComplemento();
	}
	
	public function getBairro() {
		return $_SESSION["txtbairro"];
	}
	
	public function getCidade() {
		return $_SESSION["txtcidade"];
	}
	
	public function getEstado() {
		return $_SESSION["txtestado"];
	}
	
	/** tentativas de login */
	public function addTry($login, $pass) {
		$ip = System::getIp();
		System::saveCookie();
		$login = utf8_decode($login);
		$pass = utf8_decode($pass);
		$this->site->Query("INSERT INTO login_tries (txtip, txtcookie, txtlogintry, txtpasswordtry, dtcadastro) VALUES ('$ip', '".$_COOKIE["ttots"]."', '$login', '$pass', NOW())");
		$this->tries++;
	}
	
	public function getTries() {
		if ($this->tries == FALSE) {
			$hoje = date("Y-m-d");
			$ip = System::getIp();
			$this->tries = (int) $this->site->Query("SELECT COUNT(idtry) AS retorno FROM login_tries WHERE (txtip='$ip' OR txtcookie='".$_COOKIE["ttots"]."') dtcadastro LIKE '$hoje %' AND isactive=1");
		}
		return $this->tries;
	}
	
	public function isLogin() {
		return (bool) @$_SESSION["account"];
	}
	
	public function isCaptcha() {
		$hoje = date("Y-m-d");
		$ip = System::getIp();
		$this->tries = $this->site->Query("SELECT COUNT(idtry) AS retorno FROM login_tries WHERE (txtip='$ip' OR txtcookie='".$_COOKIE["ttots"]."') AND dtcadastro LIKE '$hoje %' AND isactive=1");
		
		
		$this->tries = (int) $this->tries[0]["retorno"];
		
		if ($this->tries > 3) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	public function doLogin($login, $pass, $captcha = "") {
		$pass = sha1($pass);
		$login = adjust($login);
		$retorno = $this->server->Query("SELECT id FROM accounts WHERE name='$login' AND password='$pass'");
		$retorno = @$retorno[0]["id"];
		$captcha_ok = TRUE;
		if ($this->isCaptcha()) {
			if (strtolower($_SESSION["palavra"]) != strtolower($captcha)) {
				$captcha_ok = FALSE;
			}
		}
		
		if ($retorno != FALSE AND $captcha_ok == TRUE) {
			$hoje = date("Y-m-d");
			//resetando as tentativas de login
			$this->site->Query("UPDATE login_tries SET isactive=0 WHERE txtip='".System::getIp()."' OR txtcookie='".System::getCookie()."'");
			
			//	registrando visitação
			$visita = $this->site->Query("
				SELECT a.idvisita
				FROM visitas a
				INNER JOIN visitas_ip b ON a.idip = b.idip
				INNER JOIN visitas_cookie c ON a.idcookie = c.idcookie
				WHERE ((b.txtip='".System::getIp(TRUE)."' OR c.txtcookie = '".System::getCookie()."')
						AND a.txtbrowserstring='".System::getBrowseString()."'
						AND a.txtfullip='".System::getIp()."'
						AND a.dtcadastro LIKE '".date("Y-m-d")."%')
				GROUP BY a.idvisita");
			@$this->site->Query("INSERT INTO visitas_accounts (idvisita, idaccount) VALUES (".$visita[0]["idvisita"].", $retorno)");
			/*/verificando se essa pessoa já fez login hoje
			$this->site->Query("UPDATE visitas SET idaccount='$retorno' WHERE idaccount IS NULL AND (txtip='".System::getIp()."' OR txtcookie='".System::getCookie()."' AND txtcookie <> '') AND dtcadastro LIKE '".date("Y-m-d")."%'");
			$idaccounts = $this->site->Query("SELECT idaccount FROM visitas WHERE (txtip='".System::getIp()."' OR txtcookie='".System::getCookie()."' AND txtcookie <> '') AND dtcadastro LIKE '".date("Y-m-d")."%'");
			
			$account_already_exists = FALSE;
			$another_account_already_exists = FALSE;
			foreach($idaccounts as $idaccount) {
				if ($idaccount["idaccount"] == $retorno) {
					$account_already_exists = TRUE;
				} else {
					$another_account_already_exists = TRUE;
				}
			}
			
			if ($account_already_exists == FALSE AND $another_account_already_exists = FALSE) {
				$this->site->Query("UPDATE idaccount='$retorno' WHERE (txtip='".System::getIp()."' OR txtcookie='".System::getCookie()."' AND txtcookie <> '') AND dtcadastro LIKE '".date("Y-m-d")."%' AND idaccount IS NULL");
			} else if ($account_already_exists == FALSE AND $another_account_already_exists = TRUE) {
				$this->site->Query("INSERT INTO visitas (idaccount, txtip, txtcookie, txtbrowserstring, dtcadastro) VALUES ($retorno, '".System::getIp()."', '".System::getCookie()."', '".System::getBrowseString()."', NOW())");
			}*/
			
			$this->account = $login;
			$_SESSION["account"] = $login;
			$this->site->Query("UPDATE accounts SET dtlastday=NOW() WHERE idaccount='".$this->getAccountId()."'");
			$this->reload();
		} else {
			$this->addTry($login, $pass);
		}
	}
	
	public function logout() {
		unset($_SESSION["id"]);
		unset($_SESSION["account"]);
		unset($_SESSION["password"]);
		unset($_SESSION["premdays"]);
		unset($_SESSION["lastday"]);
		unset($_SESSION["email"]);
		unset($_SESSION["key"]);
		unset($_SESSION["group_id"]);
		
		unset($_SESSION["acessos"]);
		
		unset($_SESSION["isconfirmed"]);
		unset($_SESSION["txtconfirm"]);
		unset($_SESSION["txtusername"]);
		unset($_SESSION["txtcodename"]);
		unset($_SESSION["isgender"]);
		unset($_SESSION["txtlanguage"]);
		unset($_SESSION["txtcountry"]);
		unset($_SESSION["dtlastday"]);
		
		unset($_SESSION["nrvippoints"]);
		unset($_SESSION["txttelprefix"]);
		unset($_SESSION["txttelefone"]);
		unset($_SESSION["txtcep"]);
		unset($_SESSION["txtlogradouro"]);
		unset($_SESSION["txtnumero"]);
		unset($_SESSION["txtcomplemento"]);
		unset($_SESSION["txtbairro"]);
		unset($_SESSION["txtcidade"]);
		unset($_SESSION["txtestado"]);
	}
}
?>