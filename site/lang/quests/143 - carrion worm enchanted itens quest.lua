function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 143;

	itemweight = getItemWeightById(1987, 1);
	itemweight = itemweight + getItemWeightById(7859, 1);
	itemweight = itemweight + getItemWeightById(7763, 1);
	itemweight = itemweight + getItemWeightById(7754, 1);
	
	-- verificando se o jogador j� pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag.");
			-- considerando o items j� pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1987);
			doAddContainerItem(bag, 7859, 1);
			doAddContainerItem(bag, 7763, 1);
			doAddContainerItem(bag, 7754, 1);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end