function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 105;
	-- item = 11244, 2647, 7618x10, 7620x10
	itemweight = getItemWeightById(11244, 1);
	itemweight = itemweight + getItemWeightById(2647, 1);
	itemweight = itemweight + getItemWeightById(7618, 10);
	itemweight = itemweight + getItemWeightById(7620, 10);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a bull backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 11244);
			doAddContainerItem(bag, 2647);
			doAddContainerItem(bag, 7618, 10);
			doAddContainerItem(bag, 7620, 10);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a bull backpack, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end