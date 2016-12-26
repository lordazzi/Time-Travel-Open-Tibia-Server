function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 122;
	-- item = 5801, 7588x5, 7589x5, 2149, 2150, 2147, 2146, 9930x10
	itemweight = getItemWeightById(5801, 1);
	itemweight = itemweight + getItemWeightById(7588, 5);
	itemweight = itemweight + getItemWeightById(7589, 5);
	itemweight = itemweight + getItemWeightById(2149, 1);
	itemweight = itemweight + getItemWeightById(2150, 1);
	itemweight = itemweight + getItemWeightById(2147, 1);
	itemweight = itemweight + getItemWeightById(2146, 1);
	itemweight = itemweight + getItemWeightById(9930, 10);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a jewelled backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 5801);
			doAddContainerItem(bag, 7588);
			doAddContainerItem(bag, 7589);
			doAddContainerItem(bag, 2149);
			doAddContainerItem(bag, 2150);
			doAddContainerItem(bag, 2147);
			doAddContainerItem(bag, 2146);
			doAddContainerItem(bag, 9930, 10);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a jewelled backpack, it weights " .. itemweight .. "oz, you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end