<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 23/05/12 #

	/** envia e-mail */
	function sendMail($config) {
		System::using("phpmailer");
		$email = "ttots.contato@gmail.com";
		
		$mailer = new PHPMailer();
		$mailer->IsSMTP();
		$mailer->SMTPAuth = TRUE;
		
		$mailer->Mailer = "smtp";
		$mailer->SMTPSecure = 'ssl';
		$mailer->Host = "74.125.134.108";
		$mailer->Port = 465;
		
		$mailer->Username = $email;
		$mailer->Password = "";
		
		$mailer->From = $email;
		$mailer->FromName = "Time Travel OTS";
		
		if (gettype($config["to"]) == "array") {
			//
		} else if (gettype($config["to"]) == "string") {
			$config["to"] = str_replace(" ", "", $config["to"]);
			$config["to"] = explode(";", $config["to"]);
		}
		
		foreach ($config["to"] as $to) {
			$mailer->AddAddress($to);
		}
		$mailer->IsHTML(TRUE);
		$mailer->Subject = $config["assunto"];
		$mailer->Body = $config["mensagem"];
		
		if($mailer->Send()){
			return TRUE;
		} else {
			$sql = new MySql("ttotsite");
			$sql->Query("INSERT INTO `logs` (txttipo, txtlog, dtcadastro) VALUES ('Erro na classe mail', '".$mailer->ErrorInfo."', NOW())");
			return FALSE;
		}
	}

	/** ajusta o post para que ele possa ser utilizado */
	function post($post) {
		return adjust(@$_POST[$post]);
	}
	
	/** ajusta o get para que ele possa ser utilizado */
	function get($get) {
		if ($get == "?") {
			return adjust($_SERVER["QUERY_STRING"]);
		} else {
			return adjust(@$_GET[$get]);
		}
	}
	
	/** ajusta a informação como se fosse um post ou um get */
	function adjust($string) {
		$enc = mb_detect_encoding($string.'x', 'UTF-8, ISO-8859-1');
		$string = str_replace("'", "´", $string);
		if ($enc == "UTF-8") {
		   $string = utf8_decode($string);
		}
		return trim($string);
	}
	
	/** verifica se uma das informações de um array existe em outro */
	function array_in_array($array1, $array2) {
		if (gettype($array1) <> "array") { return FALSE; }
		if (gettype($array2) <> "array") { return FALSE; }
		
		foreach ($array1 as $arr) {
			if (in_array($arr, $array2)) {
				return TRUE;
			}
		}
		return FALSE;
	}
	
	/** pesquisa um elemento dentro de uma matriz */
	function in_matriz($search, $matriz) {
		if (gettype($matriz) == "array" OR gettype($matriz) == "resource") {
			foreach($matriz as $array) {
				if (gettype($array) == "array" OR gettype($array) == "resource") {
					return in_matriz($search, $array);
				} else {
					if ($search == $array) {
						return TRUE;
					}
				}
			}
		} else if ($search == $matriz) {
			return TRUE;
		} else {
			return FALSE;
		}
	}
	
	/** pega somente alguns campos escolhidos de um array, os campos podem vir numa string separados por vírgua ou em um array */
	function select_array($arr, $fields) {
		if (gettype($fields) == "string") {
			$fields = str_replace("\n", "", $fields);
			$fields = str_replace(" ", "", $fields);
			$fields = explode(",", $fields);
		} else if (gettype($fields) != "array") {
			return FALSE;
		}
		
		foreach($arr as $key => &$piece) {
			if (!in_array($key, $fields)) {
				unset($arr[$key]);
			}
		}
		return $arr;
	}
	
	/** um array de arrays, considerando que todos esses arrays sejam iguais, essa função pega somente os campos desejados destes */
	function select_arrays($arr, $fields) {
		foreach ($arr as &$piece) {
			$piece = select_array($piece, $fields);
		}
		return $arr;
	}
	
	/** organizando o array de menor para maior apartir de um de suas chaves */
	function sksort(&$array, $subkey = "id", $sort_ascending = TRUE) {
		if (count($array))
			$temp_array[key($array)] = array_shift($array);

		foreach($array as $key => $val){
			$offset = 0;
			$found = FALSE;
			foreach($temp_array as $tmp_key => $tmp_val) {
				if(!$found and strtolower($val[$subkey]) > strtolower($tmp_val[$subkey])) {
					$temp_array = array_merge((array) array_slice($temp_array,0,$offset),
						array($key => $val),
						array_slice($temp_array,$offset)
					);
					$found = true;
				}
				$offset++;
			}
			if(!$found) $temp_array = array_merge($temp_array, array($key => $val));
		}

		if ($sort_ascending) $array = array_reverse($temp_array);
		else $array = $temp_array;
	}
	
	/** pega o nome do arquivo sem a extenção */
	function get_file_noext($filename) {
		$retorno = get_file_ext($filename, TRUE);
		return $retorno["name"];
	}
	
	/** pega a extenção do arquivo */
	function get_file_ext($filename, $returnname = FALSE) {
		$filename = explode(".", $filename);
		if ($returnname == TRUE) {
			$ext = $filename[count($filename)-1];
			unset($filename[count($filename)-1]);
			$filename = implode(".", $filename);
			return array(0=>$ext, 1=>$filename, "ext"=>$ext, "filename"=>$filename, "name"=>$filename);
		}
		return $filename[count($filename)-1];
	}
	
	/** avisa que a operação foi bem sucedida e ainda envia mais informações */
	function success($return = TRUE, $arr = "") {
		if (gettype($arr) == "array") {
			echo(json_encode(array("success"=>(bool) $return, $arr)));
		} else {
			echo(json_encode(array("success"=>(bool) $return)));
		}
	}
	
	/* converte array para json */
	function callback($array) {
		if (gettype($array) == "array") {
			echo(json_encode(fullencode($array)));
		}
	}
	
	/* função usada para encodar todas as strings de um array antes de converte-lo para json */
	function fullencode($array) {
		foreach ($array as &$ar) {
			if (gettype($ar) == "string") {
				$ar = utf8_encode($ar);
			} else if (gettype($ar) == "array") {
				$ar = fullencode($ar);
			}
		}
		return $array;
	}
	
	function urlDecompile($url) {
		return base64_decode($url);
	}
	
	function urlCompile($url = "") {
		if ($url == "") {
			return base64_encode($_SERVER["REQUEST_URI"]);
		} else {
			return base64_encode($url);
		}
	}
	
	function redirect($to, $iscompiled = FALSE) {
		@header("location: $to");
		echo("
			<script type='text/javascript'>
				window.location.href = '$to';
			</script>
		");
		exit();
	}
	
	/* funções relacionadas com o servidor */
	function getSpells($config = array()) {
		//	lendo xml e convertendo para array
		$spells = simplexml_load_file($GLOBALS["SERVER_PATH"]."/data/spells/spells.xml");
		$spells = json_encode($spells);
		$spells = json_decode($spells, TRUE);
		
		//	ajustando array
		$array = array(); //	conjure
		foreach ($spells["conjure"] as $conjure) {
			$vocs = $conjure["vocation"];
			$array[] = $conjure["@attributes"];
			foreach ($vocs as &$voc) {
				$voc = $voc["@attributes"]["id"];
			}
			$array[count($array) - 1]["vocation"] = $vocs;
		}
		
		//	instant
		foreach ($spells["instant"] as $instant) {
			if (@$instant["@attributes"]["display"] <> "none") {
				$vocs = $instant["vocation"];
				$array[] = $instant["@attributes"];
				foreach ($vocs as &$voc) {
					$voc = $voc["@attributes"]["id"];
				}
				$array[count($array) - 1]["vocation"] = $vocs;
			}
		}
		
		//	pegando somente partes importantes do array
		$array = select_arrays($array, "name, words, lvl, maglv, prem, vocation");
		
		$selected = array();
		if (count($config) == 0) {
			sksort($array, "lvl");
			return $array;
		} else {
			foreach ($array as $arr) {
				if (@$config["vip"] == TRUE) { //AND @$arr["prem"] == 1) {
					if (array_in_array(@$config["vocations"], @$arr["vocation"])) {
						$selected[] = $arr;
					}
				} else { //if (@$arr["prem"] == 0) {
					if (array_in_array(@$config["vocations"], @$arr["vocation"])) {
						$selected[] = $arr;
					}
				}
			}
			sksort($selected, "lvl");
			return $selected;
		}
	}
	
	/* FUNÇÕES RELACIONADAS COM O OTLIST */
	/** Checa as informações de outros servidores mwhahaha */
	function getServer($server = "127.0.0.1", $port = "7171", $timeout = 60) {
		//	estamos online?
		$status = json_decode(file_get_contents("http://www.timetravel.net.br/serverinfo.js"), TRUE);
		if (@$status["status"] <> "online") {
			return array(
				"serverinfo" => array(
					"uptime" => 0
				),
				"owner" => array(),
				"players" => array(
					"online" => 0
				),
				"total" => array(),
				"npcs" => array(),
				"map" => array(),
				"connection" => FALSE,
				"code" => 304,
				"msg" => "We are offline",
				"motd" => NULL
			);
		}
		//	variaveis
		$server = strtolower($server);
		$data = "";
		try {
			$info = chr(6).chr(0).chr(255).chr(255).'info';
			$sock = @fsockopen($server, $port, $errno, $errstr, 1);
		} catch (Exception $e) {
			return array(
				"serverinfo" => array(
					"uptime" => 0
				),
				"owner" => array(),
				"players" => array(
					"online" => 0
				),
				"total" => array(),
				"npcs" => array(),
				"map" => array(),
				"connection" => FALSE,
				"code" => 404,
				"msg" => "Server offline",
				"motd" => NULL
			);
		}
		$array = array();
		
		if ($sock) {
			stream_set_timeout($sock, $timeout = 30);
			fwrite($sock, $info); 
			while (!feof($sock)) {
				$data .= fgets($sock, 4096);
			}
			$situation = stream_get_meta_data($sock);
			@socket_close($sock);
			@fclose($sock);
			
			
			if ($situation["timed_out"]) {
				//	conexão timeout
				return array(
					"serverinfo" => array(
						"uptime" => 0
					),
					"owner" => array(),
					"players" => array(
						"online" => 0
					),
					"total" => array(),
					"npcs" => array(),
					"map" => array(),
					"connection" => FALSE,
					"code" => 408,
					"msg" => "Conection timeout",
					"motd" => NULL
				);
			} else {
				//	conexão estabelecida
				$xml = simplexml_load_string($data);
				$xml = json_encode($xml);
				$xml = json_decode($xml, TRUE);
				
				$array = array();
				if (gettype($xml) == "array") {
					foreach ($xml as $key => $node) {
						if ($key <> "@attributes" AND $key <> "motd") {
							$array[$key] = $node["@attributes"];
						} else if ($key == "motd") {
							$array["motd"] = $xml["motd"];
						}
					}
					$array["code"] = 200;
					$array["msg"] = "Connection established";
					$array["connection"] = TRUE;
					return $array;
				} else {
					return array(
						"connection" => FALSE,
						"code" => 403,
						"msg" => "Connection limit exceeded"
					);
				}
			}
		} else {
			return array(
				"serverinfo" => array(
					"uptime" => 0
				),
				"owner" => array(),
				"players" => array(
					"online" => 0
				),
				"total" => array(),
				"npcs" => array(),
				"map" => array(),
				"connection" => FALSE,
				"code" => 404,
				"msg" => "Server offline",
				"motd" => NULL
			);
		}
	}
	
	function getVocation($nr) {
		switch($nr) {
			case 1:
				return "Mage";
				break;
			case 2:
				return "Tribal";
				break;
			case 3:
				return "Elfian";
				break;
			case 4:
				return "Wild";
				break;
			case 5:
				return "Ninja";
				break;
			case 6:
				return "Amazon";
				break;
			case 7:
				return "Dwarfian";
				break;
			case 8:
				return "Monk";
				break;
			case 9:
				return "Survivor";
				break;
			case 11:
				return "Master Mage";
				break;
			case 12:
				return "Shaman";
				break;
			case 13:
				return "Elder Elfian";
				break;
			case 14:
				return "Viking";
				break;
			case 15:
				return "Sword Master";
				break;
			case 16:
				return "Valkyrie";
				break;
			case 17:
				return "Dwarfian Soldier";
				break;
			case 18:
				return "Cleric";
				break;
			case 19:
				return "Gunner";
				break;
			case 21:
				return "Ancient Mage";
				break;
			case 22:
				return "Forester";
				break;
			case 23:
				return "Legendary Elfian";
				break;
			case 24:
				return "Gross Viking";
				break;
			case 25:
				return "Shadow";
				break;
			case 26:
				return "Witch";
				break;
			case 27:
				return "Dwarfian Warrior";
				break;
			case 28:
				return "Illuminated";
				break;
			case 29:
				return "Mercenary";
				break;
			case 101:
				return "Slave";
				break;
				
			case 102:
				return "Lord";
				break;
		}
	}
?>