function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 141;

	itemweight = getItemWeightById(10522, 1);
	itemweight = itemweight + getItemWeightById(2487, 1);
	itemweight = itemweight + getItemWeightById(2477, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full crown backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 10522);
			doAddContainerItem(bag, 2487, 1);
			doAddContainerItem(bag, 2477, 1);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full crown backpack, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end