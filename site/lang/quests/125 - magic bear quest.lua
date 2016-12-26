function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 125;
	-- item = 3939, 5896, 5902, 2271x5, 2279x5, 2287x5, 2303x5
	itemweight = getItemWeightById(3939, 1);
	itemweight = itemweight + getItemWeightById(5896, 1);
	itemweight = itemweight + getItemWeightById(5902, 1);
	itemweight = itemweight + getItemWeightById(2271, 5);
	itemweight = itemweight + getItemWeightById(2279, 5);
	itemweight = itemweight + getItemWeightById(2287, 5);
	itemweight = itemweight + getItemWeightById(2303, 5);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full camouflage bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 3939);
			doAddContainerItem(bag, 5896);
			doAddContainerItem(bag, 5902);
			doAddContainerItem(bag, 2271, 5);
			doAddContainerItem(bag, 2279, 5);
			doAddContainerItem(bag, 2287, 5);
			doAddContainerItem(bag, 2303, 5);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a camouflage bag, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end