-- funções de sistema
function getCid(name)
	return getPlayerByName(name);
end

function doDebug(cid, text)
	if (type(text) == "table") then
		doCreatureSay(cid, table.tostring(text), 2);
	else
		doCreatureSay(cid, tostring(text), 2);
	end
end

function table.val_to_str ( v )
  if "string" == type( v ) then
    v = string.gsub( v, "\n", "\\n" )
    if string.match( string.gsub(v,"[^'\"]",""), '^"+$' ) then
      return "'" .. v .. "'"
    end
    return '"' .. string.gsub(v,'"', '\\"' ) .. '"'
  else
    return "table" == type( v ) and table.tostring( v ) or
      tostring( v )
  end
end

function table.key_to_str ( k )
  if "string" == type( k ) and string.match( k, "^[_%a][_%a%d]*$" ) then
    return k
  else
    return "[" .. table.val_to_str( k ) .. "]"
  end
end

function table.tostring( tbl )
  local result, done = {}, {}
  for k, v in ipairs( tbl ) do
    table.insert( result, table.val_to_str( v ) )
    done[ k ] = true
  end
  for k, v in pairs( tbl ) do
    if not done[ k ] then
      table.insert( result,
        table.key_to_str( k ) .. "=" .. table.val_to_str( v ) )
    end
  end
  return "{" .. table.concat( result, " | " ) .. "}"
end

 -- função de promote
function doPromovePlayer(cid)
	if (isPlayer(cid)) then
		local promote = getPlayerPromote(cid);
		local nome = getPlayerName(cid);
		local voc = getPlayerVocation(cid);
		local sex = getPlayerSex(cid);
		
		-- elfian
		if (voc == 3 or voc == 13) then
			if (getPlayerPromoteLevel(cid) == 0) then
				doPlayerAddOutfit(cid, 62, 0);
				doPlayerAddOutfit(cid, 64, 0);
			elseif (getPlayerPromoteLevel(cid) == 1) then
				doPlayerAddOutfit(cid, 63, 0);
			end	
		-- sorcerer
		elseif (voc == 4 or voc == 14) then
			if (sex == 0 and getPlayerPromoteLevel(cid) == 0) then
				doPlayerAddOutfit(cid, 359, 0);
			elseif (sex == 1 and getPlayerPromoteLevel(cid) == 1) then
				doPlayerAddOutfit(cid, 229, 0);
			end
		-- amazon
		elseif ((voc == 6 or voc == 16) and getPlayerPromoteLevel(cid) == 1) then
			doPlayerAddOutfit(cid, 54, 0);
		elseif (voc == 7 or voc == 17) then
			if (getPlayerPromoteLevel(cid) == 0) then
				doPlayerAddOutfit(cid, 69, 0);
				doPlayerAddOutfit(cid, 71, 0);
			elseif (getPlayerPromoteLevel(cid) == 1) then
				doPlayerAddOutfit(cid, 70, 0);
			end
		-- monk
		elseif (voc == 8 or voc == 18) then
			if (getPlayerPromoteLevel(cid) == 0) then
				if (sex == 0) then
					doPlayerAddOutfit(cid, 58, 0);
				elseif (sex == 1) then
					doPlayerAddOutfit(cid, 9, 0);
				end
			elseif (getPlayerPromoteLevel(cid) == 1) then
				doPlayerAddOutfit(cid, 309, 0);
			end	
		end

		doPlayerSave(cid);
		doRemoveCreature(cid);
		db.executeQuery("UPDATE players SET vocation='" .. promote .. "' WHERE name = '" .. nome .. "'");
	end
end

 -- funções de NPC
function getPlayerVipPoints(cid)
	local result = db.getResult("SELECT nrvippoints as points FROM ttotsite.accounts_vipinformacao WHERE idaccount = '" .. getPlayerAccountId(cid) .. "'");
	if(result:getID() ~= -1) then
		return result:getDataInt("points");
	else
		return false;
	end
end

function doRemovePlayerVipPoints(cid, quantidade)
	local points = getPlayerVipPoints(cid);
	if (points ~= false) then
		points = points - quantidade;
		return db.executeQuery("UPDATE ttotsite.accounts_vipinformacao SET nrvippoints = '" .. points .. "' WHERE idaccount = '" .. getPlayerAccountId(cid) .. "'");
	else
		return false;
	end
end

function sayOnTime(text, intime)
  addEvent(function()
		selfSay(text)
  end, intime*1000)
end
 
function startConversation(msg)
	if (msg == "oi" or msg == "olá" or msg == "eae" or msg == "hi" or msg == "hello") then
		return true;
	else
		return false;
	end
end

function endConversartion(msg)
	if (msg == "tchau" or msg == "até" or msg == "bye") then
		return true;
	else
		return false;
	end
end

function isPositiveTalk(msg)
	if (msg == "yeah" or msg == "yes" or msg == "yep" or msg == "y" or msg == "sim" or msg == "s") then
		return true;
	else
		return false;
	end
end

function isNegativeTalk(msg)
	if (msg == "não" or msg == "no" or msg == "nop" or msg == "not") then
		return true;
	else
		return false;
	end
end

function askForJob(msg)
	if (msg == "mission" or msg == "job" or msg == "quest" or msg == "missão" or msg == "trabalho") then
		return true;
	else
		return false;
	end
end

 -- verificando a linguagem que o suário fala
function getPlayerLanguage(cid)
	if (getPlayerStorageValue(cid, 100) == 1) then
		return "pt-br";
	elseif (getPlayerStorageValue(cid, 100) == 2) then
		return "en-us";
	end
end

 -- converte a vocação para o nome dela
function getVocationName(vid)
	if (vid == 0) then
		return "Official";
	elseif (vid == 1) then
		return "Sorcerer";
	elseif (vid == 2) then
		return "Tribal";
	elseif (vid == 3) then
		return "Elfian";
	elseif (vid == 4) then
		return "Wild";
	elseif (vid == 5) then
		return "Ninja";
	elseif (vid == 6) then
		return "Amazon";
	elseif (vid == 7) then
		return "Dwarfian";
	elseif (vid == 8) then
		return "Monk";
	elseif (vid == 9) then
		return "Survivor";
	elseif (vid == 11) then
		return "Master Sorcerer";
	elseif (vid == 12) then
		return "Shaman";
	elseif (vid == 13) then
		return "Elder Elfian";
	elseif (vid == 14) then
		return "Viking";
	elseif (vid == 15) then
		return "Sword Master";
	elseif (vid == 16) then
		return "Valkyrie";
	elseif (vid == 17) then
		return "Dwarfian Soldier";
	elseif (vid == 18) then
		return "Cleric";
	elseif (vid == 19) then
		return "Gunner";
	elseif (vid == 21) then
		return "Ancient Sorcerer";
	elseif (vid == 22) then
		return "Forester";
	elseif (vid == 23) then
		return "Legendary Elfian";
	elseif (vid == 24) then
		return "Gross Viking";
	elseif (vid == 25) then
		return "Shadow";
	elseif (vid == 26) then
		return "Witch";
	elseif (vid == 27) then
		return "Dwarfian Warrior";
	elseif (vid == 28) then
		return "Illuminated";
	elseif (vid == 29) then
		return "Mercenary";
	elseif (vid == 101) then
		return "Slave";
	elseif (vid == 102) then
		return "Lord";
	end
end

function getPlayerPromoteLevel(cid)
	return getVocationPromoteLevel(getPlayerVocation(cid));
end

function getVocationPromoteLevel(vid)
	if (vid == 1 or vid == 2 or vid == 3 or vid == 4 or vid == 5 or vid == 6 or vid == 7 or vid == 8 or vid == 9 or vid == 10) then
		return 0;
	elseif (vid == 11 or vid == 12 or vid == 13 or vid == 14 or vid == 15 or vid == 16 or vid == 17 or vid == 18 or vid == 19 or vid == 20) then
		return 1;
	elseif (vid == 21 or vid == 22 or vid == 23 or vid == 24 or vid == 25 or vid == 26 or vid == 27 or vid == 28 or vid == 29 or vid == 30 or vid == 101 or vid == 102) then
		return 2;
	end
end

function getVocationPromote(vid)
	if (vid == 1) then
		return 11;
	elseif (vid == 2) then
		return 12;
	elseif (vid == 3) then
		return 13;
	elseif (vid == 4) then
		return 14;
	elseif (vid == 5) then
		return 15;
	elseif (vid == 6) then
		return 16;
	elseif (vid == 7) then
		return 17;
	elseif (vid == 8) then
		return 18;
	elseif (vid == 9) then
		return 19;
	elseif (vid == 10) then
		return 20;
	elseif (vid == 11) then
		return 21;
	elseif (vid == 12) then
		return 22;
	elseif (vid == 13) then
		return 23;
	elseif (vid == 14) then
		return 24;
	elseif (vid == 15) then
		return 25;
	elseif (vid == 16) then
		return 26;
	elseif (vid == 17) then
		return 27;
	elseif (vid == 18) then
		return 28;
	elseif (vid == 19) then
		return 29;
	elseif (vid == 20) then
		return 30;
	else 
		return 0;
	end
end

function getPlayerPromote(cid)
	return getVocationPromote(getPlayerVocation(cid));
end

 -- verificando se uma posição esta do lado de outra
function isNext(pos1, pos2)
	if (pos1.z == pos2.z) then
		if (pos1.x == pos2.x or pos1.x == pos2.x - 1 or pos1.x == pos2.x + 1) then
			if (pos1.y == pos2.y or pos1.y == pos2.y - 1 or pos1.y == pos2.y + 1) then
				return true;
			else
				return false;
			end
		else
			return false;
		end
	else
		return false;
	end
end

function isInArray(array, value, caseSensitive)
	if (caseSensitive == nil or caseSensitive == false) and type(value) == "string" then
		local lowerValue = value:lower()
		for _, _value in ipairs(array) do
			if type(_value) == "string" and lowerValue == _value:lower() then
				return true
			end
		end
	else
		for _, _value in ipairs(array) do
			if (value == _value) then return true end
		end
	end
	return false
end

function doPlayerGiveItem(cid, itemid, amount, subType)
	local item = 0
	if(isItemStackable(itemid)) then
		item = doCreateItemEx(itemid, amount)
		if(doPlayerAddItemEx(cid, item, true) ~= RETURNVALUE_NOERROR) then
			return false
		end
	else
		for i = 1, amount do
			item = doCreateItemEx(itemid, subType)
			if(doPlayerAddItemEx(cid, item, true) ~= RETURNVALUE_NOERROR) then
				return false
			end
		end
	end

	return true
end

function doPlayerGiveItemContainer(cid, containerid, itemid, amount, subType)
	for i = 1, amount do
		local container = doCreateItemEx(containerid, 1)
		for x = 1, getContainerCapById(containerid) do
			doAddContainerItem(container, itemid, subType)
		end

		if(doPlayerAddItemEx(cid, container, true) ~= RETURNVALUE_NOERROR) then
			return false
		end
	end

	return true
end

function doPlayerTakeItem(cid, itemid, amount)
	return getPlayerItemCount(cid, itemid) >= amount and doPlayerRemoveItem(cid, itemid, amount)
end

function doPlayerSellItem(cid, itemid, count, cost)
	if(not doPlayerTakeItem(cid, itemid, count)) then
		return false
	end

	if(not doPlayerAddMoney(cid, cost)) then
		error('[doPlayerSellItem] Could not add money to: ' .. getPlayerName(cid) .. ' (' .. cost .. 'gp).')
	end

	return true
end

function doPlayerWithdrawMoney(cid, amount)
	if(not getBooleanFromString(getConfigInfo('bankSystem'))) then
		return false
	end

	local balance = getPlayerBalance(cid)
	if(amount > balance or not doPlayerAddMoney(cid, amount)) then
		return false
	end

	doPlayerSetBalance(cid, balance - amount)
	return true
end

function doPlayerDepositMoney(cid, amount)
	if(not getBooleanFromString(getConfigInfo('bankSystem'))) then
		return false
	end

	if(not doPlayerRemoveMoney(cid, amount)) then
		return false
	end

	doPlayerSetBalance(cid, getPlayerBalance(cid) + amount)
	return true
end

function doPlayerAddStamina(cid, minutes)
	return doPlayerSetStamina(cid, getPlayerStamina(cid) + minutes)
end

function isPremium(cid)
	return (isPlayer(cid) and (getPlayerPremiumDays(cid) > 0 or getBooleanFromString(getConfigValue('freePremium'))))
end

function getMonthDayEnding(day)
	if(day == "01" or day == "21" or day == "31") then
		return "st"
	elseif(day == "02" or day == "22") then
		return "nd"
	elseif(day == "03" or day == "23") then
		return "rd"
	end

	return "th"
end

function getMonthString(m)
	return os.date("%B", os.time{year = 1970, month = m, day = 1})
end

function getArticle(str)
	return str:find("[AaEeIiOoUuYy]") == 1 and "an" or "a"
end

function doNumberFormat(i)
	local str, found = string.gsub(i, "(%d)(%d%d%d)$", "%1,%2", 1), 0
	repeat
		str, found = string.gsub(str, "(%d)(%d%d%d),", "%1,%2,", 1)
	until found == 0
	return str
end

function doPlayerAddAddons(cid, addon)
	for i = 0, table.maxn(maleOutfits) do
		doPlayerAddOutfit(cid, maleOutfits[i], addon)
	end

	for i = 0, table.maxn(femaleOutfits) do
		doPlayerAddOutfit(cid, femaleOutfits[i], addon)
	end
end

function getTibiaTime(num)
	local minutes, hours = getWorldTime(), 0
	while (minutes > 60) do
		hours = hours + 1
		minutes = minutes - 60
	end

	if(num) then
		return {hours = hours, minutes = minutes}
	end

	return {hours =  hours < 10 and '0' .. hours or '' .. hours, minutes = minutes < 10 and '0' .. minutes or '' .. minutes}
end

function doWriteLogFile(file, text)
	local f = io.open(file, "a+")
	if(not f) then
		return false
	end

	f:write("[" .. os.date("%d/%m/%Y %H:%M:%S") .. "] " .. text .. "\n")
	f:close()
	return true
end

function getExperienceForLevel(lv)
	lv = lv - 1
	return ((50 * lv * lv * lv) - (150 * lv * lv) + (400 * lv)) / 3
end

function doMutePlayer(cid, time)
	local condition = createConditionObject(CONDITION_MUTED, (time == -1 and time or time * 1000))
	return doAddCondition(cid, condition, false)

end

function doSummonCreature(name, pos)
	local cid = doCreateMonster(name, pos, false, false)
	if(not cid) then
		cid = doCreateNpc(name, pos)
	end

	return cid
end

function getPlayersOnlineEx()
	local players = {}
	for i, cid in ipairs(getPlayersOnline()) do
		table.insert(players, getCreatureName(cid))
	end

	return players
end

function getPlayerByName(name)
	local cid = getCreatureByName(name)
	return isPlayer(cid) and cid or nil
end

function isPlayer(cid)
	return isCreature(cid) and cid >= AUTOID_PLAYERS and cid < AUTOID_MONSTERS
end

function isPlayerGhost(cid)
	return isPlayer(cid) and (getCreatureCondition(cid, CONDITION_GAMEMASTER, GAMEMASTER_INVISIBLE, CONDITIONID_DEFAULT) or getPlayerFlagValue(cid, PLAYERFLAG_CANNOTBESEEN))
end

function isMonster(cid)
	return isCreature(cid) and cid >= AUTOID_MONSTERS and cid < AUTOID_NPCS
end

function isNpc(cid)
	-- Npc IDs are over int32_t range (which is default for lua_pushnumber),
	-- therefore number is always a negative value.
	return isCreature(cid) and (cid < 0 or cid >= AUTOID_NPCS)
end

function isUnderWater(cid)
	return isInArray(underWater, getTileInfo(getCreaturePosition(cid)).itemid)
end

function doPlayerAddLevel(cid, amount, round)
	local experience, level, amount = 0, getPlayerLevel(cid), amount or 1
	if(amount > 0) then
		experience = getExperienceForLevel(level + amount) - (round and getPlayerExperience(cid) or getExperienceForLevel(level))
	else
		experience = -((round and getPlayerExperience(cid) or getExperienceForLevel(level)) - getExperienceForLevel(level + amount))
	end

	return doPlayerAddExperience(cid, experience)
end

function doPlayerAddMagLevel(cid, amount)
	local amount = amount or 1
	for i = 1, amount do
		doPlayerAddSpentMana(cid, getPlayerRequiredMana(cid, getPlayerMagLevel(cid, true) + 1) - getPlayerSpentMana(cid), false)
	end

	return true
end

function doPlayerAddSkill(cid, skill, amount, round)
	local amount = amount or 1
	if(skill == SKILL__LEVEL) then
		return doPlayerAddLevel(cid, amount, round)
	elseif(skill == SKILL__MAGLEVEL) then
		return doPlayerAddMagLevel(cid, amount)
	end

	for i = 1, amount do
		doPlayerAddSkillTry(cid, skill, getPlayerRequiredSkillTries(cid, skill, getPlayerSkillLevel(cid, skill) + 1) - getPlayerSkillTries(cid, skill), false)
	end

	return true
end

function isPrivateChannel(channelId)
	return channelId >= CHANNEL_PRIVATE
end

function doBroadcastMessage(text, class)
	local class = class or MESSAGE_STATUS_WARNING
	if(type(class) == 'string') then
		local className = MESSAGE_TYPES[class]
		if(className == nil) then
			return false
		end

		class = className
	elseif(class < MESSAGE_FIRST or class > MESSAGE_LAST) then
		return false
	end

	for _, pid in ipairs(getPlayersOnline()) do
		doPlayerSendTextMessage(pid, class, text)
	end

	print("> Broadcasted message: \"" .. text .. "\".")
	return true
end

function doPlayerBroadcastMessage(cid, text, class, checkFlag, ghost)
	local checkFlag, ghost, class = checkFlag or true, ghost or false, class or TALKTYPE_BROADCAST
	if(checkFlag and not getPlayerFlagValue(cid, PLAYERFLAG_CANBROADCAST)) then
		return false
	end

	if(type(class) == 'string') then
		local className = TALKTYPE_TYPES[class]
		if(className == nil) then
			return false
		end

		class = className
	elseif(class < TALKTYPE_FIRST or class > TALKTYPE_LAST) then
		return false
	end

	for _, pid in ipairs(getPlayersOnline()) do
		doCreatureSay(cid, text, class, ghost, pid)
	end

	print("> " .. getCreatureName(cid) .. " broadcasted message: \"" .. text .. "\".")
	return true
end

function doCopyItem(item, attributes)
	local attributes = ((type(attributes) == 'table') and attributes or { "aid" })

	local ret = doCreateItemEx(item.itemid, item.type)
	for _, key in ipairs(attributes) do
		local value = getItemAttribute(item.uid, key)
		if(value ~= nil) then
			doItemSetAttribute(ret, key, value)
		end
	end

	if(isContainer(item.uid)) then
		for i = (getContainerSize(item.uid) - 1), 0, -1 do
			local tmp = getContainerItem(item.uid, i)
			if(tmp.itemid > 0) then
				doAddContainerItemEx(ret, doCopyItem(tmp, true).uid)
			end
		end
	end

	return getThing(ret)
end

function doSetItemText(uid, text, writer, date)
	local thing = getThing(uid)
	if(thing.itemid < 100) then
		return false
	end

	doItemSetAttribute(uid, "text", text)
	if(writer ~= nil) then
		doItemSetAttribute(uid, "writer", tostring(writer))
		if(date ~= nil) then
			doItemSetAttribute(uid, "date", tonumber(date))
		end
	end

	return true
end

function getItemWeightById(itemid, count, precision)
	local item, count, precision = getItemInfo(itemid), count or 1, precision or false
	if(not item) then
		return false
	end

	if(count > 100) then
		-- print a warning, as its impossible to have more than 100 stackable items without "cheating" the count
		print('[Warning] getItemWeightById', 'Calculating weight for more than 100 items!')
	end

	local weight = item.weight * count
	return precission and weight or math.round(weight, 2)
end

function choose(...)
	local arg = {...}
	return arg[math.random(1, table.maxn(arg))]
end

function doPlayerAddExpEx(cid, amount)
	if(not doPlayerAddExp(cid, amount)) then
		return false
	end

	local position = getThingPosition(cid)
	doPlayerSendTextMessage(cid, MESSAGE_EXPERIENCE, "You gained " .. amount .. " experience.", amount, COLOR_WHITE, position)

	local spectators, name = getSpectators(position, 7, 7), getCreatureName(cid)
	for _, pid in ipairs(spectators) do
		if(isPlayer(pid) and cid ~= pid) then
			doPlayerSendTextMessage(pid, MESSAGE_EXPERIENCE_OTHERS, name .. " gained " .. amount .. " experience.", amount, COLOR_WHITE, position)
		end
	end

	return true
end

function getItemTopParent(uid)
	local parent = getItemParent(uid)
	if(not parent or parent.uid == 0) then
		return nil
	end

	while(true) do
		local tmp = getItemParent(parent.uid)
		if(tmp and tmp.uid ~= 0) then
			parent = tmp
		else
			break
		end
	end

	return parent
end

function getItemHolder(uid)
	local parent = getItemParent(uid)
	if(not parent or parent.uid == 0) then
		return nil
	end

	local holder = nil
	while(true) do
		local tmp = getItemParent(parent.uid)
		if(tmp and tmp.uid ~= 0) then
			if(tmp.itemid == 1) then -- a creature
				holder = tmp
				break
			end

			parent = tmp
		else
			break
		end
	end

	return holder
end

function valid(f)
	return function(p, ...)
		if(isCreature(p)) then
			return f(p, ...)
		end
	end
end
