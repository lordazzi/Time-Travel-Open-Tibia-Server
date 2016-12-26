function nameArtibleAdjuster(killer)
	killer_name = getCreatureName(killer);
	if (not (isPlayer(killer) or getCreatureName(killer) == "Nemesis" or getCreatureName(killer) == "Black Face Ox" or getCreatureName(killer) == "Curupira" or getCreatureName(killer) == "Caipora" or getCreatureName(killer) == "Celeste" or getCreatureName(killer) == "Supreme Tirano")) then
		local first = string.sub(killer_name, 0, 1);
		if (first == "a" or first == "e" or first == "i" or first == "o" or first == "u") then
			killer_name = "an " .. killer_name
		else
			killer_name = "a " .. killer_name
		end
	end
	return killer_name;
end

function killers2string(killers_table)
	local new_table = {};
	for i, j in ipairs(killers_table) do
		new_table[i] = nameArtibleAdjuster(j);
	end
	
	return table.concat(new_table, ", ");
end

function onDeath(cid, corpse, killer)
	-- Quando o player morre
	if (isPlayer(cid) == true) then
		if (type(killer) == "table") then
			doItemSetAttribute(doAddContainerItem(corpse.uid, 11076), "description", "You see " .. getPlayerName(cid) .. "'s skull. He was killed by " .. killers2string(killer) .. ". " .. os.date("%d/%m/%Y %X", os.time() - 25635));
		else
			doItemSetAttribute(doAddContainerItem(corpse.uid, 11076), "description", "You see " .. getPlayerName(cid) .. "'s skull. He was killed by " .. getCreatureName(killer) .. ". " .. os.date("%d/%m/%Y %X", os.time() - 25635));
		end
	end
	return true;
end
