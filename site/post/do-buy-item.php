<?php
# AUTHOR: RICARDO AZZI #
#  CREATED: 01/02/13   #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

function isPremItem($id) {
	if ($id == 1 OR $id == 18) {
		return TRUE;
	} else {
		return FALSE;
	}
}

$acc = new Account($_SESSION["account"]);
$site = new MySql("ttotsite");
$server = new MySql("ttotserver");
if ($acc->isLogin() AND isSet($_POST["item"]) AND isSet($_POST["player"])) {
	//	recebendo o post
	$item = post("item");
	$select = post("select");
	$player = post("player");
	
	//	verificando se o personagem existe e se ele pertence a esta conta
	$play = $server->Query("SELECT id, online FROM players WHERE name='$player' AND account_id='".$acc->getAccountId()."'");
	$isonline = $play[0]["online"];
	$play = $play[0]["id"];
	
	if ($play == FALSE OR $player == "") {
		callback(array(
			"success" => FALSE,
			"msg" => "Impossível continuar: você só pode comprar itens para personagens cadastrados na sua conta.",
			"valor" => 0
		)); exit();
	}
	
	if ($isonline == TRUE AND !isPremItem($item)) {
		callback(array(
			"success" => FALSE,
			"msg" => "Impossível continuar: você não pode comprar itens com o seu jogador online! Saia do jogo para comprar itens.",
			"valor" => 0
		)); exit();
	}
	
	//	descobrindo a mochila/bag escolhida
	if ($select <> FALSE) {
		$select = explode("-", $select);
		$tipo = $select[0];
		$select = $select[1];
	} else {
		$tipo = FALSE;
		$select = FALSE;
	}
	
	$mochila = 0;
	$bag = 0;
	$buying = $site->Query("SELECT idmarketitem, vlpreco, vlnovopreco, dtpromotion, nriditem, nramountperspace, isonlyone, isbag, isbackpack FROM market_items WHERE idmarketitem=$item AND isactive=1");
	if ($tipo == "bag") {
		//	se a pessoa estiver tentando fazer uma compra com bag em um item onde isso não é possível
		if ($buying[0]["isbag"] == FALSE) {
			callback(array(
				"success" => FALSE,
				"msg" => "Impossível continuar: esse item não é vendido em sacolas.",
				"valor" => 0
			)); exit();
		}
		
		switch($select) {
			//	bag
			case 0:
				$bag = 1987;
				break;
				
			//	blue bag
			case 1:
				$bag = 1995;
				break;
			
			//	golden bag
			case 2:
				$bag = 1997;
				break;
				
			//	gray bag
			case 3:
				$bag = 1996;
				break;
				
			//	green bag
			case 4:
				$bag = 1991;
				break;
				
			//	orange bag
			case 5:
				$bag = 10520;
				break;
				
			//	purple bag
			case 6:
				$bag = 1994;
				break;
				
			//	red bag
			case 7:
				$bag = 1993;
				break;
			
			//	yellow bag
			case 8:
				$bag = 1992;
				break;
				
			//	pirate bag
			case 9:
				$bag = 5927;
				break;
				
			//	camouflage bag
			case 10:
				$bag = 3939;
				break;
				
			//	beach bag
			case 11:
				$bag = 5950;
				break;
				
			//	fur bag
			case 12:
				$bag = 7343;
				break;
				
			//	expedition bag
			case 13:
				$bag = 11242;
				break;
				
			//	brocade bag
			case 14:
				$bag = 9775;
				break;
		}
	} else if ($tipo == "bps") {
		//	se a pessoa estiver tentando fazer uma compra com bag em um item onde isso não é possível
		if ($buying[0]["isbackpack"] == FALSE) {
			callback(array(
				"success" => FALSE,
				"msg" => "Impossível continuar: esse item não é vendido em mochilas.",
				"valor" => 0
			)); exit();
		}
		
		switch($select) {
			//	backpack
			case 0:
				$mochila = 1988;
				break;
				
			//	blue backpack
			case 1:
				$mochila = 2002;
				break;
				
			//	golden backpack
			case 2:
				$mochila = 2004;
				break;
				
			//	gray backpack
			case 3:
				$mochila = 2003;
				break;
				
			// green backpack
			case 4:
				$mochila = 1998;
				break;
				
			//	orange backpack
			case 5:
				$mochila = 10519;
				break;
				
			//	purple backpack
			case 6:
				$mochila = 2001;
				break;
				
			//	red backpack
			case 7:
				$mochila = 2000;
				break;
				
			//	yellow backpack
			case 8:
				$mochila = 1999;
				break;
				
			//	pirate backpack
			case 9:
				$mochila = 5926;
				break;
				
			//	santa backpack
			case 10:
				$mochila = 11263;
				break;
				
			//	anniversary backpack
			case 11:
				$mochila = 16007;
				break;
				
			//	backpack of holding
			case 12:
				$mochila = 2365;
				break;
				
			//	camouflage backpack
			case 13:
				$mochila = 3940;
				break;
			
			//	beach backpack
			case 14:
				$mochila = 5949;
				break;
			
			//	expedition backpack
			case 15:
				$mochila = 11241;
				break;
			
			//	buggy backpack
			case 16:
				$mochila = 15646;
				break;
				
			//	brocade backpack
			case 17:
				$mochila = 9774;
				break;
			
			//	minotaur backpack
			case 18:
				$mochila = 11244;
				break;
			
			//	black ox face backpack
			case 19:
				$mochila = 10518;
				break;
			
			//	chinese backpack
			case 20:
				$mochila = 11243;
				break;
			
			//	crown backpack
			case 21:
				$mochila = 10522;
				break;
				
			//	crystal backpack
			case 22:
				$mochila = 18394;
				
			//	deepling backpack
				break;
			case 23:
				$mochila = 15645;
				break;
				
			//	fur backpack
			case 24:
				$mochila = 7342;
				break;
				
			//	amazon backpack
			case 25:
				$mochila = 11119;
				break;
				
			//	jewelled backpack
			case 26:
				$mochila = 5801;
				break;
				
			//	moon backpack
			case 27:
				$mochila = 10521;
				break;
				
			//	mushroom backpack
			case 28:
				$mochila = 18393;
				break;
		}
	} else {
		//	tentando comprar uma unica unidade sem que isso seja permitido
		if ($buying[0]["isonlyone"] == FALSE AND $buying[0]["idmarketitem"] <> 1 AND $buying[0]["idmarketitem"] <> 18) {
			callback(array(
				"success" => FALSE,
				"msg" => "Impossível continuar: esse item não pode ser comprado em uma única unidade.",
				"valor" => 0
			)); exit();
		}
	}
	
	if ($buying[0]["vlnovopreco"] <> 0 AND $buying[0]["dtpromotion"] <> 0 AND time() <= $buying[0]["dtpromotion"]) {
		$preco = $buying[0]["vlnovopreco"];
	} else {
		$preco = $buying[0]["vlpreco"];
	}
	
	//	verificando se foi comprado em conjunto
	$isbp = 0;
	$isbag = 0;
	$isone = 0;
	if ($mochila <> 0) {
		$isbp = 1;
		$preco *= 20;
	} else if ($bag <> 0) {
		$isbag = 1;
		$preco *= 8;
	} else {
		$isone = 1;
	}
	
	$vippoints = $site->Query("SELECT nrvippoints FROM accounts_vipinformacao WHERE idaccount=".$acc->getAccountId());
	$vippoints = $vippoints[0]["nrvippoints"];
	if ($vippoints >= $preco) {
		//	registrando log de compra
		$site->Query("INSERT INTO accounts_item_comprados (idaccount, idplayer, idmarketitem, isonlyone, isbag, isbackpack, nrpontosgastos, dtcadastro)
							VALUES (".$acc->getAccountId().", $play, $item, $isone, $isbag, $isbp, $preco, NOW())");
		
		//	removendo o dinheiro
		$site->Query("UPDATE accounts_vipinformacao SET nrvippoints = '".($vippoints - $preco)."' WHERE idaccount = '".$acc->getAccountId()."'");
		
		//	verificando o que está sendo comprado
		if ($buying[0]["nriditem"] <> FALSE) {
			//	exercendo a compra
			$depot = $server->Query("SELECT a.sid
				FROM player_depotitems a
				INNER JOIN players b ON b.id = $play
				INNER JOIN player_depotitems c ON a.pid = c.sid AND a.player_id = c.player_id AND c.pid = b.town_id
				WHERE a.player_id = $play AND a.itemtype = 14404");
			$depot = $depot[0]["sid"];
			
			//	ultimo item inserido para este player
			$lastitem = $server->Query("SELECT MAX(sid) AS sid FROM player_depotitems WHERE player_id=$play");
			$lastitem = $lastitem[0]["sid"];
			
			$parcel = $lastitem + 1;
			$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
						VALUES ($play, $parcel, $depot, 2596, 1, '')");
			
			$itemuid = $lastitem + 2;
			if ($bag <> 0) {
				$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
					VALUES ($play, $itemuid, $parcel, $bag, 1, '')");
					for ($i = 0; $i < 8; $i++) {
						$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 1 + $i).", $itemuid, ".$buying[0]["nriditem"].", ".$buying[0]["nramountperspace"].", '')");
					}
			} else if ($mochila <> 0) {
				$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
					VALUES ($play, $itemuid, $parcel, $mochila, 1, '')");
					for ($i = 0; $i < 20; $i++) {
						$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 1 + $i).", $itemuid, ".$buying[0]["nriditem"].", ".$buying[0]["nramountperspace"].", '')");
					}
			} else {
				$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
					VALUES ($play, $itemuid, $parcel, ".$buying[0]["nriditem"].", ".$buying[0]["nramountperspace"].", '')");
			}
			
			callback(array(
				"success" => TRUE,
				"msg" => "Seu item foi comprado com sucesso, será entregue para seu player em instantes na sua cidade natal.",
				"valor" => ($vippoints - $preco)
			));
		} else if (isPremItem($buying[0]["idmarketitem"])) {
			//	comprando premmy account
			$prem = $server->Query("SELECT premdays FROM accounts WHERE id=".$acc->getAccountId());
			$prem = $prem[0]["premdays"];
			switch($buying[0]["idmarketitem"]) {
				case 1:
					$prem += 15;
					break;
				case 18:
					$prem += 30;
					break;
			}
			$server->Query("UPDATE accounts SET premdays='$prem' WHERE id='".$acc->getAccountId()."'");
			callback(array(
				"success" => TRUE,
				"msg" => "Seus dias de premmy account foram comprados com sucesso.",
				"valor" => ($vippoints - $preco)
			));
		} else if ($buying[0]["idmarketitem"] == 17) {
			if ($bag <> 0) {
				//	exercendo a compra
				$depot = $server->Query("SELECT sid FROM player_depotitems WHERE player_id=$play AND itemtype=14404");
				$depot = $depot[0]["sid"];
				
				//	ultimo item inserido para este player
				$lastitem = $server->Query("SELECT MAX(sid) AS sid FROM player_depotitems WHERE player_id=$play");
				$lastitem = $lastitem[0]["sid"];
				$itemuid = $lastitem + 2;
				
				//	inserindo parcel
				$parcel = $lastitem + 1;
					//	bag
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, $parcel, $depot, 2596, 1, '')");
							
					//	parcel
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, $itemuid, $parcel, $bag, 1, '')");
					
					// dust remover
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 1).", $itemuid, 9930, 100, '')");
					
					//	dice
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 2).", $itemuid, 5792, 1, '')");
					
					//	wooden whistle
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 3).", $itemuid, 5786, 1, '')");
							
					//	mechanical fishing rod
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 4).", $itemuid, 10223, 1, '')");
							
					//	sneaky stabber of eliteness
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 5).", $itemuid, 10511, 1, '')");
						
					//	squeezing gear of girlpower
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 6).", $itemuid, 10513, 1, '')");
						
					//	whacking driller of fate
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 7).", $itemuid, 10515, 1, '')");
							
					//	adicionando comida
					$food = "8839 2668 5097 2669 8838 2790 8845 2673 11246 2690 2787 8841 2689 12639 2684 2791 12416 8844 2691 12641 8843 2667 8842 2672 2796";
					$food = explode(" ", $food);
					$server->Query("INSERT INTO player_depotitems (player_id, sid, pid, itemtype, count, attributes)
							VALUES ($play, ".($itemuid + 8).", $itemuid, ".$food[rand(0, count($food))].", 100, '')");
							
					callback(array(
						"success" => TRUE,
						"msg" => "Seu item foi comprado com sucesso, será entregue para seu player em instantes na sua cidade natal.",
						"valor" => ($vippoints - $preco)
					));
					
			} else {
				callback(array(
					"success" => FALSE,
					"msg" => "Impossível continuar: escolha uma bag.",
					"valor" => 0
				));
			}
			
		} else {
			callback(array(
				"success" => FALSE,
				"msg" => "Impossível continuar: erro interno, por favor avise os administradores.",
				"valor" => 0
			));
		}
	
	} else {
		callback(array(
			"success" => FALSE,
			"msg" => "Impossível continuar: Você não tem pontos vip o suficiente para comprar este item!",
			"valor" => 0
		));
	}
	
} else {
	callback(array(
		"success" => FALSE,
		"msg" => "Impossível continuar: Você não está logado. Faça o login para comprar coisas.",
		"valor" => 0
	));
}
?>