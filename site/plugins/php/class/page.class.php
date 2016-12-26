<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 09/11/12 #

class Page {
	public $account;
	private $tries = NULL;
	private $iscaptcha = NULL; 
	
	public function __construct($array = array()) {
		if (@$_SESSION["account"] == TRUE) {
			$this->account = new Account($_SESSION["account"]);
		} else if (@$array["logado"] == TRUE AND @$_SESSION["account"] == FALSE) {
			redirect("/account-login-signup.php?".urlCompile());
		} else {
			$this->account = new Account();
		}
		unset($array["logado"]);
		
		if (isSet($array["access"])) {
			$cansee = TRUE;
			foreach ($array["access"] as $acc) {
				if (!$this->account->haveAccess($acc)) {
					$cansee = FALSE;
				}
			}
			
			if ($cansee == FALSE) {
				redirect("/index.php");
			}
		}
		unset($array["access"]);
		
		require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/php/incs/header.php");
		require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/php/incs/leftbar.php");
		
		if (count($array) != 0) {
			$this->setMirror($array);
		}
	}
	
	public function __destruct() {
		require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/php/incs/rightbar.php");
		echo('<script type="text/javascript" src="plugins/js/last-run.js"></script>');
	}
	
	public static function jsClass($class) {
		echo("<script type='text/javascript' src='plugins/js/class/$class.class.js'></script>");
		if (file_exists("plugins/js/class/$class.class.css")) {
			echo("<link rel='stylesheet' type='text/css' href='plugins/js/class/$class.class.css' />");
		}
	}
	
	/** função que mostra qual o arquivo espelho */
	public static function setMirror($types) {
		if (@$types["js"] == TRUE) {
			echo("<script type='text/javascript' src='".Page::getMirror("js")."'></script>");
		}
		
		if (@$types["css"] == TRUE) {
			echo("<link rel='stylesheet' type='text/css' href='".Page::getMirror("css")."' />");
		}
		
		if (@$types["php"] == TRUE) {
			require_once(Page::getMirror("php"));
		}
	}
	
	public static function getMirror($type) {
		$file = get_file_noext($_SERVER["PHP_SELF"]);
		return "/mirror/$type$file.$type";
	}
	
	public static function unpathed($evoke) {
		$ext = get_file_ext($evoke);
		switch ($ext) {
			case "js":
				echo("<script type='text/javascript' src='/mirror/$ext/unpathed/$evoke'></script>");
				break;
			case "css":
				echo("<link rel='stylesheet/less' type='text/css' href='/mirror/$ext/unpathed/$evoke' />");
				break;
			case "php":
				require_once($_SERVER["DOCUMENT_ROOT"]."/mirror/$ext/unpathed/$evoke");
				break;
		}
	}
}
?>