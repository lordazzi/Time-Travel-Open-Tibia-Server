function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 144;

	itemweight = getItemWeightById(1988, 1);
	itemweight = itemweight + getItemWeightById(2460, 1);
	itemweight = itemweight + getItemWeightById(2465, 1);
	itemweight = itemweight + getItemWeightById(2478, 1);
	itemweight = itemweight + getItemWeightById(2511, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a brass set.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 1988);
			doAddContainerItem(bag, 2460, 1);
			doAddContainerItem(bag, 2465, 1);
			doAddContainerItem(bag, 2478, 1);
			doAddContainerItem(bag, 2511, 1);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a brass set, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end