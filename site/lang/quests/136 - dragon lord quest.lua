function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 136;

	itemweight = getItemWeightById(1993, 1);
	itemweight = itemweight + getItemWeightById(2152, 10);
	itemweight = itemweight + getItemWeightById(2201, 1);
	itemweight = itemweight + getItemWeightById(2195, 1);
	itemweight = itemweight + getItemWeightById(2191, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full red bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1993);
			doAddContainerItem(bag, 2152, 10);
			doAddContainerItem(bag, 2201, 1);
			doAddContainerItem(bag, 2195, 1);
			doAddContainerItem(bag, 2191, 1);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full red bag, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end