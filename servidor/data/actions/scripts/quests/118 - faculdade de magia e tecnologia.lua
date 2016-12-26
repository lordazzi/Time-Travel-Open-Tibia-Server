function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 118;
	-- item = 7343, 7620x10, 7618x10, 2202, 2152x10, 9930x5
	itemweight = getItemWeightById(7343, 1);
	itemweight = itemweight + getItemWeightById(7620, 10);
	itemweight = itemweight + getItemWeightById(7618, 10);
	itemweight = itemweight + getItemWeightById(2202, 1);
	itemweight = itemweight + getItemWeightById(2152, 10);
	itemweight = itemweight + getItemWeightById(9930, 5);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 7343);
			doAddContainerItem(bag, 7620, 10);
			doAddContainerItem(bag, 7618, 10);
			doAddContainerItem(bag, 2202, 1);
			doAddContainerItem(bag, 2152, 10);
			doAddContainerItem(bag, 9930, 5);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end