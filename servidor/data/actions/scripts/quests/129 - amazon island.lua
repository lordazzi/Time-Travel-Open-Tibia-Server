function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 129;

	itemweight = getItemWeightById(5927, 1);
	itemweight = itemweight + getItemWeightById(13872, 1);
	itemweight = itemweight + getItemWeightById(2144, 10);
	itemweight = itemweight + getItemWeightById(13546, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full pirate bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 5927);
			doAddContainerItem(bag, 13872);
			doAddContainerItem(bag, 2144, 10);
			doAddContainerItem(bag, 13546);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full pirate bag, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end