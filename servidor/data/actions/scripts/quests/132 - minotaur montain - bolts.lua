function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 132;

	itemweight = getItemWeightById(11244, 1);
	itemweight = itemweight + getItemWeightById(2543, 100);
	itemweight = itemweight + getItemWeightById(2547, 50);
	itemweight = itemweight + getItemWeightById(6529, 50);
	itemweight = itemweight + getItemWeightById(5878, 30);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bull backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 11244);
			doAddContainerItem(bag, 2543, 100);
			doAddContainerItem(bag, 2547, 50);
			doAddContainerItem(bag, 6529, 50);
			doAddContainerItem(bag, 5878, 30);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full bull backpack, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end