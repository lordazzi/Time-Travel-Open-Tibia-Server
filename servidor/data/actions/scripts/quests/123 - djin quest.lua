function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 123;
	-- item = 5801, 2152x15, 2451, 2156, 2289x5, 2158
	itemweight = getItemWeightById(5801, 1);
	itemweight = itemweight + getItemWeightById(2152, 15);
	itemweight = itemweight + getItemWeightById(2451, 1);
	itemweight = itemweight + getItemWeightById(2156, 1);
	itemweight = itemweight + getItemWeightById(2158, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full full jewelled backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 5801);
			doAddContainerItem(bag, 2152, 15);
			doAddContainerItem(bag, 2451);
			doAddContainerItem(bag, 2156);
			doAddContainerItem(bag, 2158);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full jewelled backpack, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end