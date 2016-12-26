function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 116;
	-- item = 1987, 2166, 1294x30, 2667x15, 2409
	itemweight = getItemWeightById(1987, 1);
	itemweight = itemweight + getItemWeightById(2166, 1);
	itemweight = itemweight + getItemWeightById(1294, 30);
	itemweight = itemweight + getItemWeightById(2667, 15);
	itemweight = itemweight + getItemWeightById(2409, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1987);
			doAddContainerItem(bag, 2166);
			doAddContainerItem(bag, 1294, 30);
			doAddContainerItem(bag, 2667, 15);
			doAddContainerItem(bag, 2409);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end