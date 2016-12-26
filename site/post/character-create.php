<?php
# AUTHOR: RICARDO AZZI #
# CREATED: 16/11/12 #
$GLOBAL["nocount"] = TRUE;
require_once($_SERVER["DOCUMENT_ROOT"]."/plugins/config.php");

$acc = new Account($_SESSION["account"]);
if ($acc->isLogin()) {
	$sql = new MySql("ttotserver");
	$name = trim(post("name"));
	$gender = post("gender");
	$vocation = post("vocation");
	$city = post("city");
	$success = TRUE;

	$existe = $sql->Query("SELECT COUNT(id) AS existe FROM `players` WHERE `name` = '$name'");
	$existe = (bool) $existe[0]["existe"];
	if ($existe == TRUE) {
		$success = FALSE;
	} else if ($name == "") {
		$success = FALSE;
	} else if (!preg_match("/^[a-zA-Z ]+$/", $name)) {
		$success = FALSE;
	} else if (strlen($name) <= 5) {
		$success = FALSE;
	}

	if (!($gender == 0 OR $gender == 1)) {
		$success = FALSE;
	}

	if (!($vocation == 1 OR $vocation == 2 OR $vocation == 3 OR $vocation == 4 OR $vocation == 5 OR $vocation == 6 OR $vocation == 7 OR $vocation == 8)) {
		$success = FALSE;
	}

	if (!($city == 1 OR $city == 2)) {
		$success = FALSE;
	}

	if ($vocation == 6 AND $gender != 0) {
		$success = FALSE;
	}

	if ($vocation == 7 AND $gender != 1) {
		$success = FALSE;
	}

	if ($success == TRUE) {
		$sql = new MySql("ttotserver");
		$acc = new Account($_SESSION["account"]);
		
		if ($city == 1) {
			$posx = 2082;
			$posy = 1999;
			$posz = 8;
		} else if ($city == 2) {
			$posx = 2408;
			$posy = 2019;
			$posz = 12; 
		}
		
		if ($vocation == 1) { //sorcerer
			if ($gender == 0) {
				$lookbody = 105;
				$lookfeet = 18;
				$lookhead = 132;
				$looklegs = 88;
				$looktype = 138;
			} else if ($gender == 1) {
				$lookbody = 113;
				$lookfeet = 114;
				$lookhead = 38;
				$looklegs = 117;
				$looktype = 130;
			}
		} else if ($vocation == 2) { //tribal
			$lookbody = 101;
			$lookfeet = 77;
			$lookhead = 114;
			$looklegs = 115;
			if ($gender == 0) {
				$looktype = 158;
			} else if ($gender == 1) {
				$looktype = 154;
			}		
		} else if ($vocation == 3) { //elfian
			$lookbody = 120;
			$lookfeet = 115;
			$lookhead = 116;
			$looklegs = 116;
			$looktype = 159;
		} else if ($vocation == 4) { //wild
			$lookbody = 96;
			$lookfeet = 18;
			$lookhead = 115;
			$looklegs = 117;
			if ($gender == 0) {
				$looktype = 147;
			} else if ($gender == 1) {
				$looktype = 143;
			}
		} else if ($vocation == 5) { //ninja
			$lookbody = 114;
			$lookfeet = 114;
			$lookhead = 116;
			$looklegs = 114;
			if ($gender == 0) {
				$looktype = 156;
			} else if ($gender == 1) {
				$looktype = 152;
			}
		} else if ($vocation == 6) { //amazon
			$lookbody = 120;
			$lookfeet = 132;
			$lookhead = 113;
			$looklegs = 114;
			$looktype = 137;
		} else if ($vocation == 7) { //dwarf
			$lookbody = 116;
			$lookfeet = 115;
			$lookhead = 98;
			$looklegs = 108;
			$looktype = 160;
		} else if ($vocation == 8) {
			$lookbody = 114;
			$lookfeet = 114;
			$lookhead = 114;
			$looklegs = 114;
			if ($gender == 0) { //monk
				$looktype = 58;
			} else if ($gender == 1) {
				$looktype = 57;
			}
		}
		
		$sql->Query("
		INSERT INTO players
			(name, world_id, account_id, level, vocation, health, healthmax, 
			lookbody, lookfeet, lookhead, looklegs, looktype, mana, manamax,
			soul, town_id, posx, posy, posz, cap, sex, balance, stamina,
			loss_experience, loss_mana, loss_skills, loss_containers, loss_items)
		VALUES
			('$name', 0, ".$acc->getAccountId().", 1, $vocation, 200, 200,
			$lookbody, $lookfeet, $lookhead, $looklegs, $looktype, 100, 100,
			100, $city, $posx, $posy, $posz, 500, $gender, 250, 201660000,
			100, 100, 100, 100, 100)
		");
		$playerid = $sql->getLastId();
		
		$sql->Query("INSERT INTO players_skills (player_id, skillid, value) VALUES ($playerid, 0, 10)");
		$sql->Query("INSERT INTO players_skills (player_id, skillid, value) VALUES ($playerid, 1, 10)");
		$sql->Query("INSERT INTO players_skills (player_id, skillid, value) VALUES ($playerid, 2, 10)");
		$sql->Query("INSERT INTO players_skills (player_id, skillid, value) VALUES ($playerid, 3, 10)");
		$sql->Query("INSERT INTO players_skills (player_id, skillid, value) VALUES ($playerid, 4, 10)");
		$sql->Query("INSERT INTO players_skills (player_id, skillid, value) VALUES ($playerid, 5, 10)");
		$sql->Query("INSERT INTO players_skills (player_id, skillid, value) VALUES ($playerid, 6, 10)");
		
		$lang = 0;
		if ($acc->getLang() == "pt-br") {
			$lang = 1;
		} else if ($acc->getLang() == "en-us") {
			$lang = 2;
		}
		
		$sql->Query("INSERT INTO `player_storage` (`player_id`, `key`, `value`, `description`) VALUES ($playerid, 100, $lang, 'Linguagem: ".$acc->getLang()."'); ");
		
		if ($vocation == 1) {//SORCERER
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 8820, 1, ''),
					($playerid, 106, 102, 2554, 1, ''),
					($playerid, 107, 102, 2120, 1, ''),
					($playerid, 108, 102, 2191, 1, ''),
					($playerid, 109, 102, 2148, ".rand(4,10).", 0x0f05),
					($playerid, 110, 102, 2300, 20, '');
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 2662, 1, ''),
					($playerid, 3, 102, 2001, 1, ''),
					($playerid, 4, 103, 8819, 1, ''),
					($playerid, 5, 104, 2512, 1, ''),
					($playerid, 6, 105, 13829, 1, ''),
					($playerid, 7, 106, 2649, 1, ''),
					($playerid, 8, 107, 2642, 1, ''),
					($playerid, 102, 108, 2190, 1, ''),
					($playerid, 102, 109, 2679, ".rand(45,60).", 0x0f32),
					($playerid, 102, 110, 2260, ".rand(4,6).", 0x0f05),
					($playerid, 102, 111, 2050, 1, ''),
					($playerid, 102, 112, 2282, 15, '');
			");
		} else if ($vocation == 2) {//TRIBAL
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 2526, 1, ''),
					($playerid, 106, 102, 2554, 1, ''),
					($playerid, 107, 102, 2120, 1, ''),
					($playerid, 108, 102, 2186, 1, ''),
					($playerid, 109, 102, 2667, ".rand(4,6).", 0x0f05),
					($playerid, 110, 102, 2148, ".rand(4,6).", 0x0f05),
					($playerid, 111, 102, 2300, 20, '');
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 3967, 1, ''),
					($playerid, 3, 102, 1998, 1, ''),
					($playerid, 5, 103, 2512, 1, ''),
					($playerid, 6, 104, 13829, 1, ''),
					($playerid, 7, 105, 3983, 1, ''),
					($playerid, 102, 106, 2679, ".rand(4,6).", 0x0f05),
					($playerid, 102, 107, 2674, ".rand(4,6).", 0x0f05),
					($playerid, 102, 108, 2675, ".rand(4,6).", 0x0f05),
					($playerid, 102, 109, 2676, ".rand(4,6).", 0x0f05),
					($playerid, 102, 110, 2050, 1, ''),
					($playerid, 102, 111, 2260, ".rand(4,6).", 0x0f05),
					($playerid, 102, 112, 2182, 1, ''),
					($playerid, 102, 113, 2282, 15, ''),
					($playerid, 102, 114, 2300, 20, '');
			");
		} else if ($vocation == 3) {//ELFIAN
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 2554, 1, ''),
					($playerid, 106, 102, 2120, 1, ''),
					($playerid, 107, 102, 1294, ".rand(20,30).", 0x0f19),
					($playerid, 108, 102, 2389, ".rand(4,6).", 0x0f05),
					($playerid, 109, 102, 2544, ".rand(60,89).", 0x0f32),
					($playerid, 110, 102, 2544, ".rand(60,89).", 0x0f32),
					($playerid, 111, 102, 2148, ".rand(4,6).", 0x0f05),
					($playerid, 112, 102, 2300, 20, '');
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 2461, 1, ''),
					($playerid, 3, 102, 1999, 1, ''),
					($playerid, 4, 103, 2485, 1, ''),
					($playerid, 6, 104, 2456, 1, ''),
					($playerid, 7, 105, 2468, 1, ''),
					($playerid, 8, 106, 2642, 1, ''),
					($playerid, 102, 107, 2544, ".rand(60,89).", 0x0f05),
					($playerid, 102, 108, 2544, ".rand(60,89).", 0x0f05),
					($playerid, 102, 109, 2544, ".rand(60,89).", 0x0f05),
					($playerid, 102, 110, 2544, ".rand(60,89).", 0x0f05),
					($playerid, 102, 111, 2666, ".rand(4,6).", 0x0f05),
					($playerid, 102, 112, 1294, ".rand(20,30).", 0x0f19),
					($playerid, 102, 113, 2282, 15, '');
			");
		} else if ($vocation == 4) {//WILD
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 2554, 1, ''),
					($playerid, 106, 102, 2120, 1, ''),
					($playerid, 107, 102, 2671, ".rand(4,6).", 0x0f05),
					($playerid, 108, 102, 2666, ".rand(8,12).", 0x0f0a),
					($playerid, 109, 102, 2148, ".rand(4,6).", 0x0f05),
					($playerid, 110, 102, 2300, 20, '');
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 2482, 1, ''),
					($playerid, 3, 102, 2002, 1, ''),
					($playerid, 4, 103, 2484, 1, ''),
					($playerid, 5, 104, 2526, 1, ''),
					($playerid, 6, 105, 2395, 1, ''),
					($playerid, 7, 106, 2468, 1, ''),
					($playerid, 8, 107, 2643, 1, ''),
					($playerid, 102, 108, 2668, 1, 0x0f01),
					($playerid, 102, 109, 2671, ".rand(2,4).", 0x0f03),
					($playerid, 102, 110, 2666, ".rand(4,6).", 0x0f05),
					($playerid, 102, 111, 2282, 15, '');
			");
		} else if ($vocation == 5) {
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 2554, 1, ''),
					($playerid, 106, 102, 2120, 1, ''),
					($playerid, 107, 102, 8842, ".rand(8,12).", 0x0f0a),
					($playerid, 108, 102, 11246, ".rand(17,22).", 0x0f14),
					($playerid, 109, 102, 2148, ".rand(4,6).", 0x0f05),
					($playerid, 110, 102, 2300, 20, '');
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 12656, 1, ''),
					($playerid, 3, 102, 2003, 1, ''),
					($playerid, 4, 103, 12657, 1, ''),
					($playerid, 5, 104, 2512, 1, ''),
					($playerid, 6, 105, 2412, 1, ''),
					($playerid, 7, 106, 2468, 1, ''),
					($playerid, 8, 107, 2642, 1, ''),
					($playerid, 102, 108, 2667, ".rand(4,6).", 0x0f05),
					($playerid, 102, 109, 11246, ".rand(12,17).", 0x0f0f),
					($playerid, 102, 110, 2399, ".rand(8,12).", 0x0f0a),
					($playerid, 102, 111, 2282, 15, '');
			");
		} else if ($vocation == 6) {
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 2691, ".rand(8,12).", 0x0f0a),
					($playerid, 106, 102, 2389, ".rand(13,17).", 0x0f0f),
					($playerid, 107, 102, 2456, 1, ''),
					($playerid, 108, 102, 2554, 1, ''),
					($playerid, 109, 102, 2120, 1, ''),
					($playerid, 110, 102, 2148, ".rand(4,6).", 0x0f05);
					($playerid, 111, 102, 2658, 1, ''),
					($playerid, 112, 102, 2300, 20, '');
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 3971, 1, ''),
					($playerid, 2, 102, 2125, 1, ''),
					($playerid, 3, 103, 2000, 1, ''),
					($playerid, 4, 104, 2484, 1, ''),
					($playerid, 5, 105, 2512, 1, ''),
					($playerid, 6, 106, 2385, 1, ''),
					($playerid, 7, 107, 2468, 1, ''),
					($playerid, 8, 108, 2642, 1, ''),
					($playerid, 103, 109, 2691, ".rand(4,6).", 0x0f05),
					($playerid, 103, 110, 2389, ".rand(3,5).", 0x0f04),
					($playerid, 103, 111, 2282, 15, '');
			");
		} else if ($vocation == 7) {
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 2554, 1, ''),
					($playerid, 106, 102, 2120, 1, ''),
					($playerid, 107, 102, 2553, 1, ''),
					($playerid, 108, 102, 2787, ".rand(18,22).", 0x0f14),
					($playerid, 109, 102, 2148, ".rand(4,6).", 0x0f05);
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 2458, 1, ''),
					($playerid, 3, 102, 1988, 1, ''),
					($playerid, 4, 103, 2484, 1, ''),
					($playerid, 5, 104, 2526, 1, ''),
					($playerid, 6, 105, 2386, 1, ''),
					($playerid, 7, 106, 2468, 1, ''),
					($playerid, 8, 107, 2643, 1, ''),
					($playerid, 102, 108, 2787, ".rand(8,12).", 0x0f0a),
					($playerid, 102, 109, 2282, 15, '');
			");
		} else if ($vocation == 8) {
			$sql->Query("
				INSERT INTO `player_depotitems` (`player_id`, `sid`, `pid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 101, $city, 2589, 1, ''),
					($playerid, 102, 101, 2594, 1, ''),
					($playerid, 103, 101, 14404, 1, ''),
					($playerid, 104, 101, 14405, 1, ''),
					($playerid, 105, 102, 2680, ".rand(4,6).", 0x0f05),
					($playerid, 106, 102, 2674, ".rand(4,6).", 0x0f05),
					($playerid, 107, 102, 2685, ".rand(4,6).", 0x0f05),
					($playerid, 108, 102, 2681, 1, 0x0f01),
					($playerid, 109, 102, 2682, 1, 0x0f01),
					($playerid, 110, 102, 2678, 1, 0x0f01),
					($playerid, 111, 102, 2683, 1, ''),
					($playerid, 112, 102, 2686, 1, 0x0f01),
					($playerid, 113, 102, 2684, ".rand(4,6).", 0x0f05),
					($playerid, 114, 102, 2554, 1, ''),
					($playerid, 115, 102, 2120, 1, ''),
					($playerid, 116, 102, 2148, ".rand(4,6).", 0x0f05),
					($playerid, 117, 102, 2300, 20, '');
			");
			
			$sql->Query("
				INSERT INTO `player_items` (`player_id`, `pid`, `sid`, `itemtype`, `count`, `attributes`) VALUES
					($playerid, 1, 101, 2461, 1, ''),
					($playerid, 3, 102, 2004, 1, ''),
					($playerid, 4, 103, 8819, 1, ''),
					($playerid, 6, 104, 7735, 1, ''),
					($playerid, 7, 105, 2649, 1, ''),
					($playerid, 8, 106, 2643, 1, ''),
					($playerid, 102, 107, 2673, ".rand(4,6).", 0x0f05),
					($playerid, 102, 108, 2675, ".rand(4,6).", 0x0f05),
					($playerid, 102, 109, 2382, 1, ''),
					($playerid, 102, 110, 2260, ".rand(8,12).", 0x0f0a),
					($playerid, 102, 111, 8842, ".rand(4,6).", 0x0f05),
					($playerid, 102, 112, 2679, ".rand(8,12).", 0x0f0a),
					($playerid, 102, 113, 2162, 1, ''),
					($playerid, 102, 114, 2282, 15, '');
			");
		}
	}
} else {
	$success = FALSE;
}

callback(array(
	"success"=>$success
));
?>