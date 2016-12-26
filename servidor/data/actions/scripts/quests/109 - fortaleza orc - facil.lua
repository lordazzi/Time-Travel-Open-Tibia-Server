function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 109;
	-- item = 1987, 2411, 2434, 2407
	itemweight = getItemWeightById(1987, 1);
	itemweight = itemweight + getItemWeightById(2411, 1);
	itemweight = itemweight + getItemWeightById(2434, 1);
	itemweight = itemweight + getItemWeightById(2407, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1987);
			doAddContainerItem(bag, 2411);
			doAddContainerItem(bag, 2434);
			doAddContainerItem(bag, 2407);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end