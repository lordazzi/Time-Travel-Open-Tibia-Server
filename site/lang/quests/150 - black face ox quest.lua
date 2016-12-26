function onUse(cid, item, fromPosition, itemEx, toPosition)
	actionid = 150;

	itemweight = getItemWeightById(10518, 1);
	itemweight = itemweight + getItemWeightById(2462, 1);
	itemweight = itemweight + getItemWeightById(2160, 1);
	itemweight = itemweight + getItemWeightById(2152, 50);
	itemweight = itemweight + getItemWeightById(2633, 1);
	
	-- verificando se o jogador já pegou o item antes
	if (getPlayerStorageValue(cid, actionid) < 1) then
		-- se o peso do item for menor ou igual a quantidade de capacidade livre do jogador
		if (itemweight <= getPlayerFreeCap(cid)) then
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full Black Face Ox's backpack.");
			-- considerando o items já pego
			doPlayerSetStorageValue(cid, actionid, 1);
			-- adicionando items
			local bag = doPlayerAddItem(cid, 10522);
			doAddContainerItem(bag, 2462, 1);
			doAddContainerItem(bag, 2160, 1);
			doAddContainerItem(bag, 2152, 50);
			doAddContainerItem(bag, 2633, 1);
		else
			doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "You have found a full Black Face Ox's backpack, it weights " .. itemweight .. ", you have not cap.")
		end
	else
		doPlayerSendTextMessage(cid, MESSAGE_INFO_DESCR, "It is empty.")
	end
	return true
end