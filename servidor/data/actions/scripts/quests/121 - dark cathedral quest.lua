function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 121;
	-- item = 1996, 5908, 5941, 2402, 2145x10
	itemweight = getItemWeightById(1996, 1);
	itemweight = itemweight + getItemWeightById(5908, 1);
	itemweight = itemweight + getItemWeightById(5941, 1);
	itemweight = itemweight + getItemWeightById(2402, 1);
	itemweight = itemweight + getItemWeightById(2145, 10);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 10519);
			doAddContainerItem(bag, 5908);
			doAddContainerItem(bag, 5941);
			doAddContainerItem(bag, 2402);
			doAddContainerItem(bag, 2145, 10);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bag, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end