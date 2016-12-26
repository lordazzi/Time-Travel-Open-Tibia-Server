<?php
# @AUTOR = ricardo #

//	This class is developed and endorsed by Ricardo Azzi Inc.
class Ajax {
	//	Métodos privados
	public function serverProtocol() {
		if($_SERVER['HTTPS'] == 'on') {
			return 'https';
		} else {
			return 'http';
		}
	}
	
	public function currentUrl() {
		if ($_SERVER["QUERY_STRING"] <> "") {
			return Ajax::serverProtocol()."://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]?$_SERVER[QUERY_STRING]";
		} else {
			return Ajax::serverProtocol()."://$_SERVER[SERVER_NAME]$_SERVER[REQUEST_URI]";
		}
	}
	
	//	Métodos publicos
	public function request($config = array()) {
		//	LENDO AS CONFIGURAÇÕES
		//	para qual url?
		$url = $config["url"];
		if ($url == FALSE) { $url = $config["to"]; }
		if ($url == FALSE) { $url = $config["send"]; }
		if ($url == FALSE) { $url = $config["link"]; }
		if ($url == FALSE || $url == "") { return FALSE; }
		
		//	enviar para mim mesmo?
		if ($url == "this") { $url = Ajax::currentUrl(); }
		if ($url == "me") { $url = Ajax::currentUrl(); }
		if ($url == "self") { $url = Ajax::currentUrl(); }
		
		//	variaveis enviadas via POST
		if ($config["post"] AND gettype($config["post"]) == "array") {
			$params["post"] = $config["post"];
			$method = "post";
		}
		
		//	variaveis enviadas via GET
		if ($config["get"] AND gettype($config["get"]) == "array") {
			$params["get"] = $config["get"];
			$method = "get";
		}
		
		//	se não há $config[get] nem $config[post] continuar buscando a forma como os dados estão sendo passados
		if ($method == "") {
			//	verificando o metodo, se não for dado nenhum, por padrão é POST
			$method = $config["method"];
			if ($method == FALSE) { $method = $config["type"]; }
			if ($method == FALSE) { $method = $config["style"]; }
			if ($method == FALSE) { $method = $config["http"]; }
			if ($method == FALSE) { $method = $config["httpmethod"]; }
			if ($method == FALSE) { $method = "get"; }
			
			//	pegando os parâmetros, precisa pelo menos ter um parâmetro, se não o post ou get não é feito
			$params[$method] = $config["params"];
			if ($params[$method] == FALSE) { $params[$method] = $config["data"]; }
			if ($params[$method] == FALSE) { $params[$method] = $config["info"]; }
			if ($params[$method] == FALSE) { $params[$method] = $config["param"]; }
			if (gettype($params[$method]) <> "array" AND ($method <> "" OR $method == "serialize")) { return FALSE; }
			$method = strtolower(trim($method));
		}
		
		$format = $config["format"];
		if ($format == FALSE) { $format = $config["2array"]; }
		if ($format == FALSE) { $format = $config["toarray"]; }
		
		// OK, CONCLUIU A LIDA DAS CONFIGURAÇÕES, AGORA INICIA A HTTP REQUEST
		
		$retorno = "";
		//	quando é enviado via GET e POST ao mesmo tempo
		if ($config["get"] AND gettype($config["get"]) == "array" AND $config["post"] AND gettype($config["post"]) == "array") {
			$url = Ajax::addGetToUrl($url, $params["get"]);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params["post"]);
			$retorno = curl_exec($ch);
			curl_close($ch);
			
		//	enviando via POST
		} else if ($method == "post") {
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_setopt($ch, CURLOPT_POST, 1);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $params["post"]);
			$retorno = curl_exec($ch);
			curl_close($ch);
		
		//	enviando via GET
		} else if ($method == "get") {
			$get = Ajax::addGetToUrl($url, $params["get"]);
			$retorno = file_get_contents($get);
			
		// sem metodo de envido definido
		} else if ($method == "serialize") {
			if (isSet($_GET)) {
				$url = Ajax::addGetToUrl($url, $_GET);
			}

			if (isSet($_POST)) {
				$ch = curl_init();
				curl_setopt($ch, CURLOPT_URL, $url);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $_POST);
				$retorno = curl_exec($ch);
				curl_close($ch);
			} else {
				$retorno = file_get_contents($url);
			}
			
		} else {
			$retorno = file_get_contents($url);
		}
		
		if ($format == FALSE) {
			return $retorno;
		} else if ($format == "json") {
			return json_decode($retorno, TRUE);
		} else if ($format == "xml") {
			$retorno = simplexml_load_string($retorno);
			$retorno = json_encode($retorno);
			return json_decode($retorno, TRUE);
		}
	}
	
	public function addGetToUrl($url, $get = array()) {
		//	pegando os parâmetros do get e convertendo-os para um array
		//	separando a cerquilha (se houver) da url
		$cerquilha = explode("#", $url);
		
		//	separando a url dos parametros, caso existam
		$items = explode("?", $cerquilha[0]);
		
		//	definindo a variavel cerquilha exclusivamente para ela
		$cerquilha = $cerquilha[1];
		
		//	redefinindo a variavel url, para a url sem a sua query string
		$url = $items[0];
		
		//	convertendo os parâmetros da url para um array
		$items = explode("&", $items[1]);
		if ($items[0] === "" AND count($items) == 1) { $items = array(); }
		
		$params = array();
		foreach ($items as &$item) {
			if (strpos($item, "=") !== FALSE) {
				$item = explode("=", $item);
				$params[(string) $item[0]] = $item[1];
			} else {
				$params[] = $item;
			}
		}
		
		//	adicionando os novos parâmetros ao array de gets
		$params = array_merge($params, $get);
		
		//	criando string do get
		$begin = "";
		$end = "";
		foreach ($params as $key => $param) {
			if (gettype($key) == "string") {
				$end .= "$key=$param&";
			} else if (gettype($key) == "integer") {
				$begin .= "$param&";
			}
		}
		$querystring = $begin.substr($end, 0, strlen($end) - 1);
		
		//	retornando url com os valores já adicionados
		if (strlen($cerquilha) <> 0) {
			return "$url?".urlencode("$querystring")."#$cerquilha";
		} else {
			return "$url?".urlencode("$querystring");
		}
	}
}
?>