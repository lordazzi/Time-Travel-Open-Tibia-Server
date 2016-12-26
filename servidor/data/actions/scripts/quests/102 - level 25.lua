function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 102;
	-- item = 3982, 2527, 7618x25, 7620x25, 2152x15, 2300x50, 2282x50
	itemweight = getItemWeightById(1987, 1);
	itemweight = itemweight + getItemWeightById(3982, 1);
	itemweight = itemweight + getItemWeightById(2527, 1);
	itemweight = itemweight + getItemWeightById(7618, 25);
	itemweight = itemweight + getItemWeightById(7620, 25);
	itemweight = itemweight + getItemWeightById(2152, 15);
	itemweight = itemweight + getItemWeightById(2300, 50);
	itemweight = itemweight + getItemWeightById(2282, 50);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1987);
			doAddContainerItem(bag, 3982);
			doAddContainerItem(bag, 2527);
			doAddContainerItem(bag, 7618, 25);
			doAddContainerItem(bag, 7620, 25);
			doAddContainerItem(bag, 2152, 15);
			doAddContainerItem(bag, 2300, 50);
			doAddContainerItem(bag, 2282, 50);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a bag, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end