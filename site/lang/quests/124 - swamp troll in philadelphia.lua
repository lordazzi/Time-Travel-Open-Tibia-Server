function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 124;
	-- item = 1991, 2411, 2545x60, 2269x15, 2289x5, 2170
	itemweight = getItemWeightById(1991, 1);
	itemweight = itemweight + getItemWeightById(2545, 15);
	itemweight = itemweight + getItemWeightById(2269, 1);
	itemweight = itemweight + getItemWeightById(2289, 1);
	itemweight = itemweight + getItemWeightById(2170, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full green bag.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1991);
			doAddContainerItem(bag, 2411);
			doAddContainerItem(bag, 2545, 60);
			doAddContainerItem(bag, 2269, 15);
			doAddContainerItem(bag, 2289, 5);
			doAddContainerItem(bag, 2170);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full green bag, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end