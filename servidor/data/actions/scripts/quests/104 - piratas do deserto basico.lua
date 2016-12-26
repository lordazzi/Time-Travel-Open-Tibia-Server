function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 104;
	-- item = 5926, 5462, 2413
	itemweight = getItemWeightById(5926, 1);
	itemweight = itemweight + getItemWeightById(5462, 1);
	itemweight = itemweight + getItemWeightById(2413, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a pirate backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 5926);
			doAddContainerItem(bag, 5462);
			doAddContainerItem(bag, 2413);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a pirate backpack, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end