function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 134;

	itemweight = getItemWeightById(9774, 1);
	itemweight = itemweight + getItemWeightById(2280, 1);
	itemweight = itemweight + getItemWeightById(2276, 5);
	itemweight = itemweight + getItemWeightById(2270, 10);
	itemweight = itemweight + getItemWeightById(2268, 5);
	itemweight = itemweight + getItemWeightById(2303, 5);
	itemweight = itemweight + getItemWeightById(2265, 10);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full brocade backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 9774);
			doAddContainerItem(bag, 2280, 1);
			doAddContainerItem(bag, 2276, 5);
			doAddContainerItem(bag, 2270, 10);
			doAddContainerItem(bag, 2268, 5);
			doAddContainerItem(bag, 2303, 3);
			doAddContainerItem(bag, 2265, 10);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full brocade backpack, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end