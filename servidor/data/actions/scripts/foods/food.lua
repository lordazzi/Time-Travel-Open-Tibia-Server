local FOODS, MAX_FOOD = {
	[2159] = {5, "Nhoc"}, [2220] = {20, "Nham... !"}, [2222] = {8, "Smack"}, [2223] = {12, "Smack"},
	[2235] = {12, "Smack."}, [2241] = {120, "Nhoc."}, [2243] = {18, "Nhoc."},
	[2328] = {84, "Gulp."},  [2362] = {48, "Yum."}, [2666] = {180, "Munch."}, [2667] = {144, "Munch."},
	[2668] = {120, "Mmmm."}, [2669] = {204, "Munch."}, [2670] = {48, "Gulp."}, [2671] = {360, "Chomp."},
	[2672] = {720, "Chomp."}, [2673] = {60, "Yum."}, [2674] = {72, "Yum."}, [2675] = {156, "Yum."},
	[2676] = {96, "Yum."}, [2677] = {12, "Yum."}, [2678] = {216, "Slurp."}, [2679] = {12, "Yum."},
	[2680] = {24, "Yum."}, [2681] = {108, "Yum."}, [2682] = {240, "Yum."}, [2683] = {204, "Munch."},
	[2684] = {60, "Crunch."}, [2685] = {72, "Munch."}, [2686] = {108, "Crunch."}, [2687] = {24, "Crunch."},
	[2688] = {24, "Mmmm."}, [2689] = {120, "Crunch."}, [2690] = {72, "Crunch."}, [2691] = {96, "Crunch."},
	[2695] = {72, "Gulp."}, [2696] = {108, "Smack."}, [8112] = {108, "Urgh."}, [2769] = {60, "Crunch."}, [2787] = {108, "Crunch."},
	[2788] = {48, "Munch."}, [2789] = {264, "Munch."}, [2790] = {360, "Crunch."}, [2791] = {108, "Crunch."},
	[2792] = {72, "Crunch."}, [2793] = {144, "Crunch."}, [2794] = {36, "Crunch."}, [2795] = {432, "Crunch."},
	[2796] = {300, "Crunch."}, [5097] = {48, "Yum."}, [5678] = {96, "Gulp."}, [6125] = {96, "Mmmm."},
	[6278] = {120, "Mmmm."}, [6279] = {180, "Mmmm."}, [6393] = {144, "Mmmm."}, [6394] = {180, "Mmmm."},
	[6501] = {240, "Mmmm."}, [6541] = {72, "Gulp."}, [6542] = {72, "Gulp."}, [6543] = {72, "Gulp."},
	[6544] = {72, "Gulp."}, [6545] = {72, "Gulp."}, [6569] = {12, "Mmmm."}, [6574] = {60, "Mmmm."},
	[7158] = {300, "Munch."}, [7159] = {180, "Munch."}, [7245] = {84, "Munch."}, [7372] = {1, "Slurp."},
	[7373] = {1, "Slurp."}, [7374] = {1, "Slurp."},  [7375] = {1, "Slurp."}, [7376] = {1, "Slurp."},
	[7377] = {1, "Slurp."}, [7963] = {720, "Munch."},  [8838] = {120, "Gulp."}, [8839] = {60, "Yum."},
	[8840] = {12, "Yum."}, [8841] = {12, "Urgh."}, [8842] = {84, "Munch."}, [8843] = {60, "Crunch."},
	[8844] = {12, "Gulp."}, [8845] = {60, "Munch."}, [8847] = {132, "Yum."}, [9005] = {88, "Slurp."},
	[9114] = {60, "Crunch."}, [9996] = {1, "Slurp."}, [10454] = {1, "Your head begins to feel better."},
	[11246] = {310, "Yum."}, [11429] = {150, "Mmmm."}, [12415] = {360, "Yum."}, [12416] = {130, "Munch."},
	[12417] = {60, "Crunch."}, [12418] = {80, "Crunch."}, [12637] = {510, "Gulp."}, [12638] = {260, "Yum."},
	[12639] = {18, "Munch."}, [18397] = {396, "Munch."}
}, 1200

function onUse(cid, item, fromPosition, itemEx, toPosition)
	if(item.itemid == 6280) then
		if(fromPosition.x == CONTAINER_POSITION) then
			fromPosition = getThingPosition(cid)
		end

		doCreatureSay(cid, getPlayerName(cid) .. " blew out the candle.", TALKTYPE_MONSTER)
		doTransformItem(item.uid, item.itemid - 1)

		doSendMagicEffect(fromPosition, CONST_ME_POFF)
		return true
	end

	local food = FOODS[item.itemid]
	if(food == nil) then
		return false
	end

	local size = food[1]
	if(getPlayerFood(cid) + size > MAX_FOOD) then
		doPlayerSendCancel(cid, "You are full.")
		return true
	end

	doPlayerFeed(cid, size);
	doRemoveItem(item.uid, 1);
	local playerPos = getCreaturePosition(cid);
	if (item.itemid == 2668) then
		splash = doCreateItem(2018, 25, playerPos) -- saliva
		doDecayItem(splash)
	elseif (item.itemid == 2235 or item.itemid == 8112) then
		splash = doCreateItem(2018, 2, playerPos) -- sangue D:
		doDecayItem(splash)
	elseif (item.itemid == 6393) then -- valentine cake ;D
		doSendMagicEffect(playerPos, 35)
	elseif (item.itemid == 2795 or item.itemid == 8844) then -- fire mushroom e red pepper
		doSendMagicEffect(playerPos, 15)
		doCreatureAddHealth(cid, -5)
	end

	doCreatureSay(cid, food[2], TALKTYPE_MONSTER)
	return true
end