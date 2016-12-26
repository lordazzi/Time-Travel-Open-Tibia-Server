function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 112;
	-- item = 10519, 2488, 2300x10, 2152x15
	itemweight = getItemWeightById(10519, 1);
	itemweight = itemweight + getItemWeightById(2488, 1);
	itemweight = itemweight + getItemWeightById(2300, 10);
	itemweight = itemweight + getItemWeightById(2152, 15);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found an orange backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 10519);
			doAddContainerItem(bag, 2488);
			doAddContainerItem(bag, 2300, 10);
			doAddContainerItem(bag, 2152, 15);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found an orange backpack, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end